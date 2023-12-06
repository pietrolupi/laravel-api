<header class="bg-dark">
    <nav class="navbar navbar-dark">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{route('home')}}" target="_blank">Vai al sito pubblico <i class="fa-solid fa-house"></i></a>
            <form action="{{route('logout')}}" method="POST" class="d-flex">
                @csrf
              <button class="btn btn-danger my-2 my-sm-0" type="submit">Vai al sito</button>
            </form>
        </div>
      </nav>
</header>
