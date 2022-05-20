<form method="GET" action="{{ route('quiz.search') }}">
  <div class="input-group shadow-sm">
    <input type="text" class="form-control bg-white border-0" name="q" value="{{ $q ?? '' }}" placeholder="Search Quiz....">
    <button class="btn btn-link bg-white" type="submit" id="button-addon2">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </div>
</form>