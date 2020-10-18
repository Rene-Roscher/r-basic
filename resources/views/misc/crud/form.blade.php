@extends('layouts.app')

@section('before_content')
    @php($ex = explode('.', request()->route()->getAction('as')))
    @if(count($ex) == 3)
        @if($ex[2] == 'create' || $ex[2] == 'edit')
            @php($ex[2] = 'view')
            @if(\Illuminate\Support\Facades\Route::has($route = implode('.', $ex)))
                {!! \RServices\Helpers\Button\ButtonBuilder::create()->addEdit(route($route), '<i class="fa fa-arrow-left mr-1"></i> Back', 'dark col-12 col-xl-2 col-md-12 col-xs-12 mb-2')->make() !!}
            @endif
        @elseif($ex[2] == 'view')
            @php($ex[2] = 'create')
            @if(\Illuminate\Support\Facades\Route::has($route = implode('.', $ex)))
                {!! \RServices\Helpers\Button\ButtonBuilder::create()->addEdit(route(implode('.', $ex)), '<i class="fa fa-arrow-left mr-1"></i> Create', 'dark col-12 col-xl-2 col-md-12 col-xs-12 mb-2')->make() !!}
            @endif
        @endif
    @endif
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
