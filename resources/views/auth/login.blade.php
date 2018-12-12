@extends('layouts.app') {{-- layoutsフォルダのappファイルを親レイアウトとして継承する --}}

@section('content') {{-- appファイルのyield部分にセクションをはめ込む。  --}}
    <div class="text-center">
        <h1>Log in</h1>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            {!! Form::open(['route' => 'login.post']) !!} {{--フォームを始める宣言、ルーティング名を指定してPOSTメソッドでの送り先を指定 --}}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!} {{-- フォームの名前をemail、ラベルをEmailとする --}}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}  {{-- 引数　名前、値、属性追加　--}}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!} {{-- submitの第一引数はボタンの表示を与える。--}}
            {!! Form::close() !!}

            <p>New user? {!! link_to_route('signup.get', 'Sign up now!') !!}</p>
            {{--link_to_route 引数　ルーティング名、リンクにしたい文字列、URLのパラメータに代入したい値、HTMLタグの属性を配列形式で指定 --}} 
        </div>
    </div>
@endsection