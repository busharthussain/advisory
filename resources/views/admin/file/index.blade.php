@extends('layouts.superadminlayout')

@section('content')

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor"></h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{!! URL::route('super.admin.dashboard') !!}">Home</a></li>
                    <li class="breadcrumb-item">All Files</li>
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
                            <div id="notificationMessage"></div>
                         {!! Form::open(['action' => 'admin\DashboardController@uploadFile','id' => 'data-form', 'class' => 'form-horizontal form-material','files'=> true]) !!}
                            <div class="row">
                                <div class="form-group col-6">
                                    <input type="text" class="form-control" name="file_name" id="file_name" required placeholder="File Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                            <div style="margin-top: 22px;"></div>
                            <div class="row">
                                <div class="col-6">
                                    <button id="upload-file" name="upload-file" class="btn btn-success" style="width: 130px;">Upload</button>
                                </div>
                            </div>
                          {!! Form::token() !!}
                          {!! Form::close() !!}
                            <div class="row m-t-40">
                                <div class="col-6">
                                    <p class="total-record">Total <span id="total-record"></span> records found</p>
                                </div>
                                <div class="col-6">
                                    <div class="" style="float: right;">
                                        <label class="">Search:
                                            <input placeholder="" class="form-control search-input" name="search" id="search" type="search">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @include('partials._renderheaders')
                            <div class="paq-pager"></div>
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

    <script type="text/javascript">
        $renderRoute = '{{ URL::route('files.get') }}';
        $deleteRoute = '{!! URL::route('file.delete') !!}';
        $downloadFileRoute = '{!! URL::route('download.file') !!}';
        $defaultType = 'renderFiles';
        $token = "{{ csrf_token() }}";
        $page = 1;
        $search = '';
        $asc = 'asc';
        $desc = 'desc';
        $sortType  = 'desc';
        $sortColumn = 'f.created_at';

        $(document).ready(function() {
            updateFormData();
            $type = $defaultType;
            renderAdmin();
            $('#search').val('');
            $('#search').keydown(function (e) {
                if (e.keyCode == 13) {
                    $search = $(this).val();
                    $page = 1;
                    updateFormData();
                    $type = $defaultType;
                    renderAdmin();
                }
            });

            $('#upload-file').click(function (e) {
                e.preventDefault();
                if ($('#file_name').val() == '') {
                    alert('Please fill name');
                    return false;
                }
                var dc = document.getElementById("file").files;
                if (dc.length == 0) {
                    alert('Please select file');
                    return false;
                }
                $('#data-form').submit();
            });
        })

        var updateFormData = function () {
            $formData = {
                '_token': $token,
                page:  $page,
                search: $search,
                sortType: $sortType,
                sortColumn: $sortColumn
            };
        }

    </script>

    {!! HTML::script('assets/js/admin.js') !!}

@stop