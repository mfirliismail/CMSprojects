<?php
namespace App\Service;

use App\Exceptions\ProductException;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductService{

    public function getProductList($search = NULL,$paginate = NULL){

        $productList = Product::with(['category', 'tag'])->when($search !== NULL,fn($q) => $q->whereAny([
            'name',
            ], 'iLIKE', '%'.$search.'%'));

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
            throw ProductException::notFound();
        }

        return $product;
    }

    public function createProduct($product_category_id, $tag_id, $name, $code, $description, $type, $image, $content){
        // $slug = Str::slug($name); // Str::slug => Helper laravel untuk membuat slug
        // $diseaseCategory = DiseaseCategory::where('slug',$slug)->first();

        $product = Product::create([
            'product_category_id' => $product_category_id,
            'tag_id' => $tag_id,
            'name' => $name,
            'code' => $code,
            'description' => $description,
            'type' => $type,
            'image' => $image,
            'content' => $content,
            'is_active' => true,
        ]);
        return $product;
    }

    public function updateProduct($productId,$name, $description, $type, $image, $content){
        $product = Product::where('id',$productId)->first();
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($product === NULL){
            throw ProductException::notFound();
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
            throw ProductException::notFound();
        }
        $product->delete();
        return true;
    }

    public function enableDisable($productId){
      // Temukan produk berdasarkan ID
      $product = Product::find($productId);

      // Validasi jika produk tidak ditemukan, maka return error
      if ($product === null) {
        throw ProductException::notFound();
      }
  
      // Toggle nilai is_active
      $product->is_active = !$product->is_active;
      
      // Simpan perubahan
      $product->save();
        return true;
    }



}
