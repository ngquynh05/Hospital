<h1 class="visually-hidden">Sidebars examples</h1>

  <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a  href="{{ Route('backend.dashboard') }}" class="nav-link @if ($controller=='DashBoardController' && $action=='index') active @endif" aria-current="page">
        <i class="bi bi-list"></i>
          Dashboard
        </a>
      </li>
      <li>
        <a href="{{ Route('backend.admins.index') }}" class="nav-link @if ($controller=='AdminController' && in_array($action,['index','edit'])) active @endif">
        
        <i class="bi bi-person-gear"></i>
          Admins
        </a>
      </li>
      
      <li>
        <a href="{{ Route('backend.schedules.index') }}" class="nav-link @if ($controller=='ScheduleController' && in_array($action,['index','edit'])) active @endif">
        <i class="bi bi-cart3"></i>
           Schedules
        </a>
      </li>
      <li>
        <a href="{{ Route('backend.subjects.index') }}" class="nav-link @if ($controller=='SubjectController' && in_array($action,['index','edit'])) active @endif">
        <i class="bi bi-calendar3"></i>
            Subjects
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
        <i class="bi bi-person-circle"></i>
                  History
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img style="display: none;" src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <img src="{{ Avatar::create(auth()->guard('backend')->user()->name)->toBase64() }}" width="32" height="32" class="rounded-circle me-2"/>
        <strong>
          @if(auth()->guard('backend')->user()->id)
            {{ auth()->guard('backend')->user()->name }}
          @endif
        </strong>
      </a>
      <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ Route('backend.user.logout') }}">Logout</a></li>
      </ul>
    </div>
  </div>
  <div class="b-example-divider b-example-vr"></div>
  