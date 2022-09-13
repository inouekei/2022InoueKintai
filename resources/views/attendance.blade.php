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

  .common-ttl {
    margin-bottom: 30px;
    font-size: x-large;
    font-weight: bold;
  }

  .common-ttl a {
    margin: 0 40px;
    padding: 0 10px;
    border-style: solid;
    border-color: blue;
    background-color: white;
    font-size: normal;
    font-weight: normal;
    color: blue;
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
<div class="common-ttl">
  <a href={{"/attendance?targetDate=" . $previousDateStr}}>&lt;</a>
  {{$targetDateStr}}
  <a href={{"/attendance?targetDate=" . $nextDateStr}}>&gt;</a>
</div>
<table>
  <tr>
    <th>名前</th>
    <th>勤務開始</th>
    <th>勤務終了</th>
    <th>休憩時間</th>
    <th>勤務時間</th>
  </tr>
  @foreach($attendanceList as $attendance)
  <tr>
    <td>{{$attendance['name']}}</td>
    <td>{{$attendance['attendanceOnStr']}}</td>
    <td>{{$attendance['attendanceOffStr']}}</td>
    <td>{{$attendance['totalPauseStr']}}</td>
    <td>{{$attendance['attendanceTimeStr']}}</td>
  </tr>
  @endforeach
</table>
<div class="links-wrapper">
  {{$attendanceList->links('pagination.default')}}
</div>
@endsection