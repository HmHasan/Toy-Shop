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
                       {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        <a href="/product/{{$product->id}}/edit" class="btn btn-primary btn-sm">Update</a>
                    {!! Form::close() !!}
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
@endsection
