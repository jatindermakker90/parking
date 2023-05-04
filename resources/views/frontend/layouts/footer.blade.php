<footer id="footer">
  <div class="modal fade" id="Stripe3DS_Loader" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="border:4px solid #79A70A;">
      <div class="modal-content" style="border-radius: 0px;">
        <div class="modal-body" style="border-radius: 0px; background: #e5e5e5">
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-center" id="paymentlogmessage">Please wait while we process your transaction</h3>
              <center>
              <img src="{{ asset('frontend/images/wdm-loader.gif') }}" alt="CheapParking" width="100" height="100" />
              </center>
            </div>
          </div>
          <div class="row hidden-xs" style="margin-top: 20px;">
            <div class="col-md-7 col-sm-6 col-xs-6">
              <img src="{{ asset('frontend/images/sat.png') }}" alt="CheapParking" width="250px" />
            </div>
            <div class="col-md-5 col-sm-6 col-xs-6">
              <ul class="custom-ul">
                <li>
                  <h3>
                  <i class="fa fa-check-circle"></i>
                  <b>Price Check Promise </b>
                  </h3>
                  <h3>
                  <i class="fa fa-check-circle"></i>
                  <b>Get Discount upto 60%</b>
                  </h3>
                  <h3>
                  <i class="fa fa-check-circle"></i>
                  <b>Approved Car Parks</b>
                  </h3>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="modal-footer hidden-xs" style="background: #f5f5f5; margin-top: -15px;">
          <div class="row" style="margin-top: 5px;">
            <div class="col-md-12">
              <div class="row">
                <div class="col-sm-12">
                  <center>
                  <img src="{{ asset('frontend/images/secured.png') }}" alt="CheapParking" width="220px" />
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="paymentlog" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="border:4px solid #79A70A;">
      <div class="modal-content" style="border-radius: 0px;">
        <div class="modal-body" style="border-radius: 0px; background: #e5e5e5">
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-center" id="paymentlogmessage">Please wait while we process your transaction</h3>
              <center>
              <img src="{{ asset('frontend/images/wdm-loader.gif') }}" alt="CheapParking" width="100" height="100" />
              </center>
            </div>
          </div>
          <div class="row hidden-xs" style="margin-top: 20px;">
            <div class="col-md-7 col-sm-6 col-xs-6">
              <img src="{{ asset('frontend/images/sat.png') }}" alt="CheapParking" width="250px" />
            </div>
            <div class="col-md-5 col-sm-6 col-xs-6">
              <ul class="custom-ul">
                <li>
                  <h3>
                  <i class="fa fa-check-circle"></i>
                  <b>Price Check Promise </b>
                  </h3>
                  <h3>
                  <i class="fa fa-check-circle"></i>
                  <b>Get Discount upto 60%</b>
                  </h3>
                  <h3>
                  <i class="fa fa-check-circle"></i>
                  <b>Approved Car Parks</b>
                  </h3>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="modal-footer hidden-xs" style="background: #f5f5f5; margin-top: -15px;">
          <div class="row" style="margin-top: 5px;">
            <div class="col-md-12">
              <div class="row">
                <div class="col-sm-12">
                  <center>
                  <img src="{{ asset('frontend/images/secured.png') }}" alt="CheapParking" width="220px" />
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-wrapper" style="background-repeat:no-repeat;color: #fff">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-3">
          <h2>Short Links</h2>
          <ul class="discover triangle hover row">
            <li class="col-xs-12"><i class="fa fa-home" aria-hidden="true"></i><a href="{{url('/')}}">Home</a></li>
            <li class="col-xs-12"><i class="fa fa-question" aria-hidden="true"></i><a href="{{url('faq')}}">Faqs</a></li>
            <li class="col-xs-12"><i class="fa fa-book" aria-hidden="true"></i><a href="#">Terms & conditions</a></li>
            <li class="col-xs-12"><i class="fa fa-shield" aria-hidden="true"></i><a href="#">Privacy Policy</a></li>
            <li class="col-xs-12"><i class="fa fa-phone" aria-hidden="true"></i><a href="{{url('contact-us')}}">Contact us</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-md-3">
          <img src="{{ asset('frontend/images/secure-img.png') }}" class="sec1-img">
          <img src="{{ asset('frontend/images/paypal-logo.png') }}" class="sec1-img">
        </div>
        <div class="col-sm-6 col-md-3">
          <h2>Address</h2>
          <address class="contact-details">
            <span class="contact-phone" style="font-size:14px;"><i class="soap-icon-address" style="font-size:16px"></i>
              Travel Extras Deals LTD<br>T/A Parking 4 You<br>International house<br>
            776-778 barking road,<br> London E13 9PJ</span>
          </address>
        </div>
        <div class="col-sm-6 col-md-3">
          <h2>About Cheap Parking 4 You</h2>
          <p>Cheap Parking 4 You provides highly efficient yet cheap services for your meet and greet valet parking requirements at Airports in UK.</p>
          <br />
          <address class="contact-details">
            <span class="contact-phone"><i class="soap-icon-phone"></i> 0333 567 8903 / MON - FRI 09:00 To 17:00 </span>
            <br />
          </address>
          <ul class="social-icons clearfix pull-right hidden-mobile">
            <li class="twitter"><a title="twitter" href="#" data-toggle="tooltip"><i class="soap-icon-twitter"></i></a></li>
            <li class="facebook"><a title="facebook" href="#" data-toggle="tooltip"><i class="soap-icon-facebook"></i></a></li>
            <li class="instagram"><a title="Instagram" href="#" data-toggle="tooltip"><i class="soap-icon-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="">
  </div>
  <div class="bottom gray-area">
    <div class="container">
      <div class="pull-right">
        <a id="back-to-top" href="#" class="animated" data-animation-type="bounce"><i class="soap-icon-longarrow-up circle"></i></a>
      </div>
      <div class="copyright">
        <p style="color:#fff;">&copy; 2023 Cheap Parking 4 You.</p>
      </div>
    </div>
  </div>
</footer>