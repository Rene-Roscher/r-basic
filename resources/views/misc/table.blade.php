<table class="table table-striped table-bordered" style="width:100%" data-toggle="datatable" data-url="{{ $ajax }}" data-columns="{{ $columns }}">
    <thead>
    <tr>
        @foreach($columnNames as $column)
            <th>{{ $column }}</th>
        @endforeach
    </tr>
    </thead>
</table>
