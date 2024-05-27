@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Plan') }}
@endsection

@php
    $admin_payment_setting = App\Models\Utility::getAdminPaymentSetting();
@endphp

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Plan') }}</li>
@endsection

@section('action-button')
    @can('Create Plan')
        @if (
            !empty($admin_payment_setting) &&
                ($admin_payment_setting['is_manually_enabled'] == 'on' ||
                    ($admin_payment_setting['is_banktransfer_enabled'] == 'on' &&
                        !empty($admin_payment_setting['bank_details'])) ||
                    ($admin_payment_setting['is_stripe_enabled'] == 'on' &&
                        !empty($admin_payment_setting['stripe_key']) &&
                        !empty($admin_payment_setting['stripe_secret'])) ||
                    ($admin_payment_setting['is_paypal_enabled'] == 'on' &&
                        !empty($admin_payment_setting['paypal_client_id']) &&
                        !empty($admin_payment_setting['paypal_secret_key'])) ||
                    ($admin_payment_setting['is_paystack_enabled'] == 'on' &&
                        !empty($admin_payment_setting['paystack_public_key']) &&
                        !empty($admin_payment_setting['paystack_secret_key'])) ||
                    ($admin_payment_setting['is_flutterwave_enabled'] == 'on' &&
                        !empty($admin_payment_setting['flutterwave_public_key']) &&
                        !empty($admin_payment_setting['flutterwave_secret_key'])) ||
                    ($admin_payment_setting['is_razorpay_enabled'] == 'on' &&
                        !empty($admin_payment_setting['razorpay_public_key']) &&
                        !empty($admin_payment_setting['razorpay_secret_key'])) ||
                    ($admin_payment_setting['is_paytm_enabled'] == 'on' &&
                        !empty($admin_payment_setting['paytm_merchant_id']) &&
                        !empty($admin_payment_setting['paytm_merchant_key'])) ||
                    ($admin_payment_setting['is_mercado_enabled'] == 'on' &&
                        !empty($admin_payment_setting['mercado_access_token'])) ||
                    ($admin_payment_setting['is_mollie_enabled'] == 'on' &&
                        !empty($admin_payment_setting['mollie_api_key']) &&
                        !empty($admin_payment_setting['mollie_profile_id']) &&
                        !empty($admin_payment_setting['mollie_partner_id'])) ||
                    ($admin_payment_setting['is_skrill_enabled'] == 'on' && !empty($admin_payment_setting['skrill_email'])) ||
                    ($admin_payment_setting['is_coingate_enabled'] == 'on' &&
                        !empty($admin_payment_setting['coingate_auth_token'])) ||
                    ($admin_payment_setting['is_paymentwall_enabled'] == 'on' &&
                        !empty($admin_payment_setting['paymentwall_public_key']) &&
                        !empty($admin_payment_setting['paymentwall_secret_key'])) ||
                    ($admin_payment_setting['is_toyyibpay_enabled'] == 'on' &&
                        !empty($admin_payment_setting['toyyibpay_category_code']) &&
                        !empty($admin_payment_setting['toyyibpay_secret_key'])) ||
                    ($admin_payment_setting['is_payfast_enabled'] == 'on' &&
                        !empty($admin_payment_setting['payfast_merchant_id']) &&
                        !empty($admin_payment_setting['payfast_merchant_key']) &&
                        !empty($admin_payment_setting['payfast_signature'])) ||
                    ($admin_payment_setting['is_iyzipay_enabled'] == 'on' &&
                        !empty($admin_payment_setting['iyzipay_public_key']) &&
                        !empty($admin_payment_setting['iyzipay_secret_key'])) ||
                    ($admin_payment_setting['is_sspay_enabled'] == 'on' &&
                        !empty($admin_payment_setting['sspay_category_code']) &&
                        !empty($admin_payment_setting['sspay_secret_key'])) ||
                    ($admin_payment_setting['is_paytab_enabled'] == 'on' &&
                        !empty($admin_payment_setting['paytab_profile_id']) &&
                        !empty($admin_payment_setting['paytab_server_key']) &&
                        !empty($admin_payment_setting['paytab_region'])) ||
                    ($admin_payment_setting['is_benefit_enabled'] == 'on' &&
                        !empty($admin_payment_setting['benefit_api_key']) &&
                        !empty($admin_payment_setting['benefit_secret_key'])) ||
                    ($admin_payment_setting['is_cashfree_enabled'] == 'on' &&
                        !empty($admin_payment_setting['cashfree_api_key']) &&
                        !empty($admin_payment_setting['cashfree_secret_key'])) ||
                    ($admin_payment_setting['is_aamarpay_enabled'] == 'on' &&
                        !empty($admin_payment_setting['aamarpay_store_id']) &&
                        !empty($admin_payment_setting['aamarpay_signature_key']) &&
                        !empty($admin_payment_setting['aamarpay_description'])) ||
                    ($admin_payment_setting['is_paytr_enabled'] == 'on' &&
                        !empty($admin_payment_setting['paytr_merchant_id']) &&
                        !empty($admin_payment_setting['paytr_merchant_key']) &&
                        !empty($admin_payment_setting['paytr_merchant_salt'])) ||
                    ($admin_payment_setting['is_yookassa_enabled'] == 'on' &&
                        !empty($admin_payment_setting['yookassa_shop_id']) &&
                        !empty($admin_payment_setting['yookassa_secret'])) ||
                    ($admin_payment_setting['is_midtrans_enabled'] == 'on' &&
                        !empty($admin_payment_setting['midtrans_secret'])) ||
                    ($admin_payment_setting['is_xendit_enabled'] == 'on' &&
                        !empty($admin_payment_setting['xendit_api']) &&
                        !empty($admin_payment_setting['xendit_token']))))
            <a href="#" data-url="{{ route('plans.create') }}" data-size="md" data-ajax-popup="true"
                data-title="{{ __('Create New Plan') }}" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                data-bs-original-title="{{ __('Create') }}">
                <i class="ti ti-plus"></i>
            </a>
        @endif
    @endcan
