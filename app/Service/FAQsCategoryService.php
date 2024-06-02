<?php
namespace App\Service;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\FaqsCategory;
use App\Exceptions\FAQsCategoryException;
use App\Exceptions\ProductCategoryException;

class FAQsCategoryService{

    public function getFAQsCategoryList($search = NULL,$paginate = NULL){
        $faqsCategories = FaqsCategory::when($search !== NULL,fn($q) => $q->whereAny([
            'name',
        ], 'LIKE', '%'.$search.'%'));

        if($paginate !== NULL){
            // get() =>  untuk mereturn semua data di database
            return $faqsCategories->get();
        }
        // paginte() => untuk mereturn data dengan pagination yang mana tiap pagenya tergantung dari variable $paginate (nama bebas, tidak harus $paginate)
        return $faqsCategories->paginate($paginate);
    }

    public function getFAQsCategoryDetail($faqsCategoryId){
        // first untuk return 1 data
        return FaqsCategory::where('id',$faqsCategoryId)->first();
    }

    public function createFAQsCategory($name){
        // $slug = Str::slug($name); // Str::slug => Helper laravel untuk membuat slug
        $faqsCategory = FaqsCategory::where('name',$name)->first();
        // Jika sudah ada, langsung return datanya, jika belum ada buat baru
        if($faqsCategory === NULL){
            $faqsCategory = FaqsCategory::create([
                'name' => $name,
            ]);
        }
        return $faqsCategory;
    }

    public function updateFAQsCategory($faqsCategoryId, $name){
        $faqsCategory = FaqsCategory::find($faqsCategoryId);
        if ($faqsCategory === NULL) {
            throw new FAQsCategoryException("Data tidak ada");
        }
        $faqsCategory->update(['name' => $name]);
        return $faqsCategory;
    }

    public function deleteFAQsCategory($faqsCategoryId){
        $faqsCategory = FaqsCategory::where('id',$faqsCategoryId);
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($faqsCategory === NULL){
            throw new FAQsCategoryException('Data tidak ada');
        }
        $faqsCategory->delete();
        return true;
    }

    public function toggleFAQsCategoryStatus($faqsCategoryId)
    {
        $faqsCategory = FaqsCategory::findOrFail($faqsCategoryId);

        $faqsCategory->is_active = !$faqsCategory->is_active;
        $faqsCategory->save();

        return $faqsCategory;
    }



}
