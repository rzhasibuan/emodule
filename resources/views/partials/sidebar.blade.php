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
            <li class=""><a class="nav-link" href="{{route("grading.index")}}"><i class="fas fa-check"></i> <span>Grade Essays</span></a></li>
        </ul>
    </aside>
  </div>
