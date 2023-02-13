<?php

namespace App\Console\Commands;

use App\Model\Perda;
use App\Model\Unor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class TarikUnor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarik:unor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarik data Unit Organisasi aplikasi SMART ASN';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (config('master.artisan_password')==FALSE) {
            $this->eksekusi();
        } else {
            $password = $this->secret('Masukkan password Artisan!!!');
            if ($password == config('master.artisan_password')) {
                $this->eksekusi();
            } else {
                $this->error('Password Artisan Salah!!!');
            }
        }
    }

    public function eksekusi()
    {
        $this->info("\n" .'Pemutakhiran Data Perda SOTK.');
        $mantra       	= with(new Perda)->mantraSemua();
        if($mantra !== NULL)
        {
            foreach($mantra as $dt){
                Perda::updateOrCreate(['id' => $dt['id']], $dt);
            }
        }
        $this->info('Selesai..');
        $this->info("\n" .'Pemutakhiran Data Unit Organisasi');
        $mantra       	= with(new Unor)->mantraSemua();
        if($mantra !== NULL)
        {
            $progress = collect($mantra);
            $bar = $this->output->createProgressBar($progress->count());
            Schema::disableForeignKeyConstraints();
            foreach($mantra as $data){
                Unor::updateOrCreate(['id' => $data['id']], $data);
                $bar->advance();
            }
            Schema::enableForeignKeyConstraints();
            $bar->finish();
        }
    }
}
