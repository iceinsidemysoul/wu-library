<nav class="navbar navbar-toggleable-md navbar-inverse bg-faded" style="background-color: #ff6a00;">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNavBar" aria-controls="mainNavBar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">WU</a>

  <div class="collapse navbar-collapse ml-md-5" id="mainNavBar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        {{-- <router-link to="/admin" class="nav-link" exact>หน้าแรก</router-link> --}}
        <a class="nav-link current" href="/admin">หน้าแรก</a>
      </li>
      <li class="nav-item">
        {{-- <router-link to="/admin/post" class="nav-link" exact>หน้าแรก</router-link> --}}
        <a class="nav-link" href="/admin/post">Posts</a>
      </li>
      <li class="nav-item">
        {{-- <router-link to="/admin/category" class="nav-link" exact>หน้าแรก</router-link> --}}
        <a class="nav-link" href="/admin/category">Categories</a>
      </li>
    </ul>
    <ul class="nav ml-auto">
      <li class="nav-item">
        <a href="#" class="nav-link btn btn-secondary"
          onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i> Logout
        </a>
      </li>
    </ul>
    <form action="{{ route('logout') }}" method="post" id="logout-form">
      {{ csrf_field() }}
    </form>
  </div>
</nav>