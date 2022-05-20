<button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#create-faq">
  <i class="fa fa-plus"></i> Create FAQ
</button>
<form method="POST" action="{{ route('faq.create') }}" data-ajax="true">
  <div class="modal" tabindex="-1" id="create-faq">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Create FAQ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-floating mb-3">
            <input name="question" type="text" class="form-control" placeholder="Question">
            <label>Question</label>
          </div>
          <div class="form-floating mb-3">
            <textarea name="answer" class="form-control" rows="10" placeholder="Answer"></textarea>
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