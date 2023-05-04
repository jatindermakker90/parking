<header id="header" class="navbar-static-top">
  <div class="topnav">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <ul class="quick-menu pull-left hidden-mobile">
            <li>
              <button type="button" class="soap-popupbox btn btn-sm btn-primary frontendLogin" data-toggle="modal" data-target="#travelo-login">LOGIN</button>
            </li>
            <ul class="social-icons clearfix pull-right hidden-mobile">
              <li class="twitter">
                <a title="twitter" href="#" data-toggle="tooltip">
                  <i class="soap-icon-twitter"></i>
                </a>
              </li>
              <li class="facebook">
                <a title="facebook" href="#" data-toggle="tooltip">
                  <i class="soap-icon-facebook"></i>
                </a>
              </li>
              <li class="instagram">
                <a title="Instagram" href="#" data-toggle="tooltip">
                  <i class="soap-icon-instagram"></i>
                </a>
              </li>
            </ul>
          </ul>
        </div>
        <div class="col-lg-5">
          <h3 class="mobile_no">
            <i class="fa fa-mobile"></i> 0333 567 8903 / MON - FRI 09:00 To 17:00
          </h3>
        </div>
      </div> Currently no bookings
    </div>
  </div>
  <div class="main-header">
    <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle"> Mobile Menu Toggle </a>
    <div class="container">
      <h1 class="logo u_logo navbar-brand">
        <a href="{{url('/')}}" title="Cheap Parking 4 You - home">
          <img class="logo_img" src="{{ asset('frontend/images/logo.png') }}" alt="Cheap Parking 4 You" style="height: 60px;width: 60px;"/>
        </a>
      </h1>
      <nav id="main-menu" role="navigation">
        <ul class="menu scrollable-menu-ul">
          <li class="menu-item-has-children">
            <a href="{{ url('/') }}">Home</a>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> AIRPORT PARKING <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" id="LongMenusScroll" role="menu">
                @if($airports && $airports->count() > 0)
                 @foreach($airports as $key => $value)
                  <li>
                     <a href="{{ url('airport/'.$value->id)}}">{{$value->airport_name}} Airport</a>
                  </li>
                 @endforeach
                @else
                  <li>
                    <a href="#">No Airport Available</a>
                  </li>
                @endif
            </ul>
          </li>
          <li>
            <a href="{{url('about')}}">About us</a>
          </li>
          <li>
            <a href="{{ url('faq') }}">Faqs</a>
          </li>
          <li>
            <a href="{{ url('contact-us') }}">Contact</a>
          </li>
        </ul>
      </nav>
    </div>
    <nav id="mobile-menu-01" class="mobile-menu collapse">
      <ul id="mobile-primary-menu" class="menu">
        <li>
          <a href="#">Home</a>
        </li>
        <li class="menu-item-has-children">
          <a href="#">Airport Parking</a>
          <div id="MobileMenuDivWrapper">
            <ul>
              <li>
                <a href="#/gatwick-airport-parking">Gatwick Airport</a>
              </li>
              <li>
                <a href="#/heathrow-airport-parking">Heathrow Airport</a>
              </li>
              <li>
                <a href="#/bristol-airport-parking">Bristol Airport</a>
              </li>
              <li>
                <a href="#/luton-airport-parking">Luton Airport</a>
              </li>
              <li>
                <a href="#/manchester-airport-parking">Manchestar Airport</a>
              </li>
              <li>
                <a href="#/stansted-airport-parking">Stansted Airport</a>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <a href="about">About us</a>
        </li>
        <li>
          <a href="faqs">Faqs</a>
        </li>
        <li>
          <a href="contactus">Contact</a>
        </li>
      </ul>
      <ul class="mobile-topnav container">
        <li>
          <button type="button" class="soap-popupbox btn btn-sm btn-primary frontendLogin" data-toggle="modal" data-target="#travelo-login">LOGIN</button>
        </li>
      </ul>
    </nav>
  </div>
  <div id="travelo-signup" class="travelo-signup-box travelo-box">
    <div class="login-social">
      <a href="#" class="button login-facebook">
        <i class="soap-icon-facebook"></i>Login with Facebook </a>
      <a href="#" class="button login-googleplus">
        <i class="soap-icon-googleplus"></i>Login with Google+ </a>
    </div>
    <div class="seperator">
      <label>OR</label>
    </div>
    <div class="simple-signup">
      <div class="text-center signup-email-section">
        <a href="#" class="signup-email">
          <i class="soap-icon-letter"></i>Sign up with Email </a>
      </div>
      <p class="description">By signing up, I agree to  Terms of Service, Privacy Policy, Guest Refund olicy, and Host Guarantee Terms.</p>
    </div>
    <div class="email-signup">
      <form>
        <div class="form-group">
          <input type="text" class="input-text full-width" placeholder="first name">
        </div>
        <div class="form-group">
          <input type="text" class="input-text full-width" placeholder="last name">
        </div>
        <div class="form-group">
          <input type="text" class="input-text full-width" placeholder="email address">
        </div>
        <div class="form-group">
          <input type="password" class="input-text full-width" placeholder="password">
        </div>
        <div class="form-group">
          <input type="password" class="input-text full-width" placeholder="confirm password">
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox"> Tell me about news </label>
          </div>
        </div>
        <div class="form-group">
          <p class="description">By signing up, I agree to Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
        </div>
        <button type="submit" class="full-width btn-medium">SIGNUP</button>
      </form>
    </div>
    <div class="seperator"></div>
    <p>Already a member? <a href="#travelo-login" class="goto-login soap-popupbox">Login</a>
    </p>
  </div>
  <div class="modal fade" id="travelo-login" tabindex="-1" role="dialog" aria-labelledby="travelo-login">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Sign in</h3>
        </div>
        <div class="modal-body">
          <div class="form-group" id="error_log" style="display: none;">
            <div class="alert alert-error"> Incorrect Email / password </div>
          </div>
          <form id="log_ref" method="post">
            <div class="form-group" id="error_user" style="display: none;">
              <div class="alert alert-error"> Incorrect Ref / Email </div>
            </div>
            <div class="form-group">
              <input type="text" name="ref_no" id="ref_no" class="input-text full-width" placeholder="Booking Reference">
            </div>
            <div class="form-group">
              <input type="email" name="email_address" id="email_address" class="input-text full-width" placeholder="Email Address">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-success btn-block" value="View Booking" />
              <input type="hidden" name="CustomerLogin" value="wdm-log" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>