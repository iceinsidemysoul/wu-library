<nav class="navbar navbar-toggleable-md navbar-inverse bg-faded" style="background-color: #ff6a00;">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNavBar" aria-controls="mainNavBar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/admin">WU</a>

  <div class="collapse navbar-collapse ml-md-5" id="mainNavBar">
    <ul class="navbar-nav mr-auto">
      <router-link tag="li" to="/admin" class="nav-item" exact>
        <a class="nav-link"><i class="fa fa-home"></i> Home</a>
      </router-link>
      <router-link tag="li" to="/admin/post" class="nav-item">
        <a class="nav-link"><i class="fa fa-file-text-o"></i> Post</a>
      </router-link>
      <router-link tag="li" to="/admin/category" class="nav-item">
        <a class="nav-link"><i class="fa fa-tags"></i> Category</a>
      </router-link>
      
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
