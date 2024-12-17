@extends('layouts.app')

@section('title')
Contact
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-secondary mb-3 fw-bold">Your Path to Healthy Living Starts Here!</h1>
                <h5>Whether you have questions, feedback, or need guidance, we’re always here to help.<br>
                    Connect with us and let’s create a healthier tomorrow together!</h5>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="py-5 text-center">
                    <h2 class="mb-4 animate-on-scroll slide-left text-secondary fw-bold">Contact Information</h2>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa-solid fa-location-dot text-secondary"></i></h5>
                        <p>123 Music Street<br />Harmony City, HC 12345</p>
                    </div>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa fa-clock text-secondary"></i></h5>
                        <p>
                            Monday - Friday: 9:00 AM - 6:00 PM<br />
                            Saturday: 10:00 AM - 4:00 PM<br />
                            Sunday: Closed
                        </p>
                    </div>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa fa-phone text-secondary"></i></h5>
                        <p>(555) 123-4567</p>
                    </div>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa fa-envelope text-secondary"></i></h5>
                        <p>support@soundsavvy.com</p>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        <div class="social-icons animate-on-scroll slide-up text-center">
                            <h3 class="fw-bold mb-3 text-secondary">Follow Us</h3>
                            <a href="#" class="social-icon text-decoration-none text-secondary me-2"><i class="fa-brands fa-facebook fs-3"></i></a>
                            <a href="#" class="social-icon text-decoration-none text-secondary"><i class="fa-brands fa-instagram fs-3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card rounded p-5 text-center">
                    <h2 class="mb-4 animate-on-scroll slide-right text-secondary fw-bold">Send us a Message</h2>
                    <form>
                        <div class="mb-3 animate-on-scroll slide-right">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control input" id="name" required />
                        </div>
                        <div class="mb-3 animate-on-scroll slide-right">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control input"
                                id="email"
                                required />
                        </div>
                        <div class="mb-3 animate-on-scroll slide-right">
                            <label for="subject" class="form-label">Subject</label>
                            <input
                                type="text"
                                class="form-control input"
                                id="subject"
                                required />
                        </div>
                        <div class="mb-3 animate-on-scroll slide-up">
                            <label for="message" class="form-label">Message</label>
                            <textarea
                                class="form-control input"
                                id="message"
                                rows="5"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary animate-on-scroll slide-up">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection