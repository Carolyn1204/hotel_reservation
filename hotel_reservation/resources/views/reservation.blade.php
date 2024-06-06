@extends('layouts.main')
@section('content')


@php

$check_in = new DateTime($reservation_data['check_in']);
$check_out = new DateTime($reservation_data['check_out']);

$interval = $check_in->diff($check_out);
$number_of_days = $interval->days;

@endphp



<div class="container mt-5">
    <div class="row">
        <!-- Room Information -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Selected Room</h5>
                    <!-- Room Picture -->
                    <img src="{{ $reservation_data['selected_pic'] }}" class="card-img-top mb-3" alt="Vienne hotel selected room picture">
                    <!-- Room Info -->
                    <div class="booked_info" style="display:flex; justify-content:space-between; flex-wrap: wrap;">
                        <p class="card-text">Destination: {{ $reservation_data['destination'] }}</p>
                        <p class="card-text">Check in: {{ $reservation_data['check_in'] }}</p>
                        <p class="card-text">Check out: {{ $reservation_data['check_out'] }}</p>
                        <p class="card-text">Room Type: {{ $reservation_data['selected_type'] }}</p>
                        <p class="card-text">Number of Rooms: {{ $reservation_data['rooms'] }}</p>
                        <p class="card-text">Rate: ${{ $reservation_data['selected_rate'] }} CAD/night</p>
                        <p class="card-text">Subtotal: ${{ $reservation_data['selected_rate'] * $reservation_data['rooms'] * $number_of_days }} CAD</p>
                        <p class="card-text" style="font-weight:600;">Total: ${{ $reservation_data['selected_rate'] * $reservation_data['rooms'] *$number_of_days * 1.15 }} CAD</p>
                    </div>
                    

                </div>
            </div>
        </div>
        <!-- Personal Information Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Personal Information</h5>
                    <form action="{{route('submit_reservation')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary sub_btn">Submit Reservation</button>
                        <span class="err_msg"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    const first = document.querySelector("#first_name");
    const last = document.querySelector("#last_name");
    const phone = document.querySelector("#phone");
    const sub_btn = document.querySelector(".sub_btn");
    const err_msg = document.querySelector(".err_msg");

    const regex = /^[a-zA-Z\s]+$/;
    const regex_phone = /^(\d{10}|(\d{3}){3})$/;

    first.addEventListener('click',()=>{
        err_msg.style.display = "none";
    });

    last.addEventListener('click',()=>{
        err_msg.style.display = "none";
    });

    phone.addEventListener('click',()=>{
        err_msg.style.display = "none";
    });

    sub_btn.addEventListener('click', e => {

        if (!regex.test(first.value) || !regex.test(last.value)) {

            e.preventDefault();
            err_msg.innerHTML="Please enter valid name!";
            err_msg.style.display = "inline";

            }

            if (!regex_phone.test(phone.value)) {

                e.preventDefault();
                err_msg.innerHTML="Please enter valid phone number!";
                err_msg.style.display = "inline";
            }

    });

    



</script>


@endsection