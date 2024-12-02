<div class="sidebar p-3 text-white" style="width: 20%px; background-color: #2F3D40;">
    <h4 class="text p-3">DataDuk</h4>
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