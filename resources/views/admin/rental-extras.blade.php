@extends('admin.home')

@section('content')

    @include('admin.menu')
    <div class="content">
        {{--<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>--}}
        {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>--}}
        {{--<script src="http://malsup.github.com/jquery.form.js"></script>--}}

        <div class="admin-main">
            <div class="creat-admin">
                <div class="back" style=" float: right; margin-top: -27px; margin-right: 3px;">
                    <a href = '{{ route('admin.dashboard') }}'>{{  __('language.back')}}</a>
                </div>
            </div>
            <div class="block-country-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-rent-extras">
                        {{  __('language.new')}} Extra
                    </button>
                </div>
                <div class="inactive-countries-checkbox" style="margin-left: 3%; margin-top: 20px;">
                    <label class="container-checkbox">{{  __('language.inactive')}} Extras
                        <input id="inActiveRentExtras" type="checkbox" {{($data['allRentExtras'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>

            <div class="models">
                <h2>Extras</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-1">{{  __('language.photo')}}</div>
                        <div class="col col-2">Extra</div>
                        <div class="col col-1">{{  __('language.price')}}</div>
                        <div class="col col-1">{{  __('language.price')}} max</div>
                        <div class="col col-5" style="flex-basis: 18%;">Description</div>
                        <div class="col col-1">Allow choice</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['rent_extras'] as $extra)
                        <?php $index++;
                        if($extra->rental_extra_image && $extra->rental_extra_image != ''){
                            $rent_extra_image = $extra->rental_extra_image;
                        }else{
                            $rent_extra_image = 'extra-icon.jpg';
                        }
                        ?>
                        <li class="table-row item_{{$index}}" style=" {{($extra->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">

                            <div class="col col-1 cell photo_name"  data-label="#" data-content="{{ $extra->rental_extra_image }}" style="display: none"></div>
                            {{--<div class="col col-1 cell allow_choice"  data-label="#" data-content="{{ $extra->allow_choice }}" style="display: none"></div>--}}
                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-1 cell photo" data-content="{{ URL::to('/') }}/img/cars/{{ $extra->rental_extra_image }} " data-label="Photo"><img src="{{ URL::to('/') }}/img/cars/{{ $rent_extra_image }}" class="img-thumbnail" width="50" /></div>
                            <div class="col col-2 cell name" data-content="{{$extra->id}}" data-label="Extra">{{$extra->RentExtraName}}</div>
                            <div class="col col-1 cell price" data-label="price">{{$extra->RentExtraPrice}}</div>
                            <div class="col col-1 cell price_max" data-label="price">{{$extra->MaxPrice}}</div>
                            <div class="col col-5 cell description" data-label="price" style="flex-basis: 18%;">{{$extra->Description}}</div>
                            @if($extra->allow_choice)
                                <div class="col col-1 cell allow_choice"  data-label="#" data-content="{{ $extra->allow_choice }}" data-number="{{ $extra->choice_number }}">Да</div>
                            @else
                                <div class="col col-1 cell allow_choice"  data-label="#" data-content="{{ $extra->allow_choice }}" data-number="{{ $extra->choice_number }}">Не</div>
                            @endif
                            @if($extra->isActive == 1)
                                <div class="col col-1 cell status" data-content="{{$extra->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status" data-content="{{$extra->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-rent-extra" data-item-id="{{$extra->id}}">
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


    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>
    <div class="modal fade" id="create-modal-rent-extra">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="    background-color: #68b0ea;">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.new')}} Extra</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form class='needs-validation' action="{{ route('admin.add-rent-extras') }}" method='POST' id='createRentExtraForm' novalidate>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <div class="box-body">
                            <section style="margin: 10px;">
                                <fieldset style="min-height:100px; width: auto">
                                    <legend><b> {{ __('language.name') }} </b> </legend>
                                    @if($data['app_languages'])
                                        @foreach ($data['app_languages'] as $app_language)
                                            <?php $lang = $app_language->iso; ?>
                                                <div class="input-group mb-1" id="name_{{$app_language->iso}}-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-input-name-{{$app_language->iso}}">{{ __('language.name') }}-{{$app_language->iso}}</span>
                                                    </div>
                                                    <input type="text"  class="form-control"  name="name_{{$app_language->iso}}" id="name-rent-extra-{{$app_language->iso}}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" {{($app_language->iso == 'bg')? 'required': ''}}>
                                                    <div class="invalid-feedback">
                                                        Въведете име на екстрата.
                                                    </div>
                                                </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-1" >
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text">{{  __('language.extra') }}</span>
                                            </div>
                                            <input type="text"  class="form-control"  name="name_bg" id="name-rent-extra"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Въведете Име на екстрата.
                                            </div>
                                        </div>
                                    @endif
                                </fieldset>
                            </section>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }}</span>
                                </div>
                                <input type="number" class="form-control" style="margin-right: 15px;" name="price" id="rent-extra-price" aria-label="Sizing example input"  value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default">
                                <div class="invalid-feedback">
                                    Въведете стойност на цена.
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }} max</span>
                                </div>
                                <input type="number" class="form-control" style="margin-right: 15px;" name="max_price" id="rent-extra-max_price" aria-label="Sizing example input"  value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">Description</span>
                                </div>
                                <textarea type="text" class="form-control" style="margin-right: 15px;" name="description" id="description" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" ></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">Брой</span>
                                    <div class="input-group-text">
                                        <input class="check_number" type="checkbox" name="check_number" id="check_number" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <input type="number" class="form-control count_number" name="count_number" id="count_number" aria-label="Text input with checkbox" placeholder="Въведете максимална бройка за избор" disabled>
                            </div>

                        </div>
                        <div class="error-message">

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
                            <button type="submit" class="btn btn-primary ">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="edit-modal-rent-extra">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="    background-color: #68b0ea;">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.edit')}} Extra</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class='needs-validation' action="{{ route('admin.edit-rent-extras') }}" method='POST' id='editRentExtraForm' novalidate>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            @if(Session::has('error'))
                                <div class="alert-box success">
                                    <h2>{{ Session::get('error') }}</h2>
                                </div>
                            @endif
                            <div class="box-body">
                                <section style="margin: 10px;">
                                    <fieldset style="min-height:100px; width: auto">
                                        <legend><b> {{ __('language.name') }} </b> </legend>
                                        @if($data['app_languages'])
                                            <input type="hidden" class="form-control" name="rent_extra_id" id="rent-extra-id-edit" placeholder="Fleet ID" >
                                            @foreach ($data['app_languages'] as $app_language)
                                                <?php $lang = $app_language->iso; ?>
                                                <div class="input-group mb-1" id="name_{{$app_language->iso}}-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-input-name-{{$app_language->iso}}">{{ __('language.name') }}-{{$app_language->iso}}</span>
                                                    </div>
                                                    <input type="text"  class="form-control"  name="name_{{$app_language->iso}}" id="name-rent-extra-{{$app_language->iso}}-edit"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" {{($app_language->iso == 'bg')? 'required': ''}}>
                                                    <div class="invalid-feedback">
                                                        Въведете име на екстрата.
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-1" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text custom-input-group-text">{{  __('language.extra') }}</span>
                                                </div>
                                                <input type="text"  class="form-control"  name="name_bg" id="name-rent-extra-edit"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                                <div class="invalid-feedback">
                                                    Въведете Име на екстрата.
                                                </div>
                                            </div>
                                        @endif
                                    </fieldset>
                                </section>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }}</span>
                                    </div>
                                    <input type="number" class="form-control" style="margin-right: 15px;" name="price" id="rent-extra-price-edit" aria-label="Sizing example input"  value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default" >
                                    <div class="invalid-feedback">
                                        Въведете стойност на цена.
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }} max</span>
                                    </div>
                                    <input type="number" class="form-control" style="margin-right: 15px;" name="max_price" id="rent-extra-max_price-edit" aria-label="Sizing example input"  value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default" >
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">Description</span>
                                    </div>
                                    <textarea type="text" class="form-control" style="margin-right: 15px;" name="description" id="description-edit" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" ></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">Брой</span>
                                        <div class="input-group-text">
                                            <input class="check_number" type="checkbox" name="check_number" id="check_number_edit" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="number" class="form-control count_number" name="count_number" id="count_number_edit" aria-label="Text input with checkbox" placeholder="Въведете максимална бройка за избор" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.status')}}</span>
                                    </div>
                                    <select class="custom-select" name="status" id="status-edit-rent-extra" required>
                                        <option value="0">In Active</option>
                                        <option value="1">Active</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Изберете тип на скоростната кутия.
                                    </div>
                                    {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                                </div>

                            </div>
                            <div class="error-message">

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
                                <button type="submit" class="btn btn-primary ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <script  type="text/javascript">

        (function() {
            'use strict';
            window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();


    </script>

@endsection

<style type="text/css">


</style>