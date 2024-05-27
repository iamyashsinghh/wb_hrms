@extends('layouts.auth')
@section('page-title')
    {{ __('Forgot Password') }}
@endsection
@section('language-bar')
    @php
        $languages = App\Models\Utility::languages();
        $settings = App\Models\Utility::settings();
        config([
            'captcha.sitekey' => $settings['google_recaptcha_key'],
            'captcha.secret' => $settings['google_recaptcha_secret'],
            'options' => [
                'timeout' => 30,
            ],
        ]);
    @endphp
    <div class="lang-dropdown-only-desk">
        <li class="dropdown dash-h-item drp-language">
            <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="drp-text"> {{ ucFirst($languages[$lang]) }}
                </span>
            </a>
            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                @foreach ($languages as $code => $language)
                    <a href="{{ route('password.request', $code) }}" tabindex="0"
                        class="dropdown-item {{ $code == $lang ? 'active' : '' }}">
                        <span>{{ ucFirst($language) }}</span>
                    </a>
                @endforeach
            </div>
        </li>
    </div>
@endsection
@section('content')
    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600">{{ __('Forgot Password') }}</h2>
            @if (session('status'))
                <div class="alert alert-primary">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="custom-login-form">
            <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"
                        name="email" placeholder="{{ __('Enter your email') }}" required autofocus>
                    @error('email')
                        <span class="error invalid-email text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                @if (isset($settings['recaptcha_module']) && $settings['recaptcha_module'] == 'yes')
                    <div class="form-group mb-4">
                        {!! NoCaptcha::display($settings['cust_darklayout']=='on' ? ['data-theme' => 'dark'] : []) !!}
                        @error('g-recaptcha-response')
                            <span class="error small text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
                <div class="d-grid">
                    <button class="btn btn-primary mt-2" type="submit">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <p class="my-4 text-center">{{ __('Back to ') }} <a href="{{ route('login', $lang) }}"
                            tabindex="0">{{ __('Login') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('custom-scripts')
    @if (isset($settings['recaptcha_module']) && $settings['recaptcha_module'] == 'yes')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
