<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserTypes;
use App\Makers;
use App\Countries;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App;
use DateTime;
use DateTimeZone;


class Admin
{
    public static function getUsers($all = null){
        $results = DB::table('users')
            ->leftJoin('userTypes', 'userTypes.ID', '=', 'users.role')
            ->select('users.id','users.name', 'users.username', 'users.email', 'users.isActive', 'users.role', 'users.created_at', 'userTypes.TypeName' ,'userTypes.ID as UserTypeID');

        if(!$all){
            $results->where('users.isActive', '=', 1);
        }
        $results = $results->paginate(100);
        return $results;
    }

    public static function getUserTypes(){
        $results = UserTypes::get();

        return $results;
    }

    public static function createUser($data){
       $new_user = User::create([
            'name' => Input::get('name'),
            'username' =>  Input::get('username'),
            'email' =>  Input::get('email'),
            'password' => Hash::make( Input::get('password')),
            'role' =>  Input::get('role'),

        ]);

        return $new_user;
    }

    public static function getMakers(){
        $results = Makers::where('isActive', 1)->get();

        return $results;
    }

    public static function createMakers($data){
        $new_maker = new Makers ();
        $new_maker->MakerName = $data->name;
        $new_maker->save ();

        return $new_maker;
    }

    public static function editMakers($data){
        $edit_maker = Makers::find ($data->id);
        $edit_maker->MakerName = $data->name;
        $edit_maker->save ();

        return $edit_maker;
    }
    public static function deleteMakers($data){
        $edit_maker = Makers::find ($data->id);
        $edit_maker->isActive = 0;
        $edit_maker->save ();

        return $edit_maker;
    }

    public static function getCountries($all = null,$language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = DB::table('Countries')
            ->leftJoin('CountriesTranslation', 'CountriesTranslation.country_id', '=', 'Countries.id')
            ->where('CountriesTranslation.locale', '=', $language)
            ->select('Countries.id', 'CountriesTranslation.countryName as CountryName', 'Countries.Code')->get();

        return $results;
    }

//    public static function createCountries($data){
//        $new_country = new Countries ();
//        $new_country->CountryName = $data->name;
//        $new_country->CountryPrefix = $data->prefix;
//        $new_country->save ();
//
//        return $new_country;
//    }
//
//    public static function editCountries($data){
//        $edit_country = Countries::find ($data->country_id);
//        $edit_country->CountryName = $data->name;
//        $edit_country->CountryPrefix = $data->prefix;
//        if($data->status == 2){
//            $edit_country->isActive = 0;
//        }else{
//            $edit_country->isActive = 1;
//        }
//
//        $edit_country->save ();
//
//        return $edit_country;
//    }
//    public static function deleteCountries($data){
//        $edit_country = Countries::find ($data->id);
//        $edit_country->isActive = 0;
//        $edit_country->save ();
//
//        return $edit_country;
//    }
    public static function createCityTransfer($data){
        $new_city = new CarCityToCity();
        $new_city->cityFromID = $data->cityFrom;
        $new_city->cityToID = $data->cityTo;
        $new_city->TransferPrice = $data->price;
        $new_city->save ();

        return $new_city;
    }

    public static function editCityTransfer($data){
        $edit_city = CarCityToCity::find ($data->city_id);
        $edit_city->cityFromID = $data->cityFrom;
        $edit_city->cityToID = $data->cityTo;
        $edit_city->TransferPrice = $data->price;

        if($data->status == 2){
            $edit_city->isActive = 0;
        }else{
            $edit_city->isActive = 1;
        }
        $edit_city->save ();

        return $edit_city;
    }



    public static function createCity($data){
        $new_city = new Cities();
        $new_city->CityName = $data->name;
        $new_city->CountryID = $data->country;
        $new_city->save ();

        return $new_city;
    }

    public static function editCity($data){
        $edit_city = Cities::find ($data->city_id);
        $edit_city->CityName = $data->name;
        $edit_city->CountryID = $data->country;
        if($data->status == 2){
            $edit_city->isActive = 0;
        }else{
            $edit_city->isActive = 1;
        }
        $edit_city->save ();

        return $edit_city;
    }

    public static function getOffices($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }
        $results = DB::table('offices')
            ->leftJoin('Countries', 'Countries.id', '=', 'offices.CountryID')
            ->leftJoin('cities', 'cities.ID', '=', 'offices.CityID')
            ->leftJoin('CountriesTranslation', 'CountriesTranslation.country_id', '=', 'Countries.id')
            ->where('CountriesTranslation.locale', '=', $language)

