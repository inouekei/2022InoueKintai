@extends('layouts.default')
<style>
  form {
    display: inline;
    margin: 0;
    height: 100%;
  }

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

  .common-ttl {
    margin-bottom: 30px;
    font-size: x-large;
    font-weight: bold;
    text-align: center;
  }

  .common-ttl form button {
    display: inline;
    width: 50px;
    height: 60%;
    margin: 0 40px;
    padding: 0 10px;
    border-style: solid;
    border-width: thin;
    border-color: blue;
    background-color: white;
    font-size: xx-large;
    font-weight: normal
    ;
    color: blue;
  }
</style>
@section('content')
<div class="common-ttl">
  {{$username}}
  <br>
  <form action='/individual' method='post'>
    @csrf
    <input type='hidden' name='targetMonth' value={{$previousMonthStr}}>
    <input type='hidden' name='id' value={{$id}}>
    <button>&lt;</button>
  </form>
  {{$targetMonthStr}}
  <form action='/individual' method='post'>
    @csrf
    <input type='hidden' name='targetMonth' value={{$nextMonthStr}}>
    <input type='hidden' name='id' value={{$id}}>
    <button>&gt;</button>
  </form>
</div>
<table>
  <tr>
    <th>日付</th>
    <th>勤務開始</th>
    <th>勤務終了</th>
    <th>休憩時間</th>
    <th>勤務時間</th>
  </tr>
  @foreach($attendanceList as $attendance)
  <tr>
    <td>{{$attendance['targetDateStr']}}</td>
    <td>{{$attendance['attendanceOnStr']}}</td>
    <td>{{$attendance['attendanceOffStr']}}</td>
    <td>{{$attendance['totalPauseStr']}}</td>
    <td>{{$attendance['attendanceTimeStr']}}</td>
  </tr>
  @endforeach
</table>
@endsection