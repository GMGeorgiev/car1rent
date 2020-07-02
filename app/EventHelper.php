<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App;
use DateTime;
use DateTimeZone;
use App\Customers;
use App\Event;
use File;
use Mail;
use Swift_Attachment;
use PDF;
use App\Cars;
use App\CarModels;


class EventHelper extends Model
{
    public static function eventAdd($data){
        if(isset($data['customer_data']) && isset($data['rent_info'])){
            DB::beginTransaction();
            $event = new Event();

            if(isset($data['rent_info']['search_info']['dateFrom'])){
                $date_from_string = $data['rent_info']['search_info']['dateFrom'] . ' ' . $data['rent_info']['search_info']['timeFrom'];
                $date_start = date('d-m-Y H:i:s', strtotime($date_from_string));
                $date_start_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_start)->format('Y-m-d H:i:s');
                $event->start_date = $date_start_formated;

            }else{
                $event->from_date = date('Y-m-d H:i:s');
            }
            if(count($data['rent_info']['car_info'])){
                $car = Cars::where('id', $data['rent_info']['car_info'][0]->id)->first();
                $model = CarModels::where('id', $car->ModelID)->first();
                $event->title = $model->ModelName . ' ' . $car->RegNumber;
            }
            if(isset($data['rent_info']['search_info']['dateTo'])){
                $date_to_string = $data['rent_info']['search_info']['dateTo'] . ' ' . $data['rent_info']['search_info']['timeTo'];
                $date_end = date('d-m-Y H:i:s', strtotime($date_to_string));
                $date_end_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_end)->format('Y-m-d H:i:s');
                $event->end_date = $date_end_formated;
            }else{
                $event->from_date = date('Y-m-d H:i:s');
            }

            if(isset($data['rent_info']['customer_id'])){
                $event->customer_id  = $data['rent_info']['customer_id'];
            }
            if(isset($data['rent_info']['company_id'])){
                $event->company_id = $data['rent_info']['company_id'];
            }

            if(!$event->save()){
                DB::rollback();
                return null;
            }
            }

            DB::commit();
            return $event;
        }
    }