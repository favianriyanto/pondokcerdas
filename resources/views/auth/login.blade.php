@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login Pondok Cerdas</div>
                @if(session('success') != null)
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fa fa-check"></i> Berhasil!</h5>
                        {!! session('success') !!}
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} checked>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form><br><br>
                    <div class="flex-center">
                        <img src="dist/img/pondokcerdas.jpg" style="height: 20%; width: 20%; margin-right: 20px;" alt="User Image">
                        <img src="dist/img/favian.png" style="height: 20%; width: 20%; margin-right: 20px;" alt="User Image">
                        <img src="dist/img/uin.jpg" style="height: 20%; width: 20%;" alt="User Image">
                    </div><br><br>
                    Dibuat untuk Pondok Cerdas oleh <a target="_blank" href="https://favianriyanto.com"> Favian Azwadt Riyanto</a> dalam rangka <a target="_blank" href="https://uin-suska.ac.id"> KKN-DR+ 2020 UIN SUSKA RIAU</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
