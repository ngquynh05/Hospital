<x-layouts.backend>

        @if ($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
                  <li>{{ $errors->first() }}</li>
              </ul>
          </div>
        @endif

<form method="post" action="{{ Route('backend.schedules.update',['id'=>$schedule->id]) }}">
  @csrf
  @method('PUT')
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input name="name" value="{{ $schedule->name ?? ''}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</x-layouts.backend>