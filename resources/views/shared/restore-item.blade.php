<button type="button" class="btn btn-success btn-sm {{ $class ?? '' }}" data-bs-toggle="modal" data-bs-target="#delete-{{ $type }}-{{ $id }}"><i class="fa-solid fa-trash-arrow-up"></i> Restore</button>
<form method="POST" enctype="multipart/form-data" action="{{ $url }}" data-ajax="true">
  <input type="hidden" name="id" value="{{ $id }}">
  <div class="modal fade" id="delete-{{ $type }}-{{ $id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Do you want to <strong class="text-danger">&nbsp;restore&nbsp;</strong>this item?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Select "Confirm" below if you are continue this action.</p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>