<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class aplikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public $userpass='root';

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('aplikasis')->truncate();
        DB::table('aplikasis')->insert([
            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
            'nama'=>'New Application',
            'singkatan'=>'NEW APPLICATION',
            'daerah'=>'Pemerintah Kabupaten Bengkalis',
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
