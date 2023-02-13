<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AgendaHarian;
use Illuminate\Support\Facades\Schema;
use App\TugasJabatan;

class tarikUraianTugasSemua extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarik:uraian_tugas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarik data semua Uraian Tugas / Tahapan Pegawai pada aplikasi sijabpri';

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
        $this->info("\n" .'Pemutakhiran Data Uraian Tugas.');
        $mantra       	= with(new AgendaHarian)->mantra_uraian_tugas_semua();
        if($mantra !== NULL)
        {
            $progress   = collect($mantra);
            $bar        = $this->output->createProgressBar($progress->count());
            Schema::disableForeignKeyConstraints();
            foreach($mantra as $data){
                TugasJabatan::updateOrCreate([
                                                'anjab_uraian_tugas_id' => $data['uraian_tugas_id']
                                            ], 
                                            [
                                                'nama' => $data['uraian_tugas_nama'], 
                                                'waktu' => $data['uraian_waktu']
                                            ]);
                $bar->advance();
            }
            Schema::enableForeignKeyConstraints();
            $bar->finish();
        }
        $this->info('Selesai..');

        $this->info("\n" .'Pemutakhiran Data Tahapan.');
        $mantra       	= with(new AgendaHarian)->mantra_tahapan_semua();
        if($mantra !== NULL)
        {
            $progress   = collect($mantra);
            $bar        = $this->output->createProgressBar($progress->count());
            Schema::disableForeignKeyConstraints();
            foreach($mantra as $dt){
                $uraian_tugas = TugasJabatan::whereAnjabUraianTugasId($dt['uraian_tugas_id'])->first();
                TugasJabatan::updateOrCreate([
                                                'anjab_tahapan_id' => $dt['tahapan_id']
                                            ], 
                                            [
                                                'parent_id'                     => $uraian_tugas->id, 
                                                'nama'                          => $dt['tahapan_nama'], 
                                                'anjab_uraian_tugas_id'         => $dt['uraian_tugas_id'], 
                                                'waktu'                         => $dt['tahapan_waktu']
                                            ]);
                $bar->advance();
            }
            Schema::enableForeignKeyConstraints();
            $bar->finish();
        }
        $this->info('Selesai..');

    }
}
