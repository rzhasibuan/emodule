<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{route("dashboard")}}">{{env("APP_NAME") ?? ""}}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{route("dashboard")}}">AP</a>
      </div>
        <ul class="sidebar-menu">
            <li class=""><a class="nav-link" href="{{route("dashboard")}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class=""><a class="nav-link" href="{{route("users")}}"><i class="fas fa-users"></i> <span>Users</span></a></li>
            <li class=""><a class="nav-link" href="{{route("modules.index")}}"><i class="fas fa-archive"></i> <span>Data module</span></a></li>
            <li class=""><a class="nav-link" href="{{route("quizzes.index")}}"><i class="fas fa-question-circle"></i> <span>Quizzes</span></a></li>
            {{-- <li class=""><a class="nav-link" href="{{route('admin.essay-results')}}"><i class="fas fa-clipboard-list"></i> <span>Penilaian Quiz Essay</span></a></li> --}}
            <li class="">
                <a class="nav-link" href="{{ route('admin.essay-grading') }}">
                    <i class="fas fa-clipboard-check"></i> <span>Penilaian Essay</span>
                </a>
            </li>
            <li class=""><a class="nav-link" href="{{route('admin.settings.index')}}"><i class="fas fa-cog"></i> <span>Website Settings</span></a></li>
        </ul>
    </aside>
  </div>
