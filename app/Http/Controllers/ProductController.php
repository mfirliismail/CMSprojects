<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\GetListRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ErrorResource;
use App\Service\ProductService;
// use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getList(GetListRequest $request){
        try{
            return ProductResource::collection(
                (new ProductService)->getProductList(
                    search:$request->search,
                    paginate:$request->paginate,
                )
            );
        }catch(ProductException $e){
            // return new ErrorResource($e->getMessage());
        }

    }

    public function getDetail($productId)
    {
        try{
            return new ProductResource(
                (new ProductService)->getProductDetail(
                    productId:$productId,
                )
            );
        }catch(ProductsException $e){
            return new ErrorResource($e->getMessage());
        }
    }

    public function create(CreateRequest $request){
        try{
            return new ProductResource(
                (new ProductService)->createProduct(
                    product_category_id:$request->product_category_id,
                    name:$request->name,
                    description:$request->description,
                    type:$request->type,
                    image:$request->image,
                    content:$request->content,
                    )
            );
        }catch(ProductsException $e){
            // return new ErrorResource($e->getMessage());
        }
    }

    public function update($productId,UpdateRequest $request){
        try{
            return new ProductResource(
                (new ProductService)->updateProduct(
                    productId:$productId,
                    name:$request->name,
                    description:$request->description,
                    type:$request->type,
                    image:$request->image,
                    content:$request->content,
                    )
            );
        }catch(ProductsException $e){
            // return new ErrorResource($e->getMessage());
        }
    }

    public function delete($productId){
        try{
            (new ProductService)->delete($productId);
            return new BaseResource(
                message:'Success Delete'
            );

        }catch(ProductsException $e){
            // return new ErrorResource($e->getMessage());
        }
    }
}
