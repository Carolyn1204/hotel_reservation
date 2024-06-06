<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class CustomerController extends Controller
{
    use ValidatesRequests;
    public function index(){

        $apiKey = '441544ecec35045ae20f381dc43bbac6';
        $city = 'montreal';
        $client = new Client();
        $url = 'http://api.openweathermap.org/data/2.5/weather?q=' .$city. '&appid=' . $apiKey . '&units=metric';

        try {
            
            $response = $client->get($url);

            $data = $response->getBody()->getContents();

            $weatherData = json_decode($data, true);
        

        } catch (RequestException $e) {
            // Handle errors
            if ($e->hasResponse()) {
                
                $errorBody = $e->getResponse()->getBody()->getContents();
                echo "Error: " . $errorBody;
            } else {
                echo "Error: " . $e->getMessage();
            }
        }

        return view('index', ['weatherData' => $weatherData]);
     
    }

    public function registration(Request $request){
        $this-> validate($request,[
            'uname' => 'required|min:6|max:12',
            'email'=> 'required|email',
            'password'=> 'required|min:6|max:20',
            'confirm_password'=> 'required',
        ]);

        $cus = new customer;
        $cus->username = strip_tags($request->uname);
        $cus->email = strip_tags($request->email);
        $hashedPassword = strip_tags($request->password);
        $cus->password = Hash::make($hashedPassword);
        $cus->save();
        echo '<script>alert("Sign Up Successfully!");</script>';
        echo ("<script> window.location = 'http://localhost/assignments/hotel_reservation/public/index';</script>");
    }

    public function login(Request $request){
        $this-> validate($request,[
            'login_email'=> 'required',
            'login_password'=> 'required|min:6|max:20',
        ]);

        $email = strip_tags($request->input('login_email')); 
        $password = strip_tags($request->input('login_password')); 

        $customer= customer::where('email', $email)->first();

        if (!$email || !$password || !$customer) {
            echo '<script>alert("Email or password is not correct!");</script>';
            echo ("<script> window.location = 'http://localhost/assignments/hotel_reservation/public/index';</script>");
        }

        if (Hash::check($password, $customer->password)) {

            $username = DB::table('customers')->where('email', $email)->value('username');

            session(['user_name' => $username]);
            session(['user_email' => $email]);
            
            echo '<script>alert("Login Successfully!");</script>';
            echo ("<script> window.location = 'http://localhost/assignments/hotel_reservation/public/index';</script>");
            

        } else {
            
            echo '<script>alert("Email or password is not correct!");</script>';
            echo ("<script> window.location = 'http://localhost/assignments/hotel_reservation/public/index';</script>");
        }
  
    }


    public function logout(Request $request){

        $request->session()->flush();
        return response()->json(['message' => 'Logged out successfully']);

    }
}
