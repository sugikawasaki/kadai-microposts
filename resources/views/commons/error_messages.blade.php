@if (count($errors) > 0) {{-- もしエラーの数が1以上の場合　--}}
    @foreach ($errors->all() as $error) {{-- エラーのすべてを取りだして、一つずつ実行 --}}
        <div class="alert alert-warning">{{ $error }}</div> {{-- エラーの内容を表示　--}}
    @endforeach
@endif {{-- エラーがない場合終了　--}}