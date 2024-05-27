<?php

namespace App\Http\Controllers;

use App\Exceptions;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\GetListRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ErrorResource;
use App\Service\ProductService;
use Illuminate\Support\Facades\Log;
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
        }catch(Exceptions $e){
            return new ErrorResource($e->getMessage(), $e->getCode());
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
        }catch(Exceptions $e){
           return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }

    public function create(CreateRequest $request){
        try{
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                         . '-' . time() 
                         . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/products');
                $image->move($destinationPath, $imageName);
            }

            return new ProductResource(
                (new ProductService)->createProduct(
                    product_category_id:$request->product_category_id,
                    tag_id:$request->tag_id,
                    name:$request->name,
                    code:$request->code,
                    description:$request->description,
                    type:$request->type,
                    image:$imageName,
                    content:$request->content,
                    )
            );
        }catch(Exceptions $e){
            // Log::error('Product creation failed: ' . $e->getMessage());
            // return response()->json(['error' =>/ $e->getMessage()], 400);
            return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }

    public function update($productId,UpdateRequest $request){
        try{
            return new ProductResource(
                (new ProductService)->updateProduct(
                    productId:$productId,
                    name:$request->name,
                    code:$request->code,
                    tag_id:$request->tag_id,
                    product_category_id:$request->product_category_id,
                    description:$request->description,
                    type:$request->type,
                    image:$request->image,
                    content:$request->content,
                    )
            );
        }catch(Exceptions $e){
            return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }

    public function delete($productId){
        try{
            (new ProductService)->delete($productId);
            return new BaseResource(
                message:'Success Delete'
            );

        }catch(Exceptions $e){
            return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }

    public function enableDisable($productId){
        try{
            (new ProductService)->enableDisable($productId);
            return new BaseResource(
                message:'Success'
            );

        }catch(Exceptions $e){
            return new ErrorResource($e->getMessage(), $e->getCode());
        }
    }
}
