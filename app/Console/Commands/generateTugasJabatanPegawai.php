<?php

namespace App\Console\Commands;

use App\AgendaHarian;
use App\Model\Pegawai;
use App\TugasJabatan;
use App\TugasJabatanPegawai;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class generateTugasJabatanPegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:tugas_jabatan_pegawai {nip}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate tugas jabatan pegawai';

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
        $this->info("\n" .'Pemutakhiran Data Uraian Tugas pegawai.');
        $mantra       	= with(new AgendaHarian)->uraian_tugas($this->argument('nip'));
        if($mantra !== NULL)
        {
            $pegawai = Pegawai::whereNip($this->argument('nip'))->latest()->first();
            if($pegawai !== NULL)
            {

                $progress   = collect($mantra);
                $bar        = $this->output->createProgressBar($progress->count());
                Schema::disableForeignKeyConstraints();
                foreach($mantra as $data){
                    $uraian_tugas = TugasJabatan::firstOrCreate(['anjab_uraian_tugas_id' => $data['uraian_tugas_id']],
                                                                [
                                                                    'nama'  => $data['uraian_tugas_nama'],
                                                                    'waktu' => $data['uraian_waktu']
                                                                ]);
                    TugasJabatanPegawai::updateOrCreate([
                                                    'pegawai_id' => $pegawai->id,
                                                    'tugas_jabatan_id' => $uraian_tugas->id
                                                ]);
                    $bar->advance();
                }
                Schema::enableForeignKeyConstraints();
                $bar->finish();
            } else {
                $this->error("\n" .'Tidak ditemukan pegawai dengan NIP '.$this->argument('nip'));
                exit();
            }
        }
        $this->info('Selesai..');

        $this->info("\n" .'Pemutakhiran Data Tahapan pegawai.');
        $mantra       	= with(new AgendaHarian)->mantra_tahapan($this->argument('nip'));
        if($mantra !== NULL)
        {
            $pegawai = Pegawai::whereNip($this->argument('nip'))->latest()->first();
            if($pegawai !== NULL)
            {

                $progress   = collect($mantra);
                $bar        = $this->output->createProgressBar($progress->count());
                Schema::disableForeignKeyConstraints();
                foreach($mantra as $data){
                    $uraian_tugas = TugasJabatan::firstOrCreate(['anjab_tahapan_id' => $data['tahapan_id']],
                                                                [
                                                                    'nama'  => $data['tahapan_nama'],
                                                                    'waktu' => $data['tahapan_waktu']
                                                                ]);
                    TugasJabatanPegawai::updateOrCreate([
                                                    'pegawai_id' => $pegawai->id,
                                                    'tugas_jabatan_id' => $uraian_tugas->id,
                                                    'tahapan' => true
                                                ]);
                    $bar->advance();
                }
                Schema::enableForeignKeyConstraints();
                $bar->finish();
            }
        }
        $this->info('Selesai..');
    }
}
