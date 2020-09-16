@extends('layouts.app')
@section('content')
    <a href="{{route('product.create')}}" class="btn btn-success">Create New</a>
    <table class="table table-striped">
        <thead>
           <tr>
               <th>Product Photo</th>
               <th>Product ID</th>
               <th>Product Name</th>
               <th>Product Price</th>
               <th>Properties</th>
               <th>Action</th>
           </tr>
        </thead>
        @if (count($products)>0)
            @foreach($products as $product )
                <tbody>
                <tr>
                    <td><img src="/storage/product_photo/{{$product->product_photo}}" alt="" height="50px" width="50px"></td>
                    <td>{{$product->product_id}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->product_price}}</td>
                    <td>
                        @foreach($product->properties as $item)
                            <b>{{ $item->key }}</b>: {{ $item->value}}<br />
                        @endforeach
                    </td>
                    <td>

                        {!! Form::open(['route' => ['product.destroy', $product->id]],['method' => 'post']) !!}
                        {!! Form::hidden('_method','DELETE') !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm','id'=>'delete']) !!}
                        {{--                    <form action="" id="delete_form" data-route = "{{url('product/'.$product->id)}}">--}}
                        {{--                        <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                        {{--                        <button type="submit" class="btn btn-danger btn-sm float-right" id="deleteButton">Delete</button>--}}
                        {{--                    </form>--}}
                        <a href="#" class="btn btn-primary btn-sm edit_modal" data-toggle="modal" data-target="#exampleModalCenter" data-route="/product/{{$product->id}}/edit">Update</a>
                        {!! Form::close() !!}
                    </td>
                </tr>
                </tbody>

            @endforeach
        @else
            <div class="text text-danger display-4 text-center">No Record in Database
                <br><a href="{{route('product.create')}}" class="btn btn-success">Create New</a>
            </div>
        @endif
    </table>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>

        $('.edit_modal').on('click',function (){
            let route = $(this).data('route')
            $('.modal-body').load(route,function (){
                $('#exampleModalCenter').modal({show:true});
            })
        })
    </script>
@endsection

