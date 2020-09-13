@extends('layouts.app')
@section('content')
    <form action="{{route('product.store')}} " enctype="multipart/form-data" method="POST">
        @csrf

{{--     Image Upload Start   --}}
       <div class="row  d-flex justify-content-center">

               <div class="form-group">
                   <div class="main-div ">
                       <div class="sub-div">
                           <div class="main-image">
                               <img src="" alt="">
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

{{--     Image Upload End   --}}
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
            <div class="properties">

            </div>
        </div>
        <button type="button" class="btn btn-primary add-btn float-right">Add Properties</button>

        <div class="form-group">
            <input type="submit" class="btn btn-success" name="" id="submit" value="submit">
        </div>

    </form>

@endsection

@section('script')

{{--    Script For Image Preview Start--}}
<script>
    const defaultBtn = document.querySelector("#default-upload-btn");
    const sub = document.querySelector(".sub-div");
    const customBtn = document.querySelector("#custom-upload-btn");
    const image = document.querySelector("img")
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

  <script>
    let i = 0;
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
        $(document).on('click', '.remove-btn', function (){
            let button_id = $(this).data('id');
            console.log(button_id)
            $('#properties-id-'+button_id).remove();
        })

    });

  </script>
@endsection
