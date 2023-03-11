<!-- about section -->
@extends('frontend.layout')

@section('main_section')
<section class="about_section layout_padding">
  <div class="container  ">
    <div class="heading_container ">
      <h2>
        About Us
      </h2>
      <p>
        Magni quod blanditiis non minus sed aut voluptatum illum quisquam aspernatur ullam vel beatae rerum ipsum voluptatibus
      </p>
    </div>
    <div class="row">
      <div class="col-lg-6 ">
        <div class="img-box">
          <img src="{{ asset('frontend/images/about-img.jpg') }}" alt="">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="detail-box">
          <h3>
            We Are Here For Help
          </h3>
          <p>
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour, or randomised words which don't look even slightly believable. If you
            are going to use a passage to be sure there isn't anything
            the middle of text.
          </p>
          <p>
            Molestiae odio earum non qui cumque provident voluptates, repellendus exercitationem, possimus at iste corrupti officiis unde alias eius ducimus reiciendis soluta eveniet. Nobis ullam ab omnis quasi expedita.
          </p>
          <a href="">
            Read More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

<!-- why section -->

<section class="why_section layout_padding-bottom">
  <div class="container">
    <div class="col-md-10 px-0">
      <div class="heading_container">
        <h2>
          Why Choose Us
        </h2>
        <p>
          Eaque nostrum quis ad aliquam autem odio assumenda accusamus, consequuntur, iste voluptate voluptates quia non dicta hic repellendus similique a facere earum omnis? Repellendus nemo, aspernatur ullam est deserunt officiis.
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-4 mx-auto">
        <div class="box">
          <div class="img-box">
            <img src="{{ asset('frontend/images/w1.png') }}" alt="">
          </div>
          <div class="detail-box">
            <h4>
              No Booking Fees
            </h4>
            <p>
              Voluptatem earum eveniet mollitia sit animi dolorum. Iste, quas? Omnis error culpa illo nihil consequatur consectetur tenetur harum modi, quae libero ducimus reiciendis voluptat excepturi. Cum ducimus nesciunt dicta tenetur ducimus perferendis.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mx-auto">
        <div class="box">
          <div class="img-box">
            <img src="{{ asset('frontend/images/w2.png') }}" alt="">
          </div>
          <div class="detail-box">
            <h4>
              Online Payments
            </h4>
            <p>
              Voluptatem earum eveniet mollitia sit animi dolorum. Iste, quas? Omnis error culpa illo nihil consequatur consectetur tenetur harum modi, quae libero ducimus reiciendis voluptat excepturi. Cum ducimus nesciunt dicta tenetur ducimus perferendis.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mx-auto">
        <div class="box ">
          <div class="img-box">
            <img src="{{ asset('frontend/images/w3.png') }}" alt="">
          </div>
          <div class="detail-box">
            <h4>
              Simple Booking Process
            </h4>
            <p>
              Voluptatem earum eveniet mollitia sit animi dolorum. Iste, quas? Omnis error culpa illo nihil consequatur consectetur tenetur harum modi, quae libero ducimus reiciendis voluptat excepturi. Cum ducimus nesciunt dicta tenetur ducimus perferendis.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end why section -->

<!-- pricing section -->

<section class="pricing_section layout_padding">
  <div class="bg-box">
    <img src="{{ asset('frontend/images/pricing-bg.jpg') }}" alt="">
  </div>
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Our Pricing
      </h2>
    </div>
    <div class="col-xl-10 px-0 mx-auto">
      <div class="row">
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <h4 class="price">
              $10
            </h4>
            <h5 class="name">
              Basic
            </h5>
            <p>
              Consequuntur iure, quam vero quidem minima obcaecati veniam, praesentium impedit quod repudiandae tempora amet deserunt rerum accusamus. Commodi qui, illum ad ipsa porro ipsum nostrum magni minus.
            </p>
            <a href="">
              Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box box-center">
            <h4 class="price">
              $30
            </h4>
            <h5 class="name">
              Premium
            </h5>
            <p>
              Consequuntur iure, quam vero quidem minima obcaecati veniam, praesentium impedit quod repudiandae tempora amet deserunt rerum accusamus. Commodi qui, illum ad ipsa porro ipsum nostrum magni minus.
            </p>
            <a href="">
              Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <h4 class="price">
              $20
            </h4>
            <h5 class="name">
              Standard
            </h5>
            <p>
              Consequuntur iure, quam vero quidem minima obcaecati veniam, praesentium impedit quod repudiandae tempora amet deserunt rerum accusamus. Commodi qui, illum ad ipsa porro ipsum nostrum magni minus.
            </p>
            <a href="">
              Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end pricing section -->


<!-- client section -->

<section class="client_section layout_padding">
  <div class="container">
    <div class="heading_container col">
      <h2>
        What Says Our <span>Client</span>
      </h2>
    </div>
    <div class="client_container">
      <div class="carousel-wrap ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                </p>
              </div>
              <div class="client_id">
                <div class="img-box">
                  <img src="{{ asset('frontend/images/c1.jpg') }}" alt="" class="img-1">
                </div>
                <div class="name">
                  <h6>
                    Lisa Adams
                  </h6>
                  <p>
                    Magna
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                </p>
              </div>
              <div class="client_id">
                <div class="img-box">
                  <img src="{{ asset('frontend/images/c2.jpg') }}" alt="" class="img-1">
                </div>
                <div class="name">
                  <h6>
                    Michel Trout
                  </h6>
                  <p>
                    Magna
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end client section -->
@stop