@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {!! \RServices\Helpers\Datatable::create()->add('id', 'name', 'email', 'created_at')->view(route('datatable'), 'ID', 'Name', 'E-Mail', 'Created At') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
