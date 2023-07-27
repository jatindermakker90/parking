<footer class="footer">
  <div class="wrapper">
    <div class="footer-top">
      <div class="flex-row">
        <div class="fot-lft">
          <div class="fot-logo">
            <a herf="">
              <img src="{{ asset('frontend/images/cp_logo.png') }}"> 
            
            </a>
          </div>
          <div class="description">
            <p>Airport Parking Solution provides highly prudent and cost-feasible services include; Meet
            and Greet and Park and Ride at Airports in the United Kingdom.</p>
          </div>
        </div>
        <div class="fot-rgt">
          <div class="flex-row">
            <div class="fot-nav-list">
              <div class="fot-col one">
                <h6>Airports</h6>
                <ul class="nav-list">
                   @foreach($airports as $key => $value)
                  <li><a href="#">{{$value->airport_name}} Airport</a></li>
                  @endforeach
                </ul>
              </div>
              <div class="fot-col two">
                <h6>Navigation</h6>
                <ul class="nav-list">
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li><a href="{{url('/')}}">Airport Parking</a></li>
                  <li><a href="{{url('faq')}}">FAQ's</a></li>
                  <li><a href="{{url('about')}}">About</a></li>
                  <li><a href="{{url('terms')}}">Terms & Conditions</a></li>
                </ul>
              </div>
            </div>
            <div class="fot-col three">
              <h6>Subscribe To Discount Offers</h6>
              <div class="form-control">
                <form class="input-group">
                  <input type="email" placeholder="valid email address" value="">
                  <div class="btn-container"><button type="submit">Subscribe</button></div>
                </form>
                <div class="small-text">
                  <p>Input groups include support for custom selects and custom file inputs.</p>
                  <p>Browser default versions of these are not supported.</p>
                </div>
              </div>
              <div class="payment-blk">
                <h6>Payment Methods</h6>
                <ul class="payment-list">
                  <li><img src="{{ asset('frontend/images/img1.png') }}"></li>
                  <li><img src="{{ asset('frontend/images/img2.png') }}"></li>
                  <li><img src="{{ asset('frontend/images/img3.png') }}"></li>
                  <li><img src="{{ asset('frontend/images/img4.png') }}"></li>
                  <li><img src="{{ asset('frontend/images/img5.png') }}"></li>
                  <li><img src="{{ asset('frontend/images/img6.png') }}"></li>
                  <li><img src="{{ asset('frontend/images/img7.png') }}"></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="wrapper">
      <div class="flex-row">
        <div class="lft-blk">
          <p>Copyright 2023- Airport Park UK Ltd</p>
        </div>
        <!-- <div class="rgt-blk">
          <p>Company Reg no.</p>
        </div> -->
      </div>
    </div>
  </div>
</footer>
