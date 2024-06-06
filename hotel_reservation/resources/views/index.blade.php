@extends('layouts.main')
@section('content')



<div style="position: relative;">
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: rgb(59 113 202);">Welcome to Vienna Hotel</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('search')}}" method="POST">
                        @csrf
                            
                            <div class="form-group mb-3">
                                <label for="destination" class="mb-2">Destination</label>
                                <select class="form-control" id="destination" name="destination">
                                    <option value="Montreal">Montreal</option>
                                    <option value="Toronto">Toronto</option>
                                    <option value="Toronto">Vancouver</option>
                                    <option value="Ottawa">Ottawa</option>
                                    <option value="Calgray">Calgray</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="rooms" class="mb-2">Rooms</label>
                                <input type="number" class="form-control" id="rooms" min="1" placeholder="1" value="1" name="rooms">
                            </div>
                            <div class="form-group mb-3">
                                <label for="guests" class="mb-2">Guests (Maximun:6/Room)</label>
                                <input type="number" class="form-control" id="guests" min="1" max="6" placeholder="1" value="1" name="guests">
                            </div>
                            <div class="form-group mb-3">
                                <label for="check_in" class="mb-2">Check-in Date</label>
                                <input type="date" class="form-control" id="check_in" name="check_in" required >
                            </div>
                            <div class="form-group mb-5">
                                <label for="check_out" class="mb-2">Check-out Date</label>
                                <input type="date" class="form-control" id="check_out" name="check_out" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="search_btn">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 350px; position:absolute; top:0px; right:250px; font-size:18px; font-weight:550; background-color: rgb(204 231 237);">
        <div class="row g-0" style="--mdb-card-spacer-y: 0rem; line-height:50px; " >
            <div class="col-md-4" style="width:50px;">
            <img
                src="http://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}.png"
                alt="Vienna hotel weather broadcasting"
                class="img-fluid rounded-start"
            />
            </div>
            <div class="col-md-8">
            <div class="card-body" style="width:300px;">
                
                <p class="card-text">
                <small class="text-muted">{{ $weatherData['main']['temp'] }}°C&nbsp;&nbsp;&nbsp;{{ $weatherData['weather'][0]['description'] }}</small>
                </p>
            </div>
            </div>
        </div>
    </div>

</div>

<script>
    const stard = document.querySelector('#check_in');
    const endd = document.querySelector('#check_out');
    
    window.addEventListener('load',function(){

        let minStartDate = new Date().setDate(new Date().getDate());
        let minStartDateObject = new Date(minStartDate);
        

        let minStartString = minStartDateObject.toISOString().split('T')[0];
        stard.min = minStartString;
        


        let minEndtDate = new Date().setDate(new Date().getDate() + 1);
        let minEndDateObject = new Date(minEndtDate);

        let minEndString = minEndDateObject.toISOString().split('T')[0];
        endd.min = minEndString;
        

    });

    endd.addEventListener('click', function(){

      
        if(stard.value ===''){
        return;
        }

        let startDate = stard.value;

        let startDateObject = new Date(startDate);


        let minEndDate = startDateObject.setDate(startDateObject.getDate() + 1);
        let minEndDateObject = new Date(minEndDate);

        let endString = minEndDateObject.toISOString().split('T')[0];
        endd.min = endString;

    });


</script>







@endsection