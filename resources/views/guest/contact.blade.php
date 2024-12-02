@extends('guest.index')

@section('content')
<!-- Header Section -->
<section class="header-section">
    <h1>Contact Us</h1>
    <p>Feel free to reach out to us. We are here to help you!</p>
</section>

<!-- Contact Form Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Send us a message</h2>
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>

@endsection