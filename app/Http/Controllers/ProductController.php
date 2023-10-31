<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        
        //create a new product object
        $product = new Product();

        //Then add request data to the product object
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;

        //save the product in database
        $product->save();
        
        //give the response
        return response()->json([
            'message' => 'Save product query successful',
            'statusCode' => 201,
            'data' => $product
        ]);
    }

    public function getProducts() {

        //get all products thorugh model
        $products = Product::all();

        //give the response
        return response()->json([
            'message' => 'Get all products query successfully',
            'statusCode' => 200,
            'data' => $products
        ]);
    }

    public function getProduct(Request $request) {
        
        //get product id from route params
        $product_id = $request->route('productId');

        //get single product
        $product = Product::find($product_id);

        //if there is no product then response this
        if (!$product) {
            return response()->json([
                'message' => 'Can\'t find product id',
                'statusCode' => 404,
            ]);
        }

        //give the response
        return response()->json([
            'message' => 'Get single product query successfully',
            'statusCode' => 200,
            'productId' => $product_id,
            'data' => $product
        ]);
    }

    public function updateProduct(Request $request) {

        // Get the product id
        $product_id = $request->route('productId');

        // Retrieve the product instance
        $product = Product::find($product_id);

        // Check if the product exists before attempting deletion
        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
                'statusCode' => 404
            ]);
        }

        //Then add request data to the product object
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;

        // update the product
        $updatedProduct = $product->update();

        //give the response
        return response()->json([
            'message' => 'Product updated query successfully',
            'statusCode'=> 200,
            'data'=> $updatedProduct
        ]);
    }

    public function deleteProduct(Request $request) {

        // Get the product id
        $product_id = $request->route('productId');

        // Retrieve the product instance
        $product = Product::find($product_id);

        // Check if the product exists before attempting deletion
        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
                'statusCode' => 404
            ]);
        }

        // delete the product
        $product->delete();

        //give the response
        return response()->json([
            'message' => 'Product deleted query successfully',
            'statusCode'=> 200
        ]);
    }
}
