@extends('admin.home')

@section('content')
    @include('admin.menu')
    <div class="content">
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>

        <div class="admin-main">
            <div class="creat-admin">
                <div class="back" style=" float: right; margin-top: -27px; margin-right: 3px;">
                    <a href = '{{ route('admin.dashboard') }}'>{{  __('language.back')}}</a>
                </div>
            </div>
            <div class="block-country-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-model">
                        {{  __('language.new')}} {{  __('language.model')}}
                    </button>
                </div>
                <div class="inactive-countries-checkbox" style="margin-left: 3%; margin-top: 20px;">
                    <label class="container-checkbox">{{  __('language.inactive')}} {{  __('language.models')}}
                        <input id="inActiveModels" type="checkbox" {{($data['allModels'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>

            <div class="models">
                <h2>{{  __('language.models')}}</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-1">{{  __('language.photo')}}</div>
                        <div class="col col-1">{{  __('language.maker')}}</div>
                        <div class="col col-1">{{  __('language.model')}}</div>
                        <div class="col col-1">{{  __('language.year')}}</div>
                        <div class="col col-1">{{  __('language.type')}}</div>
                        <div class="col col-1">{{  __('language.price')}}</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['models'] as $model)
                        <?php $index++;
                        if($model->image && $model->image != ''){
                            $car_image = $model->image;
                        }else{
                            $car_image = 'car.png';
                        }
                        ?>
                        <li class="table-row item_{{$index}}" style=" {{($model->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">

                            <div class="col col-1 cell photo_name"  data-label="#" data-content="{{ $model->image }}" style="display: none"></div>
                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-1 cell photo" data-content="{{ URL::to('/') }}/img/cars/{{ $model->image }} " data-label="Photo"><img src="{{ URL::to('/') }}/img/cars/{{ $car_image }}" class="img-thumbnail" width="100" /></div>
                            <div class="col col-1 cell maker" data-content="{{$model->MakerID}}" data-label="Maker">{{$model->MakerName}}</div>
                            <div class="col col-1 cell name" data-label="Model">{{$model->ModelName}}</div>
                            <div class="col col-1 cell year"  data-label="Model Year">{{$model->ModelYear}}</div>
                            <div class="col col-1 cell type" data-content="{{$model->FleetTypeID}}" data-label="Maker">{{$model->FleetName}}</div>
                            <div class="col col-1 cell baseprice" data-label="address">{{$model->ModelBasePrice}}</div>
                            @if($model->isActive == 1)
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-model" data-item-id="{{$model->id}}">
                                    <i class="fa fa-edit"></i> {{ __('language.edit') }}
                                </button>
                                {{--<button type="button" class="btn btn-info responsive-btn-right" id="delete-model" data-item-id="{{$model->id}}">--}}
                                    {{--<i class="fa fa-trash"></i> {{ __('language.delete') }}--}}
                                {{--</button>--}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>
    <div class="modal fade" id="create-modal-model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.new')}} {{  __('language.model')}}</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.add-model', 'id'=>'createModelForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(Session::has('error'))
                        <div class="alert-box success">
                            <h2>{{ Session::get('error') }}</h2>
                        </div>
                    @endif
                    <div class="box-body">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{  __('language.maker')}}</label>
                            <select type="text" class="form-control" name="maker" id="maker-id" placeholder="Enter {{  __('language.maker')}}">
                                @if($data['makers'])
                                    @foreach($data['makers'] as $maker)
                                        <option value="{{{$maker->id}}}">{{{$maker->MakerName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">{{  __('language.model')}}</label>
                            <input type="text" class="form-control" name="name" id="name-city" placeholder="{{  __('language.enter')}} {{  __('language.model')}}" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div id="year-group" class="form-group has-feedback @if ($errors->has('year')) has-error @endif">
                            <label for="modal-input-year">{{  __('language.year')}}</label>
                            <input type="text" class="form-control" name="year" id="model-year" placeholder="{{  __('language.enter')}} {{  __('language.year')}}" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('year')) has-error @endif"></span>
                            @if ($errors->has('year')) <p class="help-block">{{ $errors->first('year') }}</p> @endif
                            <div id ="year_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{  __('language.type')}}</label>
                            <select type="text" class="form-control" name="type" id="type-id" placeholder="{{  __('language.enter')}} Type">
                                @if($data['types'])
                                    @foreach($data['types'] as $type)
                                        <option value="{{{$type->id}}}">{{{$type->FleetName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="price-group" class="form-group has-feedback @if ($errors->has('price')) has-error @endif">
                            <label for="modal-input-price">{{  __('language.price')}}</label>
                            <input type="text" class="form-control" name="price" id="model-price" placeholder="{{  __('language.enter')}} {{  __('language.price')}}" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price')) has-error @endif"></span>
                            @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
                            <div id ="price_error" class="help-text"></div>
                        </div>
                    </div>
                    <div id='preview-temp' style="">
                        <div id ="image_error" class="help-text"></div>
                        <input type="hidden" name="image_name" id="image_name" value="">
                        <div class="tiw" style="display: none; float: right;">
                            <button type="button" class="delete-image" id='delete-tmp-image' value='' id='delete-tmp-image'>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                    <div class="progress" style="display:none; margin-bottom: 14px; ">
                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <input type='file' name='file' id='file' class='' style=" width: 63%; margin-right: auto;;" >
                            <input type='button' class='btn btn-info'  value='Upload' id='upload'>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-modal-model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.edit')}} {{  __('language.model')}}</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'route' => 'admin.offices-settings.edit-model', 'id'=>'editModelForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(Session::has('error'))
                        <div class="alert-box success">
                            <h2>{{ Session::get('error') }}</h2>
                        </div>
                    @endif
                    <div class="box-body">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" class="form-control" name="model_id" id="model-id-edit" placeholder="User ID" >
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{  __('language.maker')}}</label>
                            <select type="text" class="form-control" name="maker" id="edit-maker-id" placeholder="Enter {{  __('language.maker')}}">
                                @if($data['makers'])
                                    @foreach($data['makers'] as $maker)
                                        <option value="{{{$maker->id}}}">{{{$maker->MakerName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                            <label for="modal-input-name">{{  __('language.model')}}</label>
                            <input type="text" class="form-control" name="name" id="model-name-edit" placeholder="{{  __('language.enter')}} {{  __('language.model')}}" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            <div id ="name_error" class="help-text"></div>
                        </div>
                        <div id="year-group" class="form-group has-feedback @if ($errors->has('year')) has-error @endif">
                            <label for="modal-input-year">{{  __('language.year')}}</label>
                            <input type="text" class="form-control" name="year" id="edit-model-year" placeholder="{{  __('language.enter')}} {{  __('language.year')}}" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('year')) has-error @endif"></span>
                            @if ($errors->has('year')) <p class="help-block">{{ $errors->first('year') }}</p> @endif
                            <div id ="year_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{  __('language.type')}}</label>
                            <select type="text" class="form-control" name="type" id="edit-type-id" placeholder="{{  __('language.enter')}} Type">
                                @if($data['types'])
                                    @foreach($data['types'] as $type)
                                        <option value="{{{$type->id}}}">{{{$type->FleetName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="price-group" class="form-group has-feedback @if ($errors->has('price')) has-error @endif">
                            <label for="modal-input-price">{{  __('language.price')}}</label>
                            <input type="text" class="form-control" name="price" id="edit-model-price" placeholder="{{  __('language.enter')}} {{  __('language.price')}}" >
                            <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price')) has-error @endif"></span>
                            @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
                            <div id ="price_error" class="help-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>

                            <select type="text" class="form-control" name="status" id="status-edit-model" >
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
                            </select>

                        </div>
                    </div>
                    <div id='preview' style="">
                            <input type="hidden" name="edit_image_name" id="edit-image_name" value="">
                        <input type="hidden" name="edit_image_name_delete" id="edit_image_name_delete" value="">
                        <div class="tiw_old" style="display: none; float: right;">
                            <button type="button" class="delete-image" id='delete-old-image-edit' value='' >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div id='preview-temp-edit' style="">
                        <div id ="image_error" class="help-text"></div>
                        <input type="hidden" name="image_name" id="image_name_edit" value="">
                        <div class="tiw" style="display: none; float: right;">
                            <button type="button" class="delete-image" id='delete-tmp-image-edit' value='' >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                    <div class="progress" style="display:none; margin-bottom: 14px; ">
                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type='file' name='file' id='file_edit' class='' style=" width: 63%; margin-right: auto;;" >
                        <input type='button' class='btn btn-info'  value='Upload' id='upload_edit'>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{--<script type="text/javascript">--}}

        {{--function validate(formData, jqForm, options) {--}}
            {{--var form = jqForm[0];--}}
            {{--if (!form.file.value) {--}}
                {{--alert('File not found');--}}
                {{--return false;--}}
            {{--}--}}
        {{--}--}}

        {{--(function() {--}}

            {{--var bar = $('.bar');--}}
            {{--var percent = $('.percent');--}}
            {{--var status = $('#status');--}}

            {{--$('form').ajaxForm({--}}
                {{--beforeSubmit: validate,--}}
                {{--beforeSend: function() {--}}
                    {{--status.empty();--}}
                    {{--var percentVal = '0%';--}}
                    {{--var posterValue = $('input[name=file]').fieldValue();--}}
                    {{--bar.width(percentVal)--}}
                    {{--percent.html(percentVal);--}}
                {{--},--}}
                {{--uploadProgress: function(event, position, total, percentComplete) {--}}
                    {{--var percentVal = percentComplete + '%';--}}
                    {{--bar.width(percentVal)--}}
                    {{--percent.html(percentVal);--}}
                {{--},--}}
                {{--success: function() {--}}
                    {{--var percentVal = 'Wait, Saving';--}}
                    {{--bar.width(percentVal)--}}
                    {{--percent.html(percentVal);--}}
                {{--},--}}
                {{--complete: function(xhr) {--}}
                    {{--status.html(xhr.responseText);--}}
                    {{--alert('Uploaded Successfully');--}}
                    {{--window.location.href = "/file-upload";--}}
                {{--}--}}
            {{--});--}}

        {{--})();--}}
    {{--</script>--}}
@endsection


