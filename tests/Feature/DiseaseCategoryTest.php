<?php

namespace Tests\Feature;

use App\Models\DiseaseCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiseaseCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_list(){
        $diseaseCategories = DiseaseCategory::factory()->count(5)->create();
        $response = $this->get(route('cms.disease-category.getList'));
        $response->assertOk();
        $response->assertJsonCount(5,'data');
        $response->assertJsonPath('data.0.name',$diseaseCategories[0]->name);
    }

    public function test_get_detail(){
        $diseaseCategory = DiseaseCategory::factory()->create();
        $response = $this->get(route('cms.disease-category.getDetail',['diseaseCategoryId' => $diseaseCategory->id]));
        $response->assertOk();
        $response->assertJsonPath('data.name',$diseaseCategory->name);
    }


    public function test_create(){
        $payload = [
            'name' => 'test'
        ];
        $response = $this->post(route('cms.disease-category.create'),$payload);
        $response->assertJsonPath('data.name',$payload['name']);
    }

    public function test_update(){
        $diseaseCategory = DiseaseCategory::factory()->create([
            'name' => 'test1',
            'slug' => 'test1'
        ]);
        $payload = [
            'name' => 'test2'
        ];
        $response = $this->post(route('cms.disease-category.update',['diseaseCategoryId' => $diseaseCategory->id]),$payload);
        $response->assertJsonPath('data.name',$payload['name']);
    }

    public function test_delete(){
        $diseaseCategories = DiseaseCategory::factory()->count(5)->create();
        $response = $this->delete(route('cms.disease-category.delete',['diseaseCategoryId' => $diseaseCategories[0]->id]));
        $response->assertJsonPath('message','Success Delete');
    }
}
