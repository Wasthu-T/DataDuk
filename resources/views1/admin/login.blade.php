<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataDuk || Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
</head>

<body>
    <div class="container center-container">
        <div class="card shadow-sm">
            @if(session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>{{ session('status') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>{{ session('loginError') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card-body">
                <h3 class="text-center mb-5 mt-2">Login</h3>
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">✉</span>
                            <input required name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email">
                        </div>
                    </div>
                    @error('email')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">🗝</span>
                            <input required name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Password">
                        </div>
                    </div>
                    <!-- <div class="text-end mb-3">
                        <a href="#" class="text-hover">Lupa Password?</a>
                    </div> -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-custom">Submit</button>
                    </div>
                    <!-- <div class="mt-3 text-center">
                        <span>Belum Punya Akun? <a href="/registration" class="text-hover">Daftar</a></span>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>