<x-layouts.backend>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{session('error')}}
    </div>
    @endif

    <form class="row g-8">
      <div class="col-auto">
        <label for="inputPassword2" class="visually-hidden">Search</label>
          <input type="text" name="search" value="{{ $params['search'] ?? '' }}" class="form-control" id="search" placeholder=" ">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Search</button>
              <a href="{{ Route('backend.schedules.create') }}" class="btn btn-primary mb-3">Create</a>
            </div>
    </form>
    <table class="table table-dark table-hover">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Created Date</th>
      <th scope="col">Updated Date</th>
      <th scope="col">Functions</th>
    </tr>
    </thead>

    <tbody>
   @php
       $x = $offset +1;
   @endphp
    @foreach ($schedules as $value)
    <tr>
      <th scope="row">{{ $x }}</th>
      <td>{{ $value->name }}</td>
      <td>{{ !empty($value->created_at) ? date('d/m/Y', strtotime($value->created_at)): '' }}</td>
      <td>{{ !empty($value->updated_at) ? date('d/m/Y', strtotime($value->updated_at)): '' }}</td>
      <td>
        <a role="button" class="btn btn-primary btn-sm" 
        href="{{ Route('backend.schedules.edit',['id'=>$value->id]) }}">

        <i class="bi bi-pencil"></i> Edit</a>
        
        <a role="button" data-id="{{ $value->id }}" class="btn btn-danger btn-sm destroySchedule" 
        href="#">
        
        
        <i class="bi bi-trash3"></i> Delete</a>

    </tr>
    @php
        $x++;
    @endphp
    @endforeach
    
    </tbody>

    </table>
    @if (!empty($pager))
        <nav aria-label="Page navigation example">
            {!! $pager !!}  

        </nav>
        @endif

        <x-slot name="javascript">
          <script>
            $(document).ready(function() { 
                 
              $(document).on('click', '.destroySchedule', function(e) {
                let id = $(this).data('id');
                Swal.fire({
                        title: "Bạn có chắc là xóa không?",
                        showCancelButton: true,
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Đóng",
                    }).then((result) => {
                        // Read more about isConfirmed, isDenied below /
                        if (result.isConfirmed) {
                            let url = '/admin/schedules/' + id;
                            $.ajax({
                                url: url,
                                method: 'DELETE',
                                data: {
                                    id: id,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    if (response.status == 'success') {
                                        window.location.reload();
                                    } else {
                                        Swal.fire({
                                            title: "Error",
                                            text: response.message,
                                            icon: "error",
                                        });
                                    }
                                }
                            });

                        }
                    });

              });


            });
            function destroy(id) {
              let isDelete = confirm("Press a button!");
              if(isDelete){
                window.location.href = '/admin/schedules/' + id;
              }
              }
          </script>
        </x-slot>
</x-layouts.backend>