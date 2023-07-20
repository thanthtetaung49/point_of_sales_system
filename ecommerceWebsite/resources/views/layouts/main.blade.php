<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Point of sales system</title>
    {{-- Bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- Fontawesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Datatable --}}
    <link type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"
          rel="stylesheet">
    {{-- custome css --}}
    <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <header>
        <section class="border-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 sidebar">
                        <a class="nav-link text-light fs-4 mt-3" href="{{ route('dashboard') }}">
                            <img class="w-25 logo me-3" src="{{ asset('logo/shopLogo.png') }}" alt="shoplogo">
                        </a>
                        <span class="border-bottom">Admin Panel</span>
                        <ul class="list-unstyled mt-3">
                            <li class="py-3">
                                <a style="font-size: 15px" class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-line me-1"></i></i>
                                    Dashboard</a>
                            </li>
                            <li class="py-3">
                                <a style="font-size: 15px" class="nav-link"
                                   href="{{ route('categoryListPage') }}"><i class="fa-solid fa-list me-1"></i>category
                                    list</a>
                            </li>
                            <li class="py-3">
                                <a style="font-size: 15px" class="nav-link" href="{{ route('productPage') }}"><i class="fa-brands fa-product-hunt me-1"></i>product
                                    list</a>
                            </li>
                            <li class="py-3">
                                <a style="font-size: 15px" class="nav-link" href="{{ route('salesListPage') }}"><i class="fa-solid fa-cart-arrow-down me-1"></i>Sales
                                    list</a>
                            </li>
                            <li class="py-3">
                                <a style="font-size: 15px" class="nav-link"
                                   href="{{ route('totalSalesListPage') }}"><i class="fa-solid fa-cart-shopping me-1"></i>Total Sales
                                    list</a>
                            </li>
                            <li class="py-3">
                                <a style="font-size: 15px" class="nav-link" href="{{ route('userPage') }}"><i class="fa-solid fa-users me-1"></i>User
                                    Management</a>
                            </li>
                            <li class="py-3">
                                <a style="font-size: 15px" class="nav-link" href="{{ route('adminPage') }}"><i class="fa-solid fa-user me-1"></i>Admin
                                    Management</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-10">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container-fluid border-bottom mb-3">
                                <button class="navbar-toggler" data-bs-toggle="collapse"
                                        data-bs-target="#navbarSupportedContent" type="button"
                                        aria-controls="navbarSupportedContent" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ms-auto me-5 mb-lg-0">
                                        <li class="nav-item dropdown me-5">

                                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                               role="button" aria-expanded="false">
                                                @if (Auth::user()->image_name != null)
                                                    <img class="avator me-2 rounded-circle"
                                                         src="{{ asset('storage/profileImage/' . Auth::user()->image_name) }}"
                                                         alt="{{ Auth::user()->image_name }}">
                                                @else
                                                    <img class="avator me-2 rounded-circle"
                                                         src="{{ asset('defaultImage/defaultMale.jfif') }}"
                                                         alt="defaultMale" />
                                                @endif
                                                {{ Auth::user()->name }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="mt-2"><a class="dropdown-item"
                                                       href="{{ route('profile') }}">Acount
                                                        Profile</a></li>
                                                <li class="mt-2">
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li class="mt-2">
                                                    <form class="d-flex justify-content-end"
                                                          action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                        <a class="me-1">
                                                            <button class="btn btn-sm bg-danger text-light"
                                                                    type="submit">Logout</button>
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>

                        @yield('dataSection')
                    </div>
                </div>
            </div>
        </section>
    </header>

    @yield('main')
    {{-- Bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
            crossorigin="anonymous"></script>
    {{-- data table --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    {{-- Google chart --}}
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    {{-- chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('js')
</body>

</html>
