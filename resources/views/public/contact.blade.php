@extends('layouts.public')

    @section('header')
        <header class="masthead" style="background-image: url({{ asset('startbootstrap/assets/img/contact-bg.jpg') }})">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h1>Contact Me</h1>
                            <span class="subheading">Have questions? I have answers.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endsection

    @section('content')
        <x-tiny></x-tiny>
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        @if(session('mail-sent'))
                            <div class="alert alert-success">
                                {{ session('mail-sent') }}
                            </div>
                        @endif
                        <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                        <div class="my-5">
                            <form id="contactForm" action="{{ route('contact.mail') }}" method="post">
                                @csrf
                                <div class="form-floating">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Enter your name..."/>
                                    @error('name') <div class="text-danger"><small><sup>*</sup>{{ $message }}</small></div> @enderror
                                    <label for="name">Name</label>
                                </div>

                                <div class="form-floating">
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Enter your email..."/>
                                    @error('email') <div class="text-danger"><small><sup>*</sup>{{ $message }}</small></div> @enderror
                                    <label for="email">Email address</label>
                                </div>

                                <div class="form-floating">
                                    <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="tel" placeholder="Enter your phone number..."/>
                                    @error('email') <div class="text-danger"><small><sup>*</sup>{{ $message }}</small></div> @enderror
                                    <label for="phone">Phone Number</label>
                                </div>
                                <br><br>
                                <div class="form-floating">
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem"></textarea>
                                    @error('message') <div class="text-danger"><small><sup>*</sup>{{ $message }}</small></div> @enderror
                                    <label for="message">Message</label>
                                </div>

                                <br/>
                                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    @endsection

