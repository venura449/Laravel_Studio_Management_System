@extends('layouts.app')

@section('content')
    <style>
        html, body {
            overflow: hidden !important;
            height: 100%;
        }
        .login-left {
            background: #000;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .brand-logo {
            color: transparent;
            background: linear-gradient(90deg, #3b82f6 0%, #fff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            font-family: 'Nunito', sans-serif;
            letter-spacing: 2px;
            font-size: 2.2rem;
            font-weight: bold;
        }
        .form-control-custom {
            background-color: rgba(255,255,255,0.08);
            border: 1px solid #3b82f6;
            color: #fff;
        }
        .form-control-custom:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: #1e3a8a;
            color: #fff;
            box-shadow: 0 0 0 0.15rem rgba(59, 130, 246, 0.25);

        }
        .form-control-custom::placeholder {
            color: rgb(70, 67, 67);
            opacity: 1;
        }
        .btn-cafepixel {
            background: linear-gradient(90deg, #1e3a8a 0%, #3b82f6 100%);
            color: #fff;
            border: none;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-cafepixel:hover {
            background: #3b82f6;
            color: #fff;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 4px 15px rgba(59,130,246,0.4);
        }
        .login-image {
            object-fit: cover;
            width: 100%;
            height: 100vh;
        }
        @media (max-width: 767.98px) {
            .login-image {
                display: none;
            }
            .login-left {
                min-height: 100vh;
            }
        }
    </style>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 login-left">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4  pt-xl-0 mt-xl-n5">
                        <form method="POST" action="{{ route('login') }}" style="width: 23rem;">
                            @csrf
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: #3b82f6;">Log in</h3>
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg form-control-custom @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address" />
                                <label class="form-label" for="email">Email address</label>
                                @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg form-control-custom @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="Password" />
                                <label class="form-label" for="password">Password</label>
                                @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-cafepixel btn-lg btn-block w-100" type="submit">Login</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none" style="color:#3b82f6;">Forgot password?</a>
                                @endif
                            </div>
                            <p>Don't have an account? <a href="{{ route('register') }}" class="link-info" style="color:#3b82f6;">Register here</a></p>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp" alt="Login image" class="login-image">
                </div>
            </div>
        </div>
    </section>
@endsection
