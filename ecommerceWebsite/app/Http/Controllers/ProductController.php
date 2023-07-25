<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct product page
    public function productPage()
    {
        $productData = Product::select("products.*", "categories.name as category_name")->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('created_at', 'desc')
            ->when(request('search'), function ($query) {
                $key = request('search');
                $query->orWhere('products.name', 'like', '%' . $key . '%')
                    ->orWhere('categories.name', 'like', '%' . $key . '%')
                    ->orWhere('products.product_code', 'like', '%' . $key . '%')
                    ->orWhere('products.item_price', 'like', '%' . $key . '%');
            })
            ->paginate(5);

        return view('admin.product.productList', compact('productData'));
    }

    // direct product create page
    public function productCreatePage()
    {
        $categoryData = Category::get();

        return view('admin.product.productCreate', compact('categoryData'));
    }

    // direct product create page insert data
    public function productCreate(Request $request)
    {
        $this->productValidationCheck($request);
        $productData = $this->productInsertData($request);

        if ($request->hasFile('productImage')) {
            $fileName = uniqid() . '_' . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public/productImage', $fileName);
            $productData['item_image'] = $fileName;
        }

        Product::create($productData);
        return redirect()->route('productPage')->with([
            'createMessage' => 'Product is created.'
        ]);
    }

    // direct product edit page
    public function productEdit($id)
    {
        $categoryData = Category::get();
        $productData = Product::select("products.*", "categories.name as category_name")
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)->first();

        return view('admin.product.productEdit', compact('categoryData', 'productData'));
    }

    // direct product update
    public function productUpdate(Request $request)
    {
        $addQuantity = Product::select('qty')->where('id', $request->productId)->first();
        $finalQuantity = $addQuantity->qty+$request->addQty;

        Validator::make($request->all(), [
            "productName" => "required|unique:products,name," . $request->productId,
            "productCategory" => "required",
            "productPrice" => "required",
            "productCode" => "required|unique:products,product_code," . $request->productId,
            "productImage" => "mimes:jpg,jpeg,png,webp,jfif"
        ])->validate();

        if ($request->hasFile('productImage')) {
            $oldFileName = Product::select('item_image')->where('id', $request->productId)->first();
            $oldFileName = $oldFileName->item_image;

            if (File::exists(public_path() . '/storage/productImage/' . $oldFileName)) {
                File::delete(public_path() . '/storage/productImage/' . $oldFileName);
            }

            $fileName =  uniqid() . "_" . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public/productImage', $fileName);

            Product::where('id', $request->productId)->update([
                'item_image' => $fileName
            ]);
        }

        Product::where('id', $request->productId)->update([
            "name" => $request->productName,
            "category_id" => $request->productCategory,
            "item_price" => $request->productPrice,
            "product_code" => $request->productCode,
            "qty" => $finalQuantity
        ]);

        return redirect()->route('productPage')->with([
            'updateMessage' => 'Product is updated.'
        ]);
    }

    // product delete
    public function productDelete($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('productPage')->with([
            'deleteMessage' => 'Product is deleted.'
        ]);
    }

    // product validation check
    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            "productName" => "required",
            "productCategory" => "required",
            "productPrice" => "required",
            "productCode" => "required|unique:products,product_code",
            "productQty" => "required",
            "productImage" => "required|mimes:jpg,jpeg,png,webp,jfif"
        ])->validate();
    }

    // product insert data
    private function productInsertData($request)
    {
        return [
            "name" => $request->productName,
            "category_id" => $request->productCategory,
            "item_price" => $request->productPrice,
            "product_code" => $request->productCode,
            "qty" => $request->productQty
        ];
    }
}
