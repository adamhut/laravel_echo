<?php

use App\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();
        $project1 = factory(Project::class)->create([
            'name' =>'Adam',
        ]);

        $project2 = factory(Project::class)->create([
            'name' => 'Jeffery',
        ]);
    }
}
