@extends('layouts.default')
<style>
  form {
    position: relative;
  }

  input {
    display: block;
    width: 400px;
    height: 40px;
    margin-bottom: 30px;
    padding-left: 10px;
    border-style: solid;
    border-radius: 5px;
    background-color: inherit;
  }

  p {
    margin-bottom: 5px;
    color: gray;
  }

  .auth-ttl {
    margin: 30px;
    font-size: x-large;
    font-weight: bold;
  }

  .email-error,
  .password-error {
    position: absolute;
    line-height: 0;
    color: red;
  }

  .email-error {
    top: 50px;
  }

  .password-error {
    top: 120px;
  }

  .auth-btn {
    border-style: none;
    background-color: blue;
    color: white;
  }
</style>
@section('content')
<div class="auth-ttl">ログイン</div>
<form action="/login" method="post">
  <table>
    @csrf
    <tr>
      <input type="text" name="email" placeholder="メールアドレス">
    </tr>
    @error('email')
    <small class="email-error">{{$message}}</small>
    @enderror
    <tr>
      <input type="password" name="password" placeholder="パスワード">
    </tr>
    @error('password')
    <small class="password-error">{{$message}}</small>
    @enderror
    <tr>
      <input class="auth-btn" type="submit" value="ログイン">
    </tr>
  </table>
</form>
<p>アカウントをお持ちでない方はこちらから</p>
<a href="/register">会員登録</a>
@endsection