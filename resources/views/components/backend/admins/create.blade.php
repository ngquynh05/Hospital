<x-layouts.backend>
    <div class="container">
      @if ($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
                  <li>{{ $errors->first() }}</li>
              </ul>
          </div>
      @endif
      <div class="row">
        <div class="col-md-6">
          <form method="post" action="{{ $isEdit == 1 ? Route('backend.admins.update',['id'=>$user->id]):
          Route('backend.admins.store') }}">
            @csrf
            @if ($isEdit == 1)
                @method('PUT')
            @endif
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Full name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name',!empty($user->name) ? $user->name : '') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email',!empty($user->email) ? $user->email : '') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            @if ($isEdit == 1)
                <button type="submit" class="btn btn-primary">Update</button>
            @else
                <button type="submit" class="btn btn-primary">Submit</button>
            @endif
          </form>
        </div>
      </div>
    </div>  
  </x-layouts.backend>