@extends('layouts.default')
<style>
  .common-ttl {
    margin-bottom: 30px;
    font-size: x-large;
    font-weight: bold;
  }

  .btn-wrapper {
    width: 80%;
    height: 50vh;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
  }

  .btn-wrapper form {
    width: 45%;
    height: 50%;
  }

  .stamp-btn,
  .stamp-btn-disabled {
    width: 100%;
    height: 100%;
    margin-bottom: 40px;
    border-style: none;
    border-radius: 10px;
    background-color: white;
    font-size: x-large;
    font-weight: bold;
  }

  .stamp-btn-disabled {
    color: whitesmoke;
  }
</style>
@section('content')
<div class="common-ttl">{{$username}}さんお疲れ様です！</div>
<div class="btn-wrapper">
  @if(!$currentAttendanceID)
  <form action="/attendance" method="post">
    @csrf
    <button class="stamp-btn">勤務開始</button>
  </form>
  <form action="/attendance" method="post">
    @csrf
    <button class="stamp-btn" disabled>勤務終了</button>
  </form>
  <form action="/pause" method="post">
    @csrf
    <button class="stamp-btn" disabled>休憩開始</button>
  </form>
  <form action="/pause" method="post">
    @csrf
    <button class="stamp-btn" disabled>休憩終了</button>
  </form>
  @else
  <form action="/attendance" method="post">
    @csrf
    <button class="stamp-btn" disabled>勤務開始</button>
  </form>
  <form action="/attendance" method="post">
    @csrf
    <button class="stamp-btn">勤務終了</button>
  </form>
  @if(!$currentPauseID)
  <form action="/pause" method="post">
    @csrf
    <button class="stamp-btn">休憩開始</button>
  </form>
  <form action="/pause" method="post">
    @csrf
    <button class="stamp-btn" disabled>休憩終了</button>
  </form>
  @else
  <form action="/pause" method="post">
    @csrf
    <button class="stamp-btn" disabled>休憩開始</button>
  </form>
  <form action="/pause" method="post">
    @csrf
    <button class="stamp-btn">休憩終了</button>
  </form>
  @endif
  @endif
</div>
@endsection