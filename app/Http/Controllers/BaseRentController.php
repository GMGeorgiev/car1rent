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


class BaseRentController extends Controller
{
    protected $fleet_types = [];
    protected $cities = [];
    protected $models = [];
    protected $cars = [];
    protected $insurance = [];
    protected $language = null;
    protected $countries = null;
    protected $svgIcons = [];
    protected $filters = [];
    private $rentInfo = [];
    private $paymentTypes = [];
    private $mycompany = [];

    public function __construct()
    {
        if(Session::get('locale')){
            $this->language = Session::get('locale');
        }else{
            $this->language = App::getLocale();


        }
        $now = new DateTime('now', new DateTimeZone('Europe/Sofia'));
        $this->filters['DateNow'] = $now->format("Y-m-d H:i:s");

        $svgIcons = SvgIcons::getSvgIcons();
        $this->svgIcons = $svgIcons;


    }
    public function goHome()
    {

        $this->cities = BaseHelper::getCities();

        $this->fleet_types = BaseHelper::getFleets();


        $data = array('cities' => $this->cities,
            'fleet_types' => $this->fleet_types
        );

        return view('welcome')->withData ( $data );
    }

    public function getSearchCars(Request $request)
    {

        $validator = Validator::make(Input::all(),[
//            'fleet' => 'required|not_in:0',
//            'city_from' => 'required|not_in:0',
//            'city_to' => 'required|not_in:0',
//            'city_to' => 'required|not_in:0',

        ]);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }else{

            $this->cities = BaseHelper::getCities();
            $this->fleet_types = BaseHelper::getFleets();
            $this->models = BaseHelper::getModels();

            if(Input::get('city_from') && Input::get('city_from') != 0){
                $this->filters['search_data']['cityFrom'] = Input::get('city_from');
                $this->filters['search_data']['cityIds'][] = Input::get('city_from');
            }else{
                foreach ($this->cities as $k => $city){
                    $this->filters['search_data']['cityIds'][$k] = $city->id;
                }
            }

            if(Input::get('city_to') && Input::get('city_to') != 0){
                $this->filters['search_data']['cityTo'] = Input::get('city_to');
            }

            if(Input::get('date_from') && Input::get('date_from') != 0){
                $this->filters['search_data']['dateFrom'] = Input::get('date_from');
            }
            if(Input::get('date_to') && Input::get('date_to') != 0){
                $this->filters['search_data']['dateTo'] = Input::get('date_to');
            }

            if(Input::get('time_from') && Input::get('time_from') != 0){
                $this->filters['search_data']['timeFrom'] = Input::get('time_from');
            }
            if(Input::get('time_to') && Input::get('time_to') != 0){
                $this->filters['search_data']['timeTo'] = Input::get('time_to');
            }

            if(Input::get('fleet') && Input::get('fleet') != 0){
                $this->filters['search_data']['fleet'] = Input::get('fleet');
                $this->filters['search_data']['fleetTypesIds'][] = Input::get('city_from');
            }else{
                foreach ($this->fleet_types as $k => $fleet_type){
                    $this->filters['search_data']['fleetTypesIds'][$k] = $fleet_type->id;
                }
            }





            $this->cars = BaseHelper::getCars(null, null, $this->filters);



            $data = array('cities' => $this->cities,
                'fleet_types' => $this->fleet_types,
                'models' => $this->models,
                'cars' => $this->cars,
                'svgIcons' => $this->svgIcons,
                'filters' => $this->filters['search_data']
            );


            return view('cars')->withData ( $data );

            // self::getCarsBase($request);
        }

    }

    public function getCarsBase(Request $request)
    {

//        if($filters){
//             $now = new DateTime('now', new DateTimeZone('Europe/Sofia'));
//             $filters['DateNow'] = $now->format("Y-m-d H:i:s");
//
//        }else{
//            $filters = [];
//             $now = new DateTime('now', new DateTimeZone('Europe/Sofia'));
//            $filters['DateNow'] = $now->format("Y-m-d H:i:s");
//        }


        $this->cities = BaseHelper::getCities();

        $this->fleet_types = BaseHelper::getFleets();
        $this->models = BaseHelper::getModels();
        $this->cars = BaseHelper::getCars(null, null, $this->filters);

        $data = array('cities' => $this->cities,
            'fleet_types' => $this->fleet_types,
            'models' => $this->models,
            'cars' => $this->cars,
            'svgIcons' => $this->svgIcons
        );


        return view('cars')->withData ( $data );
    }

    public function getBooking(Request $request)
    {
        $error = null;

        $language = App::getLocale();

        Session::forget('RentInfo');
        $car_info = null;
        $total = 0.00;
        $insurance_defaults = [];
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


        $this->cities = BaseHelper::getCities();
        $this->countries = BaseHelper::getCountries();
        $this->fleet_types = BaseHelper::getFleets();
        $this->models = BaseHelper::getModels();
        $insurance_data = BaseHelper::getInsurance();
        $this->paymentTypes = BaseHelper::getPaymentTypes();
        $this->mycompany = BaseHelper::getMyCompany();
        if($insurance_data){
            foreach ($insurance_data as $k=>$v) {
                if($v->insuranceDescription && $v->insuranceDescription != ''){
                    $explodet = explode(';',$v->insuranceDescription);
                    foreach($explodet as $k_e=>$v_e){
                        $explodet[$k_e] = trim($v_e);
                    }
                    $insurance_data[$k]->descriptions = $explodet;

                }
                if($v->isDefault == 1){
                    $insurance_defaults[] = $v;
                }

            }

        }
        $this->insurance = $insurance_data;


        if(Input::get('cityFrom') && Input::get('cityFrom') != 0){
            $this->filters['search_data']['cityFrom'] = Input::get('cityFrom');
            $this->filters['search_data']['cityIds'][] = Input::get('cityFrom');
            $ofice_from = BaseHelper::getCityOffices(Input::get('cityFrom'));
            $this->filters['search_data']['officesFrom'] = $ofice_from;
        }else{
            foreach ($this->cities as $k => $city){
                $this->filters['search_data']['cityIds'][$k] = $city->id;
            }
        }

        if(Input::get('cityTo') && Input::get('cityTo') != 0){
            $this->filters['search_data']['cityTo'] = Input::get('cityTo');

            $ofice_to = BaseHelper::getCityOffices(Input::get('cityTo'));
            $this->filters['search_data']['officesTo'] = $ofice_to;
        }

        if(Input::get('dateFrom') && Input::get('dateFrom') != 0){
            $this->filters['search_data']['dateFrom'] = Input::get('dateFrom');
        }
        if(Input::get('dateTo') && Input::get('dateTo') != 0){
            $this->filters['search_data']['dateTo'] = Input::get('dateTo');
        }

        if(Input::get('timeFrom') && Input::get('timeFrom') != 0){
            $this->filters['search_data']['timeFrom'] = Input::get('timeFrom');
            $this->filters['search_data']['over_time_take'] = 0;
        }
        if(Input::get('timeTo') && Input::get('timeTo') != 0){
            $this->filters['search_data']['timeTo'] = Input::get('timeTo');
            $this->filters['search_data']['over_time_return'] = 0;
        }



        $validator = Validator::make(Input::all(),[
            'dateFrom' => 'required|date_format:d-m-Y',
            'dateTo' => 'required|date_format:d-m-Y|after:dateFrom' ,
            'timeFrom' => 'required|date_format:H:i',
            'timeTo' => 'required|date_format:H:i',
            'cityFrom' => ['required', 'numeric'],
            'cityTo' => ['required', 'numeric'],
            'officeID' => ['required', 'numeric'],
            'modelID' => ['required', 'numeric'],
            'gear' => ['required', 'numeric'],

        ]);
        if ($validator->fails()){
            $data = array(
                'errors' => $validator->getMessageBag()->toArray(),
                'cities' => $this->cities,
                'fleet_types' => $this->fleet_types,
                'models' => $this->models,
                'filters' => $this->filters['search_data']
            );

            return view('cars')->withData ( $data );
        }else{



            foreach ($this->cities as $k => $city){
                $this->filters['search_data']['citys_name'][$city->id] = $city->CityName;
            }
            $rent_extras = BaseHelper::getRentExtras();

            $data = array(
                'rent_extras' => $rent_extras,
                'insurance' => $this->insurance,
                'search_data' => $this->filters['search_data'],
                'modelID' => Input::get('modelID'),
                'dateFrom' => Input::get('dateFrom'),
                'dateTo' => Input::get('dateTo'),
                'timeFrom' => Input::get('timeFrom'),
                'timeTo' => Input::get('timeTo'),
                'cityFrom' => Input::get('cityFrom'),
                'cityTo' => Input::get('cityTo'),
                'officeID' => Input::get('officeID'),
                'gear' => Input::get('gear')
            );


            $car_data = BaseHelper::getCarInfo($data);


            if($car_data){
                $total = 0.00;
                $car_info = $car_data;
                $selected_insurance = [];
                if(isset($car_info[0]->discountPrice)){
                    $total = number_format((float)$car_info[0]->discountPrice, 2, '.', '');
                }else{
                    $total = number_format((float)$car_info[0]->NormalPrice, 2, '.', '');
                }
                if(count($insurance_defaults) > 0){
                    foreach($insurance_defaults as $k_i =>$values){
                        $price_ins = number_format((float)$values->insurancePrice, 2, '.', '');
                        $total = number_format($total + $price_ins, 2);
                        $selected_insurance[$values->id] = $price_ins;
                    }
                }
                $carRentInfo= [
                    'rent_form' => [
                        'Total' => $total,
                        'selected_extras' => array(),
                        'insurance' => $selected_insurance
                    ],
                    'search_info' => $data
                ];
                $data['car_info'] = $car_info;
                $data['total'] = $total;
                $data['insurance_default'] = $this->insurance;
                $data['countries'] = $this->countries;
                $data['days'] = $days;
                $data['months'] = $months;
                $data['years'] = $years;
                $data['paymentsTypes'] = $this->paymentTypes;
                $data['myCompany'] = $this->mycompany;
                $carRentInfo['car_info'] = $car_info;


            }

        }

        Session::put('RentInfo', Crypt::encrypt($carRentInfo));


        return view('booking.booking')->withData ( $data, $error );
    }
    public function postGetAjaxExtras(Request $request)
    {
        $rent_extras = BaseHelper::getRentExtras();

        if($rent_extras && count($rent_extras) > 0){
            $result = [];
            if(Session::get('RentInfo')){
                $result['rent_info'] = Crypt::decrypt(Session::get('RentInfo'));
            }

            foreach($rent_extras as $k=>$extra){
                $result['extras'][$extra->id] = $extra;
            }

            return Response::json ( array (

                'success' => $result
            ) );
        }else{
            return Response::json ( array (

                'error' => $rent_extras
            ) );
        }

    }

    public function postPutExtrasToForm(Request $request)
    {

        $result = null;
        $tempForm = [];
        if(Session::get('RentInfo')){
            $result = Crypt::decrypt(Session::get('RentInfo'));
        }
        if($result){

            $tempForm = $result['rent_form'];
            if (Input::get('extra_id') && Input::get('extra_id') != 0) {
                $id = Input::get('extra_id');
                $total = (double)$tempForm['Total'];
                if (Input::get('checked') && Input::get('checked') == 1) {
                    if(Input::get('select_count') && Input::get('select_count') == 1){
                        $curent = (int)$tempForm['selected_extras'][$id]['count'];
                        $curent_price = (double)$tempForm['selected_extras'][$id]['price'];
                        $total = number_format($total - ($curent * $curent_price), 2);


                    }
                    $tempForm['selected_extras'][$id] = ['count'=> Input::get('value_count'),  'price'=> Input::get('value_price')];
                    $totalAll = ((double)Input::get('value_count') * (double)Input::get('value_price')) +  $total;
                    $tempForm['Total'] = number_format($totalAll, 2);
                }else {

                    $totalAll = $total - ((double)Input::get('value_count') * (double)Input::get('value_price'));
                    $tempForm['Total'] = number_format($totalAll, 2);
                    unset($tempForm['selected_extras'][$id]);

                }

            }

        }
        $endForm = $tempForm;
        $result['rent_form'] = $endForm;

        Session::put('RentInfo', Crypt::encrypt($result));

        return Response::json ( array (

            'success' => $endForm
        ) );




    }



    public function postEnterCoupon() {
//
        $result = null;
        $tempForm = [];
        if(Session::get('RentInfo')){
            $result = Crypt::decrypt(Session::get('RentInfo'));
        }

        if($result && !isset($result['rent_form']['coupon'])){

            $tempForm = $result['rent_form'];
            if (Input::get('coupon') && Input::get('coupon') != '') {
                $coupon = Input::get('coupon');
                $checkedCoupon = BaseHelper::getCheckCoupon($coupon);

                $total = (double)$tempForm['Total'];
                if ($checkedCoupon) {
                    $price_coupon = (double)$checkedCoupon->couponPrice;
                    if($checkedCoupon->percent == 1){
                        $total = BaseHelper::getDiscountPrice($total, $price_coupon);
                    }else{
                        $total = $total - $price_coupon;
                    }
                    $tempForm['coupon'] = ['coupon'=> $coupon, 'percent' => $checkedCoupon->percent, 'value' => $price_coupon, 'id' => $checkedCoupon->id,];
                    $tempForm['Total'] = number_format($total, 2);

                }else{
                    return Response::json ( array (

                        'error' => $checkedCoupon
                    ) );
                }

            }
            $endForm = $tempForm;
            $result['rent_form'] = $endForm;

            Session::put('RentInfo', Crypt::encrypt($result));

        }else{
            $endForm =  $tempForm;
        }


        return Response::json ( array (

            'success' => $endForm
        ) );


    }

    public function postGetAjaxInsurance(Request $request)
    {
        $rent_insurance = BaseHelper::getInsurance();

        if($rent_insurance && count($rent_insurance) > 0){
            $result = [];
            if(Session::get('RentInfo')){
                $result['rent_info'] = Crypt::decrypt(Session::get('RentInfo'));
            }

            foreach($rent_insurance as $k=>$insurance){
                $result['insurance'][$insurance->id] = $insurance;
            }

            return Response::json ( array (

                'success' => $result
            ) );
        }else{
            return Response::json ( array (

                'error' => $rent_insurance
            ) );
        }

    }

    public function postPutInsuranceToForm(Request $request)
    {

        $result = null;
        $tempForm = [];
        if(Session::get('RentInfo')){
            $result = Crypt::decrypt(Session::get('RentInfo'));
        }
        if($result){

            $tempForm = $result['rent_form'];
            if (Input::get('extra_id') && Input::get('extra_id') != 0) {
                $id = Input::get('extra_id');
                $total = (double)$tempForm['Total'];
                if (Input::get('checked') && Input::get('checked') == 1) {
//                    if(Input::get('select_count') && Input::get('select_count') == 1){
//                        $curent = (int)$tempForm['selected_extras'][$id]['count'];
//                        $curent_price = (double)$tempForm['selected_extras'][$id]['price'];
//                        $total = $total - ($curent * $curent_price);
//
//                    }
                    $tempForm['insurance'][$id] = ['price'=> Input::get('value_price')];
                    $totalAll = (double)Input::get('value_price') +  $total;
                    $tempForm['Total'] = number_format($totalAll, 2);;
                }else {

                    $totalAll = $total - (double)Input::get('value_price');
                    $tempForm['Total'] = number_format($totalAll, 2);
                    unset($tempForm['insurance'][$id]);

                }

            }

        }
        $endForm = $tempForm;
        $result['rent_form'] = $endForm;

        Session::put('RentInfo', Crypt::encrypt($result));

        return Response::json ( array (

            'success' => $endForm
        ) );

    }
    public function getConditions(Request $request){

        return view('terms');

    }


}
