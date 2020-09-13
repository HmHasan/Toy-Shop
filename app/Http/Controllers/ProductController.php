<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Array_;
use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        $products = Product::all();

//        foreach ($products as $test)
//        {
//            foreach ($test->properties as $item)
//            {
//                return $item['key'].$item['value'];
//            }
//        }





//        return $products[0]->properties['key'];
//        $var = ['key' => 'Abdul', 'value' => 65];
////        $var = ['Abdul',  65];
//        return $var['key'];

//        foreach ($products as $product) {
//
//            return $product->properties[];
//            foreach ($product->properties as $property) {
//                return $property;
////                dd($data[0]);
//            }
//
//        }
//        $product_array = [];
//
//        ## TODO : Replace foreach with Laravel Collection Map
//
//        foreach($products as $product){
//
//            $set['product_name'] = $product->product_name;
//            $set['product_image'] = $product->product_image;
//            $set['json'] = $product->properties;
//            $set['properties'] = [];
//            foreach($set['json'] as $key=>$value){
//                $set['properties'][$key] = $value;
//            }


//            array_push($product_array, $set);
//        }


        return view('product.dashboard')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_id' => 'required |unique:products',
            'product_name' => 'required',
            'product_photo' => 'nullable | image | max:1999' ,
            'product_price' => 'required',
            'properties' => 'required',
        ]);

        if($request->hasFile('product_photo'))
        {
            $filenameWithExt = $request->file('product_photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('product_photo')->getClientOriginalExtension();
            $fileNametoStore = $filename."_".time().'.'.$extension;
            $path = $request->file('product_photo')->storeAs('public/product_photo',$fileNametoStore);
        }

        else {
            $fileNametoStore = 'noimage.jpg';
        }

//        return $request->all();

        $product = new Product();
        $product->product_id = $request->input('product_id');
        $product->product_photo = $fileNametoStore;
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->properties = $request->input('properties');
        $product->save();
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $product = Product::find($id);


        return view('product.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'product_photo' => 'nullable | image | max:1999' ,
            'product_price' => 'required',
            'properties' => 'required',
        ]);

        if($request->hasFile('product_photo'))
        {
            $filenameWithExt = $request->file('product_photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('product_photo')->getClientOriginalExtension();
            $fileNametoStore = $filename."_".time().'.'.$extension;
            $path = $request->file('product_photo')->storeAs('public/product_photo',$fileNametoStore);
        }


//        return $request->all();

        $product = Product::find($id);
        $product->product_id = $request->input('product_id');
        if($request->hasFile('product_photo'))
        {
            $product->product_photo = $fileNametoStore;
        }

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->properties = $request->input('properties');
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::find($id);
        if($product->product_photo !='noimage.jpg')
        {
            Storage::Delete('/public/product_photo/'.$product->product_photo);
        }

        $product->delete();
        return redirect(route('product.index'));
    }
}
