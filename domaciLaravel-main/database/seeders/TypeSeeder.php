<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

use Illuminate\Database\Factories\TypeFactory;


class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1=Type::create([
            'name' => "sport"
        ]);

        $type2=Type::create([
            'name' => "running"
        ]);

        $type3=Type::create([
            'name' => "elegant"
        ]);

        $type4=Type::create([
            'name' => "lifestyle"
        ]);
    }
}
