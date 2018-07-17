@extends('layouts.superadminlayout')

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">@if(empty($id)) Create @else Update @endif User</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{!! URL::route('super.admin.dashboard') !!}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{!! URL::route('users.list') !!}">All Users</a></li>
                    <li class="breadcrumb-item">@if(empty($id)) Create @else Update @endif User</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel-body demo-panel-files" id='demo-files'></div>
                            <div id="notificationMessage"></div>
                            <div  id="loginform" class="create-company form-horizontal form-material">
                                <!-- <h4 class="invisible ">Create Company</h4> -->
                                {!! Form::model($data, ['id' => 'data-form', 'class' => 'form-horizontal','files'=> true]) !!}
                                <div class="row">
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name','required' => 'required', 'placeholder' => 'Name']) !!}
                                            </div>
                                            <div class="form-group col-6">
                                                {!! Form::text('sur_name', null, ['class' => 'form-control', 'id' => 'sur_name', 'placeholder' => 'Sur Name','required' => 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title','required' => 'required']) !!}
                                            </div>
                                            <div class="form-group col-6">
                                                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email','required' => 'required', 'placeholder' => 'Email']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            @php
                                                $required = false;
                                                if(empty($data))
                                                   $required = true;
                                            @endphp
                                            <div class="form-group col-6">
                                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password','required' => $required]) !!}
                                            </div>
                                            <div class="form-group col-6">
                                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Confirm Password','required' => $required]) !!}
                                            </div>
                                        </div>
                                        <div style="color: red; padding-bottom: 5px; font-size: 13px;">Password should be 6 characters long. It must contain Alphabets and Numbers</div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                {!! Form::text('mobile_number', null, ['class' => 'form-control', 'id' => 'mobile_number','required' => 'required', 'placeholder' => 'Mobile Number']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="photo-box">
                                            <ul class="photo-list">
                                                <li id="company-image">
                                                    @if(!empty($data->image))
                                                        <img src="{!! asset(userThumbnailFile.'/'.$data->image) !!}" alt="Image">
                                                    @else
                                                        <img src="{!! asset('assets/images/placeholder.png') !!}">
                                                    @endif
                                                </li>
                                                <li>
                                                    <div id="drag-and-drop-zone" class="uploader">
                                                        <div class="uploader myLabel">
                                                            <input type="file" name="file" id="file" accept="image/*">
                                                            <span>Browse</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <div class="" style="display: block;margin: 50px 0 50px; text-align: center;">
                                                <button class="btn btn-success" style="width: 130px;">@if(empty($id)) Create @else Update @endif</button>
                                                <a href="{!! URL::route('users.list') !!}" class="btn btn-danger" style="width: 130px; margin-left: 20px;">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::token() !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->

            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">© 2018  Advisory Board </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>

    {!! HTML::style('assets/css/uploader.css') !!}
    {!! HTML::style('assets/css/demo.css') !!}
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    {!! HTML::script('assets/js/jquery-migrate-1.2.1.min.js') !!}
    {!! HTML::script('assets/js/demo-preview.min.js') !!}
    {!! HTML::script('assets/js/dmuploader.min.js') !!}

    <script type="text/javascript">
        $addRecordRoute = '{{ URL::route('user.add') }}';
        $redirectRoute = '{{ URL::route('users.list') }}';
        $uploadImageRoute = '{{ URL::route('user.upload.image') }}';
        $token = "{{ csrf_token() }}";
        $id = '{!! $id !!}';
        $isViewOnly = '{!! $isViewOnly !!}';
        $batchId = $id;
        $tempImageId = 0;

        $(document).ready(function () {
            if ($isViewOnly) {
                $("#data-form :input").prop("disabled", true);
                $("input[type=button]").attr("disabled", "disabled");
            } else {
                ajaxStartStop();
                $type = 'uploadImage';
                renderAdmin();
                $('#data-form').submit(function (e) {
                    e.preventDefault();
                    updateFormData();
                    $type = 'addRecord';
                    renderAdmin();
                });
            }
        })

        var updateFormData = function () {
            $formData = {
                '_token': $token,
                data:  $('#data-form').serialize(),
                id: $id,
                tempImageId: $tempImageId
            };
        }

    </script>

    {!! HTML::script('assets/js/admin.js') !!}

@stop