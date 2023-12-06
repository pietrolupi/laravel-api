<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Front-End', 'Back-End', 'Full-Stack'];
        foreach ($data as $item) {
            $new_type = new Type();
            $new_type->name = $item;
            $new_type->slug = Str::slug($item, '-');
            $new_type->save();
        }
    }
}
