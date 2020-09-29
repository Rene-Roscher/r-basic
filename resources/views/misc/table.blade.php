<table class="table table-padded" style="width:100%" data-toggle="datatable" data-url="{{ $ajax }}" data-columns="{{ $columns }}" data-serverSide="{{ isset($serverSide) && $serverSide }}">
    <thead>
    <tr>
        @foreach($columnNames as $column)
            <th>{{ $column }}</th>
        @endforeach
    </tr>
    </thead>
</table>
