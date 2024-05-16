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
                <a href="{{ Route('backend.admins.create') }}" class="btn btn-primary mb-3">Create</a>
            </div>
         </form>
        
         <table class="table table-bordered shadow p-3 mb-5 bg-body-tertiary rounded">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Function</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $i = $offset+1;
                @endphp
                @forelse ($users as $item )
                <tr>

                    <th scope="row">{{ $i }}</th>
                    <td><img src="{{ Avatar::create($item->name)->toBase64() }}" width="50" height="50" class="rounded-circle me-2"/></td>
                    <td>{{ $item->name ?? '' }}</td>
                    <td>{{ $item->email ?? '' }}</td>
                    <td>
                        <a role="button" class="btn btn-primary btn-sm" href="{{ Route('backend.admins.edit',['id'=>$item->id]) }}"><i class="bi bi-pencil"></i> Edit</a>
                        <button @if ($item->id == $user->id)disabled @endif
                         type="button" class="btn btn-danger btn-sm deleteAdmin" data-id="{{ $item->id }}"><i class="bi bi-trash3-fill"></i> Delete</button>
                    </td>
                </tr>
                    @php
                        $i++;
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

                $(document).on('click', '.deleteAdmin', function(e) {
                    let id = $(this).data('id');
                    Swal.fire({
                        title: "Bạn có chắc là xóa không?",
                        showCancelButton: true,
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Đóng",
                    }).then((result) => {
                        // Read more about isConfirmed, isDenied below /
                        if (result.isConfirmed) {
                            let url = 'admins/' + id;
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