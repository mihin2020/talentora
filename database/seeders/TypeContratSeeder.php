<?php

namespace Database\Seeders;

use App\Models\TypeContrat;
use Illuminate\Database\Seeder;

class TypeContratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['CDD', 'CDI', 'Stage', 'Freelance'];

        foreach ($types as $type) {
            TypeContrat::firstOrCreate(['name' => $type]);
        }
    }
}
