@extends('layouts.app') {{-- layoutsフォルダのappファイルを親レイアウトとして継承する --}}

@section('content') {{-- appファイルのyield部分にセクションをはめ込む。  --}}
    <div class="text-center">
        <h1>Sign up</h1>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            {!! Form::open(['route' => 'signup.post']) !!} {{--フォームはここからはじめる宣言。'route'=>ルーティング名でPOStメソッド送り先の指定している。
            　　signup.postのルーディング、つまりregister()アクションに送信される　--}}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!} {{-- 第一引数はこのフォームの名前を指定する,　　第二引数はラベル名　--}}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!} {{-- 引数　名前、値、属性追加　--}}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!} {{-- old関数で、直前で入力した値を再度代入しておける　--}}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirmation') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!} {{-- submitの第一引数はボタンの表示を与える。--}}
            {!! Form::close() !!} {{-- form終了 --}}
        </div>
    </div>
@endsection