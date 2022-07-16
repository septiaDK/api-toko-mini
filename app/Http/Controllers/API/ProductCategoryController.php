<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');
    
        if($id)
        {
            $product_categories = ProductCategory::with('products')->find($id);
            
            if($product_categories)
            {
                return ResponseFormatter::success(
                    $product_categories,
                    'Data Kategori berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Kategori tidak ada',
                    404
                ); 
            }
        }

        $product_categories = ProductCategory::query();

        if($name)
        {
            $product_categories->where('name', 'like', '%'. $name . '%');
        }

        if($show_product)
        {
            $product_categories->with('products');
        }

        return ResponseFormatter::success(
            $product_categories->paginate($limit),
            'Data Kategori berhasil diambil'
        );
    }
}
