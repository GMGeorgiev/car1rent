<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('lang/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/country_import', 'BaseRentController@importCountries');
Route::get('/', 'BaseRentController@goHome');
Route::get('/cars', 'BaseRentController@getCarsBase')->name('cars');
Route::get('/conditions', 'BaseRentController@getConditions')->name('conditions');

Route::get('events', 'EventController@index');

Route::prefix('search-cars')->group(function (){
    Route::match(array('GET', 'POST'), '/{data?}', array(
        'as' => 'search.cars.base',
        'uses' => 'BaseRentController@getSearchCars'
    ));
//    Route::get('/', 'BaseController@getSearchCars')->name('search.cars.base');

});
Route::prefix('booking')->group(function (){
//    Route::match(array('GET', 'POST'), '/', array(
//        'as' => 'search.cars.base',
//        'uses' => 'BaseController@getSearchCars'
//    ));
    Route::get('lang/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/', 'BaseRentController@getBooking')->name('booking');
    Route::post('/get-ajax-extras', 'BaseRentController@postGetAjaxExtras')->name('admin.get-ajax-extras');
    Route::post('/ajax-extras-add-remove', 'BaseRentController@postPutExtrasToForm')->name('booking.extras-add-remove');
    Route::post('/ajax-enter-coupon', 'BaseRentController@postEnterCoupon')->name('booking.enter-coupon');
    Route::post('/get-ajax-insurance', 'BaseRentController@postGetAjaxInsurance')->name('admin.get-ajax-insurance');
    Route::post('/ajax-insurance-add-remove', 'BaseRentController@postPutInsuranceToForm')->name('booking.insurance-add-remove');
    Route::post('/create-booking', 'BookingController@postCreateBooking')->name('booking.create-booking');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@getCustomerData')->name('profile');

Route::prefix('admin')->group(function (){
    Route::get('lang/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    });


    //dashboard routes
    Route::get('/dashboard', 'EventController@index')->name('admin.dashboard');
    Route::get('/ajax-events', 'AdminController@getEventData')->name('admin.ajax-evets');
    //end dashboard


    //cars routes
    Route::get('/cars-settings', 'AdminController@getCars')->name('admin.cars-settings');

    Route::prefix('cars-settings')->group(function (){
        Route::get('lang/{locale}', function ($locale){
            Session::put('locale', $locale);
            return redirect()->back();
        });
        Route::get('/makers', 'AdminController@getMakers')->name('admin.cars-settings.makers');
        Route::get('/models', 'AdminController@getModels')->name('admin.cars-settings.models');
        Route::get('/cars', 'AdminController@posGetCars')->name('admin.cars-settings.cars');
        Route::get('/car-extras', 'AdminController@getCarExtras')->name('admin.cars-settings.car-extras');
        Route::get('/fuels', 'AdminController@getFuels')->name('admin.cars-settings.fuels');
        Route::get('/fleets', 'AdminController@posGetFleets')->name('admin.cars-settings.fleets');
        Route::get('/coupes', 'AdminController@getCarCoupes')->name('admin.cars-settings.coupes');
        Route::get('/sipp-code', 'AdminController@getPosSIPPCodes')->name('admin.cars-settings.sipp-code');
    });

    Route::post('/add-maker', 'AdminController@postAddMakers')->name('admin.cars-settings.add-makers');
    Route::post('/edit-maker', 'AdminController@postEditMakers')->name('admin.cars-settings.edit-makers');
    Route::post('/delete-maker', 'AdminController@postDeleteMakers')->name('admin.cars-settings.delete-makers');

    Route::post('/add-fleet', 'AdminController@postAddFleet')->name('admin.offices-settings.add-fleet');
    Route::post('/get-type-fleet', 'AdminController@postGetTypeFleet')->name('admin.offices-settings.get-type-fleet');
    Route::post('/edit-fleet', 'AdminController@postEditFleet')->name('admin.offices-settings.edit-fleet');
    Route::post('/all-fleet', 'AdminController@getInactiveFleet')->name('admin.all.fleet');

    Route::post('/add-fuel', 'AdminController@postAddFuel')->name('admin.offices-settings.add-fuel');
    Route::post('/get-type-fuel', 'AdminController@postGetTypeFuel')->name('admin.offices-settings.get-type-fuel');
    Route::post('/edit-fuel', 'AdminController@postEditFuel')->name('admin.offices-settings.edit-fuel');
    Route::post('/all-fuels', 'AdminController@getInactiveFuels')->name('admin.all.fuels');

    Route::post('/add-model', 'AdminController@postAddModel')->name('admin.offices-settings.add-model');
    Route::post('/edit-model', 'AdminController@postEditModel')->name('admin.offices-settings.edit-model');
    Route::post('/temp-upload-image', 'AdminController@tempUploadImage')->name('admin.offices-settings.temp-upload-image');
    Route::post('/temp-delete-image', 'AdminController@tempDeleteImage')->name('admin.offices-settings.temp-delete-image');
    Route::post('/all-models', 'AdminController@getInactiveModels')->name('admin.all.models');

    Route::post('/add-car', 'AdminController@postAddCar')->name('admin.cars-settings.add-car');
    Route::post('/edit-car', 'AdminController@postEditCar')->name('admin.cars-settings.edit-car');
    Route::post('/all-cars', 'AdminController@getInactiveCars')->name('admin.all.cars');
    Route::post('/delete-car', 'AdminController@postDeleteCar')->name('admin.cars-settings.delete-car');
    Route::get('/search-car-by-sipp', 'AdminController@posGetCars')->name('admin.cars-settings.search-car-by-sipp');

    Route::post('/add-carextra', 'AdminController@postAddCarExtra')->name('admin.cars-settings.add-carextra');
    Route::post('/get-type-carextra', 'AdminController@postGetTypeCarExtra')->name('admin.cars-settings.get-type-carextra');
    Route::post('/edit-carextra', 'AdminController@postEditCarExtra')->name('admin.cars-settings.edit-carextra');
    Route::post('/all-carextras', 'AdminController@getInactiveCarExtras')->name('admin.all.carextras');

    Route::post('/add-coupe', 'AdminController@postAddCarCoupes')->name('admin.cars-settings.add-coupe');
    Route::post('/get-type-coupe', 'AdminController@postGetTypeCoupe')->name('admin.cars-settings.get-type-coupe');
    Route::post('/edit-coupe', 'AdminController@postEditCarCoupes')->name('admin.cars-settings.edit-coupe');
    Route::post('/all-coupes', 'AdminController@getInactiveCoupes')->name('admin.all.coupes');
    // end cars


    //user routes
    Route::get('/users', 'AdminController@getUsers')->name('admin.users');

    Route::post('/users-edit', 'AdminController@editUser')->name('admin.edit');
    Route::post('/users-create', 'AdminController@createUser')->name('admin.create');
    Route::post('/users-delete', 'AdminController@deleteUsers')->name('admin.delete.user');
    Route::post('/all-users', 'AdminController@getInactiveUsers')->name('admin.all.user');
    //end user routes

    // offices routes
    Route::get('/offices-settings', 'AdminController@getCountries')->name('admin.offices-settings');

    Route::prefix('offices-settings')->group(function (){
        Route::get('lang/{locale}', function ($locale){
            Session::put('locale', $locale);
            return redirect()->back();
        });
        Route::get('/countries', 'AdminController@getCountries')->name('admin.offices-settings.countries');
        Route::get('/city-to-city', 'AdminController@getCitiesTransfers')->name('admin.offices-settings.city-to-city');
        Route::get('/offices', 'AdminController@getOffices')->name('admin.offices-settings.offices');

    });

    Route::post('/add-country', 'AdminController@postAddCountries')->name('admin.offices-settings.add-country');
    Route::post('/edit-country', 'AdminController@postEditCountries')->name('admin.offices-settings.edit-countries');
    Route::post('/all-countries', 'AdminController@getInactiveCountries')->name('admin.all.countries');
    Route::post('/delete-country', 'AdminController@postDeleteCountries')->name('admin.offices-settings.delete-countries');

    Route::post('/add-city', 'AdminController@postAddCity')->name('admin.offices-settings.add-city');
    Route::post('/edit-city', 'AdminController@postEditCity')->name('admin.offices-settings.edit-city');
    Route::post('/all-cities', 'AdminController@getInactiveCities')->name('admin.all.cities');

    Route::post('/add-city-transfer', 'AdminController@postAddCityTransfer')->name('admin.offices-settings.add-city-transfer');
    Route::post('/edit-city-transfer', 'AdminController@postEditCityTransfer')->name('admin.offices-settings.edit-city-transfer');
    Route::post('/all-cities-transfer', 'AdminController@getInactiveCityTransfers')->name('admin.all.cities-transfer');

    Route::post('/add-office', 'AdminController@postAddOffice')->name('admin.offices-settings.add-office');
    Route::post('/edit-office', 'AdminController@postEditOffice')->name('admin.offices-settings.edit-office');
    //end office routes

    //price routes
    Route::get('/prices-settings', 'AdminController@getPriceSettings')->name('admin.prices-settings');
    Route::prefix('prices-settings')->group(function (){
        Route::get('lang/{locale}', function ($locale){
            Session::put('locale', $locale);
            return redirect()->back();
        });
        Route::get('/coupons', 'AdminController@getCouponsSettings')->name('admin.price-settings.coupons');
        Route::get('/price-rules', 'AdminController@getPriceRulesSettings')->name('admin.prices-settings.price-rules');

    });
    Route::post('/add-price', 'AdminController@postAddPrice')->name('admin.price-settings.add-price');

    Route::post('/edit-price', 'AdminController@postEditPrice')->name('admin.price-settings.edit-price');
    Route::post('/get-price-languages', 'AdminController@postGetTranslationsPrice')->name('admin.price-settings.get-price-languages');
    Route::post('/all-prices', 'AdminController@getInactivePrices')->name('admin.all.prices');
    Route::post('/all-price-rules', 'AdminController@getInactivePriceRules')->name('admin.all.price-rules');

    Route::post('/add-price-rule', 'AdminController@postAddPriceRule')->name('admin.price-settings.add-price-rule');
    Route::post('/edit-price-rule', 'AdminController@postEditPriceRule')->name('admin.price-settings.edit-price-rule');
    Route::post('/check-rule', 'AdminController@checkRuleExist')->name('admin.price-settings.check-rule');
    //end price

    //rental settings
    Route::get('/rental-settings', 'AdminController@getPriceSettings')->name('admin.rental-settings');
    Route::prefix('rental-settings')->group(function (){
        Route::get('lang/{locale}', function ($locale){
            Session::put('locale', $locale);
            return redirect()->back();
        });
        Route::get('/rent-extras', 'AdminController@getRentalExtras')->name('admin.rental-settings-extras');
        Route::get('/settings', 'AdminController@getRentalSettings')->name('admin.rental-settings-settings');
        Route::get('/insurance', 'AdminController@getRentalInsurance')->name('admin.rental-settings-insurance');

    });

    //booking menage
    Route::get('/menage-booking', 'AdminController@getPriceSettings')->name('admin.menage-booking');
    Route::prefix('menage-booking')->group(function (){
        Route::get('lang/{locale}', function ($locale){
            Session::put('locale', $locale);
            return redirect()->back();
        });
        Route::get('/car-giving', 'AdminController@getGivingCar')->name('admin.menage-booking-giving');


    });

    Route::post('/add-rent-extra', 'AdminController@postAddRentExtra')->name('admin.add-rent-extras');
    Route::post('/edit-rent-extra', 'AdminController@postEditRentExtra')->name('admin.edit-rent-extras');
    Route::post('/get-rent-extras-languages', 'AdminController@postGetTranslationsRentExtra')->name('admin.get-rent-extras-languages');
    Route::post('/all-rent-extras', 'AdminController@getInactiveRentExtras')->name('admin.all.rent-extras');

    Route::post('/add-coupon', 'AdminController@postAddCoupon')->name('admin.add-coupon');
    Route::post('/edit-coupon', 'AdminController@postEditCoupon')->name('admin.edit-coupon');
    Route::post('/all-coupons', 'AdminController@getInactiveCoupons')->name('admin.all.coupons');

    Route::post('/add-insurance', 'AdminController@postAddInsurance')->name('admin.add-insurance');
    Route::post('/all-insurance', 'AdminController@getInactiveInsurance')->name('admin.all.insurance');
    Route::post('/get-insurance-languages', 'AdminController@postGetTranslationsInsurance')->name('admin.get-insurance-languages');
    Route::post('/edit-insurance', 'AdminController@postEditInsurance')->name('admin.edit-insurance');



});

