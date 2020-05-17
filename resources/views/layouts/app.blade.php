<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Netflixify</title>

    <!--font awesome-->
    <link rel="stylesheet" href="{{ asset('css/font-awesome5.11.2.min.css') }}">

    <!--bootstrap-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!--vendor css-->
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">

    <!--google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--main styles -->
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">

    <link rel="stylesheet" href="{{ asset('easyAutoComplete/easy-autocomplete.min.css') }}">

    <style>
      .fw-900{

        color: red;
      }


      .easy-autocomplete{

        width: 90%;

      }

      .easy-autocomplete input{

        color: white !important;

      }

      .eac-icon-left .eac-item img{

        max-height: 80px !important;

      }z



    </style>
</head>
<body>

@yield('content');
@include('layouts._footer')



{{-- @include('layouts._footer') --}}
<script src="{{ asset('js/playerjs.js') }}"></script>

<!--jquery-->
<script src="{{ asset('js/jquery-3.4.0.min.js') }}"></script>

<!--bootstrap-->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
{{-- <script src="{{ ('js/popper.min.js') }}"></script> --}}

<!--vendor js-->
<script src="{{ asset('js/vendor.min.js') }}"></script>

<!--main scripts-->
<script src="{{ asset('js/main.min.js') }}"></script>

<script src="{{ asset('js/custom/movie.js') }}"></script>

<script src="{{ asset('easyAutoComplete/jquery.easy-autocomplete.min.js') }}"></script>







<script>
  
      $.ajaxSetup({

          headers:{

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
   
      });
      var options = {

        url: function(search) {
        return "/movies?search=" + search;
        },

         getValue: "name",

         template : {

          type : 'iconLeft',

            fields:{

              iconSrc : "poster_path"
            }
         },

         list: {

              onChooseEvent: function(){

                var movie = $('.form-control[type="search"]').getSelectedItemData();
                var url = window.location.origin + '/movies/' + movie.id;
                window.location.replace(url);
              }
         }


      };

      $('.form-control[type="search"]').easyAutocomplete(options);

  $(document).ready(function () {

    $("#banner .movies").owlCarousel({
      loop: true,
      nav: false,
      items: 1,
      dots: false,
    });

    $(".listing .movies").owlCarousel({
      loop: true,
      nav: false,
      stagePadding: 50,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        900: {
          items: 3
        },
        1000: {
          items: 4
        }
      },
      dots: false,
      margin: 15,
      loop: true,
    });

  });
</script>


@stack('scripts')


</body>
</html>
