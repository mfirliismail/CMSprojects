<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topic\GetListRequest;
use App\Http\Requests\Topic\CreateRequest;
use App\Http\Requests\Topic\UpdateRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\TopicResource;
use App\Service\TopicService;

class TopicController extends Controller
{
    public function getList(GetListRequest $request){
        return TopicResource::collection(
            (new TopicService)->getList(
                search:$request->search,
                paginate:$request->paginate,
            )
        );

    }

    public function getDetail($topicId)
    {
        return new TopicResource(
            (new TopicService)->getDetail(
                topicId:$topicId,
            )
        );
    }

    public function create(CreateRequest $request){
        return new TopicResource(
            (new TopicService)->create(name:$request->name)
        );
    }

    public function update($topicId,UpdateRequest $request){
        return new TopicResource(
            (new TopicService)->update(topicId:$topicId,name:$request->name)
        );
    }

    public function delete($topicId){
        (new TopicService)->delete($topicId);
        return new BaseResource(
            message:'Success Delete'
        );
    }
}
