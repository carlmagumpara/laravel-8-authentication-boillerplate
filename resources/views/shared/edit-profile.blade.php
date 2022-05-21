<div class="row mb-3">
  <div class="col-md-8">
    <h5>Profile</h5>
    <form class="mt-4" method="POST" action="{{ route('profile.update.user') }}" data-ajax="true">
      @csrf
      @include('generate.input', [
        'label' => 'First Name',
        'name' => 'first_name',
        'value' => auth()->user()->first_name,
        'formGroupClass' => 'mb-3'
      ])
      @include('generate.input', [
        'label' => 'Last Name',
        'name' => 'last_name',
        'value' => auth()->user()->last_name,
        'formGroupClass' => 'mb-3'
      ])
      @include('generate.input', [
        'label' => 'Middle Name',
        'name' => 'middle_name',
        'value' => auth()->user()->middle_name,
        'formGroupClass' => 'mb-3',
      ])
      @include('generate.input', [
        'label' => 'Email',
        'name' => '',
        'value' => auth()->user()->email,
        'formGroupClass' => 'mb-3',
        'disabled' => true,
      ])
      @include('generate.input', [
        'label' => 'Contact No.',
        'name' => 'contact_no',
        'value' => auth()->user()->contact_no,
        'formGroupClass' => 'mb-3'
      ])
      @include('generate.select', [
        'label' => 'Gender',
        'name' => 'gender',
        'value' => auth()->user()->gender,
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
        'value' => auth()->user()->date_of_birth,
        'formGroupClass' => 'mb-3'
      ])
      <div>
        <button
          type="submit"
          class="btn btn-primary btn-lg"
        >
          Update
        </button>
      </div>
    </form>
  </div>
  <div class="col-md-4">
    <h5>Select Photo</h5>
    <div class="mt-4">
      @include('shared.profile-pic')
    </div>
    <div class="text-center">
      <p class="mb-0">File size: maximum 1 MB</p>
      <p>File extension: .JPEG, .PNG</p>
    </div>
  </div>
</div>