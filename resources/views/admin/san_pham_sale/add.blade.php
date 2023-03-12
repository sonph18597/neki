@extends('admin.templates.layout')
@section('content')
    <!-- Main content -->
    <section class="content appTuyenSinh">
        <link rel="stylesheet" href="{{ asset('default/bower_components/select2/dist/css/select2.min.css')}} ">
        <style>
            .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
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
            .select2-container--default .select2-selection--multiple{
                margin-top:10px;
                border-radius: 0;
            }
            .select2-container--default .select2-results__group{
                background-color: #eeeeee;
            }
        </style>

        <?php //Hiển thị thông báo thành công?>
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
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
                        <h1 style="text-align: center;color:springgreen;" class="">THÊM SẢN PHẨM GIẢM GIÁ</h1>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">ID SALE OFF <span class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <input type="text" name="id_sale_off" id="name" class="form-control" value="@isset($request['id_sale_off']){{ $request['id_sale_off'] }}@endisset">
                                <span id="mes_sdt"></span>
                            </div>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">ID SẢN PHẨM <span class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <input type="text" name="id_san_pham" id="name" class="form-control" value="@isset($request['id_san_pham']){{ $request['id_san_pham'] }}@endisset">
                                <span id="mes_sdt"></span>
                            </div>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">GIÁ SALE<span class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <input type="text" name="gia_sale" id="name" class="form-control" value="@isset($request['gia_sale']){{ $request['gia_sale'] }}@endisset">
                                <span id="mes_sdt"></span>
                            </div>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">SỐ LƯỢNG<span class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <input type="text" name="so_luong" id="name" class="form-control" value="@isset($request['so_luong']){{ $request['so_luong'] }}@endisset">
                                <span id="mes_sdt"></span>
                            </div>
                        </div>
                     
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary"> THÊM </button>
                <button type="reset" class="btn btn-default"> RESET </button>
                <a href="" class="btn btn-danger">HỦY</a>
            </div>
            <!-- /.box-footer -->
        </form>
        

    </section>
@endsection
@section('script')
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
@endsection

@section('js')
        <script>
            $.get('http://127.0.0.1:8000/api/sale-off',function(res){
                if(res.status_code == 200){
                    let sale_off= res.data;
                    let _td = '';
                    sale_off.forEach(function(item){
                       _td += '<td class="text-center">'+item.ten+'</td>';
                    });
                    $('#list-sale-off').html(_td);
                }
               
            })
        </script>
        @endsection