<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Functions\Helper;
use Faker\Generator as Faker;
use App\Models\Type;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i = 0; $i < 20; $i++){
            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->title = $faker-> name;
            $new_project->slug = Helper::generateSlug($new_project->title, Project::class);
            $new_project->description = $faker->paragraph();
            $new_project->github_link = $faker->url;
            $new_project->other_developers = $faker->name;
            $new_project->save();
    /*     $data = [

            [
                'title' => 'Laravel Boolfolio',
                'slug' => 'laravel-boolfolio',
                'description' => 'Descrizione del progetto Boolfolio',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 1,

            ],

            [
                'title' => 'Laravel Placeholder',
               'slug' => 'laravel-placeholder',
                'description' => 'Descrizione del progetto Boolfolio',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 2,

            ],

            [
                'title'=> 'Laravel DC Comics',
                'description' => 'Descrizione del progetto DC Comics',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 3,

            ],

            [
                'title'=> 'Laravel Boolando',
                'description' => 'Descrizione del progetto DC Comics',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 4,

            ],

            [
                'title'=> 'PHP ToDo List',
                'description' => 'Descrizione del progetto DC Comics',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 5,

            ],

            [
                'title'=> 'PHP Strong Password',
                'description' => 'Descrizione del progetto DC Comics',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 6,

            ],

            [
                'title'=> 'Midterm Project',
                'description' => 'Descrizione del progetto DC Comics',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 7,

            ],

            [
                'title'=> 'Final Project',
                'description' => 'Descrizione del progetto DC Comics',
                'image' => 'https://placehold.co/600x400',
                'github_link' => 'link-al-repository-su-GitHub',
                'other_developers' => '',
                //aggiungo il type al progetto
                'type_id' => 8,

            ]

        ]; */
        /* $data = ['Laravel Boolfolio', 'Laravel DC Comics', 'Laravel Boolando', 'PHP ToDo List ', 'PHP Strong Password', 'Midterm Project', 'Vite Boolando', 'Vue Slider', 'Social Posts']; */
/*         foreach ($data as $item) {

            $new_project = new Project();
            $new_project->title = $item['title'];
            $new_project->slug = Str::slug($item['title'], '-');
            $new_project->description = $item['description'];
            $new_project->image = $item['image'];
            $new_project->github_link = $item['github_link'];
            $new_project->other_developers = $item['other_developers'];
            $new_project->save();

        } */
    }

    }

}
