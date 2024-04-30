<?php
namespace App\Service;

use App\Exceptions\DiseaseCategoryException;
use App\Models\DiseaseCategory;
use Illuminate\Support\Str;

class DiseaseService{

    public function getCategoryList($search = NULL,$paginate = NULL){
        $diseaseCategories = DiseaseCategory::when($search !== NULL,fn($q) => $q->whereAny([
            'name',
            'email',
            'phone',
        ], 'LIKE', '%'.$search.'%'));

        if($paginate !== NULL){
            // get() =>  untuk mereturn semua data di database
            return $diseaseCategories->get();
        }
        // paginte() => untuk mereturn data dengan pagination yang mana tiap pagenya tergantung dari variable $paginate (nama bebas, tidak harus $paginate)
        return $diseaseCategories->paginate($paginate);
    }

    public function getCategoryDetail($diseaseCategoryId){
        // first untuk return 1 data
        return DiseaseCategory::where('id',$diseaseCategoryId)->first();
    }

    public function createCategory($name){
        $slug = Str::slug($name); // Str::slug => Helper laravel untuk membuat slug
        $diseaseCategory = DiseaseCategory::where('slug',$slug)->first();
        // Jika sudah ada, langsung return datanya, jika belum ada buat baru
        if($diseaseCategory === NULL){
            $diseaseCategory = DiseaseCategory::create([
                'slug' => $slug,
                'name' => $name,
            ]);
        }
        return $diseaseCategory;
    }

    public function updateCategory($diseaseCategoryId,$name){
        $diseaseCategory = DiseaseCategory::where('id',$diseaseCategoryId)->first();
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($diseaseCategory === NULL){
            throw new DiseaseCategoryException('Data tidak ada');
        }
        $diseaseCategory->update([
            'slug' => Str::slug($name),
            'name' => $name
        ]);

        return $diseaseCategory->refresh();
    }

    public function delete($diseaseCategoryId){
        $diseaseCategory = DiseaseCategory::where('id',$diseaseCategoryId);
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($diseaseCategory === NULL){
            throw new DiseaseCategoryException('Data tidak ada');
        }
        $diseaseCategory->delete();
        return true;
    }



}
