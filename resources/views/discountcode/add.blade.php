@extends('templates.layout')
@section('title', $_title)
@section('content')
<!-- Main content -->
<section class="content appTuyenSinh">
    <link rel="stylesheet" href="{{ asset('default/bower_components/select2/dist/css/select2.min.css')}} ">
    <style>
        .select2-container--default .select2-selection--single,
        .select2-selection .select2-selection--single {
            padding: 3px 0px;
            height: 30px;
        }

        .select2-container {
            margin-top: -5px;
        }

        option {
            white-space: nowrap;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 0px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #216992;
        }

        .select2-container--default .select2-selection--multiple {
            margin-top: 10px;
            border-radius: 0;
        }

        .select2-container--default .select2-results__group {
            background-color: #eeeeee;
        }
    </style>

    <?php //Hiển thị thông báo thành công
    ?>
    @if ( Session::has('success') )
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ Session::get('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    @endif
    <?php //Hiển thị thông báo lỗi
    ?>
    @if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{ Session::get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    @endif

    <!-- Phần nội dung riêng của action  -->
    <form class="form-horizontal " action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">Discount Code <span class="text-danger">(*)</span></label>

                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="name" id="name" class="form-control" value="{{$objItem->discount_code}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Exclude Prod <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="exclude_prod" id="exclude_prod" class="form-control" value="{{$objItem->exclude_prod}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Include Prod <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="include_prod" id="include_prod" class="form-control" value="{{$objItem->include_prod}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Condition <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="condition_type" id="condition_type" class="form-control" value="{{$objItem->condition_type}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Discount Type <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="type_discount" id="type_discount" class="form-control" value="{{$objItem->type_discount}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Discount Number <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="number" name="discount_number" id="discount_number" class="form-control" value="{{$objItem->discount_number}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Limits <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="number" name="limits" id="limits" class="form-control" value="{{$objItem->limits}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div><div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Start Time<span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="datetime" name="time_start" id="time_start" class="form-control" value="{{$objItem->time_start}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div><div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">End Time <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="datetime" name="time_end" id="time_end" class="form-control" value="{{$objItem->time_end}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary"> Save</button>
        </div>
        <!-- /.box-footer -->
    </form>

</section>
@endsection
@section('script')
<script src="{{ asset('default/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('default/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
@endsection
