<!-- about section -->
@extends('frontend.layout')
@section('main_section')
<section id="content">
  <div class="container">
    <div id="main">
      <div class="contact-address row block">
        <div class="col-md-4">
          <div class="icon-box style5">
            <i class="soap-icon-phone"></i>
            <div class="description">
              <small>We are on Monday to Friday (9am to 6 pm )</small>
              <h5>Local: 0333 567 8903 </h5>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box style5">
            <i class="soap-icon-message"></i>
            <div class="description">
              <small>Send us email on</small>
              <h5>info@cheapparking4you.co.uk</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box style5">
            <i class="soap-icon-address"></i>
            <div class="description">
              <small>Travel Extra Deals LTD</small>
              <h5>International house 776-778 barking road, London E16 2DQ</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="travelo-box box-full">
        <div class="contact-form">
          <h2>Send us a Message</h2>
          <form class="mt30" role="form" action="model/ContactForm.php" method="POST" id="ContactusForm" class="ContactusForm">
            <div class="row">
              <div class="col-sm-12"></div>
              <div class="col-sm-4">
                <div class="form-group" style="margin-bottom: 0px;">
                  <label>First Name</label>
                  <input type="text" name="firstname" id="firstname" required="required" class="input-text full-width">
                </div>
                <div class="form-group" style="margin-bottom: 0px;">
                  <label>Last Name</label>
                  <input type="text" name="lastname" id="lastname" required="required" class="input-text full-width">
                </div>
                <div class="form-group" style="margin-bottom: 0px;">
                  <label>Your Email</label>
                  <input type="email" name="email" id="email" required="required" class="input-text full-width">
                </div>
                <div class="form-group" style="margin-bottom: 0px;">
                  <label>Your Mobile</label>
                  <input type="text" name="mobile" id="mobile" required="required" class="input-text full-width">
                </div>
              </div>
              <div class="col-sm-8">
                <label>Type</label>
                <div class="form-group" style="margin-bottom: 0px;">
                  <select name="inquirytype" class="form-control" required style="background:#88E1D9;">
                    <option value="Booking">Booking</option>
                    <option value="Amendment">Amendment</option>
                    <option value="Cancellation">Cancellation</option>
                    <option value="Complaints">Complaints</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Your Message</label>
                  <textarea name="contactmessage" id="contactmessage" required rows="12" class="input-text full-width" placeholder="write message here"></textarea>
                </div>
              </div>
            </div>
            <div class="col-sms-offset-6 col-sm-offset-6 col-md-offset-8 col-lg-offset-9">
              <button class="btn-medium full-width" type="submit">SEND MESSAGE</button>
              <input type="hidden" name="action" value="ContactMessage">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end client section -->
@stop