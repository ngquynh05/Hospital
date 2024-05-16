<x-layouts.frontend>
    <div class="container mt-2">
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                <li>{{ $errors->first() }}</li>
            </ul>
        </div>
    @endif
      <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{ Route('frontend.store') }}">
            @csrf
            

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            
          </form>
        </div>
      </div>
    </div>  
  </x-layouts.frontend>