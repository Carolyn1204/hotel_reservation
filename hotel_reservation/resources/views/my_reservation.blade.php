@extends('layouts.main')
@section('content')

@php
if(session('user_name')){
    $user_name = session('user_name');
}
 
@endphp



<div class="container mt-5">
    <div class="row" style="margin-left:100px; width:1200px;">
    <h3 class="card-title" style="color: rgb(59 113 202); ">Hello, {{ $user_name }}!</h3>
        <!-- Room Information -->
        @foreach($my_reservations as $reservation)
            @php

            $check_in = new DateTime($reservation->start_date);
            $check_out = new DateTime($reservation->end_date);

            $interval = $check_in->diff($check_out);
            $number_of_days = $interval->days;

            $pic = 'img/queen.png'; 
            switch($reservation->room_type) {
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
                    break;}

            @endphp
        <div class="col-md-8 me-5 mt-5" style="width: 950px;">
        
            <div class="card mb-3" style="max-width: 950px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img
                        src="{{ $pic }}" 
                        alt="Vienne hotel my reservation room picture"
                        class="img-fluid rounded-start"
                        style="height:200px; border-radius:5px;"
                    />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="display:flex; justify-content: space-between;">
                            <div class="left" style="margin-right:50px;">
                                <p class="card-text">Destination: {{ $reservation->city}}</p>
                                <p class="card-text">Check in: {{ $reservation->start_date}}</p>
                                <p class="card-text">Check out: {{ $reservation->end_date}}</p>
                                <p class="card-text">Room Type: {{ $reservation->room_type}}</p>
                            </div>

                            <div class="right">
                                <p class="card-text">Number of Rooms: {{ $reservation->room_num}}</p>
                                <p class="card-text">Rate: ${{ $reservation->rate }} CAD/night</p>
                                <p class="card-text">Subtotal: ${{ $reservation->rate * $reservation->room_num * $number_of_days }} CAD</p>
                                <p class="card-text">Total: ${{ $reservation->rate * $reservation->room_num * $number_of_days *1.15 }} CAD</p>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            


        </div>
        @endforeach
    </div>
</div>





@endsection