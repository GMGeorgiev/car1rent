<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App;
use DateTime;
use DateTimeZone;
use App\Offices;

class BaseHelper extends Model
{
    public static function getFleets($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = FleetTypes::leftJoin('FleetTypesTranslation', 'FleetTypesTranslation.fleetType_id', '=', 'fleettypes.id')
            ->where('FleetTypesTranslation.locale', '=', $language)
            ->select('fleettypes.id', 'FleetTypesTranslation.FleetName', 'fleettypes.isActive');
        if(!$all){
            $results->where('fleettypes.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function getCities($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }

        $results = DB::table('cities')
        ->leftJoin('Countries', 'Countries.id', '=', 'cities.CountryID')
            ->leftJoin('CountriesTranslation', 'CountriesTranslation.country_id', '=', 'Countries.id')
            ->leftJoin('CitiesTranslation', 'CitiesTranslation.city_id', '=', 'cities.id')
            ->select('cities.id', 'CitiesTranslation.DefaultName as CityName', 'CountriesTranslation.countryName as countriesName', 'Countries.id as CountryID', 'cities.isActive')
        ->where('CountriesTranslation.locale', '=', $language)
        ->where('CitiesTranslation.locale', '=', $language);
        if(!$all){
            $results->where('cities.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function getCitiesTransfer($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }

        $results = CarCityToCity::join('cities as c1', 'c1.id', '=', 'CarCityToCity.cityFromID')
            ->join('cities as c2', 'c2.id', '=', 'CarCityToCity.cityToID')
            ->join('CitiesTranslation as t1', 't1.city_id', '=', 'c1.id')
            ->join('CitiesTranslation as t2', 't2.city_id', '=', 'c2.id')
            ->select(['CarCityToCity.id', 'CarCityToCity.cityFromID', 'CarCityToCity.cityToID', 't1.DefaultName as DefaultNameFrom', 't2.DefaultName as DefaultNameTo', 'CarCityToCity.TransferPrice' , 'CarCityToCity.isActive'])
        ->where('t1.locale', '=', $language)
        ->where('t2.locale', '=', $language);

//        $results = CarCityToCity::leftJoin('Cities', 'Countries.id', '=', 'cities.CountryID')
//        ->leftJoin('Countries', 'Countries.id', '=', 'cities.CountryID')
//            ->leftJoin('CountriesTranslation', 'CountriesTranslation.country_id', '=', 'Countries.id')
//            ->select('cities.id', 'cities.CityName', 'CountriesTranslation.countryName as countriesName', 'Countries.id as CountryID', 'cities.isActive')
//            ->where('CountriesTranslation.locale', '=', $language);
        if(!$all){
            $results->where('CarCityToCity.isActive', '=', 1);
        }
        $results = $results->get();

        return $results;
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

    public static function getCars($all = null, $language = null, $filters = null){
        if ($language == null) {
            $language = App::getLocale();
        }
        if($filters && !isset($filters['search_data'])){
            $cities = BaseHelper::getCities();
            $fleet_types = BaseHelper::getFleets();
            if($cities && count($cities) > 0){
                foreach ($cities as $k => $city){
                    $filters['search_data']['cityIds'][$k] = $city->id;
                }
            }else{
                $filters['search_data']['cityIds']= [];
            }

            if($fleet_types && count($fleet_types) > 0){
                foreach ($fleet_types as $k => $fleet_type){
                    $filters['search_data']['fleetTypesIds'][$k] = $fleet_type->id;
                }
            }else{
                $filters['search_data']['fleetTypesIds'] = [];
            }

        }



        $cars = Cars::leftJoin('makers', 'makers.ID', '=', 'cars.MakerID')
            ->leftJoin('carmodels', 'carmodels.ID', '=', 'cars.ModelID')
            ->leftJoin('offices', 'offices.ID', '=', 'cars.OfficeID')
            ->leftJoin('fueltypes', 'fueltypes.ID', '=', 'cars.FuelID')
            ->leftJoin('FuelTypesTranslation', 'FuelTypesTranslation.fuel_id', '=', 'fueltypes.id')
            ->leftJoin('cupetypes', 'cupetypes.ID', '=', 'cars.CupeTypeID')
            ->leftJoin('CupeTypesTranslation', 'CupeTypesTranslation.cupeType_id', '=', 'cupetypes.id')
            ->leftJoin('fleettypes', 'fleettypes.ID', '=', 'carmodels.FleetTypeID')
            ->leftJoin('FleetTypesTranslation', 'FleetTypesTranslation.fleetType_id', '=', 'fleettypes.id')
            ->select('cars.id',
                DB::raw('count(*) as total'),
                'cars.RegNumber',
                'cars.ModelID',
                'carmodels.ModelName',
                'carmodels.image',
                'cars.MakerID',
                'makers.MakerName',
                'cars.FuelID',
                'FuelTypesTranslation.FuelName',
                'FleetTypesTranslation.FleetName',
                'cars.CupeTypeID',
                'CupeTypesTranslation.DefaultName as CoupeName',
                'cars.OfficeID',
                'offices.OfficeName',
                'offices.CityID',
                'cars.ModelYear',
                'cars.CarBasePrice',
//                'cars.image',
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
                'cars.isActive')
            ->where('cars.isActive',1)
            ->where('FuelTypesTranslation.locale', '=', $language)
            ->where('CupeTypesTranslation.locale', '=', $language)
            ->where('FleetTypesTranslation.locale', '=', $language)
            ->whereIn('offices.CityID', $filters['search_data']['cityIds'])
            ->whereIn('carmodels.FleetTypeID', $filters['search_data']['fleetTypesIds'])
//        if($filters && isset($filters['search_data'])){
//            if(isset($filters['search_data']['cityFrom'])){
//                $cars->where('offices.CityID', '=', $filters['search_data']['cityFrom']);
//            }
//            if(isset($filters['search_data']['fleet'])){
//                $cars->where('carmodels.FleetTypeID', '=', $filters['search_data']['fleet']);
//            }
//
//        }


        ->groupBy('cars.ModelID', 'cars.GearType', 'cars.AC')->paginate(10);
//        $cars->get();
//            $cars_result = $cars;
//        pr($cars); exit();

        $cars_data_end = self::getCarPriceRule($cars, $language, $filters);

        return $cars_data_end;
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

    public static function getCarPriceRule($car_data = null, $language = null , $filters = null){
        $now = new DateTime('now', new DateTimeZone('Europe/Sofia'));
        $dateNow = $now->format("Y-m-d H:i:s");
        $dateNowEnd = $now->format("Y-m-d 23:59:59");
        $TimeNow = $now->format("H:i:s");


        $date_start = $dateNow;
        $date_end = null;

        if ($language == null) {
            $language = App::getLocale();
        }


        if($filters && isset($filters['search_data'])){
                $dateFrom = null;
                $timeFrom = null;
                $dateTo = null;
                $timeTo = null;
                if(isset($filters['search_data']['dateFrom']) && $filters['search_data']['dateFrom'] != 0){
                    $dateFrom = $filters['search_data']['dateFrom'];

                    if(isset($filters['search_data']['timeFrom']) &&  $filters['search_data']['timeFrom'] != 0){
                        $timeFrom = $filters['search_data']['timeFrom'];
                        $dateFrom_date = new DateTime($dateFrom  . ' ' . $timeFrom);
                        $dateFrom_formated = $dateFrom_date->format("Y-m-d H:i:s");
                        $date_start = $dateFrom_formated;

                    } else {
                        $dateFrom_date = new DateTime($dateFrom  . ' 00:00:00' );
                        $dateFrom_formated = $dateFrom_date->format("Y-m-d H:i:s");
                        $date_start = $dateFrom_formated;
                    }

                }


                if(isset($filters['search_data']['dateTo'])  && $filters['search_data']['dateTo'] != 0 && $dateFrom){
                    $dateTo = $filters['search_data']['dateTo'];

                    if(isset($filters['search_data']['timeTo']) &&  $filters['search_data']['timeTo'] != 0){
                        $timeTo = $filters['search_data']['timeTo'];
                        $dateTo_date = new DateTime($dateTo  . ' ' . $timeTo);
                        $dateTo_formated = $dateTo_date->format("Y-m-d H:i:s");
                        $date_end = $dateTo_formated;

                    } else {
                        $dateTo_date = new DateTime($dateTo  . ' 23:59:59' );
                        $dateTo_formated = $dateTo_date->format("Y-m-d H:i:s");
                        $date_end = $dateTo_formated;
                    }

                }else{
                    if($dateFrom){
                        $dateTo_date = new DateTime($dateFrom  . ' 23:59:59' );
                        $dateFrom_formated = $dateTo_date->format("Y-m-d H:i:s");
                        $date_end = $dateFrom_formated;

                    }else{
                        $date_end= $dateNowEnd;

                    }

                }

        }else{
            $date_end= $dateNowEnd;

        }

        $filters['startDate'] = $date_start;
        $filters['endDate'] = $date_end;
        $caunt_days = self::daysBetween($date_start, $date_end);

        if($caunt_days && $caunt_days > 0){
            $filters['count_days'] = $caunt_days;

        }else{
            $filters['count_days'] = 1;
        }

        $car_rules = CarsToPriceRules::leftJoin('PriceRules', 'CarsToPriceRules.RuleID', '=', 'PriceRules.id')
            ->leftJoin('Prices', 'Prices.id', '=', 'PriceRules.price_id')
            ->leftJoin('PricesTranslation', 'PricesTranslation.price_id', '=', 'Prices.id')
            ->where('PricesTranslation.locale', '=', $language)
            ->where('CarsToPriceRules.isActive', 1)->get();
//        $rules = PriceRules::where('PriceRules.isActive', 1)
//            ->leftJoin('Prices', 'Prices.id', '=', 'PriceRules.price_id')
//            ->leftJoin('PricesTranslation', 'PricesTranslation.price_id', '=', 'Prices.id')
//            ->leftJoin('carmodels', 'carmodels.id', '=', 'PriceRules.model_id')
//            ->where('PricesTranslation.locale', '=', $language)
//            ->get();

        if($car_data && count($car_data) > 0){
            foreach ($car_data as $k => $car) {
                $car_data[$k]->count_days = $filters['count_days'];
                if($car_rules && count($car_rules) > 0){
                foreach ($car_rules as $rule_info) {
//TODO filters start end
                    if ($filters['startDate'] >= $rule_info->start_date && $filters['startDate'] < $rule_info->end_date) {
                        if ($car->id == $rule_info->CarID) {

                            if(isset($filters['count_days']) && $filters['count_days'] > 1){
                                $priceRuleData = new \stdClass();

                                if($filters['count_days'] >= 2 && $filters['count_days'] <= 4){
                                    if($rule_info->discount_percent != 0){
                                        $priceRuleData->discount_price = self::getDiscountPrice($rule_info->price_2_4_days, $rule_info->discount_percent) * $filters['count_days'];
                                        $priceRuleData->discount_percent = $rule_info->discount_percent;
                                        $car_data[$k]->discountPrice = $priceRuleData->discount_price;
                                        $car_data[$k]->discountPercent = $priceRuleData->discount_percent;
                                    }
                                    $priceRuleData->Name = $rule_info->Name;
                                    $priceRuleData->price = $rule_info->price_2_4_days * $filters['count_days'];
                                    $car_data[$k]->PriceName = $rule_info->Name;
                                    $car_data[$k]->NormalPrice = $priceRuleData->price ;


                                }elseif ($filters['count_days'] >= 5 && $filters['count_days'] <= 7){

                                    if($rule_info->discount_percent != 0){
                                        $priceRuleData->discount_price =  self::getDiscountPrice($rule_info->price_5_7_days, $rule_info->discount_percent) * $filters['count_days'];
                                        $priceRuleData->discount_percent = $rule_info->discount_percent;
                                        $car_data[$k]->discountPrice = $priceRuleData->discount_price;
                                        $car_data[$k]->discountPercent = $priceRuleData->discount_percent;
                                    }
                                    $priceRuleData->Name = $rule_info->Name;
                                    $priceRuleData->price = $rule_info->price_5_7_days * $filters['count_days'];
                                    $car_data[$k]->priceRule = $priceRuleData;
                                    $car_data[$k]->NormalPrice = $priceRuleData->price ;
                                    $car_data[$k]->PriceName = $rule_info->Name;

                                }elseif ($filters['count_days'] >= 8 && $filters['count_days'] <= 15){

                                    if($rule_info->discount_percent != 0){
                                        $priceRuleData->price_8_15_days = self::getDiscountPrice($rule_info->price_8_15_days, $rule_info->discount_percent) * $filters['count_days'];
                                        $priceRuleData->discount_percent = $rule_info->discount_percent;
                                        $car_data[$k]->discountPrice = $priceRuleData->discount_price;
                                        $car_data[$k]->discountPercent = $priceRuleData->discount_percent;

                                    }
                                    $priceRuleData->Name = $rule_info->Name;
                                    $priceRuleData->price = $rule_info->price_8_15_days * $filters['count_days'];
                                    $car_data[$k]->NormalPrice = $priceRuleData->price ;
                                    $car_data[$k]->PriceName = $rule_info->Name;


                                }elseif ($filters['count_days'] >= 16 && $filters['count_days'] <= 30){

                                    if($rule_info->discount_percent != 0){
                                        $priceRuleData->price_16_30_days = self::getDiscountPrice($rule_info->price_16_30_days, $rule_info->discount_percent) * $filters['count_days'];
                                        $priceRuleData->discount_percent = $rule_info->discount_percent;
                                        $car_data[$k]->discountPrice = $priceRuleData->discount_price;
                                        $car_data[$k]->discountPercent = $priceRuleData->discount_percent;
                                    }
                                    $priceRuleData->Name = $rule_info->Name;
                                    $priceRuleData->price = $rule_info->price_16_30_days * $filters['count_days'];
                                    $car_data[$k]->NormalPrice = $priceRuleData->price ;
                                    $car_data[$k]->PriceName = $rule_info->Name;


                                }elseif ($filters['count_days'] >= 31){

                                    if($rule_info->discount_percent != 0){
                                        $priceRuleData->price_31_days = self::getDiscountPrice($rule_info->price_31_days, $rule_info->discount_percent) * $filters['count_days'];
                                        $priceRuleData->discount_percent = $rule_info->discount_percent;
                                        $car_data[$k]->discountPrice = $priceRuleData->discount_price;
                                        $car_data[$k]->discountPercent = $priceRuleData->discount_percent;
                                    }
                                    $priceRuleData->Name = $rule_info->Name;
                                    $priceRuleData->price = $rule_info->price_31_days * $filters['count_days'];
                                    $car_data[$k]->priceRule = $priceRuleData;
                                    $car_data[$k]->NormalPrice = $priceRuleData->price ;
                                    $car_data[$k]->PriceName = $rule_info->Name;

                                }elseif ($rule_info->price_weekend){

                                    if($rule_info->discount_percent != 0){
                                        $priceRuleData->discount_price = self::getDiscountPrice($rule_info->price_weekend, $rule_info->discount_percent) * $filters['count_days'];
                                        $priceRuleData->discount_percent = $rule_info->discount_percent;
                                        $car_data[$k]->discountPrice = $priceRuleData->discount_price;
                                        $car_data[$k]->discountPercent = $priceRuleData->discount_percent;
                                    }
                                    $priceRuleData->Name = $rule_info->Name;
                                    $priceRuleData->price = $rule_info->price_weekend * $filters['count_days'];
                                    $car_data[$k]->priceRule = $priceRuleData;
                                    $car_data[$k]->NormalPrice = $priceRuleData->price ;
                                    $car_data[$k]->PriceName = $rule_info->Name;

                                }
                                $car_data[$k]->priceRule = $priceRuleData;
                            } else {
                                $priceRuleData = new \stdClass();
                                if($rule_info->discount_percent != 0){
                                    $priceRuleData->discount_price = self::getDiscountPrice($rule_info->price_day, $rule_info->discount_percent);
                                    $priceRuleData->discount_percent = $rule_info->discount_percent;
                                    $car_data[$k]->discountPrice = $priceRuleData->discount_price;
                                    $car_data[$k]->discountPercent = $priceRuleData->discount_percent;
                                }
                                $priceRuleData->Name = $rule_info->Name;
                                $priceRuleData->price = $rule_info->price_day;
                                $car_data[$k]->priceRule = $priceRuleData;
                                $car_data[$k]->NormalPrice = (double)$priceRuleData->price ;
                                $car_data[$k]->PriceName = $rule_info->Name;

                            }


//                            if($rule_info->discount_percent != 0){
//                                $discounts_all = new \stdClass();
//                                $discounts_all->price_day = self::getDiscountPrice($rule_info->price_day, $rule_info->discount_percent);
//                                $discounts_all->price_2_4_days = self::getDiscountPrice($rule_info->price_2_4_days, $rule_info->discount_percent);
//                                $discounts_all->price_5_7_days = self::getDiscountPrice($rule_info->price_5_7_days, $rule_info->discount_percent);
//                                $discounts_all->price_8_15_days = self::getDiscountPrice($rule_info->price_8_15_days, $rule_info->discount_percent);
//                                $discounts_all->price_16_30_days = self::getDiscountPrice($rule_info->price_16_30_days, $rule_info->discount_percent);
//                                $discounts_all->price_31_days = self::getDiscountPrice($rule_info->price_31_days, $rule_info->discount_percent);
//                                $discounts_all->price_weekend = self::getDiscountPrice($rule_info->price_weekend, $rule_info->discount_percent);
//                                $rule_info->discounts = $discounts_all;
//
//                            }
//                            $car_data[$k]->priceRule = $rule_info;
//
//
//                            pr($car_data); exit();

                        }

                    }

                }


                }

                if(!$car_data[$k]->priceRule){
                    if(isset($filters['count_days']) && $filters['count_days'] > 1){
                        $_oprice = $car_data[$k]->CarBasePrice;
                        $car_data[$k]->CarBasePrice *= $filters['count_days'];
                        $car_data[$k]->NormalPrice = number_format((float)$_oprice * $filters['count_days'], 2, '.', '') ;

                    }

                }
            }
        }

        return $car_data;

    }

    public static function getDiscountPrice($price, $percent){
        $discount_price = $price - ($price * ($percent / 100));
        return $discount_price;

    }


//    public static function getNumberOfDaysTwoDates($dateStart = null, $dateEnd = null){
//
//        $startTimeStamp = strtotime($dateStart);
//        $endTimeStamp = strtotime($dateEnd);
//
//        $timeDiff = abs($endTimeStamp - $startTimeStamp);
//        $numberDays = round($timeDiff / (60 * 60 * 24));  // 86400 seconds in one day
//
//
//        // and you might want to convert to integer
//        $numberDays = intval($numberDays);
//
//        return $numberDays;
//
//    }

    /**
     * Number of days between two dates.
     *
     * @param date $dt1    First date
     * @param date $dt2    Second date
     * @return int
     */
    public static function daysBetween($dt1, $dt2) {
        return date_diff(
            date_create($dt2),
            date_create($dt1)
        )->format('%a');
    }


    public static function getCarInfo($data, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }
        $cars = Cars::leftJoin('makers', 'makers.ID', '=', 'cars.MakerID')
            ->leftJoin('carmodels', 'carmodels.ID', '=', 'cars.ModelID')
            ->leftJoin('offices', 'offices.ID', '=', 'cars.OfficeID')
            ->leftJoin('fueltypes', 'fueltypes.ID', '=', 'cars.FuelID')
            ->leftJoin('FuelTypesTranslation', 'FuelTypesTranslation.fuel_id', '=', 'fueltypes.id')
            ->leftJoin('cupetypes', 'cupetypes.ID', '=', 'cars.CupeTypeID')
            ->leftJoin('CupeTypesTranslation', 'CupeTypesTranslation.cupeType_id', '=', 'cupetypes.id')
            ->leftJoin('fleettypes', 'fleettypes.ID', '=', 'carmodels.FleetTypeID')
            ->leftJoin('FleetTypesTranslation', 'FleetTypesTranslation.fleetType_id', '=', 'fleettypes.id')
            ->select('cars.id',
                'cars.RegNumber',
                'cars.ModelID',
                'carmodels.ModelName',
                'carmodels.image',
                'cars.MakerID',
                'makers.MakerName',
                'cars.FuelID',
                'FuelTypesTranslation.FuelName',
                'FleetTypesTranslation.FleetName',
                'cars.CupeTypeID',
                'CupeTypesTranslation.DefaultName as CoupeName',
                'cars.OfficeID',
                'offices.OfficeName',
                'offices.CityID',
                'cars.ModelYear',
                'cars.CarBasePrice',
//                'cars.image',
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
                'cars.isActive')
            ->where('cars.isActive',1)
            ->where('cars.ModelID',$data['modelID'])
            ->where('cars.GearType',$data['gear'])
            ->where('cars.OfficeID',$data['officeID'])
            ->where('FuelTypesTranslation.locale', '=', $language)
            ->where('CupeTypesTranslation.locale', '=', $language)
            ->where('FleetTypesTranslation.locale', '=', $language)
            ->groupBy('cars.ModelID')
            ->get();

        if($cars){
            $cars_rules = self::getCarPriceRule($cars, null, $data);
        }

        return $cars;
    }

    public static function getRentExtras($all = null, $language = null){

        if ($language == null) {
            $language = App::getLocale();
        }

        $results = RentalExtras::leftJoin('RentalExtrasTranslation', 'RentalExtrasTranslation.extra_id', '=', 'RentalExtras.id')
            ->where('RentalExtrasTranslation.locale', '=', $language)
            ->select('RentalExtras.id', 'RentalExtrasTranslation.RentExtraName', 'RentalExtras.RentExtraPrice', 'RentalExtras.MaxPrice', 'RentalExtras.allow_choice', 'RentalExtras.choice_number', 'RentalExtras.Description', 'RentalExtras.rental_extra_image', 'RentalExtras.isActive');
        if(!$all){
            $results->where('RentalExtras.isActive', '=', 1);
        }
        $results = $results->paginate(100);

        return $results;
    }

    public static function getCheckCoupon($coupon, $customer = null){
        $result = null;
        $now = new DateTime('now', new DateTimeZone('Europe/Sofia'));
        $dateNow = $now->format("Y-m-d H:i:s");

        $surcheCoupon = Coupons::where('text', '=' , $coupon)->where('isActive', 1)->first();
        if($surcheCoupon){
            if($surcheCoupon->start_date && $surcheCoupon->start_date > $dateNow){
                return $result;
            }

            if($surcheCoupon->end_date && $surcheCoupon->end_date < $dateNow){
                return $result;
            }

            if($surcheCoupon->once){
                if($customer){
                    $isUsed = CouponResults::where('couponID',$surcheCoupon->id)->where('customerID', $customer)->first();
                    if($isUsed){
                        return $result;
                    }

                }else{
                    return $surcheCoupon;
                }

            }

            $result = $surcheCoupon;
            return $surcheCoupon;
        }else{
            return $result;

        }

    }

    public static function getInsurance($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }

        $results = Insurance::leftJoin('InsuranceTranslations', 'InsuranceTranslations.insurance_id', '=', 'Insurance.id')
            ->select('Insurance.id', 'InsuranceTranslations.insuranceName', 'InsuranceTranslations.insuranceDescription', 'Insurance.isActive', 'Insurance.isDefault', 'Insurance.insurancePrice')
            ->where('InsuranceTranslations.locale', '=', $language);
        if(!$all){
            $results->where('Insurance.isActive', '=', 1);
        }
        $results = $results->paginate(100);
        return $results;
    }

    public static function getPaymentTypes($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }

        $results = PaymentTypes::leftJoin('PaymentTypeTranslations', 'PaymentTypeTranslations.PaymentTypeID', '=', 'PaymentTypes.id')
            ->select('PaymentTypes.id', 'PaymentTypeTranslations.PaymentTypeName', 'PaymentTypeTranslations.PaymentTypeDescription', 'PaymentTypes.isActive')
            ->where('PaymentTypeTranslations.locale', '=', $language);
        if(!$all){
            $results->where('PaymentTypes.isActive', '=', 1);
        }
        $results = $results->paginate(100);
        return $results;
    }

    public static function getPaymentStatuses($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }

        $results = PaymentStatuses::leftJoin('PaymentStatusTranslations', 'PaymentStatusTranslations.PaymentStatusID', '=', 'PaymentStatuses.id')
            ->select('PaymentStatuses.id', 'PaymentStatusTranslations.PaymentStatusName', 'PaymentStatuses.isActive')
            ->where('PaymentStatusTranslations.locale', '=', $language);
        if(!$all){
            $results->where('PaymentStatuses.isActive', '=', 1);
        }
        $results = $results->paginate(100);
        return $results;
    }

    public static function getCityOffices($cityID,$language = null){

        if ($language == null) {
            $language = App::getLocale();
        }
        $results = DB::table('offices')
        ->leftJoin('OfficiesTranslations', 'OfficiesTranslations.officeID', '=', 'offices.id')
            ->where('offices.isActive', '=', 1)
            ->where('offices.CityID', '=', $cityID)
            ->where('OfficiesTranslations.locale', '=', $language)
            ->select('offices.id',
                'OfficiesTranslations.officeName',
                'OfficiesTranslations.officeAddress',
                'offices.CountryID',
                'offices.CityID',
                'offices.lat',
                'offices.lon',
                'offices.Phone',
                'offices.MobilePhone',
                'offices.Fax',
                'offices.email',
                'offices.office_image_url',
                'offices.isActive')
            ->get();

        return $results;
    }

    public static function getMyCompany($all = null, $language = null){
        if ($language == null) {
            $language = App::getLocale();
        }

        $results = MyCompany::leftJoin('MyCompanyTranslations', 'MyCompanyTranslations.companyID', '=', 'MyCompany.id')
            ->select('MyCompany.id', 'MyCompanyTranslations.companyName', 'MyCompanyTranslations.companyAddress', 'MyCompany.companyPhone', 'MyCompany.companyEmail', 'MyCompany.beginWork', 'MyCompany.endWork', 'MyCompany.isActive')
            ->where('MyCompanyTranslations.locale', '=', $language)
            ->where('MyCompany.isActive', '=', 1)->first();

//        $results = $results->first();
        return $results;
    }



}
