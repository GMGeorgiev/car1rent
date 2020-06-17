@extends('admin.home')

@section('content')
    @include('admin.menu')
    <div class="content">
        <div class="admin-main">
            <div class="creat-admin">
                <div class="back" style=" float: right; margin-top: -27px; margin-right: 3px;">
                    <a href = '{{ route('admin.dashboard') }}'>{{  __('language.back')}}</a>
                </div>
            </div>
            <div class="block-country-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-insurance">
                        {{  __('language.new')}} {{  __('language.insurance')}}
                    </button>
                </div>
                <div class="inactive-countries-checkbox" style="margin-left: 3%; margin-top: 20px;">
                    <label class="container-checkbox">{{  __('language.inactive')}} {{  __('language.insurance')}}
                        <input id="inActiveInsurance" type="checkbox" {{($data['allInsurance'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>
            <div class="models">
                <h2>{{  __('language.insurance_policies')}}</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-2">{{  __('language.insurance')}}</div>
                        <div class="col col-1">{{  __('language.price')}}</div>
                        <div class="col col-5" style="flex-basis: 18%;">{{  __('language.description')}}</div>
                        <div class="col col-1">{{ __('language.default')}}</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['insurance'] as $insurance)
                        <?php $index++;?>
                        <li class="table-row item_{{$index}}" style=" {{($insurance->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">

                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-2 cell name" data-content="{{$insurance->id}}" data-label="insurance">{{$insurance->insuranceName}}</div>
                            <div class="col col-1 cell price" data-label="price">{{$insurance->insurancePrice}}</div>
                            <div class="col col-5 cell description" data-label="price" style="flex-basis: 18%;">{{$insurance->insuranceDescription}}</div>
                            @if($insurance->isDefault == 1)
                                <div class="col col-1 cell default"  data-label="#" data-content="{{ $insurance->isDefault }}" data-number="{{ $insurance->isDefault }}">Да</div>
                            @else
                                <div class="col col-1 cell default"  data-label="#" data-content="{{ $insurance->isDefault }}" data-number="{{ $insurance->isDefault }}">Не</div>
                            @endif
                            @if($insurance->isActive == 1)
                                <div class="col col-1 cell status" data-content="{{$insurance->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status" data-content="{{$insurance->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-insurance" data-item-id="{{$insurance->id}}">
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
        <div class="modal fade" id="create-modal-insurance">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="    background-color: #68b0ea;">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.new')}} {{  __('language.insurance')}} </b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class='needs-validation' action="{{ route('admin.add-insurance') }}" method='POST' id='createInsuranceForm' novalidate>
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
                                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-input-name-{{$app_language->iso}}">{{$app_language->iso}}</span>
                                                    </div>
                                                    <input style="margin-right: 15px;" type="text"  class="form-control"  name="name_{{$app_language->iso}}" id="name-insurance-{{$app_language->iso}}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" {{($app_language->iso == 'bg')? 'required': ''}}>
                                                    <div class="invalid-feedback">
                                                        Въведете име на застраховка.
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-1" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text custom-input-group-text">{{  __('language.insurance') }}</span>
                                                </div>
                                                <input type="text"  class="form-control"  name="name_bg" id="name-insurance"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                                <div class="invalid-feedback">
                                                    Въведете Име на застраховка.
                                                </div>
                                            </div>
                                        @endif
                                    </fieldset>
                                </section>
                                <section style="margin: 10px;">
                                    <fieldset style="min-height:100px; width: auto">
                                        <legend><b> {{ __('language.description') }} </b> </legend>
                                        @if($data['app_languages'])
                                            @foreach ($data['app_languages'] as $app_language)
                                                <?php $lang = $app_language->iso; ?>
                                                <div class="input-group mb-3" id="name_{{$app_language->iso}}-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-input-description-{{$app_language->iso}}">{{$app_language->iso}}</span>
                                                    </div>
                                                    <textarea style="margin-right: 15px;" type="text"  class="form-control"  name="description_{{$app_language->iso}}" id="description-insurance-{{$app_language->iso}}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" {{($app_language->iso == 'bg')? 'required': ''}}></textarea>
                                                    <div class="invalid-feedback">
                                                        Въведете описание.
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-1" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text custom-input-group-text">{{  __('language.description') }}</span>
                                                </div>
                                                <textarea style="margin-right: 15px;" type="text"  class="form-control"  name="description_bg" id="description-insurance"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required></textarea>
                                                <div class="invalid-feedback">
                                                    Въведете описание.
                                                </div>
                                            </div>
                                        @endif
                                    </fieldset>
                                </section>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }}</span>
                                    </div>
                                    <input type="number" class="form-control" style="margin-right: 15px;" name="price" id="rent-insurance" aria-label="Sizing example input"  value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default" required>
                                    <div class="invalid-feedback">
                                        Въведете стойност на цена.
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.default') }}</span>
                                        <div class="input-group-text">
                                            <input class="check_number" type="checkbox" name="default" id="default" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="number" class="form-control count_number" name="def-descr" id="def-descr" aria-label="Text input with checkbox" placeholder="Застраховка по подразбиране" disabled>

                                </div>

                            </div>
                            <div class="error-message">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-modal-insurance">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="    background-color: #68b0ea;">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.edit')}} {{  __('language.insurance')}} </b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class='needs-validation' action="{{ route('admin.edit-insurance') }}" method='POST' id='editInsuranceForm' novalidate>
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
                                            <input type="hidden" class="form-control" name="insurance_id" id="insurance-id-edit" placeholder="Fleet ID" >
                                        @foreach ($data['app_languages'] as $app_language)
                                                <?php $lang = $app_language->iso; ?>
                                                <div class="input-group mb-1" id="name_{{$app_language->iso}}-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-input-name-{{$app_language->iso}}">{{$app_language->iso}}</span>
                                                    </div>
                                                    <input style="margin-right: 15px;" type="text"  class="form-control"  name="name_{{$app_language->iso}}" id="edit-name-insurance-{{$app_language->iso}}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" {{($app_language->iso == 'bg')? 'required': ''}}>
                                                    <div class="invalid-feedback">
                                                        Въведете име на застраховка.
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-1" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text custom-input-group-text">{{  __('language.insurance') }}</span>
                                                </div>
                                                <input type="text"  class="form-control"  name="name_bg" id="edit-name-insurance"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                                <div class="invalid-feedback">
                                                    Въведете Име на застраховка.
                                                </div>
                                            </div>
                                        @endif
                                    </fieldset>
                                </section>
                                <section style="margin: 10px;">
                                    <fieldset style="min-height:100px; width: auto">
                                        <legend><b> {{ __('language.description') }} </b> </legend>
                                        @if($data['app_languages'])
                                            @foreach ($data['app_languages'] as $app_language)
                                                <?php $lang = $app_language->iso; ?>
                                                <div class="input-group mb-3" id="name_{{$app_language->iso}}-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-input-description-{{$app_language->iso}}">{{$app_language->iso}}</span>
                                                    </div>
                                                    <textarea style="margin-right: 15px;" type="text"  class="form-control"  name="description_{{$app_language->iso}}" id="edit-description-insurance-{{$app_language->iso}}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" {{($app_language->iso == 'bg')? 'required': ''}}></textarea>
                                                    <div class="invalid-feedback">
                                                        Въведете описание.
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-1" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text custom-input-group-text">{{  __('language.description') }}</span>
                                                </div>
                                                <textarea style="margin-right: 15px;" type="text"  class="form-control"  name="description_bg" id="edit-description-insurance"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required></textarea>
                                                <div class="invalid-feedback">
                                                    Въведете описание.
                                                </div>
                                            </div>
                                        @endif
                                    </fieldset>
                                </section>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }}</span>
                                    </div>
                                    <input type="number" class="form-control" style="margin-right: 15px;" name="price" id="edit-insurance-price" aria-label="Sizing example input"  value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default" required>
                                    <div class="invalid-feedback">
                                        Въведете стойност на цена.
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.default') }}</span>
                                        <div class="input-group-text">
                                            <input class="check_number" type="checkbox" name="default" id="edit-default" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="number" class="form-control count_number" name="def-descr" id="def-descr" aria-label="Text input with checkbox" placeholder="Застраховка по подразбиране" disabled>

                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.status')}}</span>
                                    </div>
                                    <select class="custom-select" name="status" id="status-edit-insurance" required>
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

                            <div class="modal-footer">
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