@extends('templates.layout')
@section('title', '$_title')
@section('css')
<style>
    body {
        /*-webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;*/
        user-select: none;
    }

    .toolbar-box form .btn {
        /*margin-top: -3px!important;*/
    }

    .select2-container {
        margin-top: 0;
    }

    .select2-container--default .select2-selection--multiple {
        border-radius: 0;
    }

    .select2-container .select2-selection--multiple {
        min-height: 30px;
    }

    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 3px;
    }

    .table>tbody>tr.success>td {
        background-color: #009688;
        color: white !important;
    }

    .table>tbody>tr.success>td span {
        color: white !important;
    }

    .table>tbody>tr.success>td span.button__csentity {
        color: #333 !important;
    }

    /*.table>tbody>tr.success>td i{*/
    /*    color: white !important;*/
    /*}*/
    .text-silver {
        color: #f4f4f4;
    }

    .btn-silver {
        background-color: #f4f4f4;
        color: #333;
    }

    .select2-container--default .select2-results__group {
        background-color: #eeeeee;
    }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    {{-- @include('templates.header-action')--}}
    <div class="clearfix"></div>
    <div style="border: 1px solid #ccc;margin-top: 10px;padding: 5px;">
        <form action="" method="get">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <input type="text" name="search_code" class="form-control" placeholder="DiscountCode" value="">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12" style="text-align:center;">
                    <div class="form-group">
                        <button type="submit" name="btnSearch" class="btn btn-primary btn-sm "><i class="fa fa-search" style="color:white;"></i> Search
                        </button>
                        <a href="{{ url('/user') }}" class="btn btn-default btn-sm "><i class="fa fa-remove"></i>
                            Clear </a>
                        <a href="{{route('Router_BackEnd_DiscountCode_Add')}}" class="btn btn-info btn-sm"><i class="fa fa-user-plus" style="color:white;"></i>
                            Add new</a>
                    </div>
                </div>
            </div>

        </form>
        <div class="clearfix"></div>
    </div>
</section>

<!-- Main content -->
<section class="content appTuyenSinh">
    <div id="msg-box">
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
    </div>
    <div class="box-body table-responsive no-padding">
        <form action="" method="post">
            @csrf
            <span class="pull-right">Tổng số bản ghi tìm thấy: <span style="font-size: 15px;font-weight: bold;">8</span></span>
            <div class="clearfix"></div>
            <div class="double-scroll">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 50px" class="text-center">
                            ID
                        </th>
                        <th class="text-center">DiscountCode</th>
                        <th class="text-center">
                            Exclude Prod
                        </th>
                        <th class="text-center">
                            Include Prod                        </th>
                        <th class="text-center">
                            Condition Type
                        </th>
                        <th class="text-center">
                            Type Discount
                        </th>
                        <th class="text-center">
                            Discount Number
                        </th>
                        <th class="text-center">
                            Limit
                        </th>
                        <th class="text-center">
                            Start Time
                        </th>
                        <th class="text-center">
                            End Time
                        </th>

                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($lists as $list)
                    <tr>
                        {{-- <td><input type="checkbox" name="chk_hv[]" class="chk_hv" id="chk_hv_{{$item->id}}" value="{{$item->id}}"> </td>--}}
                        <td class="text-center">{{$list->id}}</td>
                        <td class="text-center"><a style="color:#333333;font-weight: bold;" href="{{route('Router_BackEnd_DiscountCode_Detail',$list->id)}}" style="white-space:unset;text-align: justify;"> {{$list->discount_code}} <i class="fa fa-edit"></i></a></td>
                        <td class="text-center">{{$list->exclude_prod}}</td>
                        <td class="text-center">{{$list->include_prod}}</td>
                        <td class="text-center">{{$list->condition_type}}</td>
                        <td class="text-center">{{$list->type_discount}}</td>

                        <td class="text-center">{{$list->discount_number}}</td>

                        <td class="text-center">{{$list->limits}}</td>

                        <td class="text-center">{{$list->time_start}}</td>
                        <td class="text-center">{{$list->time_end}}</td>

                        <td class="text-center"> <a href="{{route('Router_BackEnd_DiscountCode_Destroy',$list->id)}}" >Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </form>
    </div>
    <br>
    <div class="text-center">
        {{$lists->Links()}}
    </div>
    <index-cs ref="index_cs"></index-cs>
</section>

@endsection
