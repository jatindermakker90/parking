<!DOCTYPE html>
<html>
@include('frontend.layouts.header')
<body>
  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('frontend/images/slider-bg.jpg') }}" alt="">
    </div>
    <!-- header section strats -->
     @include('frontend.layouts.menubar')
    <!-- end header section -->
    <!-- slider section -->
    @include('frontend.layouts.slider')
    <!-- end slider section -->
  </div>
   @yield('main_section')
  <!-- info section -->
  @include('frontend.layouts.info')
  <!-- end info_section -->
  <!-- footer section -->
 @include('frontend.layouts.footer')
  <!-- footer section -->
 @include('frontend.layouts.footer_script')

</body>

</html>