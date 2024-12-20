@extends('layouts.app')

@section('title', __('landing.contact'))

@section('content')
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-secondary mb-3 fw-bold">{{__('landing.contact_msg1')}}</h1>
                <h5>{{__('landing.contact_msg2')}}<br>
                    {{__('landing.contact_msg3')}}</h5>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="py-5 text-center">
                    <h2 class="mb-4 animate-on-scroll slide-left text-primary fw-bold">{{__('landing.contact_info')}}
                    </h2>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa-solid fa-location-dot text-secondary"></i></h5>
                        <p>Lebanon, Saida , Natasha Saeed Street</p>
                    </div>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa fa-clock text-secondary"></i></h5>
                        <p>
                            {{__('landing.monday')}} - {{__('landing.friday')}}: 9:00 AM - 6:00 PM<br />
                            {{__('landing.saturday')}}: 10:00 AM - 4:00 PM<br />
                            {{__('landing.sunday')}}: Closed
                        </p>
                    </div>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa fa-phone text-secondary"></i></h5>
                        <p>+961 76 629 552</p>
                        <p>+961 70 833 158</p>
                    </div>
                    <div class="mb-4 animate-on-scroll slide-left">
                        <h5><i class="fa fa-envelope text-secondary"></i></h5>
                        <p>fatimakhansa97@gmail.com</p>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        <div class="social-icons animate-on-scroll slide-up text-center">
                            <h3 class="fw-bold mb-3 text-secondary">{{__('landing.follow_us')}}</h3>
                            <a href="#" class="social-icon text-decoration-none text-secondary me-2"><i
                                    class="fa-brands fa-facebook fs-3"></i></a>
                            <a href="#" class="social-icon text-decoration-none text-secondary"><i
                                    class="fa-brands fa-instagram fs-3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card rounded p-5 text-center">
                    <h2 class="mb-4 animate-on-scroll slide-right text-primary fw-bold">
                        {{__('landing.send_us_a_message')}}</h2>
                    <form class="form" action="{{ route('contact.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 animate-on-scroll slide-right">
                            <label for="name" class="form-label">{{__('landing.name')}}</label>
                            <input type="text" class="form-control input" id="name" required />
                        </div>
                        <div class="mb-3 animate-on-scroll slide-right">
                            <label for="email" class="form-label">{{__('landing.email')}}</label>
                            <input type="email" class="form-control input" id="email" required />
                        </div>
                        <div class="mb-3 animate-on-scroll slide-right">
                            <label for="phone" class="form-label">{{__('landing.phone')}}</label>
                            <input type="tel" class="form-control input" id="phone" required />
                        </div>
                        <div class="mb-3 animate-on-scroll slide-up">
                            <label for="message" class="form-label">{{__('landing.message')}}</label>
                            <textarea class="form-control input" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary animate-on-scroll slide-up">
                            {{__('landing.send_message')}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
