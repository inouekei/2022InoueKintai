<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      background-color: whitesmoke;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 80px;
      margin: 0;
      padding: 0 50px;
      background-color: white;
    }

    header ul {
      display: flex;
      justify-content: space-around;
      text-decoration: none;
      list-style: none;
      font-weight: bold;
    }

    header li:not(:last-child) {
      margin-right: 50px;
    }

    header a {
      color: black;
    }

    a {
      text-decoration: none;
      color: blue;
    }

    .sv-ttl {
      font-weight: bold;
      font-size: xx-large;
    }

    .content {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0;
      padding: 30px;
    }

    footer {
      height: 50px;
      margin-top: auto;
      background-color: white;
      line-height: 50px;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <header>
    <div>
      <a class="sv-ttl" href="/">Atte</a>
    </div>
    <div>
      <ul>
        @if (Auth::check())
        <li><a href="/">ホーム</a></li>
        <li><a href="/attendance">日付一覧</a></li>
        <li><a href="/logout">ログアウト</a></li>
        @endif
      </ul>
    </div>
  </header>
  <div class="content">
    @yield('content')
  </div>
  <footer>Atte, Inc.</footer>
</body>

</html>