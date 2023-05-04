<!-- about section -->
@extends('frontend.layout')
@section('main_section')
 <section id="content">
   <div class="container">
     <div class="row">
       <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="travelo-box question-list">
                <div class="toggle-container">
                  <div class="panel style1">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#tgg1" class="collapsed">Are the Cars parked in safe and secure Parking ?</a>
                    </h4>
                    <div id="tgg1" class="panel-collapse collapse in">
                      <div class="panel-content"> Yes, the companies associated with "TRAVEL EXTRA DEALS" maintains the "meet and greet parking" compounds. During the bookings, we are here to aid you with the exclusive details through mail, blogs and live conversation. </div>
                    </div>
                  </div>
                  <div class="panel style1">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#tgg2" class="collapsed">Do I trust your online payment procedures? </a>
                    </h4>
                    <div id="tgg2" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-content"> Yes, we have authorized procedures and carry out the transaction in full privacy. The entire details of your credit cards and payments are fully protected whilst you are using the service and we remove all the data from our server on the completion of booking procedure. </div>
                    </div>
                  </div>
                  <div class="panel style1">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#tgg3" class="collapsed">How do I amend My Bookings? </a>
                    </h4>
                    <div id="tgg3" class="panel-collapse collapse">
                      <div class="panel-content"> All alterations and cancellations are obliged to be shared with the TRAVEL EXTRA DEALS LTD. <br> All amendments will be based on the terms and condition of TRAVEL EXTRA DEALS LTD. <br> The customers who desires to diminish or prolong the stays for their reserved service will be liable to follow the deductions and payments accordingly. </div>
                    </div>
                  </div>
                  <div class="panel style1">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#tgg4" class="collapsed">What is the procedure for making the complaints? </a>
                    </h4>
                    <div id="tgg4" class="panel-collapse collapse">
                      <div class="panel-content"> We take the feedbacks and complaints of our customers very seriously and respond them as early as possible. Please contact us at 0333 567 8903 . The Travel Extra Deals is the booking agent and is liable for the payments and "meet and greet parking" booking procedures but cannot be held the responsible of complaints against any car loss or damages. </div>
                    </div>
                  </div>
                  <div class="panel style1">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#tgg5" class="collapsed">Are all the companies insured? </a>
                    </h4>
                    <div id="tgg5" class="panel-collapse collapse">
                      <div class="panel-content"> Yes, All our service provider's have Fully Comprehensive . </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       <!-- end main -->
       <title>About Us | CheapParking 4 you </title>
       <meta name="description" content="CheapParking4you offers Secured airport Meet and Greet and onsite parking. ">
       <meta http-equiv="content-type" content="text/html;charset=UTF-8">
       <div class="col-sm-4 sidebar">
         <div class="booking-details travelo-box" id="flights-tab" style="border: 1px solid rgba(63, 158, 188, 0.28); padding: 15px;">
           <div class="search-box" style="margin-top: 0px !important;">
             <form action="#" role="form" method="POST" name="" id="Home" class="Home">
               <h4 style="text-align:center;color:#000 !important;">GET A QUOTE</h4>
               <div class="row">
                 <div class="form-group">
                   <label class="control-label col-sm-12 col-xs-12 col-md-12 font-black">Airport</label>
                   <div class="col-sm-12 col-xs-12 col-md-12">
                     <select style="background-color:#88E1D9;" name="airportId" id="airportId" class="form-control" onchange="airportheathrow()">
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
                 <div class="form-group">
                   <div class="col-md-7 col-sm-7 col-xs-7">
                     <label class="control-label font-black">Drop off Date:</label>
                     <input name="dropOffDate" id="DropDate" type="text" class="input-text form-control" placeholder="Departure" />
                   </div>
                 </div>
                 <div class="form-group abc">
                   <div class="col-md-5 col-sm-5 col-xs-5">
                     <label class="control-label font-black">Dep Time:</label>
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
                 <div class="form-group">
                   <div class="col-sm-7 col-md-7 col-xs-7">
                     <label class="control-label font-black" for="email">Arrival Date:</label>
                     <input type="text" name="returnDate" id="ReturnDate" class="input-text form-control" placeholder="Departure" />
                   </div>
                 </div>
                 <div class="form-group abc">
                   <div class="col-sm-5 col-md-5 col-xs-5">
                     <label class="control-label font-black" for="email">Arrival time:</label>
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
                 <div class="form-group">
                   <div class="col-sm-12 col-md-12 col-xs-12">
                     <label class="control-label font-black" for="code">Discount Code:</label>
                     <input type="text" class="input-text form-control" name="discountCode" value="" id="discountCode" placeholder="Discount Code If Any">
                   </div>
                 </div>
                 <div class="form-group">
                   <div class="col-sm-12 col-md-12 " style="margin-top: 20px;">
                     <input type="submit" class="btn button btn-medium sky-blue1 uppercase" style="width:100%;background: #3F9EBC;color: #fff; font-weight: bold;" value="Book Now" />
                   </div>
                 </div>
               </div>
             </form>
           </div>
         </div>
         <!-- END TOP AREA  -->
       </div>
     </div>
   </div>
 </section>
<!-- end client section -->
@stop