@extends('admin.home')

@section('content')

    @include('admin.menu')
    <div class="content">
        <div style="margin: 8px 0px 0px 0px">
            <div class="creat-admin">
                <div class="back" style=" float: right; margin-top: 0px; margin-right: 3px;">
                    <a href = '{{ route('admin.dashboard') }}'>{{ __('language.back')}}</a>
                </div>
            </div>
            <div class="block-country-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-car">
                        {{  __('language.new')}}
                    </button>
                </div>
                <div class="filters">


                    {!! Form::open(['method'=>'GET','route'=>'admin.cars-settings.search-car-by-sipp','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
                    <div class="sipp-filters">
                        @foreach ($data['sipp_codes'] as $k_position =>$codes)

                            <div class="block-sipp" id="block-sipp_{{$k_position}}">
                                <label for="exampleInputEmail1">SIPP {{$k_position}}</label>

                                <select type="text" class="form-control sipp-select" name="filter_sipp_{{$k_position}}" id="filter-sipp-{{$k_position}}">
                                    <option value="-1">--</option>
                                    @foreach($codes as $code)
                                        <option value="{{$code['ID']}}" {{isset($data['filters']['filters_all_sipp'])&& $data['filters']['filters_all_sipp'][$k_position] == $code['ID']? 'selected="selected"' : '' }}>{{$code['Code']}} - {{$code['Description']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                            <div class="input-group-btn" style="margin-top: 32px; float: left;">
                     <button class="btn btn-default-sm" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="back" style=" margin-top: 78px;">
                                <a href = '{{ route('admin.cars-settings.cars') }}'>clear</a>
                            </div>

                    </div>

                    {!! Form::close() !!}
                </div>
                <div class="clear-border"></div>
                <div class="inactive-countries-checkbox" style="margin-top: 0px; margin-left: 3%;">
                    <label class="container-checkbox">{{  __('language.inactive')}}
                        <input id="inActiveCars" type="checkbox" {{($data['allCars'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>

            <div class="offices">
                <h2>{{  __('language.cars')}}</h2>
                <ul class="responsive-table">
                    <li class="table-header car-header" style="font-size: 13px; text-transform: none;">
                        <div class="col col-1 small-column">#</div>
                        <div class="col col-1 small-column">SIPP</div>
                        <div class="col col-2 medium-column">{{ __('language.regNumber')}}</div>
                        <div class="col col-1 medium-column">{{ __('language.maker')}}</div>
                        <div class="col col-1 big-column">{{ __('language.model')}}</div>
                        <div class="col col-2 medium-column">{{ __('language.office')}}</div>
                        <div class="col col-2 medium-column">{{ __('language.fuel')}}</div>
                        <div class="col col-2 medium-column">{{ __('language.coupe')}}</div>
                        <div class="col col-1 small-column">{{ __('language.year')}}</div>
                        <div class="col col-1 small-column hidden-column">{{ __('language.price')}}</div>
                        <div class="col col-1 small-column hidden-column">{{ __('language.doors')}}</div>
                        <div class="col col-1 small-column hidden-column">{{ __('language.seats')}}</div>
                        <div class="col col-1 small-column hidden-column">AC</div>
                        <div class="col col-1 small-column hidden-column">{{ __('language.tank')}} L</div>
                        <div class="col col-1 small-column hidden-column">{{ __('language.trunk')}} V</div>
                        <div class="col col-1 small-column hidden-column">{{ __('language.engine')}}</div>
                        <div class="col col-1 small-column">{{ __('language.gear')}}</div>
                        <div class="col col-1 small-column hidden-column">HP</div>
                        <div class="col col-1 small-column">{{ __('language.status')}}</div>
                        <div class="col col-3" style="text-align: center;"></div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['cars'] as $car)
                        <?php $index++; ?>

                        <li class="table-row item_{{$index}}" style=" font-size: 12px; {{($car->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">
                            <div class="col col-1 cell medium-column sipp1 hidden-column"  data-content="{{$car->sipp1_id}}" data-label="SIPP">{{$car->sipp1_id}}</div>
                            <div class="col col-1 cell medium-column sipp2 hidden-column"  data-content="{{$car->sipp2_id}}" data-label="SIPP">{{$car->sipp2_id}}</div>
                            <div class="col col-1 cell medium-column sipp3 hidden-column"  data-content="{{$car->sipp3_id}}" data-label="SIPP">{{$car->sipp3_id}}</div>
                            <div class="col col-1 cell medium-column sipp4 hidden-column"  data-content="{{$car->sipp4_id}}" data-label="SIPP">{{$car->sipp4_id}}</div>

                            <div class="col col-1 cell small-column iteration"  data-label="#">{{$index}}</div>
                            <div class="col col-1 cell small-column sipp"  data-label="SIPP">{{$car->SIPP}}</div>
                            <div class="col col-2 cell medium-column number"  data-label="RegNumber">{{$car->RegNumber}}</div>
                            <div class="col col-1 cell medium-column maker"  data-content="{{$car->MakerID}}" data-label="{{ __('language.maker')}}">{{$car->MakerName}}</div>
                            <div class="col col-1 cell big-column model"  data-content="{{$car->ModelID}}" data-label="{{ __('language.model')}}">{{$car->ModelName}}</div>
                            <div class="col col-2 cell medium-column office"  data-content="{{$car->OfficeID}}" data-label="Office">{{$car->OfficeName}}</div>
                            <div class="col col-2 cell medium-column fuel"  data-content="{{$car->FuelID}}" data-label="{{ __('language.fuel')}}">{{$car->FuelName}}</div>
                            <div class="col col-2 cell medium-column coupe" data-content="{{$car->CupeTypeID}}" data-label="{{ __('language.coupe')}}">{{$car->CoupeName}}</div>
                            <div class="col col-1 cell small-column years"  data-label="{{ __('language.year')}}">{{$car->ModelYear}}</div>
                            <div class="col col-1 cell small-column price hidden-column"  data-label="{{ __('language.price')}}">{{$car->CarBasePrice}}</div>
                            <div class="col col-1 cell small-column doors hidden-column"  data-label="Doors">{{$car->Doors}}</div>
                            <div class="col col-1 cell small-column seats hidden-column"  data-label="Seats">{{$car->Seats}}</div>
                            @if($car->AC == 1)
                                <div class="col col-1 cell small-column ac hidden-column" data-content="{{$car->AC}}" data-label="AC">Yes</div>
                            @else
                                <div class="col col-1 cell small-column ac hidden-column" data-content="{{$car->AC}}" data-label="AC">No</div>
                            @endif
                            <div class="col col-1 cell small-column tank hidden-column" data-label="Tank Liters">{{$car->TankCapacity}}</div>
                            <div class="col col-1 cell small-column trunk hidden-column"  data-label="Trunk Volume">{{$car->TrunkVolume}}</div>
                            <div class="col col-1 cell small-column engine hidden-column"  data-label="Engine">{{$car->Engine}}</div>
                            @if($car->GearType == 1)
                                <div class="col col-1 cell small-column gear"  data-content="{{$car->GearType}}" data-label="Gear Type">A</div>
                            @else
                                <div class="col col-1 cell small-column gear"   data-content="{{$car->GearType}}" data-label="Gear Type">M</div>
                            @endif
                            <div class="col col-1 cell small-column hp hidden-column" data-label="HP">{{$car->HP}}</div>
                            @if($car->isActive == 1)
                                <div class="col col-1 cell small-column status" data-content="{{$car->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell small-column status" data-content="{{$car->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell" style="    padding: 0;">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-car" data-item-id="{{$car->id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-info responsive-btn-right" id="copy-car" data-item-id="{{$car->id}}">
                                    <i class="fa fa-copy"></i>
                                </button>
                                <button type="button" class="btn btn-info responsive-btn-right" id="info-car" data-item-id="{{$car->id}}">
                                    <i class="fa fa-info"></i>
                                </button>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>
        <div class="modal fade" id="create-modal-car">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Create Car</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.cars-settings.add-car', 'id'=>'createCarForm']) !!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <div class="box-body">
                            <div id="number-group" class="form-group has-feedback @if ($errors->has('number')) has-error @endif">
                                <label for="modal-input-number">Reg Number</label>
                                <input type="text" class="form-control" name="number" id="number-car" placeholder="Enter Reg Number" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('number')) has-error @endif"></span>
                                @if ($errors->has('number')) <p class="help-block">{{ $errors->first('number') }}</p> @endif
                                <div id ="number_error" class="help-text"></div>
                            </div>
                            <div id="maker-group" class="form-group has-feedback @if ($errors->has('maker')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.maker')}}</label>
                                <select type="text" class="form-control" name="maker" id="maker-id" placeholder="Enter Maker">
                                    <option value="0">Select Maker</option>
                                    @if($data['makers'])
                                        @foreach($data['makers'] as $maker)
                                            <option value="{{{$maker->id}}}">{{{$maker->MakerName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('maker')) <p class="help-block">{{ $errors->first('maker') }}</p> @endif
                                <div id ="maker_error" class="help-text"></div>
                            </div>
                             <div id="model-group" class="form-group has-feedback @if ($errors->has('model')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.model')}}</label>
                                <select type="text" class="form-control" name="model" id="model-id" placeholder="Enter Model">
                                    @if($data['models'])
                                        <option value="0">Select Model</option>
                                        @foreach($data['models'] as $model)
                                            <option value="{{{$model->id}}}">{{{$model->ModelName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('model')) <p class="help-block">{{ $errors->first('model') }}</p> @endif
                                <div id ="model_error" class="help-text"></div>
                            </div>
                            <div id="office-group" class="form-group has-feedback @if ($errors->has('office')) has-error @endif">
                                <label for="exampleInputEmail1">Office</label>
                                <select type="text" class="form-control" name="office" id="office-id" placeholder="Enter Office">
                                    @if($data['officies'])
                                        <option value="0" selected="selected" >Select Office</option>
                                        @foreach($data['officies'] as $office)
                                            <option value="{{{$office->id}}}">{{{$office->OfficeName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('office')) <p class="help-block">{{ $errors->first('office') }}</p> @endif
                                <div id ="office_error" class="help-text"></div>
                            </div>
                            <div id="fuel-group" class="form-group has-feedback @if ($errors->has('fuel')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.fuel')}}</label>
                                <select type="text" class="form-control" name="fuel" id="fuel-id" placeholder="Enter Fuel">
                                    @if($data['fuels'])
                                        <option value="0">Select Fuel Type</option>
                                        @foreach($data['fuels'] as $fuel)
                                            <option value="{{{$fuel->id}}}">{{{$fuel->FuelName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('fuel')) <p class="help-block">{{ $errors->first('fuel') }}</p> @endif
                                <div id ="fuel_error" class="help-text"></div>
                            </div>
                            <div id="coupe-group" class="form-group has-feedback @if ($errors->has('coupe')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.coupe')}}</label>
                                <select type="text" class="form-control" name="coupe" id="coupe-id" placeholder="Enter Coupe">
                                    @if($data['coupes'])
                                        <option value="0">Select Coupe type</option>
                                        @foreach($data['coupes'] as $coupe)
                                            <option value="{{{$coupe->id}}}">{{{$coupe->CoupeName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('coupe')) <p class="help-block">{{ $errors->first('coupe') }}</p> @endif
                                <div id ="coupe_error" class="help-text"></div>
                            </div>
                            <div id="year-group" class="form-group has-feedback @if ($errors->has('year')) has-error @endif">
                                <label for="modal-input-year">{{ __('language.year')}}</label>
                                <input type="text" class="form-control" name="year" id="year-car" placeholder="Enter Car Year" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('year')) has-error @endif"></span>
                                @if ($errors->has('year')) <p class="help-block">{{ $errors->first('year') }}</p> @endif
                                <div id ="year_error" class="help-text"></div>
                            </div>
                            <div id="price-group" class="form-group has-feedback @if ($errors->has('price')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.price')}}</label>
                                <input type="text" class="form-control" name="price" id="price-car" placeholder="Enter Price">
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price')) has-error @endif"></span>
                                @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
                                <div id ="price_error" class="help-text"></div>
                            </div>
                            <div id="doors-group" class="form-group has-feedback @if ($errors->has('doors')) has-error @endif">
                                <label for="modal-input-doors">Doors</label>
                                <input type="text" class="form-control" name="doors" id="doors-car" placeholder="Enter Doors" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('doors')) has-error @endif"></span>
                                @if ($errors->has('doors')) <p class="help-block">{{ $errors->first('doors') }}</p> @endif
                                <div id ="doors_error" class="help-text"></div>
                            </div>
                            <div id="seats-group" class="form-group has-feedback @if ($errors->has('seats')) has-error @endif">
                                <label for="modal-input-seats">Seats</label>
                                <input type="text" class="form-control" name="seats" id="seats-car" placeholder="Enter Seats" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('seats')) has-error @endif"></span>
                                @if ($errors->has('seats')) <p class="help-block">{{ $errors->first('seats') }}</p> @endif
                                <div id ="seats_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">AC</label>

                                <select type="text" class="form-control" name="ac" id="ac" >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>

                            </div>
                            <div id="tank-group" class="form-group has-feedback @if ($errors->has('tank')) has-error @endif">
                                <label for="modal-input-trunk">Tank liters</label>
                                <input type="text" class="form-control" name="tank" id="tank" placeholder="Enter Tank liters" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('seats')) has-error @endif"></span>
                                @if ($errors->has('tank')) <p class="help-block">{{ $errors->first('tank') }}</p> @endif
                                <div id ="tank_error" class="help-text"></div>
                            </div>
                            <div id="trunk-group" class="form-group has-feedback @if ($errors->has('trunk')) has-error @endif">
                                <label for="modal-input-ac">Tank liters</label>
                                <input type="text" class="form-control" name="trunk" id="trunk" placeholder="Enter Trunk volume" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('trunk')) has-error @endif"></span>
                                @if ($errors->has('trunk')) <p class="help-block">{{ $errors->first('trunk') }}</p> @endif
                                <div id ="trunk_error" class="help-text"></div>
                            </div>
                            <div id="engine-group" class="form-group has-feedback @if ($errors->has('engine')) has-error @endif">
                                <label for="modal-input-engine">Engine Kw</label>
                                <input type="text" class="form-control" name="engine" id="engine" placeholder="Enter Engine Kw" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('engine')) has-error @endif"></span>
                                @if ($errors->has('engine')) <p class="help-block">{{ $errors->first('engine') }}</p> @endif
                                <div id ="engine_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gear Type</label>

                                <select type="text" class="form-control" name="gear" id="gear" >
                                    <option value="0">Manual</option>
                                    <option value="1">Automatic</option>
                                </select>

                            </div>
                            <div id="hp-group" class="form-group has-feedback @if ($errors->has('hp')) has-error @endif">
                                <label for="modal-input-hp">HP</label>
                                <input type="text" class="form-control" name="hp" id="hp" placeholder="Enter Engine HP" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('hp')) has-error @endif"></span>
                                @if ($errors->has('hp')) <p class="help-block">{{ $errors->first('hp') }}</p> @endif
                                <div id ="hp_error" class="help-text"></div>
                            </div>
                        </div>
                        <div class="sipp">
                            @foreach ($data['sipp_codes'] as $k_position =>$codes)

                            <div id="sipp_{{$k_position}}"  style="width: 24%;float: left; margin: 0.5%; text-align: center;">
                                <label for="exampleInputEmail1">SIPP {{$k_position}}</label>
                                <select type="text" class="form-control" name="sipp_{{$k_position}}" id="sipp-{{$k_position}}" >
                                    @foreach($codes as $code)
                                        <option value="{{$code['ID']}}|{{$code['Code']}}" data-content="{{$code['Code']}}">{{$code['Code']}} - {{$code['Description']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-modal-car">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Edit Car</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.cars-settings.edit-car', 'id'=>'editCarForm']) !!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <div class="box-body">
                            <input type="hidden" class="form-control" name="car_id" id="car-id-edit" placeholder="User ID" >
                            <div id="number-group" class="form-group has-feedback @if ($errors->has('number')) has-error @endif">
                                <label for="modal-input-number">Reg Number</label>
                                <input type="text" class="form-control" name="number" id="edit-number-car" placeholder="Enter Reg Number" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('number')) has-error @endif"></span>
                                @if ($errors->has('number')) <p class="help-block">{{ $errors->first('number') }}</p> @endif
                                <div id ="number_error" class="help-text"></div>
                            </div>
                            <div id="maker-group" class="form-group has-feedback @if ($errors->has('maker')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.maker')}}</label>
                                <select type="text" class="form-control" name="maker" id="edit-maker-id" placeholder="Enter Maker">
                                    <option value="0">Select Maker</option>
                                    @if($data['makers'])
                                        @foreach($data['makers'] as $maker)
                                            <option value="{{{$maker->id}}}">{{{$maker->MakerName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('maker')) <p class="help-block">{{ $errors->first('maker') }}</p> @endif
                                <div id ="maker_error" class="help-text"></div>
                            </div>
                            <div id="model-group" class="form-group has-feedback @if ($errors->has('model')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.model')}}</label>
                                <select type="text" class="form-control" name="model" id="edit-model-id" placeholder="Enter Model">
                                    @if($data['models'])
                                        <option value="0">Select Model</option>
                                        @foreach($data['models'] as $model)
                                            <option value="{{{$model->id}}}">{{{$model->ModelName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('model')) <p class="help-block">{{ $errors->first('model') }}</p> @endif
                                <div id ="model_error" class="help-text"></div>
                            </div>
                            <div id="office-group" class="form-group has-feedback @if ($errors->has('office')) has-error @endif">
                                <label for="exampleInputEmail1">Office</label>
                                <select type="text" class="form-control" name="office" id="edit-office-id" placeholder="Enter Office">
                                    @if($data['officies'])
                                        <option value="0">Select Office</option>
                                        @foreach($data['officies'] as $office)
                                            <option value="{{{$office->id}}}">{{{$office->OfficeName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('office')) <p class="help-block">{{ $errors->first('office') }}</p> @endif
                                <div id ="office_error" class="help-text"></div>
                            </div>
                            <div id="fuel-group" class="form-group has-feedback @if ($errors->has('fuel')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.fuel')}}</label>
                                <select type="text" class="form-control" name="fuel" id="edit-fuel-id" placeholder="Enter Fuel">
                                    @if($data['fuels'])
                                        <option value="0">Select Fuel Type</option>
                                        @foreach($data['fuels'] as $fuel)
                                            <option value="{{{$fuel->id}}}">{{{$fuel->FuelName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('fuel')) <p class="help-block">{{ $errors->first('fuel') }}</p> @endif
                                <div id ="fuel_error" class="help-text"></div>
                            </div>
                            <div id="coupe-group" class="form-group has-feedback @if ($errors->has('coupe')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.coupe')}}</label>
                                <select type="text" class="form-control" name="coupe" id="edit-coupe-id" placeholder="Enter Coupe">
                                    @if($data['coupes'])
                                        <option value="0">Select Coupe type</option>
                                        @foreach($data['coupes'] as $coupe)
                                            <option value="{{{$coupe->id}}}">{{{$coupe->CoupeName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('coupe')) <p class="help-block">{{ $errors->first('coupe') }}</p> @endif
                                <div id ="coupe_error" class="help-text"></div>
                            </div>
                            <div id="year-group" class="form-group has-feedback @if ($errors->has('year')) has-error @endif">
                                <label for="modal-input-year">{{ __('language.year')}}</label>
                                <input type="text" class="form-control" name="year" id="edit-year-car" placeholder="Enter Car Year" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('year')) has-error @endif"></span>
                                @if ($errors->has('year')) <p class="help-block">{{ $errors->first('year') }}</p> @endif
                                <div id ="year_error" class="help-text"></div>
                            </div>
                            <div id="price-group" class="form-group has-feedback @if ($errors->has('price')) has-error @endif">
                                <label for="exampleInputEmail1">{{ __('language.price')}}</label>
                                <input type="text" class="form-control" name="price" id="edit-price-car" placeholder="Enter Price">
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price')) has-error @endif"></span>
                                @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
                                <div id ="price_error" class="help-text"></div>
                            </div>
                            <div id="doors-group" class="form-group has-feedback @if ($errors->has('doors')) has-error @endif">
                                <label for="modal-input-doors">Doors</label>
                                <input type="text" class="form-control" name="doors" id="edit-doors-car" placeholder="Enter Doors" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('doors')) has-error @endif"></span>
                                @if ($errors->has('doors')) <p class="help-block">{{ $errors->first('doors') }}</p> @endif
                                <div id ="doors_error" class="help-text"></div>
                            </div>
                            <div id="seats-group" class="form-group has-feedback @if ($errors->has('seats')) has-error @endif">
                                <label for="modal-input-seats">Seats</label>
                                <input type="text" class="form-control" name="seats" id="edit-seats-car" placeholder="Enter Seats" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('seats')) has-error @endif"></span>
                                @if ($errors->has('seats')) <p class="help-block">{{ $errors->first('seats') }}</p> @endif
                                <div id ="seats_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">AC</label>

                                <select type="text" class="form-control" name="ac" id="edit-ac" >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>

                            </div>
                            <div id="tank-group" class="form-group has-feedback @if ($errors->has('tank')) has-error @endif">
                                <label for="modal-input-trunk">Tank liters</label>
                                <input type="text" class="form-control" name="tank" id="edit-tank" placeholder="Enter Tank liters" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('seats')) has-error @endif"></span>
                                @if ($errors->has('tank')) <p class="help-block">{{ $errors->first('tank') }}</p> @endif
                                <div id ="tank_error" class="help-text"></div>
                            </div>
                            <div id="trunk-group" class="form-group has-feedback @if ($errors->has('trunk')) has-error @endif">
                                <label for="modal-input-ac">Tank liters</label>
                                <input type="text" class="form-control" name="trunk" id="edit-trunk" placeholder="Enter Trunk volume" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('trunk')) has-error @endif"></span>
                                @if ($errors->has('trunk')) <p class="help-block">{{ $errors->first('trunk') }}</p> @endif
                                <div id ="trunk_error" class="help-text"></div>
                            </div>
                            <div id="engine-group" class="form-group has-feedback @if ($errors->has('engine')) has-error @endif">
                                <label for="modal-input-engine">Engine Kw</label>
                                <input type="text" class="form-control" name="engine" id="edit-engine" placeholder="Enter Engine Kw" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('engine')) has-error @endif"></span>
                                @if ($errors->has('engine')) <p class="help-block">{{ $errors->first('engine') }}</p> @endif
                                <div id ="engine_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gear Type</label>

                                <select type="text" class="form-control" name="gear" id="edit-gear" >
                                    <option value="0">Manual</option>
                                    <option value="1">Automatic</option>
                                </select>

                            </div>
                            <div id="hp-group" class="form-group has-feedback @if ($errors->has('hp')) has-error @endif">
                                <label for="modal-input-hp">HP</label>
                                <input type="text" class="form-control" name="hp" id="edit-hp" placeholder="Enter Engine HP" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('hp')) has-error @endif"></span>
                                @if ($errors->has('hp')) <p class="help-block">{{ $errors->first('hp') }}</p> @endif
                                <div id ="hp_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select type="text" class="form-control" name="status" id="edit-status" >
                                    <option value="0">In Active</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div id="current-sipp-group" class="form-group has-feedback">
                                <label for="modal-input-hp">Current SIPP CODE</label>
                                <input type="text" class="form-control" name="current-sipp" id="current-sipp" style="width: auto;"  disabled >
                            </div>
                            <div class="sipp">
                                @foreach ($data['sipp_codes'] as $k_position =>$codes)

                                    <div id="sipp_{{$k_position}}"  style="width: 24%;float: left; margin: 0.5%; text-align: center;">
                                        <label for="exampleInputEmail1">SIPP {{$k_position}}</label>
                                        <select type="text" class="form-control" name="sipp_{{$k_position}}" id="edit-sipp-{{$k_position}}" >
                                            @foreach($codes as $code)
                                                <option value="{{$code['ID']}}|{{$code['Code']}}" data-content="{{$code['Code']}}">{{$code['Code']}} - {{$code['Description']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="info-modal-car">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="    background-color: #68b0ea;">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Info Car</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {!! Form::open([ 'id'=>'infoCarForm']) !!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="box-body">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.regNumber')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-number-car" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.maker')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-maker-id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.model')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-model-id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.office')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-office-id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.fuel')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-fuel-id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.coupe')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-coupe-id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.year')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-year-car" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.price')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-price-car" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.doors')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-doors-car" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.seats')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-seats-car" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">AC</span>
                                </div>
                                <input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.tank')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-tank" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.trunk')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-trunk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.engine')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-engine" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.gear')}}</span>
                                </div>
                                <input type="text" class="form-control" id="info-gear" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">HP</span>
                                </div>
                                <input type="text" class="form-control" id="info-hp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">Status</span>
                                </div>
                                <input type="text" class="form-control" id="info-status" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">SIPP CODE</span>
                                </div>
                                <input type="text" class="form-control" id="info-current-sipp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

