<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ucfirst(request() -> segment(1))}} || DataDuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('foto/Dataduk.png') }}"/>
    @yield('css')
</head>

<body>
    <div class="row d-flex m-0">
        <div class="col col-md-3 col-lg-2 p-0">
            @include('admin.dashboard.partial.navbar')
        </div>

        <div class="col col-md-9 col-lg-10 p-0">
            @yield('container')
        </div>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</html>