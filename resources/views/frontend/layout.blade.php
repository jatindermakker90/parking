<!DOCTYPE html>
<html>
@include('frontend.layouts.header')
<body class="loaded">
  <div id="page-wrapper">
    @include('frontend.layouts.nav-header')
    <!-- header section strats -->
     @yield('main_section')
  </div>
</body>
 @include('frontend.layouts.footer')
 @include('frontend.layouts.footer_script')
</html>