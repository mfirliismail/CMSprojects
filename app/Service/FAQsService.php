<?php
namespace App\Service;

use App\Exceptions\FAQsException;
use App\Models\FAQs;
use Illuminate\Support\Str;

class FAQsService{

    public function getFAQsList($search = NULL,$paginate = NULL){

        $faqsList = Faqs::with(['category'])->when($search !== NULL,fn($q) => $q->whereAny([
            'name',
            ], 'iLIKE', '%'.$search.'%'));

        if($paginate !== NULL){
            // get() =>  untuk mereturn semua data di database
            return $faqsList->get();
        }
        // paginte() => untuk mereturn data dengan pagination yang mana tiap pagenya tergantung dari variable $paginate (nama bebas, tidak harus $paginate)
        return $faqsList->paginate($paginate);
    }

    public function getFAQsDetail($faqsId){
        // first untuk return 1 data
        return Faqs::where('id',$faqsId)->first();
    }

    public function createFAQs($faqs_category_id, $question, $code, $answer){
        // $slug = Str::slug($name); // Str::slug => Helper laravel untuk membuat slug
        // $diseaseCategory = DiseaseCategory::where('slug',$slug)->first();

        $faqs = Faqs::create([
            'faqs_category_id' => $faqs_category_id,
            'question' => $question,
            'code' => $code,
            'answer' => $answer,
            'is_active' => true,
        ]);
        return $faqs;
    }

    public function updateFAQs($faqsId, $faqs_category_id, $question, $code, $answer){
        $faqs = Faqs::where('id',$faqsId)->first();
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($faqs === NULL){
            throw FAQsException::notFound();
        }
        $faqs->update([
            'faqs_category_id' => $faqs_category_id,
            'question' => $question,
            'code' => $code,
            'answer' => $answer,
        ]);

        return $faqs->refresh();
    }

    public function deleteFAQs($faqsId){
        $faqs = Faqs::where('id',$faqsId);
        // Validasi jika data belum, maka return error (bisa di lakukan di validasi awal)
        if($faqs === NULL){
            throw FAQsException::notFound();
        }
        $faqs->delete();
        return true;
    }

    public function toggleFAQsStatus($faqsId)
    {
        $faqs = Faqs::findOrFail($faqsId);

        $faqs->is_active = !$faqs->is_active;
        $faqs->save();

        return $faqs;
    }



}
