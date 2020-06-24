<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use DateTime;
use DateTimeZone;
use Response;
use Redirect;
use App\BaseHelper;
use DB;

class HomeController extends BaseRentController
{
    protected $countries = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['activeBookings'] = App\Booking::query()->where('status',1)->where('user_id', Auth::user()->id)->get()->count();
        $data['unpaidBookings'] = DB::table('BookingAdditions')
                                    ->join('Booking', 'BookingAdditions.bookingID', '=' , 'Booking.id')
                                    ->where('Booking.user_id',Auth::user()->id)
                                    ->where('BookingAdditions.payment_status',3)
                                    ->get()
                                    ->count();
        $data['allBookings'] = App\Booking::query()->where('isActive', 1)->where('user_id', Auth::user()->id)->get()->count();
        return view('users.user-home')
                ->with('data',$data);
    }

    public function getCustomerData()
    {
        $data = [];
        $language = App::getLocale();


        $days = [];
        $months = months_translate($language);
        $years = [];

        for ($i = 1; $i <= 31; $i++) {
            $days[$i] = $i;
        }

        $date = (int)date('Y');
        $numYears = 100;
        for ($y = $date; $y >= $date - $numYears; $y--) {
            $years[$y] = $y;
        }

        $this->countries =
        $data['countries'] = BaseHelper::getCountries();
        $data['days'] = $days;
        $data['months'] = $months;
        $data['years'] = $years;
        $user = Auth::id();



        return view('users.user-profile')->with('data', $data);;
    }


}
