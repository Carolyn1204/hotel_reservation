@extends('layouts.main')
@section('content')

<div class="container mt-5">
  <h2 class="mb-4">Hotel Rooms</h2>

  <!-- Hotel Rooms List -->
  <div class="row">
    <!-- Room 1 -->
    @foreach($all_room_type as $room)
    @php
    $pic = 'img/queen.png'; 
    switch($room['roomType']) {
        case '1 Queen Guest Room':
            $pic = 'img/queen.png';
            break;
        case '1 King Guest Room':
            $pic = 'img/king.png';
            break;
        case 'VIP Room':
            $pic = 'img/vip.png';
            break;
        case 'Family Room':
            $pic = 'img/family.png';
            break;
    }
    @endphp

    <div class="col-lg-4 mb-4">
      <div class="card">
        <img src="{{ asset($pic) }}" class="card-img-top" alt="Vienne hotel search result room picture">
        <div class="card-body">
          <h5 class="card-title">{{ $room['roomType'] }}</h5>
          <p class="card-text">Vienne hotel is a modern hotel with an indoor pool, in the heart of downtown.</p>
          <p class="card-text"><strong>Rate:&nbsp;</strong><i>{{ $room['rate'] }}</i>&nbsp;CAD&nbsp;/&nbsp;night</p>
          <a href="{{ route('reservation') }}?type={{ urlencode($room['roomType']) }}&rate={{ urlencode($room['rate']) }}&pic={{ urlencode($pic) }}" class="btn btn-primary book_btn">Book Now</a>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>

<script>

    const book_btn = document.querySelector(".book_btn");
    
    window.onload = function() {

      book_btn.addEventListener('click', login );
    }
    
    function login(e) {

      if(!sessionStorage.getItem('user_email')){
            e.preventDefault();
            let result = window.confirm("Please login first before booking a room!");
            if (result) {
                header_login.click();
            }
        }
      
    }
    
</script>

@endsection