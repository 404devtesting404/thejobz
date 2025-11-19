@extends('layouts.app')

@section('content')
    <style>
        /* Base Styles */
        .emaillabel,
        .passwordlabel {
            position: relative !important;
            margin-right: 0px !important;
            height: 0px !important;
            padding: 0px !important;
            display: contents !important;
        }

        .passwordlabel {
            display: contents !important;

        }

        label::before {
            content: " ";
            border: 0px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
            border-radius: 3px;
        }

        /* Card Animation */
        .thejobz-card {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;
            transform: translateY(30px) scale(0.98);
            opacity: 0;
            animation: cardEntrance 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s forwards;
            transition: all 0.4s ease;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            overflow: hidden;
        }

        .thejobz-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        /* Header Animation */
        .thejobz-card-header {
            border-bottom: 2px solid rgba(234, 234, 234, 0.6);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .thejobz-card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            linear-gradient(135deg, #2db166, #202020) transform: scaleX(0);
            transform-origin: left;
            animation: headerLine 1s ease-out 0.8s forwards;
        }

        .thejobz-card-header h3 {
            transform: translateY(20px);
            opacity: 0;
            animation: textFadeIn 0.6s ease-out 0.6s forwards;
        }

        /* Input Fields Animation */
        .thejobz-input {
            border-radius: 8px;
            padding: 14px 18px;
            border: 1px solid #e0e0e0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.03);
            transform: translateY(10px);
            opacity: 0;
        }

        .thejobz-input.email {
            animation: inputFadeIn 0.5s ease-out 0.4s forwards;
        }

        .thejobz-input.password {
            animation: inputFadeIn 0.5s ease-out 0.5s forwards;
        }

        .thejobz-input:focus {
            border-color: #4a6cf7;
            box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2),
                inset 0 1px 3px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .card-header.thejobz-card-header {
            padding: 0px;
        }

        /* Button Animation */
        .thejobz-btn {
            background: linear-gradient(135deg, #2db166, #202020);
            border: none;
            padding: 14px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: translateY(10px);
            opacity: 0;
            animation: inputFadeIn 0.5s ease-out 0.7s forwards;
            box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
            position: relative;
            overflow: hidden;
        }

        .thejobz-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .thejobz-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(74, 108, 247, 0.4);
        }

        .thejobz-btn:hover::before {
            left: 100%;
        }

        .thejobz-btn:active {
            transform: translateY(1px);
        }

        /* Link Animation */
        .thejobz-link {
            color: #4a6cf7;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .thejobz-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background-color: #4a6cf7;
            transition: width 0.3s ease;
        }

        .thejobz-link:hover::after {
            width: 100%;
        }

        /* Checkbox Animation */
        .form-check-input {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #4a6cf7;
            border-color: #4a6cf7;
            box-shadow: 0 0 0 0.2rem rgba(74, 108, 247, 0.25);
            transform: scale(1.1);
        }

        /* Loading Animation */
        .thejobz-btn.loading {
            pointer-events: none;
            color: transparent;
        }

        .thejobz-btn.loading::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        /* Keyframes */
        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes headerLine {
            from {
                transform: scaleX(0);
            }

            to {
                transform: scaleX(1);
            }
        }

        @keyframes textFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes inputFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Floating Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* Additional Elements */
        .login-decoration {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(74, 108, 247, 0.1) 0%, rgba(74, 108, 247, 0) 70%);
            animation: float 6s ease-in-out infinite;
        }

        .decoration-1 {
            top: -50px;
            right: -50px;
            animation-delay: 0s;
        }

        .decoration-2 {
            bottom: -30px;
            left: -30px;
            width: 100px;
            height: 100px;
            animation-delay: 0.4s;
            animation-duration: 7s;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card thejobz-card">
                    <div class="login-decoration decoration-1"></div>
                    <div class="login-decoration decoration-2"></div>

                    {{-- <div class="card-header thejobz-card-header">
                        <h3 class="text-center">Login Back!</h3>  
                    </div> --}}

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf
                            <br>

                            <div class="form-group mb-4">
                                <label class="emaillabel" for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control thejobz-input email @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Enter your email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="passwordlabel" for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control thejobz-input password @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password"
                                    placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="thejobz-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <button type="submit" class="btn thejobz-btn w-100" id="loginButton">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="text-center pt-3">
                                <p class="mb-0">Don't have an account?
                                    <a href="{{ route('register') }}" class="thejobz-link font-weight-bold">
                                        Create Account
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission handler
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');

            loginForm.addEventListener('submit', function(e) {
                loginButton.classList.add('loading');
                loginButton.innerHTML = 'Authenticating...';

                // Simulate loading for demo purposes
                setTimeout(() => {
                    loginButton.classList.remove('loading');
                    loginButton.innerHTML = 'Login';
                }, 3000);
            });

            // Add ripple effect to button
            loginButton.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const ripple = document.createElement('span');
                ripple.className = 'ripple-effect';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        });
    </script>
@endsection
