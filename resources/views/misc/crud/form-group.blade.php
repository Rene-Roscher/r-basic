@if($type != 'checkbox')
    <div class="form-group {{ $col }}">
        <label for="{{ $name }}">{{ $label }}</label>
        <input id="{{ $name }}" type="{{ $type }}" {{ $type == 'checkbox' ? $value : null }} name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}" value="{{ $value }}" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}">
    </div>
@else
    <div class="form-group {{ $col }}">
        <label>{{ $label }}</label>
        <div class="custom-control custom-checkbox">
            <input name="{{ $name }}" type="checkbox" class="custom-control-input" id="{{ $name }}" {{ $value == 'true' ? 'checked' : null }}>
            <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
        </div>
    </div>
@endif

