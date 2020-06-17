@extends('admin.home')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.menu')
    <div id="content" class="content">

        {{--<script--}}
                {{--src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>--}}
        {{--<link rel="stylesheet"--}}
              {{--href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
        {{--<link rel="stylesheet"--}}
              {{--href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">--}}

        <div class="admin-main">
            <div class="creat-admin">
                {{--{!! Form::open(['method' => 'get', 'route' => 'users.create']) !!}--}}
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-item">
                        Нов
                    </button>
                </div>
                {{--{!! Form::close() !!}--}}

                <div class="back" style=" float: right; margin-top: -27px; margin-right: 3px;">
                    <a href = '{{ route('admin.dashboard') }}'>Назад</a>

                </div>
            </div>

            <div class="inactive-user-checkbox">
                <label class="container-checkbox">In Active Users
                    <input id="inActiveUsers" type="checkbox" {{($data['allUsers'] == true)? 'checked=checked' :''}}>
                    <span class="checkmark-checkbox"></span>
                </label>

            </div>
            <div class="test">
                <h2>{{ __('language.usersInfo') }}</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-1">{{ __('language.name')}}</div>
                        <div class="col col-1">{{ __('language.username')}}</div>
                        <div class="col col-3">{{ __('language.email')}}</div>
                        <div class="col col-1">{{ __('language.type')}}</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-2">{{ __('language.created')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['users'] as $users)
                        <?php $index++; ?>
                        <li class="table-row item_{{$index}}" style=" {{($users->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">
                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-1 cell name" data-label="{{ __('language.name')}}">{{$users->name}}</div>
                            <div class="col col-1 cell user-name" data-label="{{ __('language.username')}}">{{$users->username}}</div>
                            <div class="col col-3 cell email" data-label="{{ __('language.email')}}">{{$users->email}}</div>
                            <div class="col col-1 cell role" data-label="{{ __('language.type')}}">{{$users->TypeName}}</div>
                            @if($users->isActive == 1)
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-2 cell create" data-label="{{ __('language.created')}}">{{$users->created_at}}</div>
                            <div class="col col-3 cell">


                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-item" data-item-id="{{$users->id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-info responsive-btn-right" id="delete-item" data-item-id="{{$users->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

       </div>

        <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Edite User</b></h4>
                        </div>

                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.edit','id'=>'editUserForm']) !!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="box-body">
                            {{--<div class="form-group">--}}
                            {{--<label for="modal-input-id">User ID</label>--}}
                            <input type="hidden" class="form-control" name="user-id" id="user-id-create" placeholder="User ID" >
                            {{--</div>--}}
                            <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                                <label for="modal-input-name">Name</label>
                                <input type="text" class="form-control" name="name" id="name-create" placeholder="Enter name" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                <div id ="name_error" class="help-text"></div>
                            </div>
                            <div id="username-group" class="form-group has-feedback @if ($errors->has('username')) has-error @endif">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" name="username" id="username-create" placeholder="Enter username">
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('username')) has-error @endif"></span>
                                @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                                <div id ="username_error" class="help-text"></div>
                            </div>
                            <div id="email-group" class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" name="email" id="email-create" placeholder="Enter email">
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('email')) has-error @endif"></span>
                                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                <div id ="email_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <select type="text" class="form-control" name="role" id="role-create" placeholder="Enter Type">
                                    @if($data['userTypes'])
                                        @foreach($data['userTypes'] as $types)
                                            <option value="{{{$types->ID}}}">{{{$types->TypeName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                {{--<input type="text" class="form-control" name="status" id="status" placeholder="Enter status">--}}
                                <select type="text" class="form-control" name="status" id="status-create" >
                                    <option value="1">Active</option>
                                    <option value="2">In Active</option>
                                </select>

                            </div>
                            <div id="password-group" class="form-group has-feedback @if ($errors->has('password')) has-error @endif">
                                <label for="exampleInputEmail1">Password</label>
                                {!! Form::password('password', array('id'=>'password-create', 'class' => 'text input form-control', 'placeholder'=>'New Password')) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('password')) has-error @endif"></span>
                                @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                                <div id ="password_error" class="help-text"></div>
                            </div>

                            <div id="password_confirmation-group" class="form-group has-feedback @if ($errors->has('password_confirmation')) has-error @endif">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                {!! Form::password('password_confirmation', array('id'=>'password_confirmation-create', 'class' => 'text input form-control', 'placeholder'=>'Confirm New Password')) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('password_confirmation')) has-error @endif"></span>
                                @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                                <div id ="password_confirm_error" class="help-text"></div>
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

        <div class="modal fade" id="create-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Create User</b></h4>
                        </div>

                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.create', 'id'=>'createUserForm']) !!}
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="box-body">
                            {{--<div class="form-group">--}}
                            {{--<label for="modal-input-id">User ID</label>--}}
                            {{--<input type="text" class="form-control" name="modal-input-id" id="modal-input-id" placeholder="User ID" >--}}
                            {{--</div>--}}
                            <div id="name-group" class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                                <label for="modal-input-name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" >
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                <div id ="name_error" class="help-text"></div>
                            </div>
                            <div id="username-group" class="form-group has-feedback @if ($errors->has('username')) has-error @endif">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('username')) has-error @endif"></span>
                                @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                                <div id ="username_error" class="help-text"></div>
                            </div>
                            <div id="email-group" class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('email')) has-error @endif"></span>
                                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                <div id ="email_error" class="help-text"></div>
                            </div>
                            <div id="role-group" class="form-group has-feedback @if ($errors->has('role')) has-error @endif">
                                <label for="exampleInputEmail1">Type</label>
                                <select type="text" class="form-control" name="role" id="role" placeholder="Enter Type">
                                    @if($data['userTypes'])
                                        @foreach($data['userTypes'] as $types)
                                            <option value="{{{$types->ID}}}">{{{$types->TypeName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<label for="exampleInputEmail1">Status</label>--}}
                            {{--<input type="text" class="form-control" name="modal-input-status" id="modal-input-status" placeholder="Enter status">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="exampleInputEmail1">Password</label>--}}
                            {{--<input type="password" class="form-control" name="password" placeholder="Enter password">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="exampleInputEmail1">Confirm Password</label>--}}
                            {{--<input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">--}}
                            {{--</div>--}}

                            <div id="password-group" class="form-group has-feedback @if ($errors->has('password')) has-error @endif">
                                <label for="exampleInputEmail1">Password</label>
                                {!! Form::password('password', array('id'=>'password', 'class' => 'text input form-control', 'placeholder'=>'New Password')) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('password')) has-error @endif"></span>
                                @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                                <div id ="password_error" class="help-text"></div>
                            </div>

                            <div id="password_confirmation-group" class="form-group has-feedback @if ($errors->has('password_confirmation')) has-error @endif">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'class' => 'text input form-control', 'placeholder'=>'Confirm New Password')) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('password_confirmation')) has-error @endif"></span>
                                @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                                <div id ="password_confirm_error" class="help-text"></div>
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
                            <div id="username-group" class="form-group has-feedback @if ($errors->has('username')) has-error @endif">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" name="username" id="username-delete" disabled>
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('username')) has-error @endif"></span>
                                @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                                <div id ="username_error" class="help-text"></div>
                            </div>
                            <div id="email-group" class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" name="email" id="email-delete" disabled>
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('email')) has-error @endif"></span>
                                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                <div id ="email_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <input type="text" class="form-control" name="role" id="role-delete" disabled>
                                <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('role')) has-error @endif"></span>
                                @if ($errors->has('role')) <p class="help-block">{{ $errors->first('role') }}</p> @endif
                                <div id ="role_error" class="help-text"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <input type="text" class="form-control" name="status" id="status-delete" disabled>
                                {{--<select type="text" class="form-control" name="status" id="status-create" >--}}
                                {{--<option value="1">Active</option>--}}
                                {{--<option value="2">In Active</option>--}}
                                {{--</select>--}}
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
    </div>


@endsection
<script>

</script>
