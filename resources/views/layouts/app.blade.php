<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Microposts</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        @include('commons.navbar') {{-- サブビュー　commonsフォルダのナビバーファイルを表示する --}}

        <div class="container">
            @include('commons.error_messages') {{-- commonsフォルダのエラーメッセージを表示する --}}

            @yield('content') {{-- セクションの内容をはめこんで表示する --}}
        </div>
    </body>
</html>