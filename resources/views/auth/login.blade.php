@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}">
    @csrf
    <fieldset>
        <legend>ログイン</legend>
        
        <p>
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </label>
        </p>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <p>
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </label>
        </p>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <p>
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('次から入力を省略') }}
            </label>
        </p>
        <p>
        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('パスワードを忘れた場合') }}
            </a>
        @endif
        </p>
    </fieldset>
    </form>
@endsection
