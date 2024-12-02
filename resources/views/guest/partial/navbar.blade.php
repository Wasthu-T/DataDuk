<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2F3D40;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/beranda">DataDuk</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact Us</a>
                </li>
                @if(auth()->check())
                @if(auth()->user()->admin == 1)
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
                @endif
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/masuk">Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>