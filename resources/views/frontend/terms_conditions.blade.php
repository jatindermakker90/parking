@extends('frontend.layout')

@section('main_section')
<section class="cnt-section">
    <div class="wrapper">
        <h2 class="text-center">TERMS & CONDITIONS</h2>
        <p>These Terms &amp; Conditions apply to all bookings accepted by the<!-- --> <strong>Cheap Airport Park Ltd</strong> T/A<!-- --> <strong>Cheap Airport Parking</strong> to the exclusion of any other terms.</p>
        <div>
            <h2>Section : 1 Bookings</h2>
            <ul><li><strong>1.1</strong> We Cheap Airport Parking will endeavour to ensure that your confirmation voucher is emailed to the email address you provide on the booking form.</li><li><strong>1.2</strong>If for any reason your booking confirmation has not been received you must contact us immediately as no refund is available for no shows or if cancellation is received less than 48 hours before you are due to arrive at the car park.</li><li><strong>1.3</strong>Please click on the "More Info" on product(s) for any additional surcharges, operational hours, limitations, more information about service provider etc. Any additional charges are charged by the service provider/car parking company independently and bare no relevance to We Deal or our advertised prices.</li><li><strong>1.4</strong>We Cheap Airport Parking acts only as a booking agent for the service provider for the featured car parks. It does not itself provide the parking services.</li><li><strong>1.5</strong>You will be contracting with the individual car park and will be subject to their Terms and Conditions which may contain exemption clauses and limit each company's liability. Car Park's full Terms &amp; Conditions will be available on request.</li><li><strong>1.6</strong>Any claims by the customer in respect of parking services e.g collection &amp; delivery of vehicle, damage to the vehicle etc must be made against the parking service provider and subject to their terms and conditions.(See 1.8)</li><li><strong>1.7</strong>We Cheap Airport Parking cannot accept liability in any circumstances where performance of the contract is prevented by reason of war, threat of war, riots, terrorist activities, natural disaster, fire or adverse weather conditions etc.</li><li><strong>1.8</strong>All Parking is subject to the terms and conditions of the individual car park and the customer expressly accepts that all claims regarding damage or loss caused by the service provider must be claimed from the service provider. In certain times e.g peak hours, holiday periods or anything beyond service provider's control customers should allow at least up to an hour either side when dropping on collecting their vehicle.</li></ul>
        </div>

        <div>
            <h2>Section : 2 Cancellation Cover</h2>
            <ul><li><strong>2.1</strong>Should a customer wish to cancel they must do so at least 24 hours prior to their departure date in order to be eligible for refund minus the admin fee. The cancellation cover only allows the booking to be cancelled 24 hours prior to departure date and does not waive off the admin fee.</li><li><strong>2.2</strong>No refund will be issued if the cancellation notice is received in less than 24 hours from the departure date.</li><li><strong>2.3</strong>Cancellation Cover does not apply for bookings made the same day, booked for the following day or in certain products where stated.</li><li><strong>2.4</strong>Booking Fees, Cancellation cover and SMS Charges are non-refundable.</li></ul>
        </div>
        <ul class="in-btm-cnt">
            <li>
                <div class="icn">
                    <img src="{{ asset('frontend/images/blue-map.svg') }}">
                </div>
                <p>Compare Parking Needs Ltd, 15 Person Road, Pound Hill, Crawley</p>
            </li>
            <li>
                <div class="icn">
                    <img src="{{ asset('frontend/images/blue-phone.svg') }}">
                </div>
                <p>03335678902</p>
            </li>
            <li>
                <div class="icn">
                    <img src="{{ asset('frontend/images/blue-mail.svg') }}">
                </div>
                <p>info@airportcheapparking.co.uk</p>
            </li>
           
        </ul>
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

