@extends('layouts.app')

<!-- #region -->
<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                    <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                    <label for="reg-log"></label>
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <div class="form-group">
                                                <input id="email" type="email" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email"
                                                    class="form-style @error('email') is-invalid @enderror"
                                                    placeholder="Your Email">

                                                <i class="input-icon uil uil-at"></i>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-2">
                                                <input id="password" type="password" name="password"
                                                    class="form-style @error('password') is-invalid @enderror" required
                                                    autocomplete="current-password" placeholder="Your Password">
                                                <i class="input-icon uil uil-lock-alt"></i>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <button class="btn mt-4" type="submit">{{ __('Login') }}</button>
                                            <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot
                                                    your
                                                    password?</a></p>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="card-back">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3">Sign Up</h4>
                                        <div class="card-body">
                                            @livewire('daftar')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Livewire.on('toggleToLogin', () => {
        document.getElementById('reg-log').checked = false;
    });
</script>
