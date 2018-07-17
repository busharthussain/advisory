@extends('layouts.superadminlayout')

@section('content')

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">All Companies</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{!! URL::route('super.admin.dashboard') !!}">Home</a></li>
                <li class="breadcrumb-item">All Companies</li>
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
            <div id="notificationMessage"></div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <!-- <h4 class="card-title">All Companies</h4> -->
                            </div>
                            <div class="col-6">
                                <a class="btn btn-success pull-right" href="{!! URL::route('super.admin.create.company') !!}">Create Company</a>
                            </div>
                        </div>
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
    $renderRoute = '{{ URL::route('company.get') }}';
    $editRoute = '{{ URL::route('super.admin.edit.company') }}';
    $deleteRoute = '{!! URL::route('company.delete') !!}';
    $communityRoute = '{{ URL::route('super.admin.community') }}';
    $defaultType = 'renderCompanies';
    $token = "{{ csrf_token() }}";
    $page = 1;
    $search = '';
    $asc = 'asc';
    $desc = 'desc';
    $sortType  = 'desc';
    $sortColumn = 'companies.id';

    $(document).ready(function() {
        updateFormData();
        $type = $defaultType;
        renderAdmin();
        $('#search').val('');
        $('#search').keydown(function (e){
            if(e.keyCode == 13){
                $search = $(this).val();
                $page = 1;
                updateFormData();
                $type = $defaultType;
                renderAdmin();
            }
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