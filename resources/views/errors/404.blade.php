@extends('layouts.app1')

@section('content')
    <style>
        .error-wrapper {
            position: relative;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
            overflow: hidden;
            color: #fff;
            text-align: center;
        }

        .error-wrapper::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(0, 136, 255, 0.2);
            filter: blur(120px);
            border-radius: 50%;
            top: -80px;
            left: -80px;
        }

        .error-wrapper::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 0, 100, 0.2);
            filter: blur(120px);
            border-radius: 50%;
            bottom: -80px;
            right: -80px;
        }

        .error-box {
            position: relative;
            z-index: 2;
            animation: fadeInUp 1s ease;
        }

        .error-title {
            font-size: 130px;
            font-weight: 900;
            background: linear-gradient(135deg, #28a745, #34d058);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .error-subtitle {
            font-size: 28px;
            margin-top: -10px;
            color: #eee;
        }

        .error-desc {
            font-size: 16px;
            margin: 15px 0 30px;
            color: #cfcfcf;
        }

        .btn-back {
            padding: 12px 30px;
            background: #28a745;
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 600;
            display: inline-block;
            transition: 0.3s ease;
            box-shadow: 0 0 15px #219150;
            border: none !important;
            outline: none !important;
        }

        .btn-back:hover,
        .btn-back:focus,
        .btn-back:active {
            background: #219150 !important;
            box-shadow: 0 0 25px #219150 !important;
            color: #fff !important;
            /* <- ye add kiya */
            border: none !important;
            outline: none !important;
        }



        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="error-wrapper">
        <div class="error-box">
            <h1 class="error-title">404</h1>
            <h3 class="error-subtitle">Page Not Found</h3>
            <p class="error-desc">
                The page you're looking for doesn't exist or may have been moved.
            </p>
            <a href="{{ route('home') }}" class="btn-back">Go to Home</a>
        </div>
    </div>
@endsection
