<button class="btn btn-sm btn-success mb-2 w-100" type="button" data-bs-toggle="modal" data-bs-target="#update-item-{{ $data->id }}">
  <i class="fa-solid fa-pencil"></i> Edit
</button>
<form method="POST" action="{{ route('user.update', $data->id) }}" data-ajax="true">
  <div class="modal" tabindex="-1" id="update-item-{{ $data->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title text-capitalize">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="role_id" value="{{ $data->role_id }}">
          @include('generate.input', [
            'label' => 'First Name',
            'name' => 'first_name',
            'value' => $data->first_name,
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'label' => 'Last Name',
            'name' => 'last_name',
            'value' => $data->last_name,
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'label' => 'Middle Name',
            'name' => 'middle_name',
            'value' => $data->middle_name,
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'label' => 'Contact No.',
            'name' => 'contact_no',
            'value' => $data->contact_no,
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.select', [
            'label' => 'Gender',
            'name' => 'gender',
            'value' => $data->gender,
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
            'value' => $data->date_of_birth,
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.select', [
            'label' => 'Status',
            'name' => 'status',
            'value' => $data->status,
            'options' => [
              [
                'name' => 'Activate',
                'value' => 'Active',
              ],
              [
                'name' => 'Pending',
                'value' => 'Pending',
              ],
              [
                'name' => 'Suspend',
                'value' => 'Suspended',
              ],
            ],
            'formGroupClass' => 'mb-3'
          ])
          <div class="alert alert-primary" role="alert">
            Leave this empty if you want to unchanged password.
          </div>
          @include('generate.input', [
            'type' => 'password',
            'label' => 'Password',
            'name' => 'password',
            'value' => '',
            'formGroupClass' => 'mb-3'
          ])
          @include('generate.input', [
            'type' => 'password',
            'label' => 'Confirm Password',
            'name' => 'password_confirmation',
            'value' => '',
            'formGroupClass' => 'mb-3'
          ])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>