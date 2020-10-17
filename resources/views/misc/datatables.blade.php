@extends('layouts.app')

@section('before_content')
    {!! isset($buttons) ? $buttons : null !!}
    <div class="col-12 mb-2"></div>
@endsection

@section('content')
    {!! $view !!}
@endsection
