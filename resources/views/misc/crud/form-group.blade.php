<div class="form-group {{ $col }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <input id="{{ $name }}" type="{{ $type }}" {{ $type == 'checkbox' ? $value : null }} name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}" value="{{ $value }}" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}">
</div>
