<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Question</th>
      <th scope="col">Answer</th>
      <th scope="col" style="width: 100px;">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($list as $data)
    <tr>
      <td>{{ $data->id }}</td>
      <td>{{ $data->question }}</td>
      <td>{{ $data->answer }}</td>
      <td class="">
        @include('shared.edit-faq')
        @include('shared.delete-item', ['class' => 'w-100', 'type' => 'FAQ', 'id' => $data->id, 'url' => route('faq.delete')])
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@include('shared.pagination')