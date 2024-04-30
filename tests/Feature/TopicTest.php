<?php

namespace Tests\Feature;

use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopicTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_list(){
        $topic = Topic::factory()->count(5)->create();
        $response = $this->get(route('cms.topic.getList'));
        $response->assertOk();
        $response->assertJsonCount(5,'data');
        $response->assertJsonPath('data.0.name',$topic[0]->name);
    }

    public function test_get_detail(){
        $topic = Topic::factory()->create();
        $response = $this->get(route('cms.topic.getDetail',['topicId' => $topic->id]));
        $response->assertOk();
        $response->assertJsonPath('data.name',$topic->name);
    }


    public function test_create(){
        $payload = [
            'name' => 'test'
        ];
        $response = $this->post(route('cms.topic.create'),$payload);
        $response->assertJsonPath('data.name',$payload['name']);
    }

    public function test_update(){
        $topic = Topic::factory()->create([
            'name' => 'test1',
            'slug' => 'test1'
        ]);
        $payload = [
            'name' => 'test2'
        ];
        $response = $this->post(route('cms.topic.update',['topicId' => $topic->id]),$payload);
        $response->assertJsonPath('data.name',$payload['name']);
    }

    public function test_delete(){
        $topic = Topic::factory()->count(5)->create();
        $response = $this->delete(route('cms.topic.delete',['topicId' => $topic[0]->id]));
        $response->assertJsonPath('message','Success Delete');
    }
}
