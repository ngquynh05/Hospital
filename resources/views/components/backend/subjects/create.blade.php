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
          <form method="post" action="{{ $isEdit == 1 ? Route('backend.subjects.update',['id'=>$subject->id]):Route('backend.subjects.store') }}">
            @csrf
            @if ($isEdit == 1)
                @method('PUT')
            @endif
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name',!empty($subject->name) ? $subject->name : '') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Description</label>
              <textarea name="description" class="form-control" >{{ old('description',!empty($subject->description) ? $subject->description : '') }}</textarea>
            </div>
            
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Price</label>
              <input type="text" name="price" class="form-control" value="{{ old('price',!empty($subject->price) ? $subject->price : '') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Status</label>
              <select name="status" class="form-select" aria-label="Default select example">
                <option selected value="1">Dịch vụ đang sử dụng</option>
                <option value="0">Dịch vụ không sử dụng</option>
                </select>
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