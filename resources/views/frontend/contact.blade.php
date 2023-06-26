@extends('frontend.layout')
@section('main_section')
<section class="faq-bnr about" style="background-color: rgb(247, 247, 247);">
    <div class="wrapper">
        <div class="flex-row">
            <div class="info">
                <h4 class="mb-0">Contact Us</h3>
            </div>
            <div class="transparent-icon">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M176 216h160c8.84 0 16-7.16 16-16v-16c0-8.84-7.16-16-16-16H176c-8.84 0-16 7.16-16 16v16c0 8.84 7.16 16 16 16zm-16 80c0 8.84 7.16 16 16 16h160c8.84 0 16-7.16 16-16v-16c0-8.84-7.16-16-16-16H176c-8.84 0-16 7.16-16 16v16zm96 121.13c-16.42 0-32.84-5.06-46.86-15.19L0 250.86V464c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V250.86L302.86 401.94c-14.02 10.12-30.44 15.19-46.86 15.19zm237.61-254.18c-8.85-6.94-17.24-13.47-29.61-22.81V96c0-26.51-21.49-48-48-48h-77.55c-3.04-2.2-5.87-4.26-9.04-6.56C312.6 29.17 279.2-.35 256 0c-23.2-.35-56.59 29.17-73.41 41.44-3.17 2.3-6 4.36-9.04 6.56H96c-26.51 0-48 21.49-48 48v44.14c-12.37 9.33-20.76 15.87-29.61 22.81A47.995 47.995 0 0 0 0 200.72v10.65l96 69.35V96h320v184.72l96-69.35v-10.65c0-14.74-6.78-28.67-18.39-37.77z"></path></svg>
            </div>
        </div>
    </div>
</section>

<section class="contact-block">
    <div class="wrapper">
        <div class="flex-row">
            <div class="block-box">
                <div class="top-icon">
                    <img src="{{ asset('frontend/images/contact-01.png') }}">
                </div>
                <div class="blk-cnt">
                    <h5>Office Address</h5>
                    <p>Compare Parking Needs Ltd, 15 Person Road, Pound Hill, Crawley</p>
                </div>
            </div>
            <div class="block-box">
                <div class="top-icon">
                    <img src="{{ asset('frontend/images/contact-02.png') }}">
                </div>
                <div class="blk-cnt">
                    <h5>Phone number</h5>
                    <a href="tel:03335678902">03335678902</a>
                </div>
            </div>
            <div class="block-box">
                <div class="top-icon">
                    <img src="./images/contact-03.png') }}">
                </div>
                <div class="blk-cnt">
                    <h5>Send Email</h5>
                    <a href="Mailto:info@airportcheapparking.co.uk">info@airportcheapparking.co.uk</a>
                </div>
            </div>
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

