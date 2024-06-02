<?php

namespace App\Http\Controllers;

use App\Exceptions;
use App\Service\FAQsService;
use App\Exceptions\FAQsException;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\BaseResource;
use App\Http\Resources\FAQsResource;
use App\Http\Resources\ErrorResource;
use App\Http\Requests\FAQs\CreateRequest;
use App\Http\Requests\FAQs\UpdateRequest;
use App\Http\Requests\FAQs\GetListRequest;
// use Illuminate\Http\Request;

class FAQsController extends Controller
{
    public function getList(GetListRequest $request){
        try{
            return FAQsResource::collection(
                (new FAQsService)->getFAQsList(
                    search:$request->search,
                    paginate:$request->paginate,
                )
            );
        }catch(FAQsException $e){
            return new ErrorResource($e->getMessage(), $e->getCode());
        }

    }

    public function getDetail($faqsId)
    {
        try{
            return new FAQsResource(
                (new FAQsService)->getFAQsDetail(
                    faqsId:$faqsId,
                )
            );
        }catch(FAQsException $e){
           return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }

    public function create(CreateRequest $request){
        try {
            return new FAQsResource(
                (new FAQsService)->createFAQs(
                    faqs_category_id: $request->faqs_category_id,
                    question: $request->question,
                    code: $request->code,
                    answer: $request->answer,
                )
            );
        } catch (FAQsException $e) {
            // Log::error('FAQ creation failed: ' . $e->getMessage());
            // return response()->json(['error' => $e->getMessage()], 400);
            return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }
    

    public function update($faqsId, UpdateRequest $request){
        try{
            return new FAQsResource(
                (new FAQsService)->updateFAQs(
                    faqsId:$faqsId,
                    faqs_category_id: $request->faqs_category_id,
                    question: $request->question,
                    code: $request->code,
                    answer: $request->answer,
                    )
            );
        }catch(FAQsException $e){
            return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }

    public function delete($faqsId){
        try{
            (new FAQsService)->deleteFAQs($faqsId);
            return new BaseResource(
                message:'Success Delete'
            );

        }catch(FAQsException $e){
            return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }

    public function enableDisable($faqsId){
        try{
            return new FAQsResource(
                (new FAQsService)->toggleFAQsStatus($faqsId)
            );
        }catch(FAQsException $e){
            return new ErrorResource($e->getMessage());
        }
    }
}
