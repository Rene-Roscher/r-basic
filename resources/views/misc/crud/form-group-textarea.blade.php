@if($kind)
    @if(strtoupper($kind) == 'HTML')
        <div class="form-group {{ $col }}">
            <label for="{{ $name }}">{{ $label }}</label>
            <textarea data-toggle="tinymce" id="{{ $name }}" name="{{ $name }}" class="form-control" hidden>{!! $value !!}</textarea>
        </div>
    @endif
@else
    <div class="form-group {{ $col }}">
        <label for="{{ $name }}">{{ $label }}</label>
        <textarea id="{{ $name }}" name="{{ $name }}" class="form-control">{!! $value !!}</textarea>
    </div>
@endif
