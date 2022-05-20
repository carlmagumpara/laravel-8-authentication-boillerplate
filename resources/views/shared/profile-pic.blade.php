<div class="d-flex justify-content-center">
  <div id="profile-container" class="mb-3 position-relative">
    <img  id="profileImage" class="bg-secondary" data-original="{{ $user->photo ?? auth()->user()->photo }}" style="object-fit: cover;" src="{{ $user->photo ?? auth()->user()->photo }}" alt="{{ $user->email ?? auth()->user()->email }}">
    <div class="position-absolute profile-photo-icon">
      <i class="fa fa-camera"></i>
    </div>
  </div>
</div>
<form class="text-center" method="POST" enctype="multipart/form-data" action="{{ route('profile.update.profile-photo') }}">
  @csrf
  <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture>
  <div id="uploadPhotoButton" class="d-none">
    <button
      type="submit"
      class="btn btn-primary"
    >
      Save Photo
    </button>
    <button
      type="button"
      class="btn btn-secondary"
      id="uploadPhotoButtonReset"
    >
      Cancel
    </button>
  </div>
</form>