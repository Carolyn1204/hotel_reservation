<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class myReservationController extends Controller
{
    public function my_reservation()
    {
        $email = session('user_email');
        $my_reservations = DB::table('reservations')->where('email', $email)->get();

       return view('my_reservation', ['my_reservations' => $my_reservations]);
    }
}
