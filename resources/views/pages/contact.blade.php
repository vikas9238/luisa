@extends('layouts.app')
@section('content')

<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Contact Us</h2>
        </div>

        <div class="row mt-1 d-flex justify-content-end" data-aos="fade-right" data-aos-delay="100">

            <div class="col-lg-5">
                <div class="info">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>WZ-283/38,Plot No.38 FF, Vishnu Garden, New Delhi India 110018</p>
                    </div>

                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>info@luisapharma.com</p>
                    </div>

                    <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>7549113300</p>
                    </div>

                </div>

            </div>

            <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">
                {{ Form::open(['url' => route('pages.postContact'), 'files' => true, 'role'=>'form']) }}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="mobile_number" id="email" placeholder="Your Email" required>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>
                @if (session('alert-success'))
                <div class="my-3">
                    <div class="alert alert-success" role="alert">
                        {!! nl2br(session('alert-success')) !!}
                    </div>
                </div>
                @endif
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-warning">Send Message</button>
                </div>
                {{Form::close()}}
            </div>

        </div>

    </div>
</section><!-- End Contact Section -->

@endsection
