<!-- resources/views/user-web/contact.blade.php -->

@extends('user-web.app')

@section('title', 'Contact - Digital Forensik System')
@section('body-class', 'topics-listing-page')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user-web.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
                <h2 class="text-white">Contact Form</h2>
            </div>
        </div>
    </div>
</header>

<section class="section-padding section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h3 class="mb-4 pb-2">Hubungi Kami</h3>
            </div>

            <div class="col-lg-6 col-12">
                <form action="{{ route('user-web.contact.submit') }}" method="POST" class="custom-form contact-form" role="form">
                    @csrf
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required>
                                <label for="name">Name</label>
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" required>
                                <label for="email">Email address</label>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" required>
                                <label for="subject">Subject</label>
                                @error('subject') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Tell us about your inquiry" rows="5" required></textarea>
                                <label for="message">Message</label>
                                @error('message') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 ms-auto">
                            <button type="submit" class="form-control btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="col-lg-5 col-12 mx-auto mt-5 mt-lg-0">
                <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.3544180649144!2d107.0062891!3d-6.9271711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ebe5a5555555%3A0x5555555555555555!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1700000000000" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                <h5 class="mt-4 mb-2">Digital Forensik Center</h5>
                <p>Jakarta, Indonesia</p>

                <h5 class="mt-4 mb-2">Kontak</h5>
                <p class="mb-1">
                    <strong>Email:</strong> <a href="mailto:info@digitalforensik.com">info@digitalforensik.com</a>
                </p>
                <p>
                    <strong>Phone:</strong> <a href="tel:+6281234567890">+62 812-345-67890</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection