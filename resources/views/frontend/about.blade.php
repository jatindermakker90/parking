@extends('frontend.layout')

@section('main_section')
<section class="faq-bnr about" style="background-color: rgb(247, 247, 247);">
    <div class="wrapper">
        <div class="flex-row">
            <div class="info">
                <h4 class="mb-0">About Us</h3>
            </div>
            <div class="transparent-icon">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M576 240c0-23.63-12.95-44.04-32-55.12V32.01C544 23.26 537.02 0 512 0c-7.12 0-14.19 2.38-19.98 7.02l-85.03 68.03C364.28 109.19 310.66 128 256 128H64c-35.35 0-64 28.65-64 64v96c0 35.35 28.65 64 64 64h33.7c-1.39 10.48-2.18 21.14-2.18 32 0 39.77 9.26 77.35 25.56 110.94 5.19 10.69 16.52 17.06 28.4 17.06h74.28c26.05 0 41.69-29.84 25.9-50.56-16.4-21.52-26.15-48.36-26.15-77.44 0-11.11 1.62-21.79 4.41-32H256c54.66 0 108.28 18.81 150.98 52.95l85.03 68.03a32.023 32.023 0 0 0 19.98 7.02c24.92 0 32-22.78 32-32V295.13C563.05 284.04 576 263.63 576 240zm-96 141.42l-33.05-26.44C392.95 311.78 325.12 288 256 288v-96c69.12 0 136.95-23.78 190.95-66.98L480 98.58v282.84z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
</section>
<section class="lftimg-rgt-cnt">
    <div class="wrapper">
        <div class="flex-row">
            <div class="col-45 img-blk">
                <img src="{{ asset('frontend/images/about-bg.jpg') }}">
            </div>
            <div class="col-55 cnt-blk">
                <h2>Best Parking Deals: Our paramount purpose 🎉</h2>
                <div class="description">
                    <p><strong>Cheap Airport Parking</strong> has been conceived with the ambition to provide
                        travellers with practically affordable and hassle-free car parking options. We are a
                        comparison website with multiple top-tier car parking affiliates offering car parking
                    services in all of the United Kingdom's significant and bustling airports.</p>
                    <p>Our prime objective is to concentrate our efforts to provide our esteemed customers with
                        cost-compatible and time-saving car parking options. To accomplish this, we have teamed up
                        with competent and reputed airport parking providers to showcase comparison lists of all our
                        partners’ parking services. Subsequently, we enable travellers to leverage the power of
                    wallet-friendly and convenient car parking deals.</p>
                    <p>Moreover, our simple and <strong>swift booking process</strong> lets you avert the laborious
                        task of profile creation and other formalities. Just enter your relevant information, and
                        your parking space will be booked in a matter of minutes. And yes, do not forget to avail
                    yourself of a discount of 10%.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="lftcnt-rgtimg">
    <div class="wrapper">
        <div class="flex-row">
            <div class="cnt-blk col-50">
                <div class="top-cnt">
                    <h2>Epic Deals, Satisfied Customers</h2>
                    <p>Our credibility, pledge to offer cost-viable options, and prompt and user-friendly customer service surpass us in the crowd of other parking operators. Also, our parking deals are incredibly cheap, making all our customers delighted and satisfied with us.</p>
                </div>
                <ul class="icn-list">
                    <li>
                        <div class="blk-box">
                            <div class="top-icon">
                                <img src="{{ asset('frontend/images/img-01.png') }}">
                            </div>
                            <h3>32k+</h3>
                            <p>Happy Customer</p>
                        </div>
                    </li>
                    <li>
                        <div class="blk-box">
                            <div class="top-icon">
                                <img src="{{ asset('frontend/images/img-02.png') }}">
                            </div>
                            <h3>32k+</h3>
                            <p>Happy Customer</p>
                        </div>
                    </li>
                    <li>
                        <div class="blk-box">
                            <div class="top-icon">
                                <img src="{{ asset('frontend/images/img-03.png') }}">
                            </div>
                            <h3>32k+</h3>
                            <p>Happy Customer</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="img-blk col-50">
                <img src="{{ asset('frontend/images/about-bg.jpg') }}">
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
                        <img src="{{ asset('storage/'.$value->logo_id) }}">
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
          if($('.select').length){
          $('select').select2();
        }
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

