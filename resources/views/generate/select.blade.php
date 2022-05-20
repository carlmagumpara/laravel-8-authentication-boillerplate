<div class="form-floating {{ $formGroupClass ?? '' }}">
  <select data-value="{{ $dataValue ?? '' }}" {{ isset($id) ? 'id='.$id.'' : '' }} name="{{ $name }}" class="form-control {{ $inputClass ?? '' }}" {{ isset($required) ? 'required' : '' }} autocomplete="off">
    <option value="">{{ $placeholder ?? 'Select...' }}</option>
    @foreach ($options as $option)
        <option value="{{ $option['value'] }}" {{ isset($value) ? ($value == $option['value'] ? 'selected' : '') : '' }}>{{ $option['name'] }}</option>
    @endforeach
  </select>
  @if($label)<label class="mb-2">{{ $label }}</label>@endif
</div>