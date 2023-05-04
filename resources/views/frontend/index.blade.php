<!-- about section -->
@extends('frontend.layout')

@section('main_section')
<section id="content" class="tour">
  <div id="slideshow" class="slideshow-bg full-screen bg">
    <div id="flights-tab" class="container">
      <div class="row">
        <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
          <div class="search-box">
            <form action="#" role="form" method="POST" name="" id="Home" class="Home">
              <h1 style="text-align:center;color:#fff !important;font-size:40px;">GET A QUOTE</h1>
              <div class="row">
                <label for="airportId" class="control-label col-sm-3 col-xs-12 col-md-4">Airport:</label>
                <div class="col-sm-9 col-xs-12 col-md-8">
                  <div class="form-group">
                    <select style="background-color:#88E1D9;" name="airportId" id="airportId" class="form-control">
                      @if($airports && $airports->count() > 0)
                       <option value="0">Select Airport</option>
                       @foreach($airports as $key => $value)
                       <option value="{{$value->id}}">{{$value->airport_name}}</option>
                       @endforeach
                      @else
                       <option value="0" disabled>No Airport Available</option>
                      @endif
                     
                    </select>
                  </div>
                </div>
                <label class="control-label col-md-4 col-sm-3 col-xs-12">Drop off Date:</label>
                <div class="col-md-5 col-sm-5 col-xs-7">
                  <div class="form-group">
                    <div class="datepicker-wrap">
                      <input name="dropOffDate" id="DropDate" type="text" class="input-text form-control" placeholder="Departure Date" readonly="readonly" />
                      <label for="DropDate" id="DropDate_label">.....</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-5">
                  <div class="form-group abc">
                    <select class="form-control my_con" style="background-color:#88E1D9;" name="DepTime" id="DepTime">
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
                    <select name="DepTime" id="DepTime2" style="display:none; background-color:#88E1D9; padding-left:4px;" disabled="disabled" class="form-control">
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
                    <spans for="DepTime" class="form-error"></spans>
                  </div>
                </div>
                <label class="control-label col-sm-3 col-md-4 col-xs-12" for="email">Arrival Date:</label>
                <div class="col-sm-5 col-md-5 col-xs-7">
                  <div class="form-group">
                    <div class="datepicker-wrap">
                      <input type="text" name="returnDate" id="ReturnDate" class="input-text form-control" placeholder="Arrival Date" readonly="readonly" />
                      <label for="ReturnDate" style="" id="ReturnDate_label">.....</label>
                    </div>
                  </div>
                  <style type="text/css">
                    #DropDate,
                    #ReturnDate {
                      position: absolute;
                    }

                    #DropDate_label,
                    #ReturnDate_label {
                      width: 25px;
                      float: right;
                      margin-right: 0px;
                      top: -3px;
                      position: relative;
                      z-index: 1;
                      margin-top: 5px;
                      height: 30px;
                    }
                  </style>
                </div>
                <div class="col-sm-4 col-md-3 col-xs-5">
                  <div class="form-group abc">
                    <select class="form-control my_con" style="background-color:#88E1D9;" name="ReturnTime" id="ReturnTime">
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
                    <select name="ReturnTime" id="ReturnTime2" disabled="disabled" style="display:none; background-color:#88E1D9; padding-left:4px;" class="form-control">
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
                    <spans for="ReturnTime" class="form-error"></spans>
                  </div>
                </div>
                <label class="control-label col-sm-3 col-md-4 col-xs-12" for="code">Discount Code:</label>
                <div class="col-sm-9 col-md-8 col-xs-12">
                  <div class="form-group">
                    <input type="text" class="input-text form-control" name="discountCode" value="" id="discountCode" placeholder="Discount Code If Any">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 col-md-12 ">
                    <input type="submit" class="btn button btn-medium sky-blue1 uppercase" style="width:100%;background: #3F9EBC;color: #fff; font-weight: bold;" value="Book Now" />
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 first_h">
        <h1 class="uppercase-heading">Your One Stop Solution for Comfortable and Efficient Parking <br> The Modern Way for Convenient Parking at an Airport </h1>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row" style="background:#f5f5f5;">
      <div class="col-md-6 video-section">
        <iframe width="100%" height="350" src="{{ asset('frontend/images/compareparking.png') }}" allowfullscreen></iframe>
      </div>
      <div class="col-md-6">
        <div class="video-right-content">
          <h1 class="video-h-t">HOW IT WORKS</h1>
          <p class="video-p-t">You can book or reserve convenient parking services with just a click away, at CheapParking 4 You. <br>Choose our one-stop solution for Meet and Greet, Park and Ride and On-site Airport Parking. </p>
          <p class="video-p-t">Cheap Parking 4 You provides highly efficient yet cheap services for your meet and greet valet parking requirements at Airports in UK.</p>
          <p class="video-p-t">
            <strong>Choose our one-stop solution for Meet and Greet, Park and Ride and On-site Airport Parking.</strong>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="section parallax" id="features-section-boxes" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row image-box style7">
        <div class="col-sms-6 col-sm-6 col-md-4">
          <article class="box" id="header-boxes">
            <div class="details">
              <img src="{{ asset('frontend/images/meet-geet.png') }}" class="img-responsive" />
              <h4 class="text-center text-uppercase">
                <a href="#">Meet and Greet</a>
              </h4>
              <div class="item-home">
                <p> Meet and Greet Parking services, sometimes known as valet parking, where you can have a person from the company you prefer, who does the convenient and secure parking for you, and then greet and handover keys to you, when you come back. This meet and greet parking services arespecially designed for your convenience, as your vehicle will be parked safely and then available when you return back. </p>
              </div>
            </div>
          </article>
        </div>
        <div class="col-sms-6 col-sm-6 col-md-4">
          <article class="box" id="header-boxes">
            <div class="details">
              <img src="{{ asset('frontend/images/park-ride.png') }}" class="img-responsive" />
              <h4 class="text-center text-uppercase">
                <a href="#">Park and Ride</a>
              </h4>
              <div class="item-home">
                <p> Park and Ride is the most affordable option, where you can easily avail free shuttle service in just 5 to 10 minutes after you are done with your parking. These facilities offer a unique personalized customer service, where you easily relax and enjoy the ride without having any worries about your parking space. Park and Ride services are very secure and run frequently upon request. </p>
              </div>
            </div>
          </article>
        </div>
        <div class="col-sms-6 col-sm-6 col-md-4">
          <article class="box" id="header-boxes">
            <div class="details">
              <img src="{{ asset('frontend/images/onsiteparking.png') }}" class="img-responsive" />
              <h4 class="text-center text-uppercase">
                <a href="#">Onsite</a>
              </h4>
              <div class="item-home">
                <p> In onsite parking, you can have the advantage of being provided with a parking space from the airport itself. This includes a long stay option where you can have a short transfer and the short stay option is near the terminal. In order to avail huge discounts and savings, you are required to reserve your onsite parking in advance for the best price possible. </p>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
  <div class="section parallax" data-stellar-background-ratio="0.5" style="background-position: 50% 122px;">
    <div class="container description">
      <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-4">
          <div class="icon-box style4 animated slideInRight" data-animation-type="slideInRight" data-animation-delay="0" style="animation-duration: 1s; visibility: visible;">
            <img src="{{ asset('frontend/images/bestprice.png') }}" style="width: 150px;" />
            <h4 class="box-title">BEST PRICE GUARANTEED</h4>
            <p class="description text-justify"> We guarantee the best parking service provider with the best prices, at your request. With our list of selected airports with parking service providers, you can check and compare the prices to ensure that you have the best parking deal at the end of the day. </p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-4">
          <div class="icon-box style4 animated slideInRight" data-animation-type="slideInRight" data-animation-delay="0.3" style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
            <img src="{{ asset('frontend/images/secure_lock.png') }}" style="width: 150px;" />
            <h4 class="box-title">FULLY SECURE</h4>
            <p class="description text-justify"> We constantly monitor and check all the safety and security measures with our supplier, in order to keep your car safe and secure at all times. You can be 100% assured that your car is in the safest hands possible, during your absence. </p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-4">
          <div class="icon-box style4 animated slideInRight" data-animation-type="slideInRight" data-animation-delay="0.3" style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
            <img src="{{ asset('frontend/images/satisfaction.png') }}" style="width: 150px;" />
            <h4 class="box-title">CUSTOMER SATISFACTION</h4>
            <p class="description text-justify"> We believe that our customers are our valuable assets. That is why we go an extra mile to achieve their complete satisfaction, as we make sure to provide them with the best quality parking services. Our customers are our strength, which is why we ensure that all our contractors meet quality standards. </p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-4">
          <div class="icon-box style4 animated slideInRight" data-animation-type="slideInRight" data-animation-delay="0.3" style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
            <img src="{{ asset('frontend/images/loyal.png') }}" style="width: 150px;" />
            <h4 class="box-title">CUSTOMER LOYALTY PLATFORM</h4>
            <p class="description text-justify"> If you are a loyal customer, then you are privileged to receive a special discount offer on your parking reservation. All you have to do is simply give your reference number or your email to receive your parking deal discount.</p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-4">
          <div class="icon-box style4 animated slideInRight" data-animation-type="slideInRight" data-animation-delay="0.3" style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
            <img src="{{ asset('frontend/images/support.png') }}" style="width: 150px;" />
            <h4 class="box-title">CUSTOMER SUPPORT</h4>
            <p class="description text-justify"> If you want to reserve your parking space or want to change an existing booking, then all you have to do is call us during office hours, on the phone number provided in your confirmation email. Our agent will get back to you for your query in no time. </p>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-4">
          <div class="icon-box style4 animated slideInRight" data-animation-type="slideInRight" data-animation-delay="0.3" style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
            <img src="{{ asset('frontend/images/booking.png') }}" style="width: 150px;" />
            <h4 class="box-title">SIMPLE BOOKING PROCESS</h4>
            <p class="description text-justify"> Booking parking space on our website has never been so easy with our simple booking process. You do not have to worry about filling unnecessary details to get your parking reserved. Our user-friendly booking process is simply designed for your comfort so that you can reserve your parking in just a few clicks. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="global-map-area mobile-section parallax" data-stellar-background-ratio="0.5" style="background-position: 50% 51px;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <div class="table-wrapper hidden-table-sm">
            <div class="col-md-6 description section table-cell">
              <h1 style="font-size: 46px !important;">BEST PRICE GUARANTEE!</h1>
              <div class="review clearfix">
                <div class="five-stars-container pull-left">
                  <div class="five-stars transparent-bg" style="width: 100%;"></div>
                </div>
                <label>
                  <small class="white-color uppercase">95% user ratings</small>
                </label>
              </div>
              <br>
              <p style="font-size:18px; color:#fff;">Now book in just three simple steps and get the best price guarantee.</p>
            </div>
            <div class="col-md-6 image-wrapper table-cell hidden-sm hidden-xs">
              <img src="{{ asset('frontend/images/best.png') }}" style="height: 180px;" alt="" class="animated fadeInUp" data-animation-type="fadeInUp" style="animation-duration: 1s; visibility: visible;">
              <img src="{{ asset('frontend/images/secure-icon.png') }}" class="hidden-sm hidden-xs" style="width: 200px; margin-left: 55px;">
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</section>
<!-- end client section -->
@stop