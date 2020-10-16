@extends('layouts.app')

@section('content')
<!--    --><?php
//        $data = call_user_func([\RServices\Helpers\Datatable::class, 'create']);
//        foreach ($columns as $column) call_user_func([$data, 'put'], $column);
//        call_user_func([$data, 'setColumnNames'], $titles);
//?>
    {!! $view !!}
{{--{!! call_user_func([$data, 'view'], $route) !!}--}}
{{--    {!! \RServices\Helpers\Datatable::create()->add(explode(',', $columns))->view($route, explode(',', $columns)) !!}--}}
@endsection