            ->select('offices.id',
                'offices.OfficeName',
                'offices.Address',
                'offices.lat',
                'offices.lon',
                'offices.Phone',
                'offices.MobilePhone',
                'offices.Fax',
                'offices.email',
                'offices.office_image_url',
                'cities.id as CityID',
                'cities.CityName',
                'CountriesTranslation.countryName as CountryName',
                'Countries.id as CountryID',
                'offices.isActive');
        if(!$all){
            $results->where('cities.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function createOffice($data){
        $new_office = new Offices();
        $new_office->OfficeName = $data->name;
        $new_office->CountryID = $data->country;
        $new_office->CityID = $data->city;
        if(isset($data->country)){
            $new_office->Address = $data->address;
        }
        if(isset($data->phone)){
            $new_office->Phone = $data->phone;
        }
        if(isset($data->email)){
            $new_office->email = $data->email;
        }
        $new_office->save ();

        return $new_office;
    }

    public static function editOffice($data){
        $edit_office = Offices::find ($data->office_id);
        $edit_office->OfficeName = $data->name;
        $edit_office->CountryID = $data->country;
        $edit_office->CityID = $data->city;
        if(isset($data->country)){
            $edit_office->Address = $data->address;
        }
        if(isset($data->phone)){
            $edit_office->Phone = $data->phone;
        }
        if(isset($data->email)){
            $edit_office->email = $data->email;
        }
        $edit_office->save ();

        return $edit_office;
    }

    public static function getModels($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }
        $results = DB::table('carmodels')
            ->leftJoin('makers', 'makers.ID', '=', 'carmodels.MakerID')
            ->leftJoin('fleettypes', 'fleettypes.ID', '=', 'carmodels.FleetTypeID')
            ->leftJoin('FleetTypesTranslation', 'FleetTypesTranslation.fleetType_id', '=', 'fleettypes.id')
            ->where('FleetTypesTranslation.locale', '=', $language)
            ->select('carmodels.id',
                'carmodels.ModelName',
                'carmodels.MakerID',
                'makers.MakerName',
                'carmodels.FleetTypeID',
                'FleetTypesTranslation.FleetName',
                'carmodels.ModelYear',
                'carmodels.ModelBasePrice',
                'carmodels.image',
                'carmodels.isActive');

        if(!$all){
            $results->where('carmodels.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }



    public static function createFleet($data){
        $new_fleet = new FleetTypes();
        $new_fleet->DefaultFleetName = $data->name_bg;
        if($new_fleet->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $new_fleet_translate = new FleetTypesTranslation();
                $new_fleet_translate->fleetType_id = $new_fleet->id;
                $new_fleet_translate->locale = $k;
                if ($v != '') {
                    $new_fleet_translate->FleetName = $v;
                } else {
                    $new_fleet_translate->FleetName = $data->name_bg;
                }

                $new_fleet_translate->save();
            }
        }

        return $new_fleet_translate;
    }
    public static function editFleet($data){
        $edit_fleet = FleetTypes::find ($data->fleet_id);
        $edit_fleet->DefaultFleetName = $data->name_bg;
        $edit_fleet->isActive = $data->status;

        if($edit_fleet->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $edit_fleet_translate = FleetTypesTranslation::where('fleetType_id', '=', $data->fleet_id )->where('locale', '=', $k)->first();
                $edit_fleet_translate->fleetType_id = $data->fleet_id;
                $edit_fleet_translate->locale = $k;
                if ($v != '') {
                    $edit_fleet_translate->DefaultName = $v;
                } else {
                    $edit_fleet_translate->DefaultName = $data->name_bg;
                }

                $edit_fleet_translate->save();
            }
        }

        return $edit_fleet;
    }

    public static function getFleetType($data){
        $fleet_lang= FleetTypesTranslation::where ('fleetType_id', '=',$data->id)->get();

        return $fleet_lang;
    }

    public static function createModel($data){
        $new_model = new CarModels();
        $new_model->ModelName = $data->name;
        $new_model->MakerID = $data->maker;
        $new_model->FleetTypeID = $data->type;
        if(isset($data->year)){
            $new_model->ModelYear = $data->year;
        }
        if(isset($data->price)){
            $new_model->ModelBasePrice = $data->price;
        }
        if(isset($data->image_name) && $data->image_name != ''){

            if(file_exists(public_path('tmp/').$data->image_name)){
                $success = \File::copy(public_path('tmp/').$data->image_name, public_path('img/cars/').$data->image_name);
                $new_model->image = $data->image_name;
                unlink(public_path('tmp/').$data->image_name);
            }

        }

        $new_model->save ();

        return $new_model;
    }

    public static function editModel($data){
        $edit_model = CarModels::find ($data->model_id);
        $edit_model->ModelName = $data->name;
        $edit_model->MakerID = $data->maker;
        $edit_model->FleetTypeID = $data->type;
        if(isset($data->year)){
            $edit_model->ModelYear = $data->year;
        }
        if(isset($data->price)){
            $edit_model->ModelBasePrice = $data->price;
        }
        if(isset($data->image_name) && $data->image_name != ''){
            $success = \File::copy(public_path('tmp/').$data->image_name, public_path('img/cars/').$data->image_name);
            $edit_model->image = $data->image_name;

            unlink(public_path('tmp/').$data->image_name);
            if($data->edit_image_name != 'car.png'){
                unlink(public_path('img/cars/').$data->edit_image_name);

            }
        }elseif ($data->image_name == '' && $data->edit_image_name_delete == 1){
            $edit_model->image = null;
            unlink(public_path('img/cars/').$data->edit_image_name);

        }
        $edit_model->save ();

        return $edit_model;
    }

    public static function getFuels($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = DB::table('fueltypes')
            ->leftJoin('FuelTypesTranslation', 'FuelTypesTranslation.fuel_id', '=', 'fueltypes.id')
            ->where('FuelTypesTranslation.locale', '=', $language)
            ->select('fueltypes.id', 'FuelTypesTranslation.FuelName', 'fueltypes.isActive');
        if(!$all){
            $results->where('fueltypes.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function createFuel($data){
        $new_fuel = new FuelTypes();
        $new_fuel->DefaultFuelName = $data->name_bg;
        if($new_fuel->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $new_fuel_translate = new FuelTypesTranslation();
                $new_fuel_translate->fuel_id = $new_fuel->id;
                $new_fuel_translate->locale = $k;
                if ($v != '') {
                    $new_fuel_translate->FuelName = $v;
                } else {
                    $new_fuel_translate->FuelName = $data->name_bg;
                }

                $new_fuel_translate->save();
            }
        }

        return $new_fuel_translate;
    }
    public static function editFuel($data){
        $edit_fuel = FuelTypes::find ($data->fuel_id);
        $edit_fuel->DefaultFuelName = $data->name_bg;
        $edit_fuel->isActive = $data->status;


        if($edit_fuel->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $edit_fuel_translate = FuelTypesTranslation::where('fuel_id', '=', $data->fuel_id )->where('locale', '=', $k)->first();
                $edit_fuel_translate->fuel_id = $data->fuel_id;
                $edit_fuel_translate->locale = $k;
                if ($v != '') {
                    $edit_fuel_translate->FuelName = $v;
                } else {
                    $edit_fuel_translate->FuelName = $data->name_bg;
                }

                $edit_fuel_translate->save();
            }
        }

        return $edit_fuel;
    }

    public static function getFuelType($data){
        $fuel_lang= FuelTypesTranslation::where ('fuel_id', '=',$data->id)->get();

        return $fuel_lang;
    }

    public static function getCarExtras($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = DB::table('carextras')
            ->leftJoin('CarExtrasTranslation', 'CarExtrasTranslation.extra_id', '=', 'carextras.id')
            ->where('CarExtrasTranslation.locale', '=', $language)
            ->select('carextras.id', 'CarExtrasTranslation.DefaultName as ExtraName', 'carextras.isActive');
        if(!$all){
            $results->where('carextras.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function createCarExtra($data){
        $new_extra = new CarsExtras();
        $new_extra->ExtraName = $data->name_bg;
        if($new_extra->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $new_extra_translate = new CarExtrasTranslation();
                $new_extra_translate->extra_id = $new_extra->id;
                $new_extra_translate->locale = $k;
                if ($v != '') {
                    $new_extra_translate->DefaultName = $v;
                } else {
                    $new_extra_translate->DefaultName = $data->name_bg;
                }

                $new_extra_translate->save();
            }
        }

        return $new_extra_translate;
    }
    public static function editCarExtra($data){
        $edit_extra = CarsExtras::find ($data->carextra_id);
        $edit_extra->ExtraName = $data->name_bg;
        $edit_extra->isActive = $data->status;


        if($edit_extra->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $edit_extra_translate = CarExtrasTranslation::where('extra_id', '=', $data->carextra_id )->where('locale', '=', $k)->first();
                $edit_extra_translate->extra_id = $data->carextra_id;
                $edit_extra_translate->locale = $k;
                if ($v != '') {
                    $edit_extra_translate->DefaultName = $v;
                } else {
                    $edit_extra_translate->DefaultName = $data->name_bg;
                }

                $edit_extra_translate->save();
            }
        }

        return $edit_extra;
    }

    public static function getCarExtrasType($data){
        $extra_lang= CarExtrasTranslation::where ('extra_id', '=',$data->id)->get();

        return $extra_lang;
    }

    public static function getCarCoupes($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = DB::table('cupetypes')
            ->leftJoin('CupeTypesTranslation', 'CupeTypesTranslation.cupeType_id', '=', 'cupetypes.id')
            ->where('CupeTypesTranslation.locale', '=', $language)
            ->select('cupetypes.id', 'CupeTypesTranslation.DefaultName as CoupeName', 'cupetypes.isActive');
        if(!$all){
            $results->where('cupetypes.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function createCarCoupe($data){
        $new_cupe = new CupeTypes();
        $new_cupe->CupeTypeName = $data->name_bg;
        if($new_cupe->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $new_cupe_translate = new CupeTypesTranslation();
                $new_cupe_translate->cupeType_id = $new_cupe->id;
                $new_cupe_translate->locale = $k;
                if ($v != '') {
                    $new_cupe_translate->DefaultName = $v;
                } else {
                    $new_cupe_translate->DefaultName = $data->name_bg;
                }

                $new_cupe_translate->save();
            }
        }

        return $new_cupe_translate;
    }
    public static function editCarCoupe($data){
        $edit_coupe = CupeTypes::find ($data->coupe_id);
        $edit_coupe->CupeTypeName = $data->name_bg;
        $edit_coupe->isActive = $data->status;


        if($edit_coupe->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $edit_coupe_translate = CupeTypesTranslation::where('cupeType_id', '=', $data->coupe_id )->where('locale', '=', $k)->first();
                $edit_coupe_translate->cupeType_id = $data->coupe_id;
                $edit_coupe_translate->locale = $k;
                if ($v != '') {
                    $edit_coupe_translate->DefaultName = $v;
                } else {
                    $edit_coupe_translate->DefaultName = $data->name_bg;
                }

                $edit_coupe_translate->save();
            }
        }

        return $edit_coupe;
    }

    public static function getCarCoupeType($data){
        $cupe_lang= CupeTypesTranslation::where ('cupeType_id', '=',$data->id)->get();

        return $cupe_lang;
    }

    //cars
    public static function getCars($all = null, $language = null, $filters = null){
        if ($language == null) {
            $language = App::getLocale();
        }
        $results = DB::table('cars')
            ->leftJoin('makers', 'makers.ID', '=', 'cars.MakerID')
            ->leftJoin('carmodels', 'carmodels.ID', '=', 'cars.ModelID')
            ->leftJoin('offices', 'offices.ID', '=', 'cars.OfficeID')
            ->leftJoin('fueltypes', 'fueltypes.ID', '=', 'cars.FuelID')
            ->leftJoin('FuelTypesTranslation', 'FuelTypesTranslation.fuel_id', '=', 'fueltypes.id')
            ->leftJoin('cupetypes', 'cupetypes.ID', '=', 'cars.CupeTypeID')
            ->leftJoin('CupeTypesTranslation', 'CupeTypesTranslation.cupeType_id', '=', 'cupetypes.id')
            ->where('FuelTypesTranslation.locale', '=', $language)
            ->where('CupeTypesTranslation.locale', '=', $language)
            ->select('cars.id',
                'cars.RegNumber',
                'cars.ModelID',
                'carmodels.ModelName',
                'cars.MakerID',
                'makers.MakerName',
                'cars.FuelID',
                'FuelTypesTranslation.FuelName',
                'cars.CupeTypeID',
                'CupeTypesTranslation.DefaultName as CoupeName',
                'cars.OfficeID',
                'offices.OfficeName',
                'cars.ModelYear',
                'cars.CarBasePrice',
                'cars.image',
                'cars.Doors',
                'cars.Seats',
                'cars.AC',
                'cars.TankCapacity',
                'cars.Engine',
                'cars.GearType',
                'cars.HP',
                'cars.SIPP',
                'cars.sipp1_id',
                'cars.sipp2_id',
                'cars.sipp3_id',
                'cars.sipp4_id',
                'cars.TrunkVolume',
                'cars.isActive');

        if(!$all){
            $results->where('cars.isActive', '=', 1);
        }
        if($filters && isset($filters['filters_all_sipp'])){

            if(isset($filters['filters_all_sipp'][1]) && $filters['filters_all_sipp'][1] != -1){
                $results->where('cars.sipp1_id', '=', $filters['filters_all_sipp'][1]);
            }
            if(isset($filters['filters_all_sipp'][2]) && $filters['filters_all_sipp'][2] != -1){
                $results->where('cars.sipp2_id', '=', $filters['filters_all_sipp'][2]);
            }
            if(isset($filters['filters_all_sipp'][3]) && $filters['filters_all_sipp'][3] != -1){
                $results->where('cars.sipp3_id', '=', $filters['filters_all_sipp'][3]);
            }
            if(isset($filters['filters_all_sipp'][4]) && $filters['filters_all_sipp'][4] != -1){
                $results->where('cars.sipp4_id', '=', $filters['filters_all_sipp'][4]);
            }


        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function createCar($data){

        $sipp_id_1= null;
        $sipp_id_2= null;
        $sipp_id_3= null;
        $sipp_id_4= null;

        $sipp_code_1= '';
        $sipp_code_2= '';
        $sipp_code_3= '';
        $sipp_code_4= '';
        if(isset($data->sipp_1)){
            $array = explode('|', $data->sipp_1);
            $id1 = $array[0];
            $code1 = $array[1];

            $sipp_id_1= $id1;
            $sipp_code_1= $code1;
        }
        if(isset($data->sipp_2)){
            $array = explode('|', $data->sipp_2);
            $id2 = $array[0];
            $code2 = $array[1];

            $sipp_id_2= $id2;
            $sipp_code_2= $code2;

        }
        if(isset($data->sipp_3)){
            $array = explode('|', $data->sipp_3);
            $id3 = $array[0];
            $code3 = $array[1];

            $sipp_id_3= $id3;
            $sipp_code_3= $code3;

        }
        if(isset($data->sipp_4)){
            $array = explode('|', $data->sipp_4);
            $id4 = $array[0];
            $code4 = $array[1];

            $sipp_id_4= $id4;
            $sipp_code_4= $code4;

        }


        $sipp_code = $sipp_code_1 . $sipp_code_2 . $sipp_code_3 . $sipp_code_4;

        $new_car = new Cars();
        $new_car->RegNumber = $data->number;
        $new_car->MakerID = $data->maker;
        $new_car->ModelID = $data->model;
        $new_car->OfficeID = $data->office;
        $new_car->FuelID = $data->fuel;
        $new_car->CupeTypeID = $data->coupe;
        $new_car->AC = $data->ac;
        $new_car->HP = $data->hp;
        $new_car->GearType = $data->gear;
        $new_car->SIPP = $sipp_code;
        $new_car->sipp1_id = $sipp_id_1;
        $new_car->sipp2_id = $sipp_id_2;
        $new_car->sipp3_id = $sipp_id_3;
        $new_car->sipp4_id = $sipp_id_4;

        if(isset($data->year)){
            $new_car->ModelYear = $data->year;
        }
        if(isset($data->price)){
            $new_car->CarBasePrice = $data->price;
        }
        if(isset($data->doors)){
            $new_car->Doors = $data->doors;
        }
        if(isset($data->seats)){
            $new_car->Seats = $data->seats;
        }
        if(isset($data->tank)){
            $new_car->TankCapacity = $data->tank;
        }
        if(isset($data->trunk)){
            $new_car->TrunkVolume = $data->trunk;
        }
        if(isset($data->engine)){
            $new_car->Engine = $data->engine;
        }


        $new_car->save();


        return $new_car;
    }

    public static function editCar($data){
        $sipp_id_1= null;
        $sipp_id_2= null;
        $sipp_id_3= null;
        $sipp_id_4= null;

        $sipp_code_1= '';
        $sipp_code_2= '';
        $sipp_code_3= '';
        $sipp_code_4= '';
        if(isset($data->sipp_1)){
            $array = explode('|', $data->sipp_1);
            $id1 = $array[0];
            $code1 = $array[1];

            $sipp_id_1= $id1;
            $sipp_code_1= $code1;
        }
        if(isset($data->sipp_2)){
            $array = explode('|', $data->sipp_2);
            $id2 = $array[0];
            $code2 = $array[1];

            $sipp_id_2= $id2;
            $sipp_code_2= $code2;

        }
        if(isset($data->sipp_3)){
            $array = explode('|', $data->sipp_3);
            $id3 = $array[0];
            $code3 = $array[1];

            $sipp_id_3= $id3;
            $sipp_code_3= $code3;

        }
        if(isset($data->sipp_4)){
            $array = explode('|', $data->sipp_4);
            $id4 = $array[0];
            $code4 = $array[1];

            $sipp_id_4= $id4;
            $sipp_code_4= $code4;

        }


        $sipp_code = $sipp_code_1 . $sipp_code_2 . $sipp_code_3 . $sipp_code_4;

        $edit_car = Cars::find ($data->car_id);
        $edit_car->RegNumber = $data->number;
        $edit_car->MakerID = $data->maker;
        $edit_car->ModelID = $data->model;
        $edit_car->OfficeID = $data->office;
        $edit_car->FuelID = $data->fuel;
        $edit_car->CupeTypeID = $data->coupe;
        $edit_car->AC = $data->ac;
        $edit_car->HP = $data->hp;
        $edit_car->GearType = $data->gear;
        $edit_car->isActive = $data->status;
        $edit_car->SIPP = $sipp_code;
        $edit_car->sipp1_id = $sipp_id_1;
        $edit_car->sipp2_id = $sipp_id_2;
        $edit_car->sipp3_id = $sipp_id_3;
        $edit_car->sipp4_id = $sipp_id_4;



        if(isset($data->year)){
            $edit_car->ModelYear = $data->year;
        }

        if(isset($data->price)){
            $edit_car->CarBasePrice = $data->price;
        }
        if(isset($data->doors)){
            $edit_car->Doors = $data->doors;
        }
        if(isset($data->seats)){
            $edit_car->Seats = $data->seats;
        }
        if(isset($data->tank)){
            $edit_car->TankCapacity = $data->tank;
        }
        if(isset($data->trunk)){
            $edit_car->TrunkVolume = $data->trunk;
        }
        if(isset($data->engine)){
            $edit_car->Engine = $data->engine;
        }

        if(isset($data->sipp)){
            $edit_car->SIPP = $data->sipp;
        }

        $edit_car->save();


        return $edit_car;
    }
    public static function getSIPPCodes($all = null){

        $ordered_results = [];
        $results = DB::table('SIPPcodes')
            ->select('id','Code', 'Position', 'Description', 'isActive');

        if(!$all){
            $results->where('isActive', '=', 1);
        }
        $results = $results->get();

        if($results && count($results) > 0){
            foreach ($results as $result){
                $ordered_results[$result->Position][] = array('ID'=>$result->id, 'Code' => $result->Code, 'Position' => $result->Position,'Description' => $result->Description, 'isActive' => $result->isActive);
            }
        }

        return $ordered_results;
    }

    public static function getPrice($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = DB::table('Prices')
            ->leftJoin('PricesTranslation', 'PricesTranslation.price_id', '=', 'Prices.id')
            ->where('PricesTranslation.locale', '=', $language)
            ->select('Prices.id', 'PricesTranslation.Name', 'Prices.isActive' , 'Prices.isUsed');
        if(!$all){
            $results->where('Prices.isActive', '=', 1);
        }
        $results = $results->paginate(100);

//        $prices2 = Prices::find();

        return $results;
    }

    public static function getPriceRules($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = PriceRules::
            leftJoin('Prices', 'Prices.id', '=', 'PriceRules.price_id')
            ->leftJoin('PricesTranslation', 'PricesTranslation.price_id', '=', 'Prices.id')
            ->leftJoin('carmodels', 'carmodels.id', '=', 'PriceRules.model_id')
            ->where('PricesTranslation.locale', '=', $language)
            ->select(
                DB::raw('DATE_FORMAT(PriceRules.start_date, "%d-%m-%Y") as start_date'),
                DB::raw('DATE_FORMAT(PriceRules.end_date, "%d-%m-%Y") as end_date'),
                'PriceRules.id',
                   'PriceRules.price_id',

//                'PriceRules.start_date',
//                'PriceRules.end_date',
                'PriceRules.RulePrice',
                'PriceRules.price_day',
                'PriceRules.price_2_4_days',
                'PriceRules.price_5_7_days',
                'PriceRules.price_8_15_days',
                'PriceRules.price_16_30_days',
                'PriceRules.price_31_days',
                'PriceRules.price_weekend',
                'PriceRules.car_id',
                'PriceRules.gear_type',
                'PriceRules.discount_percent',
                'PriceRules.model_id',
                'carmodels.ModelName',
                'carmodels.ModelYear',
                'PriceRules.fuel_id',
                'PriceRules.sipp_id',
                'PriceRules.fleet_id',
                'PriceRules.maker_id',
                'PriceRules.coupe_id',
                'PriceRules.ac',
                'PriceRules.discount_id',
                'PricesTranslation.Name',
                'PriceRules.isActive');
        if(!$all){
            $results->where('PriceRules.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        if($results && count($results) > 0){
            foreach ($results as $k=>$result){
                $car_to_rule = CarsToPriceRules::where('RuleID', $result->id)->where('isActive', 1)->count();
                $results[$k]->count_cars_used = $car_to_rule;
            }
        }

//        $prices2 = Prices::find();

        return $results;
    }



    public static function createPrice($data){
        $new_price = new Prices();
        if($new_price->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $new_price_translate = new PricesTranslation();
                $new_price_translate->price_id = $new_price->id;
                $new_price_translate->locale = $k;
                if ($v != '') {
                    $new_price_translate->Name = $v;
                } else {
                    $new_price_translate->Name = $data->name_bg;
                }

                $new_price_translate->save();
            }
        }

        return $new_price_translate;
    }
    public static function editPrice($data){
        $edit_price = Prices::find ($data->price_id);
        $edit_price->isActive = $data->status;

        if($edit_price->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $edit_price_translate = PricesTranslation::where('price_id', '=', $data->price_id )->where('locale', '=', $k)->first();
                $edit_price_translate->price_id = $data->price_id;
                $edit_price_translate->locale = $k;
                if ($v != '') {
                    $edit_price_translate->Name = $v;
                } else {
                    $edit_price_translate->Name = $data->name_bg;
                }

                $edit_price_translate->save();
            }

            $ckeck_rules = PriceRules::where ('price_id', $data->price_id)->get();


            if($ckeck_rules && count($ckeck_rules) > 0){
                foreach ($ckeck_rules as $ckeck_rule){
                    $rule = PriceRules::find ($ckeck_rule->id);
                    if($data->status == 0){
                        $rule->isActive = 0;
                    }else{
                        $rule->isActive = 1;
                    }

                    $rule->save();
                }

            }
        }

        return $edit_price;
    }

    public static function getPriceTranslations($data){
        $price_lang= PricesTranslation::where ('price_id', '=',$data->id)->get();

        return $price_lang;
    }

    public static function getRentExtraTranslations($data){
        $price_lang= RentalExtrasTranslation::where ('extra_id', '=',$data->id)->get();

        return $price_lang;
    }

    public static function getInsuranceTranslations($data){
        $price_lang= InsuranceTranslations::where ('insurance_id', '=',$data->id)->get();

        return $price_lang;
    }


    public static function createPriceRule($data){

        if(isset($data->name) && $data->name != 0){
            $name = $data->name;
        }else {
            $name = null;
        }


        if(isset($data->date_start) && $data->date_start !=''){
            $date_start = date('d-m-Y H:i:s', strtotime($data->date_start));
            $date_start_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_start)->format('Y-m-d H:i:s');
        }else {
            $date_start_formated = null;
        }

        if(isset($data->date_end) && $data->date_end !=''){
            $date_end = date('d-m-Y H:i:s', strtotime($data->date_end));
            $date_end_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_end)->format('Y-m-d 23:59:59');
        }else {
            $date_end_formated = null;
        }

        if(isset($data->description) && $data->description !=''){

            $description = $data->description;
        }else {
            $description = null;
        }

        if(isset($data->gear) && $data->gear != 0){
            $gear = $data->gear;
        }else {
            $gear = 0;
        }

        if(isset($data->model) && $data->model != 0){
            $model = $data->model;
        }else {
            $model = null;
        }

        if(isset($data->discount) && $data->discount != 0){
            $discount = $data->discount;
        }else {
            $discount = 0;
        }

        if(isset($data->ac) && $data->ac != 0){
            $ac = $data->ac;
        }else {
            $ac = 0;
        }

        if(isset($data->price) && $data->price !=''){

            $price = number_format($data->price,2);
        }else {
            $price = 0.00;
        }

        if(isset($data->price1) && $data->price1 !=''){

            $price1 = number_format($data->price1,2);
        }else {
            $price1 = 0.00;
        }

        if(isset($data->price2_4) && $data->price2_4 !=''){

            $price2_4 = number_format($data->price2_4,2);
        }else {
            $price2_4 = 0.00;
        }

        if(isset($data->price_5_7) && $data->price_5_7 !=''){

            $price_5_7 = number_format($data->price_5_7,2);
        }else {
            $price_5_7 = 0.00;
        }

        if(isset($data->price_8_15) && $data->price_8_15 !=''){

            $price_8_15= number_format($data->price_8_15,2);
        }else {
            $price_8_15 = 0.00;
        }

        if(isset($data->price_16_30) && $data->price_16_30 !=''){

            $price_16_30 = number_format($data->price_16_30,2);
        }else {
            $price_16_30 = 0.00;
        }

        if(isset($data->price_31) && $data->price_31 !=''){

            $price_31 = number_format($data->price_31,2);
        }else {
            $price_31 = 0.00;
        }

        if(isset($data->price_weekend) && $data->price_weekend !=''){

            $price_weekend = number_format($data->price_weekend,2);
        }else {
            $price_weekend = 0.00;
        }

        $new_rule = new PriceRules();
        $new_rule->price_id = $name;
        $new_rule->start_date = $date_start_formated;
        $new_rule->end_date = $date_end_formated;
        $new_rule->RulePrice = $price;
        $new_rule->Description = $description;
        $new_rule->gear_type = $gear;
        $new_rule->model_id = $model;
        $new_rule->price_day = $price1;
        $new_rule->price_2_4_days = $price2_4;
        $new_rule->price_5_7_days = $price_5_7;
        $new_rule->price_8_15_days = $price_8_15;
        $new_rule->price_16_30_days = $price_16_30;
        $new_rule->price_31_days = $price_31;
        $new_rule->price_weekend = $price_weekend;
        $new_rule->discount_percent = $discount;
        $new_rule->ac = $ac;

        if($new_rule->save()){
            $edit_price = Prices::find ($name);
            $edit_price->isUsed = 1;
            $edit_price->save();

            $cars = Cars::where('isActive', 1)
                ->where('GearType', '=', $gear)
                ->where('ModelID', $model)
                ->select('id')
                ->get();

            if($cars && count($cars) > 0){
                foreach ($cars as $car){
                    $car_rule = new CarsToPriceRules();
                    $car_rule->CarID = $car->id;
                    $car_rule->RuleID = $new_rule->id;
                    $car_rule->save();
                }
            }
        }

        return $cars;
    }

