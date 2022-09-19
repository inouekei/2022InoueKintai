@extends('layouts.default')
<style>
  table {
    width: 90%;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 20px 30px;
    border-top: solid gray;
    text-align: left;
  }

  td form {
    margin: 0;
  }

  td form button {
    height: 100%;
    border-style: none;
    border-radius: 5px;
    background-color: blue;
    color: white;
  }

  .common-ttl {
    margin-bottom: 30px;
    font-size: x-large;
    font-weight: bold;
  }


  .links-wrapper {
    display: flex;
  }

  .links-wrapper a,
  .active-page-link {
    padding: 5px 10px;
    margin: 2px;
    background-color: white;
    color: blue;
  }

  .active-page-link {
    background-color: blue;
    color: white;
  }
</style>
@section('content')
<div class="common-ttl">ユーザー一覧</div>
<table>
  <tr>
    <th>ID</th>
    <th>名前</th>
    <th>メールアドレス</th>
  </tr>
  @foreach($users as $user)
  <tr>
    <td>{{$user['id']}}</td>
    <td>
      <form action='/individual' method='post'>
        @csrf
        <input type='hidden' name='id' value={{$user['id']}}>
        <button>{{$user['name']}}</button>
      </form>
    </td>
    <td>{{$user['email']}}</td>
  </tr>
  @endforeach
</table>
<div class="links-wrapper">
  {{$users->links('pagination.default')}}
</div>
@endsection