<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductCategoryException;
use App\Http\Requests\ProductCategory\CreateRequest;
use App\Http\Requests\ProductCategory\GetListRequest;
use App\Http\Requests\ProductCategory\UpdateRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ErrorResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Service\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function getList(GetListRequest $request){
        try{
            return ProductCategoryResource::collection(
                (new ProductCategoryService)->getProductCategoryList(
                    search:$request->search,
                    paginate:$request->paginate,
                )
            );
        }catch(ProductCategoryException $e){
            return new ErrorResource($e->getMessage());
        }

    }

    public function getDetail($productCategoryId)
    {
        try{
            return new ProductCategoryResource(
                (new ProductCategoryService)->getProductCategoryDetail(
                    productCategoryId:$productCategoryId,
                )
            );
        }catch(ProductCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function create(CreateRequest $request){
        try{
            return new ProductCategoryResource(
                (new ProductCategoryService)->createProductCategory(name:$request->name, parent_id:$request->parent_id)
            );
        }catch(ProductCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $productCategoryId){
        try{
            return new ProductCategoryResource(
                (new ProductCategoryService)->updateProductCategory(
                    productCategoryId:$productCategoryId,
                    name:$request->name,
                    parent_id:$request->parent_id
                )
            );
        }catch(ProductCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function delete($productCategoryId){
        try{
            (new ProductCategoryService)->deleteProductCategory($productCategoryId);
            return new BaseResource(
                message:'Success Delete'
            );

        }catch(ProductCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function enableDisable($productCategoryId){
        try{
            return new ProductCategoryResource(
                (new ProductCategoryService)->toggleProductCategoryStatus($productCategoryId)
            );
        }catch(ProductCategoryException $e){
            return new ErrorResource($e->getMessage());
        }
    }
    
}