    public static function editPriceRule($data){
        $new_rule =  PriceRules::find ($data->rule_id);

        if(isset($data->name) && $data->name != 0){
            $name = $data->name;
        }else {
            $name = null;
        }

        if(isset($data->date_start) && $data->date_start !=''){
            $date_start = date('d-m-Y H:i:s', strtotime($data->date_start));
            $date_start_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_start)->format('Y-m-d H:i:s');
        }else {
            $date_start_formated = null;
        }

        if(isset($data->date_end) && $data->date_end !=''){
            $date_end = date('d-m-Y H:i:s', strtotime($data->date_end));
            $date_end_formated = DateTime::createFromFormat('d-m-Y H:i:s', $date_end)->format('Y-m-d 23:59:59');
        }else {
            $date_end_formated = null;
        }

        if(isset($data->description) && $data->description !=''){

            $description = $data->description;
        }else {
            $description = null;
        }
        if(isset($data->discount) && $data->discount != 0){
            $discount = $data->discount;
        }else {
            $discount = 0;
        }



        if(isset($data->gear) && $data->gear != 0){
            $gear = $data->gear;
        }else {
            $gear = 0;
        }

        if(isset($data->model) && $data->model != 0){
            $model = $data->model;
        }else {
            $model = null;
        }

        if(isset($data->ac) && $data->ac != 0){
            $ac = $data->ac;
        }else {
            $ac = 0;
        }

//        if(isset($data->price) && $data->price !=''){
//
//            $price = number_format($data->price,2);
//        }else {
//            $price = null;
//        }

