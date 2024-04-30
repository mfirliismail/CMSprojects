<?php

namespace App\Http\Controllers;

use App\Exceptions\DiseaseCategoryException;
use App\Http\Requests\DiseaseCategory\CreateRequest;
use App\Http\Requests\DiseaseCategory\GetListRequest;
use App\Http\Requests\DiseaseCategory\UpdateRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\DiseaseCategoryResource;
use App\Http\Resources\ErrorResource;
use App\Service\DiseaseService;
use Illuminate\Http\Request;

class DiseaseCategoryController extends Controller
{
    public function getList(GetListRequest $request){
        try{
            return DiseaseCategoryResource::collection(
                (new DiseaseService)->getCategoryList(
                    search:$request->search,
                    paginate:$request->paginate,
                )
            );
        }catch(DiseaseCategoryException $e){
            return new ErrorResource($e->getMessage());
        }

    }

    public function getDetail($diseaseCategoryId)
    {
        try{
            return new DiseaseCategoryResource(
                (new DiseaseService)->getCategoryDetail(
                    diseaseCategoryId:$diseaseCategoryId,
                )
            );
        }catch(DiseaseCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function create(CreateRequest $request){
        try{
            return new DiseaseCategoryResource(
                (new DiseaseService)->createCategory(name:$request->name)
            );
        }catch(DiseaseCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function update($diseaseCategoryId,UpdateRequest $request){
        try{
            return new DiseaseCategoryResource(
                (new DiseaseService)->updateCategory(diseaseCategoryId:$diseaseCategoryId,name:$request->name)
            );
        }catch(DiseaseCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function delete($diseaseCategoryId){
        try{
            (new DiseaseService)->delete($diseaseCategoryId);
            return new BaseResource(
                message:'Success Delete'
            );

        }catch(DiseaseCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }
}
