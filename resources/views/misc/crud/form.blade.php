@extends('layouts.app')

@section('before_content')
    {!! \RServices\Helpers\Button\ButtonBuilder::create()->addEdit(url()->previous(), '<i class="fa fa-arrow-left mr-1"></i> Back', 'dark col-12 col-xl-2 col-md-12 col-xs-12 mb-2')->make() !!}
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
