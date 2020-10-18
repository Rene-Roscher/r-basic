<div class="form-group {{ $col }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}[]" class="form-control" multiple>
        @foreach($options as $k => $v)
            <option value="{{ $k }}" {{ in_array($k, $values) ? 'selected' : null }}>{{ $v }}</option>
        @endforeach
    </select>
</div>
