<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce Website</title>
    {{-- Bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- custome css --}}
    <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <main class="container-fluid">
        <div class="row">
            <div class="col-4 offset-4 mt-5">
                <div class=" d-flex justify-content-center bg-white">
                    <img class="w-25" src="{{ asset('logo/shopLogo.png') }}" alt="shopLogo">
                </div>
                <div class="card shadow-sm">

                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="userEmail">Name</label>
                                <input class="form-control" id="userEmail" name="email" type="email"
                                       placeholder="Enter email..." />
                            </div>
                            <div class="form-group mt-3">
                                <label for="userPassword">Password</label>
                                <input class="form-control" id="userPassword" name="password" type="password"
                                       placeholder="Enter password..." />
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn bg-dark text-white" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- Bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>





