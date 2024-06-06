<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Welcome to Vienna Hotel, the best hotel in City. Enjoy luxurious accommodations, fine dining, and exceptional service. Book your stay today!">
  <meta name="keywords" content="hotel, accommodation, City, luxury hotel, hotel booking">
  <meta name="author" content="Vienna Hotel">
  <title>Hotel Reservation</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- <link href="{{ asset('test/css/mdb.min.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('test/css/mdb.rtl.min.css') }}" rel="stylesheet">
</head>


<body style="background-image: url('img/hotel.jpg'); background-size: cover;">

  @include('layouts.header')
  
  @yield('content')

  @include('layouts.footer')

  <!-- SCRIPTS -->
  <!-- <script type="text/javascript" src="{{ asset('test/js/mdb.es.min.js') }}"></script> -->
  <script type="text/javascript" src="{{ asset('test/js/mdb.umd.min.js') }}"></script>
  

 
</body>

</html>
