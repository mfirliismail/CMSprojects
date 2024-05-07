<?php
namespace App\Service;

use App\Exceptions\ProductException;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductService{

    public function getProductList($search = NULL,$paginate = NULL){

        $productList = Product::when($search !== NULL,fn($q) => $q->whereAny([
            'name',
            'description'
        ], 'LIKE', '%'.$search.'%'));

        if($paginate !== NULL){
            // get() =>  untuk mereturn semua data di database
            return $productList->get();
        }
        // paginte() => untuk mereturn data dengan pagination yang mana tiap pagenya tergantung dari variable $paginate (nama bebas, tidak harus $paginate)
        return $productList->paginate($paginate);
    }

    public function getProductDetail($productId){
        // first untuk return 1 data
        $product = Product::where('id',$productId)->first();
        if($product === NULL){
            throw new ProductException('Data tidak ada');
        }

        return $product;
    }

    public function createProduct($product_category_id, $name, $description, $type, $image, $content){
        // $slug = Str::slug($name); // Str::slug => Helper laravel untuk membuat slug
        // $diseaseCategory = DiseaseCategory::where('slug',$slug)->first();
        $diseaseCategory = Product::create([
            'product_category_id' => $product_category_id,
            'name' => $name,
            'description' => $description,
            'type' => $type,
            'image' => $image,
            'content' => $content,
        ]);
        return $diseaseCategory;
    }

    public function updateProduct($productId,$name, $description, $type, $image, $content){
        $product = Product::where('id',$productId)->first();
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($product === NULL){
            throw new ProductException('Data tidak ada');
        }
        $product->update([
            'name' => $name,
            'description' => $description,
            'type' => $type,
            'image' => $image,
            'content' => $content,
        ]);

        return $product->refresh();
    }

    public function delete($productId){
        $product = Product::where('id',$productId);
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($product === NULL){
            throw new ProductException('Data tidak ada');
        }
        $product->delete();
        return true;
    }



}
