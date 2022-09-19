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
<div class="auth-ttl">確認メールの再送信</div>
<p>利用にはメールアドレスの確認が必要です。</p>
<p>確認メールを再送信する場合は、メールアドレスを入力の上、再送信ボタンをクリックして下さい。</p>
<form action="/email/verification-notification" method="post">
  <table>
    @csrf
    <tr>
      <input type="text" name="email" placeholder="メールアドレス">
    </tr>
    @error('email')
    <small class="email-error">{{$message}}</small>
    @enderror
    <input class="auth-btn" type="submit" value="再送信">
    </tr>
  </table>
</form>
<p>アカウントをお持ちでない方はこちらから</p>
<a href="/register">会員登録</a>
@endsection