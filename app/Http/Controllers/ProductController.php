<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        return new ProductCollection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return ProductResource
     */
    public function store(ProductStoreRequest $request)
    {
        $product_data = $request->all();
        if ($request->image){
            $product_data['image'] = $this->uploadImage($request);
        }
        $product = Product::create($product_data);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->price = $request->price;
        $product->description = $request->description;
        if($request->hasFile('image')){
           $product->image = $this->uploadImage($request);
        }
        $product->status = $request->status;
        $product->save();

        return new ProductResource($product);
    }

    public function uploadImage($request){
        $filename  = time() . '.' . $request->image->getClientOriginalExtension();
        $image_path = $request->image->storeAs('products',$filename,'public');
        $image = Image::make($request->file('image'))
            ->resize(100, null, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg',80);
        Storage::disk('public')->put( 'products/thumbnails/' . $filename, $image);
        return $filename;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
