<!-- about section -->
@extends('frontend.layout')
<style type="text/css">
.odd{
  text-align:center !important;
}
</style>
@section('main_section')
<section id="content" class="no-padding">
  <div class="banner imagebg-container" style="height: 300px; background-image: url('../frontend/images/parking.jpg'); background-size:cover;">
    <div class="container">
      <h1 class="big-caption text-center">{{ $airport->airport_name}} Airport Parking</h1>
      <h2 class="med-caption text-center">Find the best deals at {{ $airport->airport_name}} Airport Parking</h2>
    </div>
  </div>
  <div class="tab-wrapper" style="background:#7fd4ff;">
    <div class="tab-container container trans-style">
      <ul class="tabs no-padding">
        <li class="active">
          <a data-toggle="tab" href="#travel-insurance-get-free-quote" style="background:#7fd4ff; color: #000;">
            <i class="soap-icon-stories"></i>get A Free Quote </a>
        </li>
      </ul>
      <div class="tab-content" id="flights-tab" style="background:#7fd4ff;">
        <div id="travel-insurance-get-free-quote" class="tab-pane fade in active">
          <form action="#" role="form" method="POST" name="" id="Home" class="Home" novalidate="novalidate">
            <div class="row">
              <div class="col-md-12">
                <div class="mg-bn-forms" style="margin-top:20px;">
                  <div class="row">
                    <div class="col-md-2">
                      <label class="labelclass">Airport</label>
                      <select name="airportId" id="airportId" class="form-control" required="" aria-required="true">
                       @if($airports && $airports->count() > 0)
                       <option value="0">Select Airport</option>
                       @foreach($airports as $key => $value)
                       <option value="{{$value->id}}">{{$value->airport_name}}</option>
                       @endforeach
                      @else
                       <option value="0" disabled>No Airport Available</option>
                      @endif
                    </select>
                    <label for="airportId" class="error"></label>
                    </div>
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12">
                              <label class="labelclass">Departure Date</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control hasDatepicker" id="DropDate" name="dropOffDate" value="" readonly="readonly" required="" aria-required="true">
                                <label for="dropOffDate" class="error"></label>
                              </div>
                            </div>
                            <div class="col-md-5 col-sm-12 col-xs-12">
                              <label class="labelclass">Time</label>
                              <select class="form-control" name="DepTime" id="DepTime">
                                <option value="00:00">00:00</option>
                                <option value="00:15">00:15</option>
                                <option value="00:30">00:30</option>
                                <option value="00:45">00:45</option>
                                <option value="01:00">01:00</option>
                                <option value="01:15">01:15</option>
                                <option value="01:30">01:30</option>
                                <option value="01:45">01:45</option>
                                <option value="02:00">02:00</option>
                                <option value="02:15">02:15</option>
                                <option value="02:30">02:30</option>
                                <option value="02:45">02:45</option>
                                <option value="03:00">03:00</option>
                                <option value="03:15">03:15</option>
                                <option value="03:30">03:30</option>
                                <option value="03:45">03:45</option>
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
                                <option value="12:00" selected="">12:00</option>
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
                              <select class="full-width" name="DepTime" id="DepTime2" style="display:none; color:#555555;" disabled="disabled">
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
                                <option value="12:00" selected="">12:00</option>
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
                              <spans for="DepTime" class="form-error"></spans>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12">
                              <label class="labelclass">Arrival Date</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control hasDatepicker" id="ReturnDate" name="returnDate" value="" readonly="readonly" required="" aria-required="true">
                                <label for="returnDate" class="error"></label>
                              </div>
                            </div>
                            <div class="col-md-5 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                              <label class="labelclass">Time</label>
                              <select class="form-control last_option" style="color:#555555;" name="ReturnTime" id="ReturnTime">
                                <option value="00:00">00:00</option>
                                <option value="00:15">00:15</option>
                                <option value="00:30">00:30</option>
                                <option value="00:45">00:45</option>
                                <option value="01:00">01:00</option>
                                <option value="01:15">01:15</option>
                                <option value="01:30">01:30</option>
                                <option value="01:45">01:45</option>
                                <option value="02:00">02:00</option>
                                <option value="02:15">02:15</option>
                                <option value="02:30">02:30</option>
                                <option value="02:45">02:45</option>
                                <option value="03:00">03:00</option>
                                <option value="03:15">03:15</option>
                                <option value="03:30">03:30</option>
                                <option value="03:45">03:45</option>
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
                                <option value="12:00" selected="">12:00</option>
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
                              <select name="ReturnTime" id="ReturnTime2" disabled="disabled" style="display:none; color:#555555;" class="full-width">
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
                                <option value="12:00" selected="">12:00</option>
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
                              <spans for="ReturnTime" class="form-error"></spans>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="row">
                        <div class="col-md-8 last_input">
                          <label class="labelclass">Discount Code</label>
                          <input type="text" class="form-control " name="discountCode" id="discountCode" value="" placeholder="Discount Coupon">
                        </div>
                        <div class="col-md-4" style="margin-top: 24px;">
                          <button type="submit" onclick="ga('send', 'event', 'Get A Quote', 'Book Now Button');" class="btn btn-main btn-block">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    function getresult(url) {
      $.ajax({
        url: url,
        type: "GET",
        data: {
          rowcount: $("#rowcount").val(),
          airportname: $("#airportname").val(),
          gettablename: $("#gettablename").val()
        },
        success: function(data) {
          $("#pagination-result").html(data);
        },
        error: function() {}
      });
    }
  </script>
  <style media="screen">
    p {
      font-size: 14px !important;
    }
  </style>
  <div class="container md-section">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-8">
            <h1 class="uppercase-heading landing-first-h">{{ $airport->airport_name}} Airport</h1>
            <div class="block_div">
              <p>When you book your <b>{{ $airport->airport_name}} Airport Parking</b> with CheapParking4you, not only will you get the best service but also an ideal deal according to your budget and need. </p>
              <p>{{ $airport->airport_name}} parking has one terminal building, this service will provide you stress free parking and includes complimentary round-trip transportation to the airport. By booking in advance you can take advantage of low online rates and save some time and money. Also you have the ability to map direction from your location to your selected parking facility. Our online payment system is easy to use, just pay online for one day of parking ahead of time.</p>
              <div class="row">
                <div class="col-md-7">
                  <p>We Offer reputable companies they are reliable and trust worthy, once you park your car then no need to worry about your car security. We guarantee you that your car will be in safe hands. </p>
                  <p>Book now with us without facing any trouble, follow our easy to book procedure and checkout our service page to see what we have to offer.</p> For <b>
                 <!--    <a href="luton-directions">{{ $airport->airport_name}} Airport Directions</a> -->
                  </b>
                </div>
                <div class="col-md-5">
                  <img src="{{ asset('frontend/images/banner-p.png') }}" class="" alt="Luton" title="Luton" style="width: 100%;">
                </div>
              </div>
            </div>
            @if($companies->count() > 0)
            <!-- prices comparision table -->
            <div class="panel panel-default">
              <div class="panel-heading"> {{ $airport->airport_name}} Airport Parking </div>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Car Park</th>
                    <th class="hidden-xs"></th>
                    <th class="hidden-xs">Customer Rating</th>
                    <th class="hidden-xs">Terminal(s)</th>
                    <th class="hidden-xs">Transfer Time</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($companies as $key => $value)
                  <tr class="odd">
                    <td class="hidden-xs">
                      <img src="{{env('IMAGE_URL').$value->logo_id}}" width="70px">
                    </td>
                    <td>
                      <a href="#" title="{{$value->company_title}}">{{$value->company_title}}</a>
                    </td>
                    <td class="hidden-xs">
                      <div class="comp-cont">
                        <span class="reviews">
                          <div class="row">
                            <div class="col-md-12">
                              <strong class="rating-out-of-10">4.3</strong>
                              <br>
                              <small class="out-of-10">out of 5</small>
                            </div>
                          </div>
                        </span>
                      </div>
                    </td>
                    <td class="hidden-xs">{{$value->terminal->terminal_name}} </td>
                    <td class="hidden-xs">30 mins</td>
                    <td>
                      <a href="#" class="btn btn-sm btn-small btn-success" data-toggle="tooltip" data-placement="left" title="" data-original-title=""> Book now</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
            <!-- prices comparision table ends -->
            <!-- landing pages explanation -->
            <h4>Meet And Greet</h4>
            <p>
              <a href="luton-meet-and-greet.php">Meet and Greet service</a> is reliable and stress free, if you are traveling with children or lot of luggage and also you don’t have time to wait for shuttle bus then this service is ideal for you.
            </p>
            <h4>Park And Ride</h4>
            <p>Our <a href="luton-park-and-ride.php">Park and Ride service</a> is one of the most budget-friendly, when you use our service it’s not only low cost but also stress free and secure. When you use our Park and Ride service, you can easily park your car in one of the safest locations and travel to the airport via our routine airport shuttles. </p>
            <!-- landing pages explanation ends -->
          </div>
          <!-- side portion started -->
          <div class="sidebar col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="travelo-box insurance-benefits">
                  <h4 class="box-title">Interested in other Airports?</h4>
                  <ul class="check hover box" style="min-height: 0px; max-height: none; height: 273.828px;">
                    @if($airport_list && $airport_list->count() > 0)
                     @foreach($airport_list as $key => $value)
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
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="travelo-box contact-box">
                  <h4>Need Parking Help?</h4>
                  <p>CheapParking4you provides highly efficient yet cheap services for your meet and greet valet parking requirements at Airports in UK.</p>
                  <address class="contact-details">
                    <span class="contact-phone">
                      <i class="soap-icon-phone"></i> 0333 567 8903 </span>
                    <br>
                    <a class="contact-email" href="#">info@cheapparking4you.co.uk</a>
                  </address>
                </div>
              </div>
            </div>
            <div class="travelo-box contact-box hidden-xs">
              <img src="images/best-img.png" alt="" title="">
            </div>
          </div>
          <!-- side portion ended -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end client section -->
@stop