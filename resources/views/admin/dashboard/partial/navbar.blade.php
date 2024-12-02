<div class="nav1 navbar navbar-expand-md sticky-top d-block p-3 text-white " style="background-color: #2F3D40;">
    <div class="justify-content-between d-flex">
        <h4 class="text p-0 p-xl-3">DataDuk</h4>
        <button class="navbar-toggler text-white position-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 30 30\'%3E%3Cpath stroke=\'rgba%28255, 255, 255, 1%29\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' d=\'M4 7h22M4 15h22M4 23h22\'/%3E%3C/svg%3E');"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="/dashboard" class="nav-link text-white">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="/dashboard/tambah" class="nav-link text-white">
                    <i class="fas fa-plus-circle"></i> Add Data
                </a>
            </li>
            <li class="nav-item">
                <a href="update_data.html" class="nav-link text-white">
                    <i class="fas fa-edit"></i> Data Public
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="nav-link text-white btn btn-link w-100 text-start">

                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>