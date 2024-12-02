@extends('guest.index')

@section('content')
<!-- Header Section -->
<section class="header-section">
    <h1>About DataDuk</h1>
    <p>Platform pengelolaan dan analisis data penduduk secara efisien dan akurat.</p>
</section>

<!-- Content Section -->
<div class="container my-5">
    <div class="card">
        <!-- Our Mission Section -->
        <h2 class="text-center mb-4">Our Mission</h2>
        <p class="text-center">DataDuk bertujuan untuk meningkatkan efisiensi dalam pengelolaan data penduduk dengan teknologi modern, mendukung keputusan berbasis data, dan memberikan solusi yang aman dan handal untuk kebutuhan data masyarakat.</p>

        <!-- Meet Our Team Section -->
        <h2 class="text-center mt-5 mb-4">Meet Our Team</h2>
        <div class="row text-center">
            <div class="col-md-3 team-member">
                <img src="https://via.placeholder.com/120" alt="Team Member 1" class="img-fluid rounded-circle mb-3">
                <h5>John Doe</h5>
                <p>Founder & CEO</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://via.placeholder.com/120" alt="Team Member 2" class="img-fluid rounded-circle mb-3">
                <h5>Jane Smith</h5>
                <p>CTO</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://via.placeholder.com/120" alt="Team Member 3" class="img-fluid rounded-circle mb-3">
                <h5>David Lee</h5>
                <p>Data Analyst</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://via.placeholder.com/120" alt="Team Member 4" class="img-fluid rounded-circle mb-3">
                <h5>Emily Davis</h5>
                <p>Project Manager</p>
            </div>
        </div>

    </div>
</div>
@endsection