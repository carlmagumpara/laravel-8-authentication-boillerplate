<div class="row">
  <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
    <p>
      Viewing {{ $list->firstItem() ?? 0 }} - {{ $list->lastItem() }} of {{ $list->total() }} entries
    </p>
  </div>
  <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
    {{ $list->links() }}
  </div>
</div>