@extends('admin.templates.layout')
@section('title', '123456')
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

        .table > tbody > tr.success > td {
            background-color: #009688;
            color: white !important;
        }

        .table > tbody > tr.success > td span {
            color: white !important;
        }

        .table > tbody > tr.success > td span.button__csentity {
            color: #333 !important;
        }

    
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
        {{--        @include('templates.header-action')--}}
        <div class="clearfix"></div>
        <div style="border: 1px solid #ccc;margin-top: 10px;padding: 5px;">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="search_ten_nguoi_dung" class="form-control" placeholder="Tên người dùng"
                                   value="">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12" style="text-align:center;">
                        <div class="form-group">
                            <button type="submit" name="btnSearch" class="btn btn-primary btn-sm "><i
                                    class="fa fa-search" style="color:white;"></i> Tìm kiếm
                            </button>
                            <a href="{{ url('/san-pham-sale') }}" class="btn btn-default btn-sm "><i class="fa fa-remove"></i>
                                Xóa </a>
                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-user-plus" style="color:white;"></i>
                                Thêm</a>
                        </div>
                    </div>
                </div>

            </form>
            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content appTuyenSinh">
       
        <div class="box-body table-responsive no-padding">
            <form action="" method="post">
                @csrf
                <span class="pull-right">Tổng số bản ghi tìm thấy: <span
                        style="font-size: 15px;font-weight: bold;">15</span></span>
                <div class="clearfix"></div>
                <div class="double-scroll">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 50px" class="text-center"> ID </th>
                            <th class="text-center">ID SALE OFF</th>
                            <th class="text-center"> ID SẢN PHẨM </th>
                            <th class="text-center">GIÁ SALE</th>
                            <th class="text-center">SỐ LƯỢNG</th>
                            <th class="text-center">ACTION</th>
                        </tr>

                        @foreach($data as $items)
                            <tr>
                                {{--     <td><input type="checkbox" name="chk_hv[]" class="chk_hv" id="chk_hv_{{$item->id}}" value="{{$item->id}}"> </td>--}}
                                <td class="text-center" name="id[]">{{$items->id}} </td>
                                <td class="text-center"><a style="color:#333333;font-weight: bold;" href="" style="white-space:unset;text-align: justify;">
                                       {{$items->id_sale_off}} 
                                   <i class="fa fa-edit"></i></a></td>
                                <td class="text-center">{{$items->id_san_pham}}</td>
                                <td class="text-center">{{$items->gia_sale}}</td>
                                <td class="text-center">{{$items->so_luong}}</td>
                                <td class="text-center">
                                   <a href="" > <button type="button" class="btn btn-primary">SỬA</button> </a>
                                   <a href="" > <button type="button" class="btn btn-danger">XÓA</button> </a>
                                </td>
                            </tr>
                           @endforeach
                    </table>
                </div>
            </form>
        </div>
        <div class="text-center">
            {{ $data->links() }}
        </div>
        <index-cs ref="index_cs"></index-cs>
    </section>

@endsection
