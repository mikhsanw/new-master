<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public $userpass='root';

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
            'nip'=>'root',
            'nama'=>'root',
            'password'=>bcrypt($this->userpass),
            'aksesgrup_id'=>1,
            'level'=>1,
            'email'=>'spbe@riau.go.id',
            'email_verified_at'=>date("Y-m-d H:i:s"),
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
