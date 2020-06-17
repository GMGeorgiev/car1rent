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
            <div class="block-country-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-office">
                        New office
                    </button>
                </div>
                <div class="inactive-countries-checkbox" style="margin-left: 3%; margin-top: 20px;">
                    <label class="container-checkbox">In Active Offices
                        <input id="inActiveOffices" type="checkbox" {{($data['allOffices'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>

            <div class="offices">
                <h2>Offices</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-1">Office</div>
                        <div class="col col-1">City</div>
                        <div class="col col-1">{{ __('language.country')}}</div>
                        <div class="col col-1">Phone</div>
                        <div class="col col-1">Email</div>
                        <div class="col col-1">Address</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['offices'] as $office)
                        <?php $index++; ?>
                        <li class="table-row item_{{$index}}" style=" {{($office->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">
                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-1 cell name" data-label="{{ __('language.name')}}">{{$office->OfficeName}}</div>
                            <div class="col col-1 cell city" data-content="{{$office->CityID}}" data-label="City">{{$office->CityName}}</div>
                            <div class="col col-1 cell country" data-content="{{$office->CountryID}}" data-label="Country">{{$office->CountryName}}</div>
                            <div class="col col-1 cell phone" data-label="phone">{{$office->Phone}}</div>
                            <div class="col col-1 cell email" data-label="email">{{$office->email}}</div>
                            <div class="col col-1 cell address" data-label="address">{{$office->Address}}</div>
                            @if($office->isActive == 1)
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-office" data-item-id="{{$office->id}}">
                                    <i class="fa fa-edit"></i> {{ __('language.edit') }}
                                </button>
                                {{--<button type="button" class="btn btn-info responsive-btn-right" id="delete-office" data-item-id="{{$office->id}}">--}}
                                    {{--<i class="fa fa-trash"></i> {{ __('language.delete') }}--}}
                                {{--</button>--}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
    <div class="modal fade" id="create-modal-office">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Create Office</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.add-office', 'id'=>'createOfficeForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(Session::has('error'))
                        <div class="alert-box success">
                            <h2>{{ Session::get('error') }}</h2>
                        </div>
                    @endif
                    <div class="box-body">
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">Office Name</label>
                            <input type="text" class="form-control" name="name" id="name-office" placeholder="Enter Office name" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">City</label>
                            <select type="text" class="form-control" name="city" id="city-id" placeholder="Enter Type">
                                @if($data['cities'])
                                    @foreach($data['cities'] as $city)
                                        <option value="{{{$city->id}}}">{{{$city->CityName}}}</option>
                                    @endforeach
                                @endif
                            </select>
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
                        <div id="phone-group" class="form-group has-feedback @if ($errors->has('phone')) has-error @endif">
                            <label for="modal-input-phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone-office" placeholder="Enter Phone" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('phone')) has-error @endif"></span>
                            @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
                            <div id ="phone_error" class="help-text"></div>
                        </div>
                        <div id="email-group" class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="email" id="email-office" placeholder="Enter email">
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('email')) has-error @endif"></span>
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                            <div id ="email_error" class="help-text"></div>
                        </div>
                        <div id="address-group" class="form-group has-feedback @if ($errors->has('address')) has-error @endif">
                            <label for="modal-input-address">Address</label>
                            <input type="text" class="form-control" name="address" id="address-office" placeholder="Enter Address" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('address')) has-error @endif"></span>
                            @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
                            <div id ="address_error" class="help-text"></div>
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
    <div class="modal fade" id="edit-modal-office">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Edit Office</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.edit-office', 'id'=>'editOfficeForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(Session::has('error'))
                        <div class="alert-box success">
                            <h2>{{ Session::get('error') }}</h2>
                        </div>
                    @endif
                    <div class="box-body">
                        <input type="hidden" class="form-control" name="office_id" id="office-id-edit" placeholder="User ID" >
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">Office Name</label>
                            <input type="text" class="form-control" name="name" id="name-office-edit" placeholder="Enter Office name" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">City</label>
                            <select type="text" class="form-control" name="city" id="city-id-edit" placeholder="Enter City">
                                @if($data['cities'])
                                    @foreach($data['cities'] as $city)
                                        <option value="{{{$city->id}}}">{{{$city->CityName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country</label>
                            <select type="text" class="form-control" name="country" id="country-id-edit" placeholder="Enter Type">
                                @if($data['countries'])
                                    @foreach($data['countries'] as $country)
                                        <option value="{{{$country->id}}}">{{{$country->CountryName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="phone-group" class="form-group has-feedback @if ($errors->has('phone')) has-error @endif">
                            <label for="modal-input-phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone-office-edit" placeholder="Enter Phone" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('phone')) has-error @endif"></span>
                            @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
                            <div id ="phone_error" class="help-text"></div>
                        </div>
                        <div id="email-group" class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="email" id="email-office-edit" placeholder="Enter email">
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('email')) has-error @endif"></span>
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                            <div id ="email_error" class="help-text"></div>
                        </div>
                        <div id="address-group" class="form-group has-feedback @if ($errors->has('address')) has-error @endif">
                            <label for="modal-input-address">Address</label>
                            <input type="text" class="form-control" name="address" id="address-office-edit" placeholder="Enter Address" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('address')) has-error @endif"></span>
                            @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
                            <div id ="address_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>

                            <select type="text" class="form-control" name="status" id="status-edit-office" >
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
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
@endsection
        <style type="text/css">

        </style>