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

  .stamp-btn {
    width: 45%;
    height: 50%;
    margin-bottom: 40px;
    border-style: none;
    border-radius: 10px;
    background-color: white;
    font-size: x-large;
    font-weight: bold;
  }
</style>
@section('content')
<div class="common-ttl">hogeさんお疲れ様です！</div>
@csrf
<div class="btn-wrapper">
  <button class="stamp-btn">勤務開始</button>
  <button class="stamp-btn">勤務終了
  </button>
  <button class="stamp-btn">休憩開始
  </button>
  <button class="stamp-btn">休憩終了
  </button>
</div>
@endsection