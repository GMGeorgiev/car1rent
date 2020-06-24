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
use App\Booking;
use File;
use Mail;
use Swift_Attachment;
use PDF;


class BookingHelper extends Model
{
    public static function bookingAdd($data){
        if(isset($data['customer_data']) && isset($data['rent_info'])){
            DB::beginTransaction();
            $booking = new Booking();

            if(isset($data['rent_info']['search_info']['dateFrom'])){
                $date_from_string = $data['rent_info']['search_info']['dateFrom'] . ' ' . $data['rent_info']['search_info']['timeFrom'];
                $date_start = date('d-m-Y H:i:s', strtotime($date_from_string));
                $date_start_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_start)->format('Y-m-d H:i:s');
                $booking->from_date = $date_start_formated;

            }else{
                $booking->from_date = date('Y-m-d H:i:s');
            }
            if(isset($data['rent_info']['search_info']['dateTo'])){
                $date_to_string = $data['rent_info']['search_info']['dateTo'] . ' ' . $data['rent_info']['search_info']['timeTo'];
                $date_end = date('d-m-Y H:i:s', strtotime($date_to_string));
                $date_end_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_end)->format('Y-m-d H:i:s');
                $booking->to_date = $date_end_formated;
            }else{
                $booking->from_date = date('Y-m-d H:i:s');
            }
            if(count($data['rent_info']['car_info'])){
                $booking->car_id = $data['rent_info']['car_info'][0]->id;
            }else{
                $booking->car_id = $data['rent_info']['car_info'];
            }

            $booking->status = $data['rent_info']['booking_status'];

            if(isset($data['rent_info']['rent_form']['Total'])){
                $booking->amount = $data['rent_info']['rent_form']['Total'];
            }else{
                $booking->amount = 0.00;
            }

            if(isset($data['rent_info']['search_info']['cityFrom'])){
                $booking->pickup_loc = $data['rent_info']['search_info']['cityFrom'];
            }

            if(isset($data['rent_info']['search_info']['cityTo'])){
                $booking->drop_loc = $data['rent_info']['search_info']['cityTo'];
            }

            if(isset($data['rent_info']['search_info']['cityTo'])){
                $booking->drop_loc = $data['rent_info']['search_info']['cityTo'];
            }

            if(isset($data['rent_info']['message'])){
                $booking->description = $data['rent_info']['message'];
            }

            if(isset($data['rent_info']['file'])){
                $booking->booking_file = $data['rent_info']['file'];
            }

            if(isset($data['rent_info']['customer_id'])){
                $booking->customer_id  = $data['rent_info']['customer_id'];
            }
            if(isset($data['rent_info']['company_id'])){
                $booking->company_id = $data['rent_info']['company_id'];
            }
            if(isset($data['rent_info']['user_id'])){
                $booking->user_id  = $data['rent_info']['user_id'];
            }

            $booking->isActive = 1;

            if(!$booking->save()){
                DB::rollback();
                return null;
            }else{
                $booking_auditions = new BookingAdditions();

                $booking_auditions->bookingID = $booking->id;
                $booking_auditions->firstName = $data['customer_data']['name'];

                if(isset($data['customer_data']['last_name'])){
                    $booking_auditions->lastName = $data['customer_data']['last_name'];
                }

                if(isset($data['customer_data']['email'])){
                    $booking_auditions->email = $data['customer_data']['email'];
                }
                if(isset($data['customer_data']['phone'])){
                    $booking_auditions->phone = $data['customer_data']['phone'];
                }
                if(isset($data['customer_data']['country_id'])){
                    $booking_auditions->countryID = $data['customer_data']['country_id'];
                }
                if(isset($data['customer_data']['customer_address'])){
                    $booking_auditions->address = $data['customer_data']['customer_address'];
                }
                if(isset($data['customer_data']['dob_date'])){
                    $booking_auditions->birth_date = $data['customer_data']['dob_date'];
                }
                if(isset($data['rent_info']['TakeAddress'])){
                    $booking_auditions->TakeAddress = $data['rent_info']['TakeAddress'];
                }
                if(isset($data['rent_info']['RetAddress'])){
                    $booking_auditions->RetAddress = $data['rent_info']['RetAddress'];
                }
                if(isset($data['rent_info']['message'])){
                    $booking_auditions->message = $data['rent_info']['message'];
                }
                if(isset($data['rent_info']['payment_status'])){
                    $booking_auditions->payment_status = $data['rent_info']['payment_status'];
                }
                if(isset($data['payment_type'])){
                    $booking_auditions->paymentType = $data['payment_type'];
                }

                if(!$booking_auditions->save()){
                    DB::rollback();
                    return null;
                }

                if(isset($data['rent_info']['rent_form']['selected_extras']) && count($data['rent_info']['rent_form']['selected_extras'])){
                    $extras = $data['rent_info']['rent_form']['selected_extras'];
                    foreach($extras as $e_id => $extra){
                        $booking_extras = new BookingExtraResults();
                        $booking_extras->BookingID = $booking->id;
                        $booking_extras->RentalExtraID = $e_id;
                        $booking_extras->count = $extra['count'];
                        $booking_extras->price = $extra['price'];
                        if(!$booking_extras->save()){
                            DB::rollback();
                            return null;
                        }
                    }

                }

                if(isset($data['rent_info']['rent_form']['insurance']) && count($data['rent_info']['rent_form']['insurance'])){
                    $insurances = $data['rent_info']['rent_form']['insurance'];
                    foreach($insurances as $i_id => $insurance){
                        $booking_insurance = new BookingInsuranceResults();
                        $booking_insurance->BookingID = $booking->id;
                        $booking_insurance->InsuranceID = $i_id;
                        if(!$booking_insurance->save()){
                            DB::rollback();
                            return null;
                        }
                    }
                }

                if(isset($data['rent_info']['rent_form']['coupon']) && count($data['rent_info']['rent_form']['coupon'])){
                    $coupon = $data['rent_info']['rent_form']['coupon']['id'];
                        $booking_coupon = new CouponResults();
                        $booking_coupon->BookingID = $booking->id;
                        $booking_coupon->couponID = $coupon;
                        if(!$booking_coupon->save()){
                            DB::rollback();
                            return null;
                        }

                }
            }

            DB::commit();
            return $booking;
        }
        return null;

    }
    public static function bookingSendCustomerMail($data){
       // $date_now = date('d-m-Y');
//        $destinationPath = public_path() . "/temp/pdf/";
//        if (!File::exists($destinationPath)) {
//            File::makeDirectory($destinationPath, 0775, true);
//        }
        $destinationPath = null;

        if($data){
            $customerMail = null;
            $filename = trim(preg_replace('/\s+/', '', 'RentCar-' . $data['booking']->id . '-' . $data['bookingDate']));
            $destinationPath = storage_path('temp/pdf/' . $filename . '.pdf');

            if(isset($data['customer_data']['email'])){
                $customerMail = trim($data['customer_data']['email']);
            }

            $data = [
                'data' => $data
            ];

            $pdf = PDF::loadView('pdf.customer-confirm-rent-mail', $data);
            if ($pdf->save($destinationPath)){
                $to = $customerMail;
                $subject = 'Car1bg - Rent a Car';
                $mailResult = Mail::send('emails.customer-confirm-mail', $data, function ($mailMessage) use ($to,  $subject, $destinationPath ) {
                    $mailMessage->to($to)
                        ->subject($subject)
                        ->attach($destinationPath);

                });

            }


//            $destinationPath = public_path() . "/temp/pdf/";
//            $pdf->move(url() . '/public/images/', $imageName);
//
//            pr($pdf); exit();
            return true;

        }

    }


}