        if(isset($data->price1) && $data->price1 !=''){

            $price1 = number_format($data->price1,2);
        }else {
            $price1 = null;
        }

        if(isset($data->price2_4) && $data->price2_4 !=''){

            $price2_4 = number_format($data->price2_4,2);
        }else {
            $price2_4 = 0.00;
        }

        if(isset($data->price5_7) && $data->price5_7 !=''){

            $price5_7 = number_format($data->price5_7,2);
        }else {
            $price5_7 = null;
        }

        if(isset($data->price8_15) && $data->price8_15 !=''){

            $price8_15 = number_format($data->price8_15,2);
        }else {
            $price8_15 = 0.00;
        }

        if(isset($data->price16_30) && $data->price16_30 !=''){

            $price16_30 = number_format($data->price16_30,2);
        }else {
            $price16_30 = null;
        }

        if(isset($data->price31) && $data->price31 !=''){

            $price31 = number_format($data->price31,2);
        }else {
            $price31 = 0.00;
        }

        if(isset($data->price_weekend) && $data->price_weekend !=''){

            $price_weekend = number_format($data->price_weekend,2);
        }else {
            $price_weekend = null;
        }

        if(isset($data->status) && $data->status !=''){

            $status = $data->status;
        }else {
            $status = 1;
        }




