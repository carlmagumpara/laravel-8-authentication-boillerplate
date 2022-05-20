<button class="btn btn-danger text-capitalize" type="button" data-bs-toggle="modal" data-bs-target="#create-faq">
  <i class="fa fa-plus"></i> Create {{ substr($type, 0, -1) }}
</button>
<form method="POST" action="{{ route('user.create') }}" data-ajax="true">
  <div class="modal" tabindex="-1" id="create-faq">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title text-capitalize">Create {{ substr($type, 0, -1) }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @php
            $roleId = [
                'admins' => 1,
                'staffs' => 2,
                'users' => 3,
            ];
          @endphp
          <input type="hidden" name="role_id" value="{{ $roleId[$type] }}">
          @include('generate.input', [
            'label' => 'First Name',
            'name' => 'first_name',
            'value' => '',
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'label' => 'Last Name',
            'name' => 'last_name',
            'value' => '',
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'label' => 'Middle Name',
            'name' => 'middle_name',
             'value' => '',
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'label' => 'Contact No.',
            'name' => 'contact_no',
            'value' => '',
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.select', [
            'label' => 'Gender',
            'name' => 'gender',
            'value' => '',
            'options' => [
              [
                'name' => 'Male',
                'value' => 'Male',
              ],
              [
                'name' => 'Female',
                'value' => 'Female',
              ]
            ],
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'label' => 'Date of Birth',
            'type' => 'date',
            'name' => 'date_of_birth',
            'value' => '',
            'formGroupClass' => 'mb-3'
          ])
          <div class="form-floating mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">
            <label for="email" class="">{{ __('Email Address') }}</label>
            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}">
            <label for="password" class="">{{ __('Password') }}</label>
            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
            <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>