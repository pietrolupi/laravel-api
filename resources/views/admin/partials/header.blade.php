<header class="bg-dark">
    <nav class="navbar navbar-dark">
        <div class="container-fluid d-flex justify-content-between ">
            <div>
                <a class="navbar-brand" href="{{route('home')}}" target="_blank">PUBLIC HOME <i class="fa-solid fa-house"></i></a>

            </div>

            <div>
                <form action="{{route('admin.projects.index')}}" method="GET">
                    <input name="toSearch" class="form-control mr-sm-2" type="text" type="search" placeholder="Cerca un progetto...">
                </form>
            </div>

            <div class="d-flex align-items-center">
                <a class="me-3" href="{{route('profile.edit')}}">{{Auth::user()->name}}</a>
                <form action="{{route('logout')}}" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-danger my-2 my-sm-0" type="submit">LOGOUT</button>
                </form>
            </div>
        </div>
    </nav>
</header>