        $new_rule->price_id = $name;
        $new_rule->start_date = $date_start_formated;
        $new_rule->end_date = $date_end_formated;
//        $new_rule->RulePrice = $price;
        $new_rule->Description = $description;
        $new_rule->gear_type = $gear;
        $new_rule->model_id = $model;
        $new_rule->price_day = $price1;
        $new_rule->price_2_4_days = $price2_4;
        $new_rule->price_5_7_days = $price5_7;
        $new_rule->price_8_15_days = $price8_15;
        $new_rule->price_16_30_days = $price16_30;
        $new_rule->price_31_days = $price31;
        $new_rule->price_weekend = $price_weekend;
        $new_rule->discount_percent = $discount;
        $new_rule->ac = $ac;
        $new_rule->isActive = $status;


//        if($new_rule->save()){
            $chek_prices = PriceRules::where('price_id',$name)->where('isActive', 1)->count();


            if($status == 0){
                if($chek_prices <= 1){
                    $edit_price = Prices::find ($name);
                    $edit_price->isUsed = 0;
                    $edit_price->save();
                }

                $affected = DB::table('CarsToPriceRules')
                    ->where('RuleID', '=', $data->rule_id)
                    ->where('isActive', '=', 1)
                    ->update(array('isActive' => 0));

                $new_rule->save();
            }

