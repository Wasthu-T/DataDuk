<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ucfirst(request() -> segment(1))}} || DataDuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @yield('css')
</head>

<body>
    <div class="d-flex">
        @include('admin.dashboard.partial.navbar')
        @yield('container')
    </div>
</body>

@yield('scripts')


</html>