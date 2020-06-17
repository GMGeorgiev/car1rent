<?php

namespace App\Http\Controllers;

use App\AppLanguage;
use App\BaseHelper;
use App\Cities;
use App\Countries;
use App\Coupons;
use App\PriceRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Response;
use App\User;
use Session;
use App\Admin;
use App\Makers;


class AdminController extends Controller
{
//


    public function index()
    {
        return view('admin.home');
    }

    public function getDachboard()
    {
        return view('admin.dashboard');
    }




    public function getExtras()
    {
        return view('admin.extras');
    }


    public function getMakers()
    {
        $data = Admin::getMakers ();
        return view('admin.makers')->withData ( $data );;
    }

    public function postAddMakers(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newMaker = Admin::createMakers($request);

            return response ()->json ( $newMaker );
        }
    }

    public function postEditMakers(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $editMaker = Admin::editMakers($request);

            return response ()->json ( $editMaker );
        }
    }

    public function postDeleteMakers(Request $request)
    {

            $editMaker = Admin::deleteMakers($request);

            return response ()->json ( );

    }

    public function getUsers()
    {
        $all_users = null;
        if(Session::get('Users')){
            $all_users = true;
        }

        $users = Admin::getUsers($all_users);
        $userTypes = Admin::getUserTypes();

        $data=[ 'users' => $users,
            'userTypes' => $userTypes,
            'allUsers' => $all_users
        ];

        return View('admin.users')->with('data', $data);

    }


    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {

        $validator = Validator::make(Input::all(),[
            'name' => ['required', 'string', 'max:255'],
            'username' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }else{
            return User::create([
                'name' => Input::get('name'),
                'username' =>  Input::get('username'),
                'email' =>  Input::get('email'),
                'password' => Hash::make( Input::get('password')),
                'role' =>  Input::get('role'),

            ]);
        }


    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveUsers(Request $request)
    {

        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('Users', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('Users');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
 * Store a newly created user in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function getInactiveModels(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllModels', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllModels');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveCityTransfers(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllCityTransfers', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllCityTransfers');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveRentExtras(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllRentExtras', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllRentExtras');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveCoupes(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllCoupes', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllCoupes');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveFleet(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllFleet', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllFleet');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveFuels(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllFuels', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllFuels');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveCoupons(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllCoupons', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllCoupons');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveCars(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllCars', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllCars');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveCarExtras(Request $request)
    {


        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllCarExtras', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllCarExtras');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }



    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveCities(Request $request)
    {

        $all_check = $request->checked;

        if ($all_check == 1) {
            Session::put('AllCities', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllCities');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }

    }
    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveCountries(Request $request)
    {
        $all_check = $request->checked;
        if ($all_check == 1) {
            Session::put('AllCountries', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllCountries');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactivePriceRules(Request $request)
    {
        $all_check = $request->checked;
        if ($all_check == 1) {
            Session::put('AllPriceRules', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllPriceRules');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactiveInsurance(Request $request)
    {
        $all_check = $request->checked;
        if ($all_check == 1) {
            Session::put('AllInsurance', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllInsurance');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInactivePrices(Request $request)
    {
        $all_check = $request->checked;
        if ($all_check == 1) {
            Session::put('AllPrices', 1);

            return ['all' => $request->checked,  'all_sesions' => Session::all()];
        } else {

            Session::forget('AllPrices');

            return ['all' => $request->checked, 'all_sesions' => Session::all()];
        }
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        //
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request)
    {
        $data = [];
        $rules = array();
        $data_user = null;
        if(!User::find(Input::get('user-id'))){
            return Response::json(array(
                'fail' => true
            ));
        }else{
            $data_user = User::find(Input::get('user-id'));
            $rules['name'] = ['required', 'string', 'max:255'];
            $rules['username'] = 'required|string|max:255';
            $data['name'] = trim(Input::get('name'));
            $data['username'] = trim(Input::get('name'));

        }

        if(Input::get('email')){
            if($data_user->email != trim(Input::get('email'))){
                $data['email'] = Input::get('email');
                $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            }

        }
        if(Input::get('password') && Input::get('password') != ''){
            $data['password'] = Input::get('password');
            $data['password_confirmation'] = Input::get('password_confirmation');
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }


        $validator = Validator::make($data,$rules);

        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }else{

            $data_user->name = trim(Input::get('name'));
            $data_user->username = trim(Input::get('username'));
            $data_user->role = trim(Input::get('role'));
            $data_user->isActive = trim(Input::get('status'));
            if(Input::get('email')){
                if($data_user->email != trim(Input::get('email'))){
                    $data_user->email = trim(Input::get('email'));
                }

            }
            if(Input::get('password') && Input::get('password') != ''){
                $data_user->password = Hash::make(Input::get('password'));
            }
            $data_user->save();


            return $data_user;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUsers(Request $request)
    {
        if(!User::find(Input::get('user-id'))){

            return Response::json(array(
                'fail' => true,
                'errors' => ['error-delete-message'=>'user not find']
            ));

        }else{

            $data_user_delete = User::find(Input::get('user-id'));
            if($data_user_delete->isActive == 0){
                return Response::json(array(
                    'fail' => true,
                    'errors' => ['error-delete-message'=>'User has been deleted before']
                ));
            }else{
                $data_user_delete->isActive = 0;
                if($data_user_delete->save()){
                    return Response::json(array(
                        'success' => true
                    ));
                }else{
                    return Response::json(array(
                        'fail' => true,
                        'errors' => ['error-delete-message'=>'user not deleted']
                    ));
                }

            }
        }
    }

    // cars
    public function posGetCars(Request $request)
    {
        $filters= null;
//        $filters_data = null;

        $all_cars = null;
        if(Session::get('AllCars')){
            $all_cars = true;
        }

//        if(Input::get ('filter_sipp_1')  && Input::get ('filter_sipp_1') != -1 && Input::get ('filter_sipp_2') && Input::get ('filter_sipp_2') != -1 && Input::get ('filter_sipp_3') && Input::get ('filter_sipp_3') != -1 && Input::get ('filter_sipp_4') && Input::get ('filter_sipp_4') != -1){
//            $filters['filter_sipp'] = Input::get ('filter_sipp_1') . Input::get ('filter_sipp_2') . Input::get ('filter_sipp_3') . Input::get ('filter_sipp_4');

            if(Input::get ('filter_sipp_1') && Input::get ('filter_sipp_1')){
                $filters['filters_all_sipp'][1] = Input::get ('filter_sipp_1');
            }
            if(Input::get ('filter_sipp_2') && Input::get ('filter_sipp_2')){
                $filters['filters_all_sipp'][2] = Input::get ('filter_sipp_2');
            }
            if(Input::get ('filter_sipp_3') && Input::get ('filter_sipp_3')){
                $filters['filters_all_sipp'][3] = Input::get ('filter_sipp_3');
            }
            if(Input::get ('filter_sipp_4') && Input::get ('filter_sipp_4')){
                $filters['filters_all_sipp'][4] = Input::get ('filter_sipp_4');
            }
       // }





        $models = Admin::getModels();
        $makers = Admin::getMakers();
        $fuels = Admin::getFuels();
        $coupes = Admin::getCarCoupes();
        $officies = Admin::getOffices();
        $sipp_codes = Admin::getSIPPCodes();


        $cars = Admin::getCars($all_cars, null, $filters);

        $data=[ 'models' => $models,
            'makers' => $makers,
            'fuels' => $fuels,
            'coupes' => $coupes,
            'officies' => $officies,
            'sipp_codes' => $sipp_codes,
            'cars' => $cars,
            'filters' => $filters,
            'allCars' => $all_cars
        ];

        return view('admin.cars')->withData ( $data );;
    }
    public function postAddCar(Request $request)
    {
        $rules = array (
            'number' => 'required',
            'maker' => 'required|not_in:0',
            'model' => 'required|not_in:0',
            'office' => 'required|not_in:0',
            'fuel' => 'required|not_in:0',
            'coupe' => 'required|not_in:0'
        );


        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newCar = Admin::createCar($request);

           return $newCar;
        }
    }

    public function postEditCar(Request $request)
    {
        $rules = array (
            'number' => 'required',
            'maker' => 'required|not_in:0',
            'model' => 'required|not_in:0',
            'office' => 'required|not_in:0',
            'fuel' => 'required|not_in:0',
            'coupe' => 'required|not_in:0'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $editCar = Admin::editCar($request);

            return $editCar;
        }
    }

    // countries
    public function getCountries()
    {

        $all_countries = null;
        if(Session::get('AllCountries')){
            $all_countries = true;
        }

        $all_cities = null;
        if(Session::get('AllCities')){
            $all_cities = true;
        }

        $countries = Admin::getCountries ($all_countries);
        $cities = BaseHelper::getCities ($all_cities);

        $data=[ 'countries' => $countries,
            'cities' => $cities,
            'allCountries' => $all_countries,
            'allCities' => $all_cities
        ];
        return view('admin.countries')->withData ( $data );;
    }

    public function postAddCountries(Request $request)
    {
        $rules = array (
            'name' => 'required',
            'prefix' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newMaker = Admin::createCountries($request);

            return $newMaker;
        }
    }

    public function postEditCountries(Request $request)
    {
        $rules = array (
            'name' => 'required',
            'prefix' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editMaker = Admin::editCountries($request);

            return response ()->json ( $editMaker );
        }
    }

    public function postDeleteCountries(Request $request)
    {

        $editMaker = Admin::deleteCountries($request);

        return response ()->json ( );

    }

    // cities
//    public function getCities()
//    {
//        $data = Admin::getCities ();
//        return view('admin.cities')->withData ( $data );
//    }

    public function postAddCity(Request $request)
    {
        $rules = array (
            'name' => 'required',
            'country' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newMaker = Admin::createCity($request);

            return $newMaker;
        }
    }

    public function postEditCity(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editMaker = Admin::editCity($request);

            return response ()->json ( $editMaker );
        }
    }

    // offices
    public function getOffices()
    {
        $all_offices = null;
        if(Session::get('AllOffices')){
            $all_offices = true;
        }

        $countries = Admin::getCountries ();
        $cities = BaseHelper::getCities ();
        $offices = Admin::getOffices($all_offices);

        $data=[ 'countries' => $countries,
            'cities' => $cities,
            'offices' => $offices,
            'allOffices' => $all_offices
        ];


        return view('admin.offices')->withData ( $data );
    }

    public function postAddOffice(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newOffice = Admin::createOffice($request);

            return $newOffice;
        }
    }

    public function postEditOffice(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editOffice = Admin::editOffice($request);

            return response ()->json ( $editOffice );
        }
    }
    public function getModels()
    {

        $all_models = null;
        if(Session::get('AllModels')){
            $all_models = true;
        }
        $makers = Admin::getMakers ();

        $car_models = Admin::getModels($all_models);
        $car_types = BaseHelper::getFleets();

        $data=[ 'makers' => $makers,
            'models' => $car_models,
            'types' => $car_types,
            'allModels' => $all_models
        ];
        return view('admin.models')->withData ( $data );
    }

    public function posGetFleets()
    {
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }

        $all_fleets = null;
        if(Session::get('AllFleet')){
            $all_fleets = true;
        }

        $fleets = BaseHelper::getFleets ($all_fleets);

        $data=[ 'fleets' => $fleets,
            'allFleet' => $all_fleets,
            'app_languages' => $app_language
        ];

        return view('admin.fleets')->withData ( $data );;
    }
    public function postAddFleet(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newFleet = Admin::createFleet($request);

            return $newFleet;
        }
    }

    public function postEditFleet(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editOffice = Admin::editFleet($request);

            return response ()->json ( $editOffice );
        }
    }

    public function postGetTypeFleet(Request $request)
    {

            $editType = Admin::getFleetType($request);
            if($editType){
                return response ()->json ( $editType );


            }else{
                return Response::json ( array (

                    'errors' => 'error data'
                ) );

            }

    }

    public function tempUploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->passes()) {
            $input = $request->all();
            if(isset($input['name'])){
                $path = public_path('tmp/') . $input['name'];
               unlink($path);
            }

            $input['file'] = time().'_'.$request->file->getClientOriginalName();
            $request->file->move(public_path('tmp'), $input['file']);
            $location = url('/tmp/'. $input['file']);

            return response()->json(['success'=>'done', 'path'=>$location, 'name'=>$input['file']] );
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function tempDeleteImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            $input = $request->all();

            $path = public_path('tmp/') . $input['name'];

             if(unlink($path)){
                 return response()->json(['success'=>'done'] );
             }else{
                 return response()->json(['fail'=>'cannot delete'] );
             }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function postAddModel(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newOffice = Admin::createModel($request);

            return $newOffice;
        }
    }

    public function postEditModel(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editOffice = Admin::editModel($request);

            return response ()->json ( $editOffice );
        }
    }

    // Fuels

    public function getFuels()
    {
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }

        $all_fuels = null;
        if(Session::get('AllFuels')){
            $all_fuels = true;
        }

        $fuels = Admin::getFuels ($all_fuels);

        $data=[ 'fuels' => $fuels,
            'allFuels' => $all_fuels,
            'app_languages' => $app_language
        ];

        return view('admin.fuels')->withData ( $data );;
    }
    public function postAddFuel(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newFleet = Admin::createFuel($request);

            return $newFleet;
        }
    }

    public function postEditFuel(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editOffice = Admin::editFuel($request);

            return response ()->json ( $editOffice );
        }
    }

    public function postGetTypeFuel(Request $request)
    {

        $editType = Admin::getFuelType($request);
        if($editType){
            return response ()->json ( $editType );


        }else{
            return Response::json ( array (

                'errors' => 'error data'
            ) );

        }

    }

    // Car Extras

    public function getCarExtras()
    {
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }

        $all_extras = null;
        if(Session::get('AllCarExtras')){
            $all_extras = true;
        }

        $extras = Admin::getCarExtras($all_extras);

        $data=[ 'extras' => $extras,
            'allExtras' => $all_extras,
            'app_languages' => $app_language
        ];

        return view('admin.extras')->withData ( $data );;
    }
    public function postAddCarExtra(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newExtra = Admin::createCarExtra($request);

            return $newExtra;
        }
    }

    public function postEditCarExtra(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editExtra = Admin::editCarExtra($request);

            return response ()->json ( $editExtra );
        }
    }

    public function postGetTypeCarExtra(Request $request)
    {

        $editType = Admin::getCarExtrasType($request);
        if($editType){
            return response ()->json ( $editType );


        }else{
            return Response::json ( array (

                'errors' => 'error data'
            ) );

        }

    }

    // Car Coupes

    public function getCarCoupes()
    {
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }

        $all_coupes = null;
        if(Session::get('AllCoupes')){
            $all_coupes = true;
        }

        $coupes = Admin::getCarCoupes($all_coupes);

        $data=[ 'coupes' => $coupes,
            'allCoupes' => $all_coupes,
            'app_languages' => $app_language
        ];

        return view('admin.coupe')->withData ( $data );;
    }
    public function postAddCarCoupes(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newCoupe = Admin::createCarCoupe($request);

            return $newCoupe;
        }
    }

    public function postEditCarCoupes(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editCoupe = Admin::editCarCoupe($request);

            return response ()->json ( $editCoupe );
        }
    }

    public function postGetTypeCoupe(Request $request)
    {

        $editType = Admin::getCarCoupeType($request);
        if($editType){
            return response ()->json ( $editType );


        }else{
            return Response::json ( array (

                'errors' => 'error data'
            ) );

        }

    }

    public function getPosSIPPCodes()
    {
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }

        $sipp_codes = Admin::getSIPPCodes();


        $data=[ 'sipp_codes' => $sipp_codes,
            'app_languages' => $app_language
        ];

        return view('admin.sipp-codes')->withData ( $data );
    }



    public function getPriceRulesSettings()
    {
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }

        $all_prices = null;
        if(Session::get('AllPrices')){
            $all_prices = true;
        }

        $all_rules = null;
        if(Session::get('AllPriceRules')){
            $all_rules = true;
        }

        $models = Admin::getModels();

        $rules = Admin::getPriceRules($all_rules);

        $prices = Admin::getPrice($all_prices);


        $data=[ 'prices' => $prices,
            'price_rules' => $rules,
            'models' => $models,
            'allPrices' => $all_prices,
            'allPriceRules' => $all_rules,
            'app_languages' => $app_language
        ];

        return view('admin.prices-rules')->withData ( $data );
    }

    public function postAddPrice(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newPrice = Admin::createPrice($request);

            return $newPrice;
        }
    }

    public function postEditPrice(Request $request)
    {
        $rules = array (
            'name_bg' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editCoupe = Admin::editPrice($request);

            return response ()->json ( $editCoupe );
        }
    }

    public function postGetTranslationsPrice(Request $request)
    {

        $editType = Admin::getPriceTranslations($request);
        if($editType){
            return response ()->json ( $editType );


        }else{
            return Response::json ( array (

                'errors' => 'error data'
            ) );

        }

    }

    public function postAddPriceRule(Request $request)
    {

        $rules = array (
            'name' => 'required|not_in:0',
            'date_start' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newRule = Admin::createPriceRule($request);

            return $newRule;
        }
    }

    public function postEditPriceRule(Request $request)
    {
        $rules = array (
            'name' => 'required|not_in:0',
            'date_start' => 'required',
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editCoupe = Admin::editPriceRule($request);

            return response ()->json ( $editCoupe );
        }
    }

    public function checkRuleExist(Request $request)
    {
        $rule_chek = Admin::checkPriceRule(Input::all ());
       if($rule_chek && count($rule_chek) > 0){
           return Response::json ( array (

               'hasRule' => $rule_chek
           ) );
       }else{
           return Response::json ( array (

               'ok' => 'ok'
           ) );
       }
    }
    public function getRentalExtras(Request $request)
    {
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }
        $all_rent_extras = null;
        if(Session::get('AllRentExtras')){
            $all_rent_extras = true;
        }

        $rent_extras = Admin::getRentExtras($all_rent_extras);

        $data=[
            'rent_extras' => $rent_extras,
            'allRentExtras' => $all_rent_extras,
            'app_languages' => $app_language
        ];
        return view('admin.rental-extras')->withData ( $data );


    }
    public function postAddRentExtra(Request $request)
    {

        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newExtra = Admin::createRentalExtra($request);

            return $newExtra;
        }
    }

    public function postEditRentExtra(Request $request)
    {

        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $editExtra = Admin::editRentalExtra($request);

            return $editExtra;
        }
    }

    public function postGetTranslationsRentExtra(Request $request)
    {

        $editType = Admin::getRentExtraTranslations($request);
        if($editType){
            return response ()->json ( $editType );


        }else{
            return Response::json ( array (

                'errors' => 'error data'
            ) );

        }

    }



    public function getCouponsSettings()
    {
        $locale = null;
        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }
        if(Session::get('locale')){
            $locale = Session::get('locale');
        }

        $all_cupons = null;
        if(Session::get('AllCoupons')){
            $all_cupons = true;
        }

        $coupons = Admin::getCoupons($all_cupons);

        $data=[
            'coupons' => $coupons,
            'allCoupons' => $all_cupons,
            'app_languages' => $app_language,
            'locale' => $locale
        ];
        return view('admin.coupons')->withData ( $data );
    }


    public function postAddCoupon(Request $request)
    {

        $rules = array (
            'name' => 'required',
            'price' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newExtra = Admin::createCoupon($request);

            return $newExtra;
        }

    }

    public function postEditCoupon(Request $request)
    {

        $rules = array (
            'name' => 'required',
            'price' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newExtra = Admin::editCoupon($request);

            return $newExtra;
        }

    }

    public function getRentalInsurance()
    {

        $app_language = null;
        if(AppLanguage::get()){
            $app_language = AppLanguage::get();
        }
        $all_insurance = null;
        if(Session::get('AllInsurance')){
            $all_insurance = true;
        }
        $insurance = Admin::getInsurance($all_insurance);

        $data=[
            'insurance' => $insurance,
            'allInsurance' => $all_insurance,
            'app_languages' => $app_language
        ];
        return view('admin.rental-insurance')->withData ( $data );
    }

    public function postAddInsurance(Request $request)
    {

        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newInsurance = Admin::createInsurance($request);

            return $newInsurance;
        }
    }

    public function postEditInsurance(Request $request)
    {

        $rules = array (
            'name_bg' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $editExtra = Admin::editInsurance($request);

            return $editExtra;
        }
    }

    public function postGetTranslationsInsurance(Request $request)
    {

        $editType = Admin::getInsuranceTranslations($request);
        if($editType){
            return response ()->json ( $editType );


        }else{
            return Response::json ( array (

                'errors' => 'error data'
            ) );

        }

    }

    public function getCitiesTransfers()
    {

        $all_transfers = null;
        if(Session::get('AllCityTransfers')){
            $all_transfers = true;
        }

        $cities = BaseHelper::getCities ();
        $transfers = BaseHelper::getCitiesTransfer();

        $data=[ 'transfers' => $transfers,
            'cities' => $cities,
            'allTransfers' => $all_transfers
        ];
        return view('admin.cityTocity')->withData ( $data );;
    }

    public function postAddCityTransfer(Request $request)
    {
        $rules = array (
            'cityFrom' => 'required',
            'cityTo' => 'required',
            'price' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $newMaker = Admin::createCityTransfer($request);

            return $newMaker;
        }
    }

    public function postEditCityTransfer(Request $request)
    {
        $rules = array (
            'cityFrom' => 'required',
            'cityTo' => 'required',
            'price' => 'required'
        );

        $validator = Validator::make ( Input::all (),$rules);

        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $editMaker = Admin::editCityTransfer($request);

            return response ()->json ( $editMaker );
        }
    }

    public function getRentalSettings(Request $request)
    {
        return view('admin.rental-settings');


    }





}
