<button class="btn btn-sm btn-success mb-2 w-100" type="button" data-bs-toggle="modal" data-bs-target="#update-item-{{ $data->id }}">
  <i class="fa-solid fa-pencil"></i> Edit
</button>
<form method="POST" action="{{ route('faq.update', $data->id) }}" data-ajax="true">
  <div class="modal" tabindex="-1" id="update-item-{{ $data->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Update FAQ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-floating mb-3">
            <input name="question" type="text" class="form-control" placeholder="Question" value="{{ $data->question }}">
            <label>Question</label>
          </div>
          <div class="form-floating mb-3">
            <textarea name="answer" class="form-control" rows="10" placeholder="Answer">{{ $data->answer }}</textarea>
            <label>Answer</label>
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