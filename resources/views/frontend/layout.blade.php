<!DOCTYPE html>
<html lang="en">
    @include('frontend.layouts.header')
        <body>
           @include('frontend.layouts.nav-header')
           @yield('main_section')
           @include('frontend.layouts.footer')

        </body>
         @include('frontend.layouts.footer_script')
         @yield('js_section')
</html>