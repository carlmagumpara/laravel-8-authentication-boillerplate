@include('shared.pagination')
<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        @if($type === 'admins')
        <th scope="col">Is Super Admin</th>
        @endif
        <th scope="col">Email</th>
        <th scope="col">Contact No.</th>
        <th scope="col">Date of Birth</th>
        <th scope="col">Status</th>
        <th scope="col">Deleted At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($list as $data)
      <tr>
        <td>{{ $data->id }}</td>
        <td> <img src="{{ $data->photo }}" style="width: 30px; height: 30px;" class="me-2"> <span>{{ $data->first_name }} {{ $data->last_name }}</span></td>
        @if($type === 'admins')
        <td>{{ $data->is_super ? 'Yes' : 'No' }}</td>
        @endif
        <td>{{ $data->email ?? 'N/A' }}</td>
        <td>{{ $data->contact_no ?? 'N/A' }}</td>
        <td>{{ $data->date_of_birth ?? 'N/A' }}</td>
        <td>{{ $data->deleted_at ? 'Deleted' : $data->status }}</td>
        <td>{{ $data->deleted_at ?? 'N/A' }}</td>
        <td>
          @if($data->deleted_at)
            @include('shared.restore-item', ['class' => 'w-100', 'type' => 'User', 'id' => $data->id, 'url' => route('user.restore')])
          @else
            @include('shared.edit-user')
            @include('shared.delete-item', ['class' => 'w-100', 'type' => 'User', 'id' => $data->id, 'url' => route('user.delete')])
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@include('shared.pagination')