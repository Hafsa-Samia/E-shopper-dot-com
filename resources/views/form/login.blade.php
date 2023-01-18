<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')::Customercare
    </title>
    <!-- CSS only -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
    {{-- <link href="css/styles.css" rel="stylesheet" /> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>




<body style="background-color:#d3e9f366">
    {
        <div class="container">

            <div class="custom-login">
                <div class="row">
                    <div class="col-md-4 offset-4">
                        <h4 align="center">Sign Up</h4>
                        <hr>
                        <form action="{{ route('login-user') }}" method="POST">
                            @if(Session::has('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="InputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="logemail" name="email"
                                    aria-describedby="emailHelp" value="{{ old('email') }}">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="mb-3">
                                    <label for="InputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="logpass" name="password">
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-primary">LogIn</button>
                                <br>
                                <p>New User? Create an account from <a href="{{ route('registration') }}">here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    }

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>

</html>

