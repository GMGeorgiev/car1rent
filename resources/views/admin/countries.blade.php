@extends('admin.home')

@section('content')
    @include('admin.menu')
    <div class="content">

        <div class="admin-main">
        <div class="creat-admin">
            <div class="back" style=" float: right; margin-top: -27px; margin-right: 3px;">
                <a href = '{{ route('admin.dashboard') }}'>Назад</a>
            </div>
        </div>



            <div class="block-cities-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" style="margin-top: 14px;" class="btn btn-primary" id="create-city">
                        Нов Град
                    </button>
                </div>
                <div class="inactive-cities-checkbox" style="margin-left: 3%; margin-top: 20px;">
                    <label class="container-checkbox">In Active Cities
                        <input id="inActiveCities" type="checkbox" {{($data['allCities'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>

            <div class="cities">
                <h2>Cities</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-1">City</div>
                        <div class="col col-1">{{ __('language.country')}}</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['cities'] as $city)
                        <?php $index++; ?>

                            <li class="table-row item_{{$index}}" style=" {{($city->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">
                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-1 cell name" data-label="{{ __('language.name')}}">{{$city->CityName}}</div>
                            <div class="col col-1 cell country" data-content="{{$city->CountryID}}" data-label="Prefix">{{$city->countriesName}}</div>
                            @if($city->isActive == 1)
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-city" data-item-id="{{$city->id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                {{--<button type="button" class="btn btn-info responsive-btn-right" id="delete-city" data-item-id="{{$city->id}}">--}}
                                    {{--<i class="fa fa-trash"></i> --}}
                                {{--</button>--}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

    </div>
    </div>

    </div>

    <div class="modal fade" id="create-modal-country">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Create Country</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.add-country', 'id'=>'createCountryForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(Session::has('error'))
                        <div class="alert-box success">
                            <h2>{{ Session::get('error') }}</h2>
                        </div>
                    @endif
                    <div class="box-body">
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">Country Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Country name" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div id="prefix-group" class="form-group has-feedback @if ($errors->has('prefix')) has-error @endif">
                            <label for="exampleInputEmail1">Country Prefix</label>
                            <input type="text" class="form-control" name="prefix" id="prefix" placeholder="Enter Country Prefix">
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('prefix')) has-error @endif"></span>
                            @if ($errors->has('prefix')) <p class="help-block">{{ $errors->first('prefix') }}</p> @endif
                            <div id ="prefix_error" class="help-text"></div>
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
    <div class="modal fade" id="create-modal-city">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Create City</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.add-city', 'id'=>'createCityForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(Session::has('error'))
                        <div class="alert-box success">
                            <h2>{{ Session::get('error') }}</h2>
                        </div>
                    @endif
                    <div class="box-body">
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">City Name</label>
                            <input type="text" class="form-control" name="name" id="name-city" placeholder="Enter City name" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country</label>
                            <select type="text" class="form-control" name="country" id="country-id" placeholder="Enter Type">
                                @if($data['countries'])
                                    @foreach($data['countries'] as $country)
                                        <option value="{{{$country->id}}}">{{{$country->CountryName}}}</option>
                                    @endforeach
                                @endif
                            </select>
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
    <div class="modal fade" id="edit-modal-country">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Edit Country</b></h4>
                    </div>

                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.edit-countries','id'=>'editCountryForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="box-body">
                        <input type="hidden" class="form-control" name="country_id" id="country-id-edit" placeholder="User ID" >
                        {{--</div>--}}
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">Country</label>
                            <input type="text" class="form-control" name="name" id="name-edit" placeholder="Enter name" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div id="prefix-group" class="form-group has-feedback @if ($errors->has('prefix')) has-error @endif">
                            <label for="exampleInputEmail1">Country Prefix</label>
                            <input type="text" class="form-control" name="prefix" id="prefix-edit" placeholder="Enter Country Prefix">
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('prefix')) has-error @endif"></span>
                            @if ($errors->has('prefix')) <p class="help-block">{{ $errors->first('prefix') }}</p> @endif
                            <div id ="prefix_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>

                            <select type="text" class="form-control" name="status" id="status-edit" >
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-modal-city">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Edit City</b></h4>
                    </div>

                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.edit-city','id'=>'editCityForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="box-body">
                        <input type="hidden" class="form-control" name="city_id" id="city-id-edit" placeholder="User ID" >
                        {{--</div>--}}
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">City</label>
                            <input type="text" class="form-control" name="name" id="city-name-edit" placeholder="Enter name" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country</label>
                            <select type="text" class="form-control" name="country" id="city-country-id-edit" placeholder="Enter Type">
                                @if($data['countries'])
                                    @foreach($data['countries'] as $country)
                                        <option value="{{{$country->id}}}">{{{$country->CountryName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>

                            <select type="text" class="form-control" name="status" id="status-edit-city" >
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Delete User</b></h4>
                    </div>

                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.delete.user','id'=>'deleteUserForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="box-body">
                        <div id="delete-text" class="delete-text @if ($errors->has('error-delete-message')) has-error @endif">
                            <p class="delete-text-message">Искате ли да изтрите този потребител:</p>
                            <div id ="delete_error" class="help-text"></div>
                        </div>
                        {{--<div class="form-group">--}}
                        {{--<label for="modal-input-id">User ID</label>--}}
                        <input type="hidden" class="form-control" name="user-id" id="user-id-delete" disabled >
                        {{--</div>--}}
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">Name</label>
                            <input type="text" class="form-control" name="name" id="name-delete" disabled>
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <input type="text" class="form-control" name="status" id="status-delete" disabled>
                            <select type="text" class="form-control" name="status" id="status-create" >
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
                            </select>
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('status')) has-error @endif"></span>
                            @if ($errors->has('status')) <p class="help-block">{{ $errors->first('status') }}</p> @endif
                            <div id ="status_error" class="help-text"></div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

