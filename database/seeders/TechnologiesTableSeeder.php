<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['PHP', 'Laravel', 'Vue', 'Javascript', 'HTML', 'CSS', 'Bootstrap','Vite','Database'];
        foreach ($data as $item) {
            $new_technology = new Technology();
            $new_technology->name = $item;
            $new_technology->slug = Str::slug($item, '-');
            $new_technology->save();
        }
    }

}
