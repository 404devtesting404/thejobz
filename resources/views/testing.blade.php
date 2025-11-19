<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MyApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e8eaed, #42a5f5);
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: #1877f2 !important;
            color: #fff !important;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 1rem;
            border-radius: 20px 20px 0 0;
        }

        .social-icons a {
            font-size: 1.5rem;
            margin: 0 10px;
            color: #495057;
            transition: 0.3s;
        }

        .social-icons a:hover {
            color: #1877f2;
            transform: scale(1.2);
        }

        .card-footer {
            background: #f1f3f5;
            border-top: none;
        }

        .fb-page-wrapper {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center">
                    Login with Facebook
                </div>

                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">Login</button>
                        </div>

                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                                <a href="#" class="text-decoration-none">Forgot Your Password?</a>
                            @endif
                        </div>

                        <div class="mt-2 text-center">
                            <a href="#" class="text-decoration-none">Don't have an account? Register</a>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center py-3">
                    <span class="text-muted me-2">Follow us:</span>
                    <div class="social-icons d-inline">
                        <a href="https://facebook.com/YourPage" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facebook Like Box -->
        <div class="fb-page-wrapper">
            <div class="fb-page" data-href="https://www.facebook.com/YourPage"
                data-tabs="timeline,events,messages"
                data-width="340"
                data-height="200"
                data-small-header="false"
                data-adapt-container-width="true"
                data-hide-cover="false"
                data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/YourPage" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/YourPage">Facebook Page</a>
                </blockquote>
            </div>
        </div>
    </div>

    <!-- Facebook SDK -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="FbNonce"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
