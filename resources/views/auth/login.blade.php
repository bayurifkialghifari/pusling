<x-layouts.auth>
    <x-slot:title>
        LOGIN
    </x-slot:title>
    <div class="container d-flex flex-column">
        <div class="row" style="margin-top: 10em;background: url('{{ asset('background-image-city.png') }}');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: bottom;
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0px;
        ">
            <div class="col-md-6">
                <div class="text-center mt-4">
                    <h1 class="h2">Welcome back!</h1>
                    <p class="lead">
                        Sign in to your account to continue
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="align-middle">
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="email"
                                            autofocus
                                            placeholder="Enter your email"
                                        />


                                        <x-acc-input-error for="email" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input
                                            type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                        />

                                        <x-acc-input-error for="password" />
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label text-small" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                        <button type="submit" class="btn btn-primary float-end">
                                            Masuk
                                        </button>
                                    </div>
                                </form>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('register'))
                                        Belum punya akun ?
                                        <a href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                    @endif
                                </div>
                                <img src="{{ asset('bsre.png') }}" style="width:230px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
