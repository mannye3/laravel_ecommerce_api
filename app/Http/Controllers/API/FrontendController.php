<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function category()
    {
        $category = Category::all();

        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);


    }



    public function product($slug)
    {

        $category = Category::where('slug', $slug)->where('status', '0')->first();

        if($category)
        {
            $product = Product::where('category_id', $category->id)->where('status', '0')->get();

            if($product)
            {
                return response()->json([
                    'status' => 200,
                    'product_data' => [
                        'product' => $product,
                        'category' => $category,
                    ]
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'No product available ',
                ]);
            }


        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'No such category found',
            ]);
        }
    }



    public function viewproduct($category_slug, $product_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', '0')->first();

        if($category)
        {
            $product = Product::where('category_id', $category->id)
                                ->where('slug',$product_slug )
                                ->where('status', '0')
                                ->first();

            if($product)
            {
                return response()->json([
                    'status' => 200,
                     'product' => $product,


                ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'No product available ',
                ]);
            }


        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'No such category found',
            ]);
        }
    }

}
