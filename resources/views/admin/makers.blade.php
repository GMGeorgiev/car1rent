@extends('admin.home')

@section('content')
    @include('admin.menu')
    <div class="content">
        <div class="form-group row addMaker" style="margin-top: 38px;">
            <div class="col-md-8">
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="Enter some name" required>
                <p class="error text-center alert alert-danger hidden"></p>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit" id="addMaker">
                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        {{ csrf_field() }}

        <div class="table-responsive text-center">
            <table class="table table-borderless" id="table">
                <thead>
                <tr>
                    <th style="display:none;" class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                @foreach($data as $item)
                    <tr class="item{{$item->id}}">
                        <td style="display:none;">{{$item->id}}</td>
                        <td>{{$item->MakerName}}</td>
                        <td><button  class="edit-modal-maker btn btn-info" data-id="{{$item->id}}"
                                    data-name="{{$item->MakerName}}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="delete-modal-maker btn btn-danger" data-id="{{$item->id}}"
                                    data-name="{{$item->MakerName}}">
                                <i class="fa fa-trash"></i> Delete
                            </button></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Edit Maker</b></h4>
                    </div>

                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group hidden">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="n">
                            </div>
                        </div>
                    </form>
                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="dname"></span> ? <span
                                class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn actionBtn" data-dismiss="modal">
                                <span id="footer_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
