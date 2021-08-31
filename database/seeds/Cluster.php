<?php

use Illuminate\Database\Seeder;

class Cluster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clusters')->truncate();
        DB::table('clusters')->insert([
            [
                'cluster_name' => 'Jawa Barat',

            ],
            [
                'cluster_name' => 'Jakarta',

            ],
            [
                'cluster_name' => 'Sulawesi',
            ],
            [
                'cluster_name' => 'Jawa Tengah',
            ],
            [
                'cluster_name' => 'Purwakarta',
            ],
        ]);
    }
}
