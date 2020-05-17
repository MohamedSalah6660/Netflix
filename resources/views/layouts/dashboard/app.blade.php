<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>Netflix</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard_files/css/main.css')}}">
    <!-- CSRF Token -->

    <script src="{{asset('dashboard_files/js/jquery-3.3.1.min.js')}}"></script>
    
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        @toastr_css

    <style>
      
      label{

        font-weight: bold;
      }

    </style>

@stack('styles')

  </head>
  <body class="app sidebar-mini">



 @include('layouts.dashboard._header')
 @include('layouts.dashboard._aside')



    <main class="app-content">
     
    
  @yield('content')



    </main>
        @jquery
    @toastr_js
    @toastr_render

    <!-- Essential javascripts for application to work-->
    <script src="{{asset('dashboard_files/js/popper.min.js')}}"></script>
    <script src="{{asset('dashboard_files/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard_files/js/main.js')}}"></script>
    <script src="{{asset('dashboard_files/js/select2.min.js')}}"></script>
    <script src="{{asset('dashboard_files/js/custom/movie.js')}}"></script>
 
    <script>

      $.ajaxSetup({

          headers:{

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
   
      });
      
        
      $(document).ready(function() {
        
        $('.select2').select2({

          width:'100%'
        });


      });



    </script>



  </body>
</html>