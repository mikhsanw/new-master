<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        $this->call(aksesGrupSeeder::class);
        $this->call(menuSeeder::class);
        $this->call(aksesMenuSeeder::class);
        $this->call(userSeeder::class);
        $this->call(aplikasiSeeder::class);
        $this->command->info("Login dengan \n username : ". with(new userSeeder)->userpass ."\n password : ".with(new userSeeder)->userpass);
        $this->command->info("Silahkan login");
    }
}
