@extends('layouts.app')

@section('before_content')
    <a type="button" class="col-12 col-xl-2 col-md-12 col-xs-12 btn btn-dark mb-2" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Zurück</a>
@endsection

@section('content')
<form data-rs action="{{ $action }}" method="{{ $method }}">
    <div class="row">
        {!! $slot !!}
    </div>
    @if($action)
        <button type="submit" class="btn btn-primary">{{ $submitTitle }}</button>
    @endif
</form>
@endsection
