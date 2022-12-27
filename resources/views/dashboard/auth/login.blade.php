<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">

    @include('dashboard.auth.authHead')

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xl-8">
                        @include('dashboard.auth.authImage')
                    </div>

                    <div class="col-xl-4">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">
                                
                                <div class="d-flex flex-column h-100">
                                    <div class="my-auto">
                                        <div class="text-center">
                                            @include('dashboard.partials.language')
                                        </div>

                                        <div>
                                            <h5 class="text-primary">{{ __('lang.welcome_back') }}</h5>
                                            <p class="text-muted">{{ __('lang.login_quote') }}</p>
                                        </div>
            
                                        <!-- Session Status -->
                                        <x-auth-session-status class="mb-3" :status="session('status')" />

                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-3" :errors="$errors" />
                                        
                                        <div class="mt-4">
                                            <form action="{{ route('admin.login') }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">{{ __('lang.email') }}</label>
                                                    <input type="text" class="form-control" name="email" placeholder="{{ __('lang.please_enter') }} {{ __('lang.email') }}" value="{{ old('email') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('lang.password') }}</label>
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" class="form-control" placeholder="{{ __('lang.please_enter') }} {{ __('lang.password') }}" aria-label="Password" aria-describedby="password-addon" name="password">
                                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                </div>
                        
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check" name="remember">
                                                    <label class="form-check-label" for="remember-check">
                                                        {{ __('lang.remember_me') }}
                                                    </label>
                                                </div>
                                                
                                                <div class="mt-3 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">{{ __('lang.login_btn') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="mt-4 mt-md-5 text-center">
                                        @include('dashboard.partials.copyright')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

        @include('dashboard.auth.authScripts')

    </body>
</html>
