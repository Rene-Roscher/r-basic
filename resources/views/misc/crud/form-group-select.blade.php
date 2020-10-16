<div class="form-group {{ $col }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-control">
        @foreach($options as $k => $v)
            <option value="{{ $k }}" {{ $k == $value ? 'selected' : null }}>{{ $v }}</option>
        @endforeach
    </select>
</div>
