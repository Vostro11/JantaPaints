<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Canvas Area Draw</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap.no-icons.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Allura' rel='stylesheet'>    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="{{asset('frontend/css/fancybox.min.css')}}" media="screen">

    <link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/slick/slick-theme.css')}}"/>
    <script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>

  </head>
  <body>
    <!-- @include('frontend.layouts.nav') -->
    
  <div id="main" class="container-fluid">
    @yield('content')
  </div>
  @include('frontend.layouts.footer')
  
  <script src="{{asset('frontend/js/fancybox.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Lightbox -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js"></script>
  
  <script language="javascript" src="{{asset('frontend/js/jquery.canvasAreaDraw.js')}}"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="{{asset('frontend/slick/slick.min.js')}}"></script>
  <script language="javascript" src="{{asset('frontend/js/custom.js')}}"></script>
  <script language="javascript" src="{{asset('frontend/js/test.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.color-palet-wrapper').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
      });

      $('.color-palet-wrapper-exterior').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
      });
    });
  </script>
@yield('ext_script')
</body>
</html>