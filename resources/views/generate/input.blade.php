<div class="form-floating {{ $formGroupClass ?? '' }}">
  <input {{ isset($id) ? 'id='.$id.'' : '' }} name="{{ $name }}" type="{{ $type ?? 'text' }}" class="form-control {{ $inputClass ?? '' }}" value="{{ $value }}" placeholder="{{ $label }}" {{ isset($required) ? 'required' : '' }} autocomplete="off" {{ isset($step) ? 'step='.$step.'' : '' }} {{ isset($disabled) ? 'disabled' : '' }}>
  <label class="mb-2">{{ $label }}</label>
</div>