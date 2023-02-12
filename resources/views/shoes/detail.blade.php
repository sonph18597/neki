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
    <form class="form-horizontal " action="{{route('Router_BackEnd_Shoes_Update',['id'=>request()->route('id')])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">Name <span class="text-danger">(*)</span></label>

                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="name" id="name" class="form-control" value="{{$objItem->name}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">Id Prod Sale <span class="text-danger">(*)</span></label>

                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="id_prod_sale" id="namid_prod_salee" class="form-control" value="{{$objItem->id_prod_sale}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Id Type <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="id_type" id="id_type" class="form-control" value="{{$objItem->id_type}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">List Variant <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="list_variant" id="list_variant" class="form-control" value="{{$objItem->list_variant}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">Img</label>
                        <div class="col-md-9 col-sm-8">
                            <div class="row">
                                <div class="col-xs-6">
                                    <img id="mat_truoc_preview" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image" style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid" />
                                    <input type="file" name="img_list" accept="image/*" class="form-control-file @error('cmt_mat_truoc') is-invalid @enderror" id="cmt_truoc">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Description <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="description" id="description" class="form-control" value="{{$objItem->description}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Min Price <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="number" name="min_price" id="min_price" class="form-control" value="{{$objItem->min_price}}">
                            <span id="mes_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 col-sm-4 control-label">Max Price <span class="text-danger">(*)</span></label>
                        <div class="col-md-9 col-sm-8">
                            <input type="number" name="max_price" id="max_price" class="form-control" value="{{$objItem->max_price}}">
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
