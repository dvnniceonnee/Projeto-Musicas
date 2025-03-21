<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Shop</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.min.css">
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
</head>
<body class="fs-6">
<header class="px-3 pt-3 pb-1">
    <nav class="navbar bg-gray col-12 mx-auto rounded-3">
        <div class="container-fluid">
            <a class="text-white m-0 col-2 text-decoration-none" href="{{route('route_home')}}"><i
                    class="bi bi-house-door"></i><Span class="ms-2 e">Início</Span></a>
            <form class="d-flex col-6 mx-auto w-50" role="search" action="{{route('index_all', "musics")}}" method="GET">
                <input class="form-control me-2 rounded-3" type="search" name="search" value="{{ request()->query('search') }}" placeholder="Search Musics"
                       aria-label="Search">
                <button class="btn text-white" type="submit"><i class="bi bi-search"></i></button>
            </form>
            @if(Route::has('login'))
                @auth
                    <div class="nav-item dropdown">
                        <a data-bs-toggle="dropdown" aria-expanded="true" href="" >
                            <img src="{{asset('storage/'.Auth::user()->photo)}}"
                                 class="img-fluid navbar-brand rounded-circle" alt="" width="35" height="30">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2">
                            <li class="my-1">
                                <a class="dropdown-item text-center p-0" href="{{route('user_profile')}}">
                                    <button class="btn btn-secondary text-white w-100 rounded-pill" type="submit">
                                        <span class="mx-2">Profile</span><i class="bi bi-person-square"></i></button>
                                </a>
                            </li>
                            @if(\App\Models\User::checkIfItsAdmin())
                                <li class="my-1">
                                    <a class="dropdown-item text-center p-0" href="{{route('user_dashboard')}}">
                                        <button class="btn btn-secondary text-white w-100 rounded-pill" type="submit">
                                            <span class="mx-2">Dashboard</span><i class="bi bi-list"></i></button>

                                    </a>
                                </li>
                            @endif
                            <li class="my-1">
                                <form class="dropdown-item text-center p-0" action="{{ route('logout') }}" method="POST" >
                                    @csrf
                                    <button class="btn btn-danger text-white w-100 rounded-pill" type="submit"><span class="mx-2">Logout</span><i class="bi bi-box-arrow-left"></i></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="text-white col-2 text-end text-decoration-none" href="{{route('login')}}"><i
                            class="bi bi-door-open"></i><span class="mx-2">Login</span></a>
                @endauth
            @endif

        </div>
    </nav>
</header>
<main class="px-3 my-1">
    @yield('content')
</main>
<footer class="p-3 mt-0">
    <div class="container-fluid mt-0 bg-gray rounded-2 text-white p-2">
        <ul class="nav justify-content-center border-bottom w-50 mx-auto pb-3 mb-3">
            <li class="nav-item"><a href="{{route('route_home')}}" class="nav-link px-2 text-white">Home</a></li>
            <li class="nav-item"><a href="{{route('index_all', 'pages')}}" class="nav-link px-2">Musics</a></li>
            <li class="nav-item"><a href="{{route('index_all', 'albums')}}" class="nav-link px-2">Albums</a></li>
            <li class="nav-item"><a href="{{route('index_all', 'bands')}}" class="nav-link px-2">Bands</a></li>
            <li class="nav-item"><a href="{{route('register')}}" class="nav-link px-2">Register</a></li>
        </ul>
        <p class="text-center mb-3">© 2024 Miguel Madureira, Software Developer</p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.16/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script
    src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js"></script>
<script src="{{asset('js\script.js')}}"></script>
</body>
</html>
