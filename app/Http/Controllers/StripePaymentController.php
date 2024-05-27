<?php

namespace App\Http\Controllers;


use App\Models\Coupon;
use App\Models\Order;
use App\Models\Plan;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function index()
    {
        $objUser = \Auth::user();
        if (\Auth::user()->type == 'super admin') {
            $orders  = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->orderBy('orders.created_at', 'DESC')->get();

            return view('order.index', compact('orders'));
        } elseif (\Auth::user()->type == 'company') {
            $objUser = \Auth::user();
            $orders  = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->where('user_id', $objUser->id)->orderBy('orders.created_at', 'DESC')->get();

            return view('order.index', compact('orders'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function stripe($code)
    {
        $admin_payment_setting = Utility::getAdminPaymentSetting();
        if (
            isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_manually_enabled'] == 'on'
            || $admin_payment_setting['is_banktransfer_enabled'] == 'on'
            || $admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret'])
            || $admin_payment_setting['is_iyzipay_enabled'] == 'on' && !empty($admin_payment_setting['iyzipay_public_key']) && !empty($admin_payment_setting['iyzipay_secret_key'])
            || $admin_payment_setting['is_paypal_enabled'] == 'on' && !empty($admin_payment_setting['paypal_client_id']) && !empty($admin_payment_setting['paypal_secret_key'])
            || $admin_payment_setting['is_paystack_enabled'] == 'on' && !empty($admin_payment_setting['paystack_public_key']) && !empty($admin_payment_setting['paystack_secret_key'])
            || $admin_payment_setting['is_flutterwave_enabled'] == 'on' && !empty($admin_payment_setting['flutterwave_public_key']) && !empty($admin_payment_setting['flutterwave_secret_key'])
            || $admin_payment_setting['is_razorpay_enabled'] == 'on' && !empty($admin_payment_setting['razorpay_public_key']) && !empty($admin_payment_setting['razorpay_secret_key'])
            || $admin_payment_setting['is_paytm_enabled'] == 'on' && !empty($admin_payment_setting['paytm_merchant_id']) && !empty($admin_payment_setting['paytm_merchant_key'])
            || $admin_payment_setting['is_mercado_enabled'] == 'on' && !empty($admin_payment_setting['mercado_access_token'])
            || $admin_payment_setting['is_mollie_enabled'] == 'on' && !empty($admin_payment_setting['mollie_api_key']) && !empty($admin_payment_setting['mollie_profile_id']) && !empty($admin_payment_setting['mollie_partner_id'])
            || $admin_payment_setting['is_skrill_enabled'] == 'on' && !empty($admin_payment_setting['skrill_email'])
            || $admin_payment_setting['is_coingate_enabled'] == 'on' && !empty($admin_payment_setting['coingate_auth_token'])
            || $admin_payment_setting['is_paymentwall_enabled'] == 'on' && !empty($admin_payment_setting['paymentwall_public_key']) && !empty($admin_payment_setting['paymentwall_secret_key'])
            || $admin_payment_setting['is_toyyibpay_enabled'] == 'on' && !empty($admin_payment_setting['toyyibpay_category_code']) && !empty($admin_payment_setting['toyyibpay_secret_key'])
            || $admin_payment_setting['is_payfast_enabled'] == 'on' && !empty($admin_payment_setting['payfast_merchant_id']) && !empty($admin_payment_setting['payfast_merchant_key']) && !empty($admin_payment_setting['payfast_signature'])
            || $admin_payment_setting['is_sspay_enabled'] == 'on' && !empty($admin_payment_setting['sspay_category_code']) && !empty($admin_payment_setting['sspay_secret_key'])
            || $admin_payment_setting['is_paytab_enabled'] == 'on' && !empty($admin_payment_setting['paytab_profile_id']) && !empty($admin_payment_setting['paytab_server_key']) && !empty($admin_payment_setting['paytab_region'])
            || $admin_payment_setting['is_benefit_enabled'] == 'on' && !empty($admin_payment_setting['benefit_api_key']) && !empty($admin_payment_setting['benefit_secret_key'])
            || $admin_payment_setting['is_cashfree_enabled'] == 'on' && !empty($admin_payment_setting['cashfree_api_key']) && !empty($admin_payment_setting['cashfree_secret_key'])
            || $admin_payment_setting['is_aamarpay_enabled'] == 'on' && !empty($admin_payment_setting['aamarpay_store_id']) && !empty($admin_payment_setting['aamarpay_signature_key']) && !empty($admin_payment_setting['aamarpay_description'])
            || $admin_payment_setting['is_paytr_enabled'] == 'on' && !empty($admin_payment_setting['paytr_merchant_id']) && !empty($admin_payment_setting['paytr_merchant_key']) && !empty($admin_payment_setting['paytr_merchant_salt'])
            || $admin_payment_setting['is_yookassa_enabled'] == 'on' && !empty($admin_payment_setting['yookassa_shop_id']) && !empty($admin_payment_setting['yookassa_secret'])
            || $admin_payment_setting['is_midtrans_enabled'] == 'on' && !empty($admin_payment_setting['midtrans_secret'])
            || $admin_payment_setting['is_xendit_enabled'] == 'on' && !empty($admin_payment_setting['xendit_api']) && !empty($admin_payment_setting['xendit_token'])
        ) {
            if (\Auth::user()->can('Manage Company Settings')) {

                try {
                    $plan_id        = Crypt::decrypt($code);
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error', __('Plan Not Found.'));
                }

                $plan_id = \Illuminate\Support\Facades\Crypt::decrypt($code);
                $plan    = Plan::find($plan_id);
                if ($plan) {
                    return view('stripe', compact('plan', 'admin_payment_setting'));
                } else {
                    return redirect()->back()->with('error', __('Plan is deleted.'));
                }
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function stripePost(Request $request)
    {
        try {
            $planID      = Crypt::decrypt($request->plan_id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Plan Not Found.'));
        }

        $admin_payment_setting = Utility::getAdminPaymentSetting();

        if (\Auth::user()->can('Manage Company Settings') && (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret']))) {
            $objUser = \Auth::user();
            $planID  = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
            $plan    = Plan::find($planID);

            if ($plan) {
                try {
                    $price = $plan->price;
                    if (!empty($request->coupon)) {
                        $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                        if (!empty($coupons)) {
                            $usedCoupun     = $coupons->used_coupon();
                            $discount_value = ($plan->price / 100) * $coupons->discount;
                            $price          = $plan->price - $discount_value;

                            if ($coupons->limit == $usedCoupun) {
                                return redirect()->back()->with('error', __('This coupon code has expired.'));
                            }
                        } else {
                            return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                        }
                    }

                    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                    $user = \Auth::user();

                    if ($price <= 0.0) {
                        if ($request->has('coupon') && $request->coupon != '') {
                            $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                            if (!empty($coupons)) {
                                $userCoupon = new UserCoupon();
                                $userCoupon->user = $user->id;
                                $userCoupon->coupon = $coupons->id;
                                $userCoupon->order = $orderID;
                                $userCoupon->save();
                                $usedCoupun = $coupons->used_coupon();
                                if ($coupons->limit <= $usedCoupun) {
                                    $coupons->is_active = 0;
                                    $coupons->save();
                                }
                            }
                        }

                        $order = new Order();
                        $order->order_id = $orderID;
                        $order->name = $user->name;
                        $order->card_number = '';
                        $order->card_exp_month = '';
                        $order->card_exp_year = '';
                        $order->plan_name = $plan->name;
                        $order->plan_id = $plan->id;
                        $order->price = $price;
                        $order->price_currency = $admin_payment_setting['currency'];
                        $order->payment_type = __('STRIPE');
                        $order->payment_status = 'success';
                        $order->txn_id = '';
                        $order->receipt = '';
                        $order->user_id = $user->id;
                        $order->save();
                        $assignPlan = $user->assignPlan($plan->id);

                        return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                    }

                    if ($price > 0.0) {
                        Stripe\Stripe::setApiKey($admin_payment_setting['stripe_secret']);
                        $data = Stripe\Charge::create(
                            [
                                "amount" => 100 * $price,
                                "currency" => !empty($admin_payment_setting['currency']) ? $admin_payment_setting['currency'] : 'inr',
                                "source" => $request->stripeToken,
                                "description" => " Plan - " . $plan->name,
                                "metadata" => ["order_id" => $orderID],
                            ]
                        );
                    } else {
                        $data['amount_refunded'] = 0;
                        $data['failure_code']    = '';
                        $data['paid']            = 1;
                        $data['captured']        = 1;
                        $data['status']          = 'succeeded';
                    }
                    if ($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1) {

                        $orders = Order::create(
                            [
                                'order_id' => $orderID,
                                'name' => $request->name,
                                'card_number' => isset($data['payment_method_details']['card']['last4']) ? $data['payment_method_details']['card']['last4'] : '',
                                'card_exp_month' => isset($data['payment_method_details']['card']['exp_month']) ? $data['payment_method_details']['card']['exp_month'] : '',
                                'card_exp_year' => isset($data['payment_method_details']['card']['exp_year']) ? $data['payment_method_details']['card']['exp_year'] : '',
                                'plan_name' => $plan->name,
                                'plan_id' => $plan->id,
                                'price' => $price,
                                'price_currency' => isset($data['currency']) ? $data['currency'] : '',
                                'txn_id' => isset($data['balance_transaction']) ? $data['balance_transaction'] : '',
                                'payment_status' => isset($data['status']) ? $data['status'] : 'succeeded',
                                'payment_type' => __('STRIPE'),
                                'receipt' => isset($data['receipt_url']) ? $data['receipt_url'] : 'free coupon',
                                'user_id' => $objUser->id,
                            ]
                        );

                        if (!empty($request->coupon)) {
                            $userCoupon         = new UserCoupon();
                            $userCoupon->user   = $objUser->id;
                            $userCoupon->coupon = $coupons->id;
                            $userCoupon->order  = $orderID;
                            $userCoupon->save();

                            $usedCoupun = $coupons->used_coupon();
                            if ($coupons->limit <= $usedCoupun) {
                                $coupons->is_active = 0;
                                $coupons->save();
                            }
                        }
                        if ($data['status'] == 'succeeded') {
                            $assignPlan = $objUser->assignPlan($plan->id);
                            if ($assignPlan['is_success']) {
                                return redirect()->route('plans.index')->with('success', __('Plan successfully activated.'));
                            } else {
                                return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                            }
                        } else {
                            return redirect()->route('plans.index')->with('error', __('Your payment has failed.'));
                        }
                    } else {
                        return redirect()->route('plans.index')->with('error', __('Transaction has been failed.'));
                    }
                } catch (\Exception $e) {
                    return redirect()->route('plans.index')->with('error', __($e->getMessage()));
                }
            } else {
                return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
