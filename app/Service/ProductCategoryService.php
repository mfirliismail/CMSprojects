<?php
namespace App\Service;

use App\Exceptions\ProductCategoryException;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryService{

    public function getProductCategoryList($search = NULL,$paginate = NULL){
        $productCategories = ProductCategory::with('children');

        if($paginate !== NULL){
            // get() =>  untuk mereturn semua data di database
            return $productCategories->get();
        }
        // paginte() => untuk mereturn data dengan pagination yang mana tiap pagenya tergantung dari variable $paginate (nama bebas, tidak harus $paginate)
        return $productCategories->paginate($paginate);
    }

    public function getProductCategoryDetail($productCategoryId){
        // first untuk return 1 data
        $productCategory = ProductCategory::where('id',$productCategoryId)->first();

        if($productCategory === NULL){
            throw ProductCategoryException::notFound();
        }
        
        return $productCategory;
    }

    public function createProductCategory($name, $parent_id, $is_active){
        // $slug = Str::slug($name); // Str::slug => Helper laravel untuk membuat slug
        $productCategory = ProductCategory::where('name',$name)->first();
        // Jika sudah ada, langsung return datanya, jika belum ada buat baru
        if($productCategory === NULL){
            $productCategory = ProductCategory::create([
                'name' => $name,
                'parent_id' => $parent_id,
                'is_active' => $is_active
            ]);
        }
        return $productCategory;
    }

    public function updateProductCategory($productCategoryId, $name, $parent_id){
        $productCategory = ProductCategory::find($productCategoryId);
        if ($productCategory === NULL) {
            throw ProductCategoryException::notFound();
        }
        $productCategory->update(['name' => $name, 'parent_id' => $parent_id]);
        return $productCategory;
    }

    public function deleteProductCategory($productCategoryId){
        $productCategory = ProductCategory::where('id',$productCategoryId);
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($productCategory === NULL){
            throw ProductCategoryException::notFound();
        }
        $productCategory->delete();
        return true;
    }

    public function toggleProductCategoryStatus($productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);

        $productCategory->is_active = !$productCategory->is_active;
        $productCategory->save();

        return $productCategory;
    }



}
