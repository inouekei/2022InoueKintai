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
    /* display: block; */
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

  .links-wrapper a {
    padding: 5px 10px;
    margin: 2px;
    background-color: white;
    color: blue;
  }
</style>
@section('content')
<div class="common-ttl">
  <a href="/attendance">&lt;</a>
  2021-11-01
  <a href="/attendance">&gt;</a>
</div>
<table>
  <tr>
    <th>名前</th>
    <th>勤務開始</th>
    <th>勤務終了</th>
    <th>休憩時間</th>
    <th>勤務時間</th>
  </tr>
  <tr>
    <td>user1</td>
    <td>09:00:00</td>
    <td>17:00:00</td>
    <td>01:00:00</td>
    <td>07:00:00</td>
  </tr>
  <tr>
    <td>user2</td>
    <td>09:00:00</td>
    <td>17:00:00</td>
    <td>01:00:00</td>
    <td>07:00:00</td>
  </tr>
  <tr>
    <td>user3</td>
    <td>09:00:00</td>
    <td>17:00:00</td>
    <td>01:00:00</td>
    <td>07:00:00</td>
  </tr>
  <tr>
    <td>user4</td>
    <td>09:00:00</td>
    <td>17:00:00</td>
    <td>01:00:00</td>
    <td>07:00:00</td>
  </tr>
  <tr>
    <td>user5</td>
    <td>09:00:00</td>
    <td>17:00:00</td>
    <td>01:00:00</td>
    <td>07:00:00</td>
  </tr>
</table>

<div class="links-wrapper">
  <a href="/attendance">&lt;</a>
  <a href="/attendance">1</a>
  <a href="/attendance">2</a>
  <a href="/attendance">3</a>
  <a href="/attendance">4</a>
  <a href="/attendance">5</a>
  <a href="/attendance">6</a>
  <a href="/attendance">7</a>
  <a href="/attendance">8</a>
  <a href="/attendance">9</a>
  <a href="/attendance">10</a>
  <a href="/attendance">...</a>
  <a href="/attendance">20</a>
  <a href="/attendance">21</a>
  <a href="/attendance">&gt;</a>
</div>
@endsection