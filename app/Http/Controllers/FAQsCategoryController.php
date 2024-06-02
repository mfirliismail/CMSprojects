<?php

namespace App\Http\Controllers;

use App\Models\FAQsCategory;
use Illuminate\Http\Request;
use App\Http\Resources\BaseResource;
use App\Service\FAQsCategoryService;
use App\Http\Resources\ErrorResource;
use App\Exceptions\FAQsCategoryException;
use App\Http\Resources\FAQsCategoryResource;
use App\Http\Requests\FAQsCategory\CreateRequest;
use App\Http\Requests\FAQsCategory\UpdateRequest;
use App\Http\Requests\FAQsCategory\GetListRequest;

class FAQsCategoryController extends Controller
{
    public function getList(GetListRequest $request){
        try{
            return FAQsCategoryResource::collection(
                (new FAQsCategoryService)->getFAQsCategoryList(
                    search:$request->search,
                    paginate:$request->paginate,
                )
            );
        }catch(FAQsCategoryException $e){
            return new ErrorResource($e->getMessage());
        }

    }

    public function getDetail($faqsCategoryId)
    {
        try{
            return new FAQsCategoryResource(
                (new FAQsCategoryService)->getFAQsCategoryDetail(
                    faqsCategoryId:$faqsCategoryId,
                )
            );
        }catch(FAQsCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function create(CreateRequest $request){
        try{
            return new FAQsCategoryResource(
                (new FAQsCategoryService)->createFAQsCategory(name:$request->name)
            );
        }catch(FAQsCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $faqsCategoryId){
        try{
            return new FAQsCategoryResource(
                (new FAQsCategoryService)->updateFAQsCategory(
                    faqsCategoryId:$faqsCategoryId,
                    name:$request->name
                )
            );
        }catch(FAQsCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function delete($faqsCategoryId){
        try{
            (new FAQsCategoryService)->deleteFAQsCategory($faqsCategoryId);
            return new BaseResource(
                message:'Success Delete'
            );

        }catch(FAQsCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function enableDisable($faqsCategoryId){
        try{
            return new FAQsCategoryResource(
                (new FAQsCategoryService)->toggleFAQsCategoryStatus($faqsCategoryId)
            );
        }catch(FAQsCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }
    
}
