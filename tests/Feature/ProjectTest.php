<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\Project; 
use \App\Models\User;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectTest extends TestCase
{

    use DatabaseMigrations;

    public function testValidateStatusis200WhenGetProject()
    {
        $response = $this->get('/project');

        $response->assertStatus(200);
    }

    public function testTagH1ListeDesprojetsExist()
    {
        $response = $this->get('/project');

        $value = '<h1>Liste des projets</h1>';

        $response->assertSee($value, false);
    }

    public function testLoloIsInDB()
    {
        $project = User::factory()
        ->create([
            'name'=>'Lolo'
        ]);
        $this->assertDatabaseHas("users",['name'=>'Lolo']);
    }

    public function testProjectIsInDB()
    {
        
        
        $project = Project::factory()
        ->create([
            'name'=>'Project'
        ]);
        // $this->assertDatabaseHas("projects",['name'=>'Project']);
        $response = $this->get('/project');
        $response->assertSee($project->name, false);
    }


    public function testViewDetailsExist()
    {
        
        $project = Project::factory()
        ->create([
            'name'=>'Project'
        ]);
        // $this->assertDatabaseHas("projects",['name'=>'Project']);
        $response = $this->get('/project/'.$project->id);
        $response->assertSee($project->name, false);
    }

}