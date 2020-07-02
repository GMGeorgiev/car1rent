<?php

namespace App\Http\Controllers;

use App\Cities;
use App\BaseHelper;
use App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use App\SvgIcons;
use DateTime;
use DateTimeZone;
use Response;
use Redirect;
use Illuminate\Http\Request;
use Crypt;
use App\Countries;
use App\CountryTranslation;
use App\AppLanguage;
use App\BookingHelper;
use PDF;
use App\Offices;
use Illuminate\Support\Facades\Auth;
use App\EventHelper;

class BookingController extends Controller
{
    protected $language = null;

    public function __construct()
    {
        if(Session::get('locale')){
            $this->language = Session::get('locale');
        }else{
            $this->language = App::getLocale();
        }

    }

    public function postCreateBooking(Request $request){

        $data_booking = null;

        $rules = array (
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'dob_day' => 'required',
            'dob_month' => 'required',
            'dob_year' => 'required',
            'add1' => 'required',
            'repeatEmail' => 'required|same:email',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
//            return Response::json ( array (
//
//                'errors' => $validator->getMessageBag ()->toArray ()
//            ) );
            return Redirect::back()
                ->withErrors($validator)
                ->withInput(Input::all());
        else {
            if(Session::get('RentInfo') && Input::get('payment')){
                $data_booking['rent_info'] = Crypt::decrypt(Session::get('RentInfo'));
                $data_booking['customer_data'] = [];
                $cities = Cities::all();
                $data_booking['cities'] = [];
                if($cities){
                    foreach ($cities as $citie){
                        $data_booking['cities'][$citie->id] = $citie->CityName;

                    }
                }




                $paymentType = Input::get('payment');
                $data_booking['payment_type'] = Input::get('payment');
                if(Auth::user()){
                    $data_booking['rent_info']['user_id'] = Auth::user()->id;
                }
                if(Input::get('addТаке') && Input::get('addТаке') != ''){
                    $data_booking['rent_info']['TakeAddress'] = trim(Input::get('addТаке'));
                }
                if(Input::get('retТаке') && Input::get('retТаке') != ''){
                    $data_booking['rent_info']['RetAddress'] = trim(Input::get('retТаке'));
                }

                if(Input::get('cupon_code') && Input::get('cupon_code') != ''){
                    $data_booking['rent_info']['cupon_code'] = trim(Input::get('cupon_code'));
                }

                if(Input::get('message') && Input::get('message') != ''){
                    $data_booking['rent_info']['message'] = trim(Input::get('message'));
                }

                // customer data

                if(Input::get('name') && Input::get('name') != ''){
                    $data_booking['customer_data']['name'] = trim(Input::get('name'));
                }
                if(Input::get('last_name') && Input::get('last_name') != ''){
                    $data_booking['customer_data']['last_name'] = trim(Input::get('last_name'));
                }


                if(Input::get('email') && Input::get('email') != ''){
                    $data_booking['customer_data']['email'] = trim(Input::get('email'));
                }
                if(Input::get('phone') && Input::get('phone') != ''){
                    $data_booking['customer_data']['phone'] = trim(Input::get('phone'));
                }
                if(Input::get('country') && Input::get('country') != ''){
                    $data_booking['customer_data']['country_id'] = Input::get('country');
                }

                if(Input::get('cupon_code') && Input::get('cupon_code') != ''){
                    $data_booking['customer_data']['cupon_code'] = trim(Input::get('cupon_code'));
                }

                if(Input::get('add1') && Input::get('add1') != ''){
                    $data_booking['customer_data']['customer_address'] = trim(Input::get('add1'));
                }

                if(Input::get('file') && Input::get('file') != ''){
                    $data_booking['rent_info']['file'] = Input::get('file');
                }


                $dob_date = null;
                $dob_day = null;
                $dob_month = null;
                $dob_year = null;

                if(Input::get('dob_day') && Input::get('dob_day') != ''){

                    if(Input::get('dob_day') < 10){
                        $dob_day = '0' . Input::get('dob_day');
                    }else{
                        $dob_day = Input::get('dob_day');
                    }
                }

                if(Input::get('dob_month') && Input::get('dob_month') != ''){
                    $dob_month = Input::get('dob_month');
                }

                if(Input::get('dob_year') && Input::get('dob_year') != ''){
                    $dob_year = Input::get('dob_year');
                }
                if($dob_day && $dob_month && $dob_year){
                    $dob_date = date($dob_year . '-' . $dob_month . '-' . $dob_day);
                    $data_booking['customer_data']['dob_date'] = $dob_date;
                }

                $data_booking['rent_info']['booking_status'] = 1;

            }else{
                return Redirect::back()
                    ->withInput(Input::all());
            }
            $bookingTypes = BaseHelper::getPaymentTypes();
            $data_booking['bookingTypes'] = [];
            foreach ($bookingTypes as $k_b=>$v_b){
                $data_booking['bookingTypes'][$v_b->id] = $v_b;
            }

            $bookingExtras = BaseHelper::getRentExtras();
            $data_booking['bookingExtras'] = [];
            foreach ($bookingExtras as $k_e=>$v_e){
                $data_booking['bookingExtras'][$v_e->id] = $v_e;
            }

            $bookingInsurance = BaseHelper::getInsurance();
            $data_booking['bookingInsurance'] = [];
            foreach ($bookingInsurance as $k_i=>$v_i){
                $data_booking['bookingInsurance'][$v_i->id] = $v_i;
            }

            $paymentStatuses = BaseHelper::getPaymentStatuses();
            $data_booking['paymentStatuses'] = [];
            foreach ($paymentStatuses as $k_i=>$v_i){
                $data_booking['paymentStatuses'][$v_i->id] = $v_i;
            }
            $offices = Offices::where('isActive', 1)->get();
            if($offices){
                foreach ($offices as $k_0=>$v_0){
                    $data_booking['offices'][$v_0->id] = $v_0;
                }
            }else{
                $data_booking['offices'] = null;
            }

            $countries = BaseHelper::getCountries();
            if($countries){
                $data_booking['countries'] = $countries;
            }
            else{
                $data_booking['countries'] = null;
            }


            if($paymentType == 1){
                $data_booking['rent_info']['payment_status'] = 3;
                $booking = BookingHelper::bookingAdd($data_booking);
                EventHelper::eventAdd($data_booking);
                $data_booking['bookingDate'] = $booking->created_at->format('d-m-Y');
                $data_booking['booking'] = $booking;

            }elseif($paymentType == 2){
                $data_booking['rent_info']['payment_status'] = 3;

            }elseif($paymentType == 3){

            }else{
                return Redirect::back()
                    ->withInput(Input::all());
            }
//            if($data_booking){
//                $data = [
//                    'data' => $data_booking
//                ];
//
//                $pdf = PDF::loadView('pdf.customer-confirm-rent-mail', $data);
//            return $pdf->download('RentCar.pdf');
//                pr($pdf); exit();
//
//            }
           // return view('pdf.customer-confirm-rent-mail')->withData($data_booking);
            $sendMail = BookingHelper::bookingSendCustomerMail($data_booking);


            return view('booking.finish-booking')->withData ( $data_booking );
        }


    }
}
