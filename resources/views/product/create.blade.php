@extends('layouts.app')
@section('content')
    <form action="{{route('product.store')}} " enctype="multipart/form-data" method="POST">
        @csrf

        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="product_photo">Product Image</label>
                    <input type="file" name="product_photo" id="product_photo" class="form-control">
                </div>
                <div class="col-md-5">
                    <img id="blah" src="#" alt="" class="img-thumbnail"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="product_name">Product ID</label>
            <input type="number" name="product_id" id="product_id" class="form-control">
        </div>
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="product_price">Price</label>
            <input type="number" name="product_price" id="product_price" class="form-control">
        </div>
        <div class="form-group">
            <label for="attribute">Product Attribute</label>
            <div class="row">
                <div class="col-md-4">
                        Key
                </div>
                <div class="col-md-8">
                    value
                </div>
            </div>
            <div class="row extend_row">
                <div class="col-md-4">
                    <input type="text" class="form-control input_filed" name="properties[0][key]">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control input_filed" name="properties[0][value]">
                </div>
                <div class="col-md-2">
                    <a href="#" class="btn btn-success add_button add" >+</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="" id="submit" value="submit">
        </div>

    </form>

@endsection

@section('script')

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#product_photo").change(function() {
            readURL(this);
        });
    </script>

    <script>

        var input_filed = $('.extend_row');
        var addbutton = $('.add_button');
        var i = 0;
            $(document).on('click', '.add',function (){
                i++;
                $(input_filed).append('<div class="col-md-4 mt-2"><input type="text" name="properties['+i+'][key]" class="form-control"></div>');
                $(input_filed).append('<div class="col-md-6 mt-2"><input type="text" name="properties['+i+'][value]" class="form-control"></div>'+'<div class="col-md-2 mt-2"><a href="#" class="btn btn-success add">+</a></div>');
            })

    </script>

@endsection
