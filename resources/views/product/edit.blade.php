@extends('include.include')
@section('content')
    <form action="{{url('product/'.$product->id)}}" enctype="multipart/form-data" method="POST" data-route = "{{url('product/'.$product->id)}}" id="update_form">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="row  d-flex justify-content-center">
            <div class="form-group">
                <div class="main-div ">
                    <div class="sub-div">
                        <div class="main-image">
                            <img src="{{'/storage/product_photo/'.$product->product_photo}}" alt="" class="photo">
                        </div>
                        <div class="main-content">
                            <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                            <div class="main-content-text">no file choose yet !</div>

                        </div>
                    </div>

                </div>
                <input type="file" name="product_photo" id="default-upload-btn" hidden>
                <button onclick="defaultBtnActive()"  id="custom-upload-btn" type="button">Choose a Photo</button>
            </div>
        </div>
        <div class="form-group">
            <label for="product_name">Product ID</label>
            <input type="number" name="product_id" id="product_id" class="form-control" value="{{$product->product_id}}">
        </div>
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{$product->product_name}}">
        </div>
        <div class="form-group">
            <label for="product_price">Price</label>
            <input type="number" name="product_price" id="product_price" class="form-control" value="{{$product->product_price}}">
        </div>
        <div class="form-group">
            <div class="properties">
                @if (count($product->properties) >0)


                @foreach($product->properties as $item)
                    <div id="properties-id-{{$loop->iteration}}" class="row align-items-end">
                        <div class="col-md-5">
                            <label>Properties Name</label>
                            <input type="text" class="form-control" name="properties[{{$loop->iteration}}][key]" value="{{$item->key}}">
                        </div>
                        <div class="col-md-5">
                            <label>Properties Details</label>
                            <input type="text" class="form-control" name="properties[{{$loop->iteration}}][value]" value="{{$item->value}}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-btn form-control" data-id="{{$loop->iteration}}">Remove</button>
                        </div>

                    </div>
                @endforeach
                @endif
            </div>
            <button class="btn btn-primary add-btn mt-2 float-right" type="button">Add Properties</button>
        </div>
        <div class="form-group">
            <br>
            <br>

            <hr>
            <input type="submit" class="btn btn-info" name="" id="submit" value="Update">
        </div>

    </form>
@endsection

@section('script')
    {{--    Script For Image Preview Start--}}
    <script>
        const defaultBtn = document.querySelector("#default-upload-btn");
        const sub = document.querySelector(".sub-div");
        const customBtn = document.querySelector("#custom-upload-btn");
        const image = document.querySelector(".photo")
        console.log(image);
        function defaultBtnActive()
        {
            defaultBtn.click();
        }

        defaultBtn.addEventListener("change",function (){
            const file = this.files[0];

            if(file)
            {
                const reader = new FileReader();
                reader.onload = function (){
                    const result = reader.result;

                    image.src = result;
                    sub.classList.add("active");

                }
                reader.readAsDataURL(file)
            }
        })


    </script>
    {{--    Script For Image Preview End--}}

{{--    <script>--}}
{{--        function readURL(input) {--}}
{{--            if (input.files && input.files[0]) {--}}
{{--                var reader = new FileReader();--}}

{{--                reader.onload = function(e) {--}}
{{--                    $('#blah').attr('src', e.target.result);--}}
{{--                }--}}

{{--                reader.readAsDataURL(input.files[0]); // convert to base64 string--}}
{{--            }--}}
{{--        }--}}

{{--        $("#product_po").change(function() {--}}
{{--            readURL(this);--}}
{{--        });--}}
{{--    </script>--}}

    <script>
        let properties = JSON.parse("{{ json_encode(count($product->properties)) }}");
        let i = properties;
        $(document).on('click','.add-btn',function (){
            i++;
            let properties = '<div id="properties-id-'+i+'" class="row align-items-end">' +
                '<div class="col-md-5"><label>Properties Name</label>'+
                '<input type="text" class="form-control" name="properties['+i+'][key]"></div>'+
                '<div class="col-md-5"><label>Properties Details</label>'+
                '<input type="text" class="form-control" name="properties['+i+'][value]"></div>'+
                '<div class="col-md-2">'+
                '<button type="button" class="btn btn-danger btn-sm remove-btn form-control" data-id="'+i+'">Remove</button></div>'
            $('.properties').append(properties);


        });

        $(document).on('click', '.remove-btn', function (){
            let button_id = $(this).data('id');
            console.log(button_id)
            $('#properties-id-'+button_id).remove();
        })

    </script>
@endsection

