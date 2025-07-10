@extends('layouts.app')

@section('content')
<style>
    html, body {
        overflow: hidden !important;
        height: 100%;
    }
    .register-left {
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
        background-color: rgba(255,255,255,0.15);
        border-color: #1e3a8a;
        color: #fff;
        box-shadow: 0 0 0 0.15rem rgba(59,130,246,0.25);
    }
    .form-control-custom::placeholder {
        color: rgb(70, 67, 67);
        opacity: 1;
    }
    .input-icon {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #3b82f6;
        top: 0.25rem;
        left: 0.5rem;
        font-size: 1.2rem;
    }
    .register-title {
        text-align: left;
        color: #3b82f6;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 2rem;
        margin-top: 1.5rem;
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
    .register-image {
        object-fit: cover;
        object-position: left;
        width: 100%;
        height: 100vh;
    }
    @media (max-width: 767.98px) {
        .register-image {
            display: none;
        }
        .register-left {
            min-height: 100vh;
        }
    }
</style>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 register-left">
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4  pt-xl-0 mt-xl-n5">
          <form method="POST" action="{{ route('register') }}" style="width: 23rem;">
            @csrf
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: #3b82f6;">Create New Account</h3>
            <div class="form-outline mb-2 position-relative">
              <label class="form-label mb-1" for="name">Name</label>
              <div class="input-group">
                <input id="name" type="text" class="form-control form-control-lg form-control-custom @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name" />
              </div>
              @error('name')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-outline mb-4 position-relative">
              <label class="form-label mb-1" for="email">Email address</label>
              <div class="input-group">
                <input id="email" type="email" class="form-control form-control-lg form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address" />
              </div>
              @error('email')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-outline mb-4 position-relative">
              <label class="form-label mb-1" for="password">Password</label>
              <div class="input-group">
                <input id="password" type="password" class="form-control form-control-lg form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" />
              </div>
              @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-outline mb-4 position-relative">
              <label class="form-label mb-1" for="password-confirm">Confirm Password</label>
              <div class="input-group">
                <input id="password-confirm" type="password" class="form-control form-control-lg form-control-custom" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
              </div>
            </div>
            <div class="pt-1 mb-4">
              <button class="btn btn-cafepixel btn-lg btn-block w-100" type="submit">Register</button>
            </div>
            <p>Already have an account? <a href="{{ route('login') }}" class="link-info" style="color:#3b82f6;">Login here</a></p>
          </form>
        </div>
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="https://images.unsplash.com/photo-1597368089932-9eb344fea930?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Register image" class="register-image">
      </div>
    </div>
  </div>
</section>
@endsection