        if($status == 1){
                $chek_cars = self::checkPriceRule($data);

            if(count($chek_cars) <= 0){
                $edit_price = Prices::find ($name);
                $edit_price->isUsed = 1;
                $edit_price->save();

                $affected = DB::table('CarsToPriceRules')
                    ->where('RuleID', '=', $data->rule_id)
                    ->where('isActive', '=', 0)
                    ->update(array('isActive' => 1));

                $new_rule->save();

           }else{
                $new_rule = ['has_rules' => $chek_cars];
            }

        }


        //return $chek_prices;

//

       // }


        return $new_rule;
    }

    public static function checkPriceRule($data, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }

        $date_start = date('d-m-Y H:i:s', strtotime($data['date_start']));
        $from = DateTime::createFromFormat('d-m-Y H:i:s', $date_start)->format('Y-m-d H:i:s');

        $date_end = date('d-m-Y H:i:s', strtotime($data['date_end']));

        $to = DateTime::createFromFormat('d-m-Y H:i:s', $date_end)->format('Y-m-d H:i:s');
        $rangeCount = PriceRules::leftJoin('Prices', 'Prices.id', '=', 'PriceRules.price_id')
            ->leftJoin('PricesTranslation', 'PricesTranslation.price_id', '=', 'Prices.id')
            ->leftJoin('carmodels', 'carmodels.id', '=', 'PriceRules.model_id')
            ->where('PricesTranslation.locale', '=', $language)->where(function ($query) use ($from, $to) {
            $query->where(function ($query) use ($from, $to) {
                $query->where('start_date', '<=', $from)
                    ->where('end_date', '>=', $from);
            })->orWhere(function ($query) use ($from, $to) {
                $query->where('start_date', '<=', $to)
                    ->where('end_date', '>=', $to);
            })->orWhere(function ($query) use ($from, $to) {
                $query->where('start_date', '>=', $from)
                    ->where('end_date', '<=', $to);
            });
        })->where('PriceRules.price_id', $data['name'])
            ->where('PriceRules.model_id', $data['model'])
            ->where('PriceRules.gear_type', $data['gear'])
            ->where('PriceRules.isActive', 1);
            if(isset($data['rule_id']) && $data['rule_id'] != ''){

                $rangeCount->where('PriceRules.id', '!=', $data['rule_id']);
            }
        $rangeCount =$rangeCount->get();

        return $rangeCount;

    }

    public static function getRentExtras($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }
        $results = DB::table('RentalExtras')
            ->leftJoin('RentalExtrasTranslation', 'RentalExtrasTranslation.extra_id', '=', 'RentalExtras.id')
            ->where('RentalExtrasTranslation.locale', '=', $language)
            ->select('RentalExtras.id', 'RentalExtrasTranslation.RentExtraName', 'RentalExtras.isActive', 'RentalExtras.allow_choice', 'RentalExtras.choice_number','RentalExtras.Description', 'RentalExtras.MaxPrice', 'RentalExtras.RentExtraPrice' , 'RentalExtras.rental_extra_image');
        if(!$all){
            $results->where('RentalExtras.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function createRentalExtra($data){
        $new_rental_extra = new RentalExtras();

        if(isset($data->price) && $data->price !=''){

            $price = number_format($data->price,2);
        }else {
            $price = 0.00;
        }

        if(isset($data->max_price) && $data->max_price !=''){

            $max_price = number_format($data->max_price,2);
        }else {
            $max_price = 0.00;
        }

        if(isset($data->description) && $data->description !=''){

            $description = trim($data->description);
        }else {
            $description = null;
        }

        if(isset($data->check_number) && $data->check_number == 'on'){
            $new_rental_extra->allow_choice = 1;

            if($data->count_number != ''){
                $new_rental_extra->choice_number = $data->count_number;
            }else{
                $new_rental_extra->choice_number = null;
            }

        }else {
            $new_rental_extra->allow_choice = 0;
        }




        if(isset($data->image_name) && $data->image_name != ''){

            if(file_exists(public_path('tmp/').$data->image_name)){
                $success = \File::copy(public_path('tmp/').$data->image_name, public_path('img/cars/').$data->image_name);
                $new_rental_extra->rental_extra_image = $data->image_name;
                unlink(public_path('tmp/').$data->image_name);
            }

        }

        $new_rental_extra->RentExtraPrice = $data->price;
        $new_rental_extra->MaxPrice = $data->max_price;
        $new_rental_extra->Description = $description;

        if($new_rental_extra->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $new_rental_extra_translate = new RentalExtrasTranslation();
                $new_rental_extra_translate->extra_id = $new_rental_extra->id;
                $new_rental_extra_translate->locale = $k;
                if ($v != '') {
                    $new_rental_extra_translate->RentExtraName = $v;
                } else {
                    $new_rental_extra_translate->RentExtraName = $data->name_bg;
                }

                $new_rental_extra_translate->save();
            }
        }

        return $new_rental_extra_translate;
    }

    public static function editRentalExtra($data){
        $edit_rental_extra = RentalExtras::find ($data->rent_extra_id);
        $edit_rental_extra->isActive = $data->status;
        if(isset($data->price) && $data->price !=''){

            $price = number_format($data->price,2);
        }else {
            $price = 0.00;
        }

        if(isset($data->max_price) && $data->max_price !=''){

            $max_price = number_format($data->max_price,2);
        }else {
            $max_price = 0.00;
        }

        if(isset($data->description) && $data->description !=''){

            $description = trim($data->description);
        }else {
            $description = null;
        }

        if(isset($data->check_number) && $data->check_number == 'on'){
            $edit_rental_extra->allow_choice = 1;

            if($data->count_number != ''){
                $edit_rental_extra->choice_number = $data->count_number;
            }else{
                $edit_rental_extra->choice_number = null;
            }

        }else {
            $edit_rental_extra->allow_choice = 0;
        }

        $edit_rental_extra->RentExtraPrice = $data->price;
        $edit_rental_extra->MaxPrice = $data->max_price;
        $edit_rental_extra->Description = $description;

        if(isset($data->image_name) && $data->image_name != ''){
            $success = \File::copy(public_path('tmp/').$data->image_name, public_path('img/cars/').$data->image_name);
            $edit_rental_extra->rental_extra_image = $data->image_name;

            unlink(public_path('tmp/').$data->image_name);
            if($data->edit_image_name != 'car.png'){
                unlink(public_path('img/cars/').$data->edit_image_name);

            }
        }elseif ($data->image_name == '' && $data->edit_image_name_delete == 1){
            $edit_rental_extra->rental_extra_image = null;
            unlink(public_path('img/cars/').$data->edit_image_name);

        }

        if($edit_rental_extra->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];

            foreach ($data_inputs as $k => $v) {

                $edit_rental_extra_translate = RentalExtrasTranslation::where('extra_id', '=', $data->rent_extra_id )->where('locale', '=', $k)->first();
                $edit_rental_extra_translate->extra_id = $data->rent_extra_id;
                $edit_rental_extra_translate->locale = $k;
                if ($v != '') {
                    $edit_rental_extra_translate->RentExtraName = $v;
                } else {
                    $edit_rental_extra_translate->RentExtraName = $data->name_bg;
                }

                $edit_rental_extra_translate->save();
            }


        }

        return $edit_rental_extra;
    }

    public static function createCoupon($data){
        $new_cupon = new Coupons();
        $new_cupon->text = trim($data->name);
        $new_cupon->couponPrice = $data->price;
        if(isset($data->date_start)){
            $new_cupon->start_date = $data->date_start;
        }
        if(isset($data->date_end)){
            $new_cupon->end_date = $data->date_end;
        }
        if(isset($data->once)){
            $new_cupon->once = $data->once;
        }
        if(isset($data->percent)){
            $new_cupon->percent = $data->percent;
        }
        if(isset($data->description)){
            $new_cupon->description = $data->description;
        }
        $new_cupon->save ();

        return $new_cupon;
    }

    public static function editCoupon($data){
        $edit_coupon = Coupons::find ($data->coupon_id);

        $edit_coupon->text = trim($data->name);
        $edit_coupon->couponPrice = $data->price;
        if(isset($data->date_start)){
            $edit_coupon->start_date = $data->date_start;
        }else{
            $edit_coupon->start_date = null;
        }
        if(isset($data->date_end)){
            $edit_coupon->end_date = $data->date_end;
        }else{
            $edit_coupon->end_date = null;
        }

        if(isset($data->once)){
            $edit_coupon->once = $data->once;
        }else{
            $edit_coupon->once = 0;
        }
        if(isset($data->percent)){
            $edit_coupon->percent = $data->percent;
        }else{
            $edit_coupon->percent = 0;
        }
        if(isset($data->description)){
            $edit_coupon->description = $data->description;
        }
        $edit_coupon->save ();

        return $edit_coupon;
    }

    public static function getCoupons($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        if(!$all){
            $coupons = Coupons::where('isActive',1)->get();
        }else{
            $coupons = Coupons::all();
        }


        return $coupons;
    }

    public static function getInsurance($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }
        $results = DB::table('Insurance')
            ->leftJoin('InsuranceTranslations', 'InsuranceTranslations.insurance_id', '=', 'Insurance.id')
            ->where('InsuranceTranslations.locale', '=', $language)
            ->select('Insurance.id', 'InsuranceTranslations.insuranceName', 'Insurance.isActive', 'InsuranceTranslations.insuranceDescription', 'Insurance.isDefault','Insurance.insurancePrice');
        if(!$all){
            $results->where('Insurance.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function createInsurance($data){
        $new_insurance = new Insurance();

        if(isset($data->price) && $data->price !=''){

            $price = number_format($data->price,2);
        }else {
            $price = 0.00;
        }



        if(isset($data->default) && $data->default == 1){
            $new_insurance->isDefault = 1;

        }else {
            $new_insurance->isDefault = 0;
        }

        $new_insurance->insurancePrice = $price;


        if($new_insurance->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];
            $data_descr = ['bg' => $data->description_bg, 'en' => $data->description_en, 'de' => $data->description_de, 'ru' => $data->description_ru,];

            foreach ($data_inputs as $k => $v) {

                $new_insurance_translate = new InsuranceTranslations();
                $new_insurance_translate->insurance_id = $new_insurance->id;
                $new_insurance_translate->locale = $k;

                if ($v != '') {
                    $new_insurance_translate->insuranceName = $v;
                    if(isset($data_descr[$k]) && $data_descr[$k] !=''){

                        $description = trim($data_descr[$k]);
                    }else {
                        $description = null;
                    }
                } else {
                    $new_insurance_translate->insuranceName = $data->name_bg;
                    $description = trim($data->description_bg);
                }
                $new_insurance_translate->insuranceDescription = $description;

                $new_insurance_translate->save();

            }
        }

        return $new_insurance;
    }

    public static function editInsurance($data){
        $edit_insurance = Insurance::find ($data->insurance_id);
        $edit_insurance->isActive = $data->status;
        if(isset($data->price) && $data->price !=''){

            $price = number_format($data->price,2);
        }else {
            $price = 0.00;
        }



        if(isset($data->default) && $data->default == 1){
            $edit_insurance->isDefault = 1;

        }else {
            $edit_insurance->isDefault = 0;
        }

        $edit_insurance->insurancePrice = $price;


        if($edit_insurance->save ()) {
            $data_inputs = ['bg' => $data->name_bg, 'en' => $data->name_en, 'de' => $data->name_de, 'ru' => $data->name_ru,];
            $data_descr = ['bg' => $data->description_bg, 'en' => $data->description_en, 'de' => $data->description_de, 'ru' => $data->description_ru,];

            foreach ($data_inputs as $k => $v) {

                $edit_insurance_translate= InsuranceTranslations::where('insurance_id', '=', $data->insurance_id )->where('locale', '=', $k)->first();
                $edit_insurance_translate->insurance_id = $edit_insurance->id;
                $edit_insurance_translate->locale = $k;

                if ($v != '') {
                    $edit_insurance_translate->insuranceName = $v;
                    if(isset($data_descr[$k]) && $data_descr[$k] !=''){

                        $description = trim($data_descr[$k]);
                    }else {
                        $description = null;
                    }
                } else {
                    $edit_insurance_translate->insuranceName = $data->name_bg;
                    $description = trim($data->description_bg);
                }
                $edit_insurance_translate->insuranceDescription = $description;

                $edit_insurance_translate->save();

            }
        }

        return $edit_insurance;
    }



}
