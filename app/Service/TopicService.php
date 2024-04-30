<?php
namespace App\Service;

use App\Models\Topic;
use Illuminate\Support\Str;

class TopicService{

    public function getList(string $search = NULL,int $paginate = NULL){
        return Topic::when($search !== NULL,fn($q) => $q->whereAny([
            'name',
        ], 'LIKE', '%'.$search.'%'))
        ->when($paginate == NULL,fn($q)=> $q->get())
        ->when($paginate != NULL,fn($q)=> $q->paginate($paginate));
    }

    public function getDetail($topicId){
        return Topic::where('id',$topicId)->first();
    }

    public function create($name){
        $slug = Str::slug($name); // Str::slug => Helper laravel untuk membuat slug
        return Topic::firstOrCreate([
            'slug' => $slug
        ],[
            'name' => $name
        ]);
    }

    public function update($topicId,$name){
        $topic = Topic::where('id',$topicId)->first();
        $topic->update([
            'slug' => Str::slug($name),
            'name' => $name
        ]);
        return $topic->refresh();
    }

    public function delete($topicId){
        Topic::where('id',$topicId)->delete();
        return true;
    }



}
