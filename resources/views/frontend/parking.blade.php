@extends('frontend.layout')

@section('main_section')
<section class="lft-cnt-rgt-frm">
    <div class="wrapper">
        <div class="flex-row">
            <div class="cnt-blk">
                <h1>Airport Parking</h1>
                <div class="description">
                    <p>When it comes to parking your vehicle, We provide cost-effective and hassle-free options. We aim to spare your valuable time and hard-earned money, allowing you to focus on the things that matter most during your travels.</p>
                    <p>Generally, we focus on providing Park and Ride and Meet and Greet parking services at 
                        @foreach($airports as $key => $value)
                         <a href="{{ url('airport/'.$value->id) }}">{{$value->airport_name}} Airport @if($key != ($airports->count() - 1)) {{","}}@endif</a>
                        @endforeach
                    .</p>
                </div>
            </div>
            <div class="frm-blk">
                <form>
                    <div class="wrapper">
                        <div class="search-title">
                            <h4>Start your Parking search here</h4>
                        </div>
                        <div class="field select-field">
                            <label for="airport">Select Airpot *</label>
                            <div class="field-row">
                                <div class="field-control">
                                    <div class="select-field">
                                        <select name="traveling_from" id="traveling_from">
                                            <option disabled>Select Airport</option>
                                            @foreach($airports as $key => $value)
                                            <option value="{{$value->id}}">{{$value->airport_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="drop-icon">
                                        <svg
                                            height="20" width="20" viewBox="0 0 20 20" aria-hidden="true"
                                            focusable="false" class="css-8mmkcg">
                                            <path
                                                d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="pick-up col-50">
                                <label>Pick-up Date *</label>
                                <div class="field-control">
                                    <div class="select-field">
                                        <input type="text" name="pick_up_date" id="pick_up_date" class="inpt_box">
                                    </div>
                                </div>
                            </div>
                            <div class="drop-off col-50">
                                <label>Pick-up Time *</label>
                                <div class="field-control">
                                    <div class="select-field">
                                        <select name="pick_up_time" id="pick_up_time">
                                              <option value="00:00">00:00</option>
                                              <option value="04:00">04:00</option>
                                              <option value="04:15">04:15</option>
                                              <option value="04:30">04:30</option>
                                              <option value="04:45">04:45</option>
                                              <option value="05:00">05:00</option>
                                              <option value="05:15">05:15</option>
                                              <option value="05:30">05:30</option>
                                              <option value="05:45">05:45</option>
                                              <option value="06:00">06:00</option>
                                              <option value="06:15">06:15</option>
                                              <option value="06:30">06:30</option>
                                              <option value="06:45">06:45</option>
                                              <option value="07:00">07:00</option>
                                              <option value="07:15">07:15</option>
                                              <option value="07:30">07:30</option>
                                              <option value="07:45">07:45</option>
                                              <option value="08:00">08:00</option>
                                              <option value="08:15">08:15</option>
                                              <option value="08:30">08:30</option>
                                              <option value="08:45">08:45</option>
                                              <option value="09:00">09:00</option>
                                              <option value="09:15">09:15</option>
                                              <option value="09:30">09:30</option>
                                              <option value="09:45">09:45</option>
                                              <option value="10:00">10:00</option>
                                              <option value="10:15">10:15</option>
                                              <option value="10:30">10:30</option>
                                              <option value="10:45">10:45</option>
                                              <option value="11:00">11:00</option>
                                              <option value="11:15">11:15</option>
                                              <option value="11:30">11:30</option>
                                              <option value="11:45">11:45</option>
                                              <option value="12:00" selected>12:00</option>
                                              <option value="12:15">12:15</option>
                                              <option value="12:30">12:30</option>
                                              <option value="12:45">12:45</option>
                                              <option value="13:00">13:00</option>
                                              <option value="13:15">13:15</option>
                                              <option value="13:30">13:30</option>
                                              <option value="13:45">13:45</option>
                                              <option value="14:00">14:00</option>
                                              <option value="14:15">14:15</option>
                                              <option value="14:30">14:30</option>
                                              <option value="14:45">14:45</option>
                                              <option value="15:00">15:00</option>
                                              <option value="15:15">15:15</option>
                                              <option value="15:30">15:30</option>
                                              <option value="15:45">15:45</option>
                                              <option value="16:00">16:00</option>
                                              <option value="16:15">16:15</option>
                                              <option value="16:30">16:30</option>
                                              <option value="16:45">16:45</option>
                                              <option value="17:00">17:00</option>
                                              <option value="17:15">17:15</option>
                                              <option value="17:30">17:30</option>
                                              <option value="17:45">17:45</option>
                                              <option value="18:00">18:00</option>
                                              <option value="18:15">18:15</option>
                                              <option value="18:30">18:30</option>
                                              <option value="18:45">18:45</option>
                                              <option value="19:00">19:00</option>
                                              <option value="19:15">19:15</option>
                                              <option value="19:30">19:30</option>
                                              <option value="19:45">19:45</option>
                                              <option value="20:00">20:00</option>
                                              <option value="20:15">20:15</option>
                                              <option value="20:30">20:30</option>
                                              <option value="20:45">20:45</option>
                                              <option value="21:00">21:00</option>
                                              <option value="21:15">21:15</option>
                                              <option value="21:30">21:30</option>
                                              <option value="21:45">21:45</option>
                                              <option value="22:00">22:00</option>
                                              <option value="22:15">22:15</option>
                                              <option value="22:30">22:30</option>
                                              <option value="22:45">22:45</option>
                                              <option value="23:00">23:00</option>
                                              <option value="23:15">23:15</option>
                                              <option value="23:30">23:30</option>
                                              <option value="23:45">23:45</option>
                                        </select>
                                    </div>
                                    <div class="drop-icon">
                                        <svg
                                            height="20" width="20" viewBox="0 0 20 20" aria-hidden="true"
                                            focusable="false" class="css-8mmkcg">
                                            <path
                                                d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="pick-up col-50">
                                <label>Drop-off Date *</label>
                                <div class="field-control">
                                    <div class="select-field">
                                        <input type="text" name="drop_off_date" id="drop_off_date" class="inpt_box"/>
                                    </div>
                                </div>
                            </div>
                            <div class="drop-off col-50">
                                <label>Drop-off Time *</label>
                                <div class="field-control">
                                    <div class="select-field">
                                        <select name="drop_off_time" id="drop_off_time">
                                             <option value="00:00">00:00</option>
                                              <option value="04:00">04:00</option>
                                              <option value="04:15">04:15</option>
                                              <option value="04:30">04:30</option>
                                              <option value="04:45">04:45</option>
                                              <option value="05:00">05:00</option>
                                              <option value="05:15">05:15</option>
                                              <option value="05:30">05:30</option>
                                              <option value="05:45">05:45</option>
                                              <option value="06:00">06:00</option>
                                              <option value="06:15">06:15</option>
                                              <option value="06:30">06:30</option>
                                              <option value="06:45">06:45</option>
                                              <option value="07:00">07:00</option>
                                              <option value="07:15">07:15</option>
                                              <option value="07:30">07:30</option>
                                              <option value="07:45">07:45</option>
                                              <option value="08:00">08:00</option>
                                              <option value="08:15">08:15</option>
                                              <option value="08:30">08:30</option>
                                              <option value="08:45">08:45</option>
                                              <option value="09:00">09:00</option>
                                              <option value="09:15">09:15</option>
                                              <option value="09:30">09:30</option>
                                              <option value="09:45">09:45</option>
                                              <option value="10:00">10:00</option>
                                              <option value="10:15">10:15</option>
                                              <option value="10:30">10:30</option>
                                              <option value="10:45">10:45</option>
                                              <option value="11:00">11:00</option>
                                              <option value="11:15">11:15</option>
                                              <option value="11:30">11:30</option>
                                              <option value="11:45">11:45</option>
                                              <option value="12:00" selected>12:00</option>
                                              <option value="12:15">12:15</option>
                                              <option value="12:30">12:30</option>
                                              <option value="12:45">12:45</option>
                                              <option value="13:00">13:00</option>
                                              <option value="13:15">13:15</option>
                                              <option value="13:30">13:30</option>
                                              <option value="13:45">13:45</option>
                                              <option value="14:00">14:00</option>
                                              <option value="14:15">14:15</option>
                                              <option value="14:30">14:30</option>
                                              <option value="14:45">14:45</option>
                                              <option value="15:00">15:00</option>
                                              <option value="15:15">15:15</option>
                                              <option value="15:30">15:30</option>
                                              <option value="15:45">15:45</option>
                                              <option value="16:00">16:00</option>
                                              <option value="16:15">16:15</option>
                                              <option value="16:30">16:30</option>
                                              <option value="16:45">16:45</option>
                                              <option value="17:00">17:00</option>
                                              <option value="17:15">17:15</option>
                                              <option value="17:30">17:30</option>
                                              <option value="17:45">17:45</option>
                                              <option value="18:00">18:00</option>
                                              <option value="18:15">18:15</option>
                                              <option value="18:30">18:30</option>
                                              <option value="18:45">18:45</option>
                                              <option value="19:00">19:00</option>
                                              <option value="19:15">19:15</option>
                                              <option value="19:30">19:30</option>
                                              <option value="19:45">19:45</option>
                                              <option value="20:00">20:00</option>
                                              <option value="20:15">20:15</option>
                                              <option value="20:30">20:30</option>
                                              <option value="20:45">20:45</option>
                                              <option value="21:00">21:00</option>
                                              <option value="21:15">21:15</option>
                                              <option value="21:30">21:30</option>
                                              <option value="21:45">21:45</option>
                                              <option value="22:00">22:00</option>
                                              <option value="22:15">22:15</option>
                                              <option value="22:30">22:30</option>
                                              <option value="22:45">22:45</option>
                                              <option value="23:00">23:00</option>
                                              <option value="23:15">23:15</option>
                                              <option value="23:30">23:30</option>
                                              <option value="23:45">23:45</option>
                                        </select>
                                    </div>
                                    <div class="drop-icon">
                                        <svg
                                            height="20" width="20" viewBox="0 0 20 20" aria-hidden="true"
                                            focusable="false" class="css-8mmkcg">
                                            <path
                                                d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="promo">
                                <label>Promo Code *</label>
                                <input type="text" name="promo"
                                placeholder="Promo Code" class="promo-code" value="" fdprocessedid="a1m4le">
                            </div>
                            <button class="book-now-btn">
                            <span><svg
                                stroke="currentColor" fill="currentColor" stroke-width="0"
                                viewBox="0 0 512 512" height="1em" width="1em"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                </path>
                            </svg>Search</span>
                            </button>
                        </div>
                        <div class="extras-container lg-show">
                            <div class="extra-label">
                                <h4>Free extra</h4>
                            </div>
                            <div class="checkbox-container">
                                <div class="cancellation-field">
                                    <div class="single-checkbox">
                                        <div class="title">
                                            <span><img src="{{ asset('frontend/images/checked.webp') }}"></span>
                                            <h6>Free cancellation cover.</h6>
                                        </div>
                                        <div class="optional-mark"><svg stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                            </path>
                                        </svg></div>
                                    </div>
                                </div>
                                <div class="sms-field">
                                    <div class="single-checkbox">
                                        <div class="title">
                                            <span><img src="{{ asset('frontend/images/checked.webp') }}"></span>
                                            <h6>Customers statisfaction.</h6>
                                        </div>
                                        <div class="optional-mark"><svg stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                            </path>
                                        </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="lft-img-rgt-lst">
    <div class="wrapper">
        <div class="flex-row">
            <div class="img-blk">
                <figure><img src="{{ asset('frontend/images/parking-bg.806ee24a.jpg') }}" class="img"
                alt="Cars are parked on their specific parking lots."></figure>
            </div>
            <div class="cnt-blk">
                <div class="tp-hdg">
                    <h2>Why to Book with <span>Airport Parking Solution?</span></h2>
                </div>
                <div class="booking-list-container">
                        <ul class="cnt-list"><span class="blue-dot"></span>
                        <li>
                            <h5>Hassle Free Services</h5>
                            <div class="row"> <img src="{{ asset('frontend/images/hassle-free.png') }}" class="img">
                                <p>Our parking options are carefully designed to provide convenience and ease. We offer well-located parking facilities that are easily accessible, ensuring that you can park your vehicle conveniently and quickly. You won't have to waste time searching for a parking spot or deal with the frustration of finding parking in crowded areas.</p>
                            </div>
                        </li>
                        <li>
                            <h5>Guaranteed Low Prices</h5>
                            <div class="row"><img src="{{ asset('frontend/images/price-check-promise.21e68766.png') }}"
                                class="img-2" >
                                <p>We offer competitive pricing that is designed to fit within your budget, helping you avoid costly car parking fees. By choosing our parking services, you can rest assured that you are getting the best value for your money.</p>
                            </div>
                        </li>
                        <li>
                            <h5>Modern Amenities</h5>
                            <div class="row"><img src="{{ asset('frontend/images/amenities.png') }}" class="img">
                                <p>Moreover, our parking facilities are equipped with modern amenities and advanced security measures to give you peace of mind. We prioritize the safety and security of your vehicle, providing surveillance cameras, well-lit areas, and dedicated personnel to ensure the protection of your valuable asset.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="four-blk-slider">
    <div class="wrapper">
        <div class="title text-center">
            <h2>We are serving</h2>
        </div>
        <div class="slider-outer">
            <div id="we-serving" class="owl-carousel owl-theme we-serving">
                @foreach($airports as $key => $value)
                <div class="item">
                    <div class="item-blk">
                        <div class="item-top">
                            <div class="image">
                                <img src="{{ asset('frontend/images/airtport.webp') }}">
                            </div>
                            <div class="gradient">
                                <h6>{{$value->airport_name}} Airport</h6>
                            </div>
                        </div>
                        <div class="more-content">
                            <p> Parking Solution provides you the cost-effective services, Park and Ride and Meet and Greet. Book with us to get the cheapest price deals and also one of the best and trustable service </p>
                        </div>
                        <div class="btn-container"><a href="{{url('airport/'.$value->id)}}" target="_blank"
                        class="read-more-btn">Read more</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="three-blk-slider">
    <div class="wrapper">
        <div class="title text-center">
            <h2>Our Happy Customers</h2>
        </div>
        <div id="our-customers" class="owl-carousel owl-theme our-customers">
           @foreach($companies as $key => $value)
            <div class="item">
                <div class="item-blk">
                    <div class="image">
                        <img src="{{ Storage::url('profile-image/'.$value->logo_id) }}">
                    </div>
                    <div class="content">
                        <h4>{{$value->company_title}}</h4>
                        <div class="stars">
                            <div class="star">
                                <img src="{{ asset('frontend/images/star-filled.png') }}">
                                <img src="{{ asset('frontend/images/star-filled.png') }}">
                                <img src="{{ asset('frontend/images/star-filled.png') }}">
                                <img src="{{ asset('frontend/images/star-filled.png') }}">
                                <img src="{{ asset('frontend/images/star-filled.png') }}">
                            </div>
                        </div>
                     <!--    <p>Very smooth! Car collected within 5 minutes of arrival at terminal 1 Manchester and upon
                            arrival, I was several hours earlier than what was on the booking but no problem for
                        them. Dropped car off as left within 15 mins.</p> -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@stop
@section('js_section')
<script type="text/javascript">
$(document).ready(function(){
        if($('.select').length){
          $('select').select2();
        }
        $("#drop_off_date").datepicker();
        $("#pick_up_date").datepicker();
        $("#we-serving").owlCarousel({
                margin: 20,
                center: false,
                loop: true,
                dots:false,
                nav: true,
                mouseDrag:  false,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                autoplay:true,
                autoplayTimeout:7500,
                autoplayHoverPause:true,
                responsive: {
                0: { items: 1 },
                420: { items: 1 },
                599: { items: 2 },
                799: { items: 3 },
                1000: { items:4 }
            }
        });

        $("#our-customers").owlCarousel({
            margin: 0,
            center: false,
            loop: true,
            mouseDrag:  false,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoplay:true,
            autoplayTimeout:7500,
            dots:false,
            nav: true,
            autoplayHoverPause:true,
            responsive: {
                0: {
                  items: 1
                },
                768: {
                  items: 3,
                },
                1000: {
                  items: 3,
                }
              }
        });
});
</script>
@stop