@endsection

@section('content')
    <div class="row">

        @foreach ($plans as $plan)
            <div class="col-lg-3 col-md-4">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="card-body ">
                        <span class="price-badge bg-primary">{{ $plan->name }}</span>

                        <div class="d-flex flex-row-reverse m-0 p-0 ">
                            @can('Edit Plan')
                                <div class="action-btn bg-primary ms-2">
                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                        data-ajax-popup="true" data-title="{{ __('Edit Plan') }}"
                                        data-url="{{ route('plans.edit', $plan->id) }}" data-size="lg" data-bs-toggle="tooltip"
                                        data-bs-original-title="{{ __('Edit') }}" data-bs-placement="top"><span
                                            class="text-white"><i class="ti ti-pencil"></i></span></a>
                                </div>
                            @endcan

                            @if (\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id)
                                <span class="d-flex align-items-center ms-2">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2">{{ __('Active') }}</span>
                                </span>
                            @endif
                        </div>


                        <span
                            class="mb-4 f-w-600 p-price">{{ !empty($admin_payment_setting['currency_symbol']) ? $admin_payment_setting['currency_symbol'] : '$' }}{{ number_format($plan->price) }}<small
                                class="text-sm">/ {{ $plan->duration }}</small></span>

                        <p class="mb-0">
                            {{ $plan->description }}
                        </p>

                        <ul class="list-unstyled my-4">
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->max_users == -1 ? __('Unlimited') : $plan->max_users }} {{ __('Users') }}
                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->max_employees == -1 ? __('Unlimited') : $plan->max_employees }}
                                {{ __('Employees') }}
                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->storage_limit == -1 ? __('Lifetime') : $plan->storage_limit }}
                                {{ __('MB Storage') }}
                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->enable_chatgpt == 'on' ? __('Enable Chat GPT') : __('Disable Chat GPT') }}
                            </li>
                        </ul>
                        <div class="row d-flex justify-content-between">
                            @if (
                                (!empty($admin_payment_setting) &&
                                    ($admin_payment_setting['is_manually_enabled'] == 'on' ||
                                        $admin_payment_setting['is_banktransfer_enabled'] == 'on' ||
                                        $admin_payment_setting['is_stripe_enabled'] == 'on' ||
                                        $admin_payment_setting['is_paypal_enabled'] == 'on' ||
                                        $admin_payment_setting['is_paystack_enabled'] == 'on' ||
                                        $admin_payment_setting['is_flutterwave_enabled'] == 'on' ||
                                        $admin_payment_setting['is_razorpay_enabled'] == 'on' ||
                                        $admin_payment_setting['is_mercado_enabled'] == 'on' ||
                                        $admin_payment_setting['is_paytm_enabled'] == 'on' ||
                                        $admin_payment_setting['is_mollie_enabled'] == 'on' ||
                                        $admin_payment_setting['is_skrill_enabled'] == 'on' ||
                                        $admin_payment_setting['is_iyzipay_enabled'] == 'on' ||
                                        $admin_payment_setting['is_sspay_enabled'] == 'on' ||
                                        $admin_payment_setting['is_paytab_enabled'] == 'on' ||
                                        $admin_payment_setting['is_benefit_enabled'] == 'on' ||
                                        $admin_payment_setting['is_cashfree_enabled'] == 'on' ||
                                        $admin_payment_setting['is_aamarpay_enabled'] == 'on' ||
                                        $admin_payment_setting['is_paytr_enabled'] == 'on' ||
                                        $admin_payment_setting['is_yookassa_enabled'] == 'on' ||
                                        $admin_payment_setting['is_midtrans_enabled'] == 'on' ||
                                        $admin_payment_setting['is_xendit_enabled'] == 'on' ||
                                        $admin_payment_setting['is_payfast_enabled'] == 'on' ||
                                        $admin_payment_setting['is_toyyibpay_enabled'] == 'on' ||
                                        $admin_payment_setting['is_coingate_enabled'] == 'on')) ||
                                    (!empty($admin_payment_setting) && $admin_payment_setting['is_paymentwall_enabled'] == 'on'))
                                @can('Buy Plan')
                                    @if ($plan->id != \Auth::user()->plan && \Auth::user()->type != 'super admin')
                                        <div class="col-8">
                                            @if (!$plan->price == 0)
                                                <div class="d-grid text-center">
                                                    <a href="{{ route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)) }}"
                                                        class="btn btn-primary btn-sm d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="{{ __('Subscribe') }}"
                                                        title="{{ __('Subscribe') }}">{{ __('Subscribe') }}
                                                        <i class="ti ti-arrow-narrow-right ms-1"></i></a>
                                                    <p></p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endcan
                            @endif
                            @if (\Auth::user()->type == 'company' && \Auth::user()->plan != $plan->id)
                                @if ($plan->id != 1)
                                    <div class="col-3">
                                        @if (\Auth::user()->requested_plan != $plan->id)
                                            <a href="{{ route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)]) }}"
                                                class="btn btn-primary btn-icon btn-sm"
                                                data-title="{{ __('Send Request') }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-original-title="{{ __('Send Request') }}"
                                                title="{{ __('Send Request') }}">
                                                <span class="btn-inner--icon"><i class="ti ti-arrow-forward-up"></i></span>
                                            </a>
                                        @else
                                            <a href="{{ route('request.cancel', \Auth::user()->id) }}"
                                                class="btn btn-danger btn-icon btn-sm"
                                                data-title="{{ __('Cancel Request') }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-original-title="{{ __('Cancel Request') }}"
                                                title="{{ __('Cancel Request') }}">
                                                <span class="btn-inner--icon"><i class="ti ti-shield-x"></i></span>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            @endif

                            @php
                                $plan_expire_date = \Auth::user()->plan_expire_date;
                            @endphp

                            @if (\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id)
                                <p class="mb-0">
                                    {{ __('Plan Expired : ') }}
                                    {{ !empty($plan_expire_date) ? \Auth::user()->dateFormat($plan_expire_date) : 'Lifetime' }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
