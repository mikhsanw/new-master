<?php

namespace App\Console\Commands;

use App\Model\Eselon;
use App\Model\Jabatan;
use App\Model\JabatanJenis;
use App\Model\Kepangkatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class TarikJabatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarik:jabatan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarik jabatan smart asn';

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
        $this->info("\n" .'Pemutakhiran Data Jabatan Jenis.');
        $jenis				= new JabatanJenis;
        $mantra       	= $jenis->mantraSemua();
        if($mantra !== NULL)
        {
            foreach($mantra as $dt){
                JabatanJenis::updateOrCreate(['id' => $dt['id']], $dt);
            }
        }
        $this->info('Selesai..');

        $this->info("\n" .'Pemutakhiran Data Kepangkatan.');
        $pangkat				= new Kepangkatan;
        $mantra       	= $pangkat->mantraSemua();
        if($mantra !== NULL)
        {
            foreach($mantra as $dt){
                Kepangkatan::updateOrCreate(['id' => $dt['id']], $dt);
            }
        }
        $this->info('Selesai..');

        $this->info("\n" .'Pemutakhiran Data Eselon.');
        $selon				= new Eselon;
        $mantra       	= $selon->mantraSemua();
        if($mantra !== NULL)
        {
            foreach($mantra as $dt){
                Eselon::updateOrCreate(['id' => $dt['id']], $dt);
            }
        }
        $this->info('Selesai..');
        $this->info("\n" .'Pemutakhiran Data Jabatan');
        $jabat				= new Jabatan;
        $mantra       	= $jabat->mantraSemua();
        if($mantra !== NULL)
        {
            $progress = collect($mantra);
            $bar = $this->output->createProgressBar($progress->count());
            Schema::disableForeignKeyConstraints();
            foreach($mantra as $data){
                Jabatan::updateOrCreate(['id' => $data['id']], $data);
                $bar->advance();
            }
            Schema::enableForeignKeyConstraints();
            $bar->finish();
        }
    }
}
