<?php

use Illuminate\Database\Seeder;

class StablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('establishments')->delete();
        factory(App\Models\Establishment::class)->create();
    }
}
