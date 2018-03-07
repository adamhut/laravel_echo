<?php


use App\User;
use App\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ProjectSeeder::class);

        $project = Project::find(1);
        $user = User::find(1);
        $project->participants()->attach($user);

        $user = User::find(2);
        $project->participants()->attach($user);
    }
}
