@extends('frontend.layout')

@section('main_section')
   <section class="form-bg form-blk">
        <div class="wrapper">
            <div class="blk-inr" style="background-image:url(../frontend/images/contentbanner.png)">
                <div class="frm-out">
                    <form>
                        <div class="frm-wrap">
                        <h4>Start your Parking search here</h4>
                        <div class="input-field">
                            <label for="traveling">Traveling From</label>
                            <div class="select-out">
                                <select name="traveling_from" id="traveling_from">
                                    <option disabled>Select Airport</option>
                                    @foreach($airports as $key => $value)
                                    <option value="{{$value->id}}" {{ $airport->id == $value->id ? 'selected' : ''}}>{{$value->airport_name}}</option>
                                    @endforeach
                                </select>
                                <span class="drop-icon">
                                    <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false" class="css-8mmkcg"><path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z"></path></svg>
                                </span>
                            </div>
                        </div>
                        <div class="frm-row one">
                            <div class="input-field col-60">
                                <label for="birthday">Drop-off Date *</label>
                                <input type="text" name="drop_off_date" id="drop_off_date" class="inpt_box"/>
                            </div>
                            <div class="input-field col-38">
                                <label for="appt">Drop-off Time *</label>
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
                        </div>
                        <div class="frm-row two">
                            <div class="input-field col-60">
                                <label for="birthday">Pick-up Date *</label>
                                <input type="text" name="pick_up_date" id="pick_up_date" class="inpt_box">
                            </div>
                            <div class="input-field col-38">
                                <label for="appt">Pick-up Time *</label>
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
                        </div>
                        <div class="input-field">
                            <label for="birthday">Promo Code *</label>
                            <input type="" name="promo" id="promo" placeholder="Promo Code">
                        </div>
                        <button color="#fff" class="form-btn">
                            <span>
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                </svg>Search Parking</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="cnt-section">
        <div class="wrapper">
            <h2 class="text-center">{{ $airport->airport_name }} Airport Parking</h2>
            <div>
               <p>Nowadays, numerous online airport parking service providers are available for you offering various parking options. So, locating low-priced airport parking has become simple.</p><p>Do you want reasonably priced parking at {{ $airport->airport_name }} while taking a flight? If yes, then <strong>Airport Parking Solution</strong> is here to resolve your issue.</p><p>It's simple to find even-handed and inexpensive parking alternatives at {{ $airport->airport_name }} Airport when reserving a parking space with us. As a booking agent, we collaborate with top-notch parking providers and locate the most affordable and handy options for your vehicle parking at {{ $airport->airport_name }} Airport.</p>
            </div>
            <h3>Parking options at {{ $airport->airport_name }} Airport</h3>
            <p>At {{ $airport->airport_name }} Airport, you may confidently choose our quick and economic Park and Ride service. You can locate various options with our booking process that is practical and viable. Thus, each of the services we provide is distinctive and unique.</p>
            @foreach($companies as $key => $value)
            <h4>{{$value->company_title}}</h4>
            {!! $value->short_description !!}
            @endforeach

            <h4>Long-stay parking</h4>
            <p>With ever-growing traffic in the airport, finding a suitable airport parking spot is very challenging. The<!-- --> <strong>{{ $airport->airport_name }} Airport long-stay parking</strong> option is the best but most expensive on-site parking for those planning extensive trips abroad. Long-stay parking at {{ $airport->airport_name }} Airport is the best option for you when you want a quick transfer parking a vehicle at the airport.</p>
            <p>Moreover, when customers intend to have a trip for more than a week, they confidently avail of Long-stay parking. However, you may get our Meet and Greet and Park and Ride services that are much cheaper than on-site airport parking.</p>
      
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

