@extends('layouts.default')
<style>
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

  .auth-btn {
    border-style: none;
    background-color: blue;
    color: white;
  }
</style>
@section('content')
<div class="auth-ttl">会員登録</div>
<form action="/register" method="post">
  <table>
    @csrf
    <tr>
      <input type="text" name="name" placeholder="名前">
    </tr>
    <tr>
      <input type="text" name="email" placeholder="メールアドレス">
    </tr>
    <tr>
      <input type="password" name="password" placeholder="パスワード">
    </tr>
    <tr>
      <input type="password" name="password_confirmation" placeholder="確認用パスワード">
    </tr>
    <tr>
      <input class="auth-btn" type="submit" value="会員登録">
    </tr>
  </table>
</form>
<p>アカウントをお持ちの方はこちらから</p>
<a href="/login">ログイン</a>
@endsection