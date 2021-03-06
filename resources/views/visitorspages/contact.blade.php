@extends('main')

@section("pagetitle", " Contact")

@section('bgimg', 'background-image: url("/img/contact-bg1.jpg")')
@section('subheading','Have questions? We have answers (maybe).')

@section('content')
  <!-- Main Content -->
  <div class="container">
      <div class="row">
          <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
              <p class="text-center">Want to get in touch with us?<br/>Fill out the form below to send us a message and we will try to get back to you within 24 hours!</p>
              <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
              <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
              <!-- NOTE: To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
              <form name="sentMessage" id="contactForm" method="post" action="{{ url('contact')}}">
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Name</label>
                          <input type="text" class="form-control" name="name" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Email Address</label>
                          <input type="email" class="form-control" name="email" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Phone Number</label>
                          <input type="tel" class="form-control" placeholder="Phone Number" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Subject</label>
                          <textarea rows="2" class="form-control" placeholder="Subject" id="subject" name="subject" required data-validation-required-message="Please enter a subject."></textarea>
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Message</label>
                          <textarea rows="5" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter a message."></textarea>
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <br>
                  <div id="success"></div>
                  <div class="row">
                      <div class="form-group col-xs-12">
                          <button type="submit" class="btn btn-default pull-right"><span class="glyphicon glyphicon-envelope"></span> Send</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>

@endsection


@section('scripts')
  <script type="text/javascript" src="/js/parsley.min.js"></script>
@endsection 