<x-layouts.frontend>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">User information</li>
            </ol>
        </nav>
        <p>Full name: <b>{{ $user->name ?? '' }}</b></p>
        <p>Email: <b>{{ $user->email ?? '' }}</b></p>
        <p>Phone: <b>{{ $user->phone ?? '' }}</b></p>
        <p>Address: <b>{{ $user->address ?? '' }}</b></p>
        <p>Avatar: <img src= "{{ Avatar::create($user->name)->toBase64() }}" height="50" width="50"/></p>
        <p>Birthday: <b>{{ !empty($user->birthday) ? date('d/m/Y', strtotime($user->birthday)) :null }}</b></p>
        <p>Gender: <b>{{ $user->gender == 1 ? 'male' : 'female' }}</b></p>


    </div>
</x-layouts.frontend>
