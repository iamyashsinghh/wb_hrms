@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Plan Order') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Plan Order') }}</li>
@endsection

@php
    $file = \App\Models\Utility::get_file('uploads/order/');
    $admin_payment_setting = App\Models\Utility::getAdminPaymentSetting();
@endphp

@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    {{-- <h5></h5> --}}
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Order Id') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Plan Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Coupon') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Invoice') }}</th>
                                    @if (\Auth::user()->type == 'super admin')
                                        <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ $order->plan_name }}</td>
                                        <td>{{ (!empty($admin_payment_setting['currency_symbol']) ? $admin_payment_setting['currency_symbol'] : '$') . $order->price }}
                                        </td>
                                        <td>
                                            @if ($order->payment_status == 'succeeded')
                                                <i class="mdi mdi-circle text-success"></i>
                                                {{ ucfirst($order->payment_status) }}
                                            @else
                                                <i class="mdi mdi-circle text-danger"></i>
                                                {{ ucfirst($order->payment_status) }}
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>{{ !empty($order->total_coupon_used) ? (!empty($order->total_coupon_used->coupon_detail) ? $order->total_coupon_used->coupon_detail->code : '-') : '-' }}
                                        </td>
                                        <td>{{ $order->payment_type }}</td>
                                        <td class="Id text-center">
                                            @if (!empty($order->receipt && !empty($order->payment_type == 'STRIPE')))
                                                <a href="{{ $order->receipt }}" class="btn  btn-outline-primary"
                                                    target="_blank"><i class="fas fa-file-invoice"></i></a>
                                            @elseif(!empty($order->receipt && !empty($order->payment_type == 'Bank Transfer')))
                                                <a href="{{ $file . '' . $order->receipt }}"
                                                    class="btn btn-outline-primary" target="_blank"><i
                                                        class="fas fa-file-invoice"></i></a>
                                            @else
                                                <p>-</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if (\Auth::user()->type == 'super admin')
                                                @if ($order->payment_status == 'Pending' && $order->payment_type == 'Bank Transfer')
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                            data-size="lg"
                                                            data-url="{{ URL::to('order/' . $order->id . '/action') }}"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="{{ __('Order Action') }}"
                                                            data-bs-original-title="{{ __('Manage Order') }}">
                                                            <i class="ti ti-caret-right text-white"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @elseif(\Auth::user()->type == 'company' && $order->payment_type == 'Bank Transfer')
                                                <div class="action-btn bg-success ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                        data-size="lg"
                                                        data-url="{{ URL::to('order/' . $order->id . '/action') }}"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                        title="" data-title="{{ __('Manage Order') }}"
                                                        data-bs-original-title="{{ __('Manage Order') }}">
                                                        <i class="ti ti-caret-right text-white"></i>
                                                    </a>
                                                </div>
                                            @else
                                            @endif

                                            @if (\Auth::user()->type == 'super admin')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['order.destroy', $order->id],
                                                        'id' => 'delete-form-' . $order->id,
                                                    ]) !!}
                                                    <a href="#"
                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                        data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="Delete" aria-label="Delete"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
