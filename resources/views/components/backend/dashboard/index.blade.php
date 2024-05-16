<x-layouts.backend>
    <div class="alert alert-danger" role="alert">
        A simple danger alert-check it out!
    </div>
    <div>Dashboard</div>
    <div>Welcome <b>{{ $user->name ?? 'unknown'}}</b></div>
</x-layouts.backend>