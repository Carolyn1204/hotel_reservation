<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

class reservationController extends Controller
{
    use ValidatesRequests;
    public function readJsonFile()
    {
        // Path to your JSON file
        $filePath = public_path('data/hotel.json');

        // Check if the file exists
        if (file_exists($filePath)) {
            // Read the JSON file
            $jsonContent = file_get_contents($filePath);
            
            // Decode JSON to array
            $dataArray = json_decode($jsonContent, true); 

            if ($dataArray === null) {
                // JSON decoding failed
                echo "Error decoding JSON.";
            } else {
                // JSON decoding succeeded
                return $dataArray;
            }
        } else {
            // File not found
            echo "File not found.";
        }
    }

    public function search(Request $request){
        

        $destination = $request->input('destination','Montreal');
        $rooms = intval($request->input('rooms',1));
        $guests = intval($request->input('guests',1));
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');


        session(['destination' => $destination]);
        session(['rooms' => $rooms]);
        session(['guests' => $guests]);
        session(['check_in' => $check_in]);
        session(['check_out' => $check_out]);


        $occupied_room_type = DB::select("
        SELECT R.room_type 
        FROM reservations AS R 
        JOIN capacities AS C ON R.room_type = C.room_type
        WHERE R.city = ? 
        AND C.room_capacity >= ? 
        AND (
            (R.start_date BETWEEN ? AND ?) 
            OR (R.end_date BETWEEN ? AND ?)
        ) 
        GROUP BY R.room_type 
        HAVING SUM(R.room_num) > 3-$rooms
    ", [$destination, $guests, $check_in, $check_out, $check_in, $check_out]);



       $room_data = new reservationController();
       $data = $room_data -> readJsonFile();
       $all_room_type =  array_filter($data, function($key) {
        return $key == 0 || $key == 3 || $key == 6 || $key == 9;
        }, ARRAY_FILTER_USE_KEY);


        $occupied_room_types = array_map(function ($obj) {
            return $obj->room_type;
        }, $occupied_room_type);
        
        $available_room_type = array_filter($all_room_type, function ($room) use ($occupied_room_types) {
            return !in_array($room['roomType'], $occupied_room_types);
        });
        
    

         return view('search', ['all_room_type' => $available_room_type]);

    }

    public function reservation(Request $request){

        $selected_type = $request->input('type');
        $selected_rate = $request->input('rate');
        $selected_pic = $request->input('pic');

        session(['room_type' => $selected_type]);
        session(['rate' => $selected_rate]);

        $destination = session('destination');
        $rooms = session('rooms');
        $guests = session('guests');
        $check_in = session('check_in');
        $check_out = session('check_out');
        
        $reservation_data = ['destination' => $destination, 'rooms' => $rooms, 'guests' => $guests, 
        'check_in' => $check_in, 'check_out' => $check_out, 'selected_type' => $selected_type, 'selected_rate' => $selected_rate, 'selected_pic' => $selected_pic ];

        return view('reservation', ['reservation_data' => $reservation_data]);
    }

    public function submit_reservation(Request $request){


        $this->validate($request, [
            'first_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'last_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'phone' => ['required', 'regex:/^(\d{10}|(\d{3}){3})$/'],
        ]);


        $res = new reservation;
        $res->firstName = strip_tags($request->first_name);
        $res->LastName = strip_tags($request->last_name);
        $res->phone = strip_tags($request->phone);
        $res->email = session('user_email');
        $res->city = session('destination');
        $res->room_type = session('room_type');
        $res->room_num = session('rooms');
        $res->rate = session('rate');
        $res->start_date = session('check_in');
        $res->end_date = session('check_out');
        $res->save();
        echo '<script>alert("Book Successfully!");</script>';
        echo ("<script> window.location = 'http://localhost/assignments/hotel_reservation/public/my_reservation';</script>");

        


    }
}


    
