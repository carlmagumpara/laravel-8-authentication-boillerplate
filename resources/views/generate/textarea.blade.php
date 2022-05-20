<div class="form-group {{ $formGroupClass ?? '' }}">
  <label class="mb-2">{{ $label }}</label>
  <textarea {{ isset($id) ? 'id='.$id.'' : '' }} name="{{ $name }}" class="form-control {{ $inputClass ?? '' }}"  placeholder="{{ $label }}" {{ isset($required) ? 'required' : '' }} autocomplete="off" rows="{{ $rows ?? 3 }}">{{ $value }}</textarea>
</div>