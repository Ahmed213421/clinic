
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{asset('clinic/js/jquery.min.js')}}"></script>
      <script src="{{asset('clinic/js/popper.min.js')}}"></script>
      <script src="{{asset('clinic/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('clinic/js/jquery-3.0.0.min.js')}}"></script>
      <script src="{{asset('clinic/js/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('clinic/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{asset('clinic/js/custom.js')}}"></script>
      <!-- javascript -->
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <script>
         $('#datepicker').datepicker({
             uiLibrary: 'bootstrap'
         });
      </script>
      <script>
         $('#timepicker').timepicker({
             uiLibrary: 'bootstrap'
         });
      </script>

      @yield('js')
   </body>
</html>
