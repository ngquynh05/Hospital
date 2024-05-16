<x-layouts.backend>
    <div class="container">
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
    @endif
        <form class="row g-8">
            <div class="col-auto">
               <label for="inputPassword2" class="visually-hidden">Full Name</label>
               <input type="text" name="search" value="{{ $params['search'] ?? '' }}" class="form-control" id="search" placeholder=" ">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
                <a href="{{ Route('backend.subjects.create') }}" class="btn btn-primary mb-3">Create</a>
            </div>
         </form>
        
         <table class="table table-bordered shadow p-3 mb-5 bg-body-tertiary rounded">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Function</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $t = $offset+1;
                @endphp
                @forelse ($subjects as $item )
                <tr>
                    <th scope="row">{{ $t }}</th>
                    <td>{{ $item->name ?? '' }}</td>
                    <td>{{ $item->description ?? '' }}</td>
                    <td>{{ $item->price ?? '' }}</td>
                    <td>{{ $status[$item->status] }}</td>
                    <td>
                        <a role="button" class="btn btn-primary btn-sm" href="{{ Route('backend.subjects.edit',['id'=>$item->id]) }}">
                        <i class="bi bi-pencil"></i> Edit</a>
                        <a role="button" data-id="{{ $item->id }}" class="btn btn-danger btn-sm destroySubject" href="#">
        
        
                        <i class="bi bi-trash3"></i> Delete</a>
                    </td>
                </tr>
                    @php
                        $t++;
                    @endphp
                @empty
                <tr>
                    <td colspan="3">No records found</td>
                </tr>
                    
                @endforelse
              
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

                $(document).on('click', '.destroySubject', function(e) {
                    let id = $(this).data('id');
                    Swal.fire({
                        title: "Bạn có chắc là xóa không?",
                        showCancelButton: true,
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Đóng",
                    }).then((result) => {
                        // Read more about isConfirmed, isDenied below /
                        if (result.isConfirmed) {
                            let url = '/admin/subjects/' + id;
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
        </script>

    </x-slot>
    </div>

    
</x-layouts.backend>