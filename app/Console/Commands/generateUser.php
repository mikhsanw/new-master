<?php

namespace App\Console\Commands;

use App\Http\Controllers\Backend\userController;
use App\Model\Pegawai;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class generateUser extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature='generate:user';

    /**
     * The console command description.
     * @var string
     */
    protected $description='Command description';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle()
    {
        $myRequest=new Request;
        $myRequest->setMethod('POST');
        $this->info('Mengunduh data dari SMART-ASN ...');
        try {
            if ($mantra=(new Pegawai)->mantraSeluruhPegawai()) {
                $bar=$this->output->createProgressBar(count($mantra));
                $this->info('Update ('.count($mantra).') data pegawai ..');
                foreach ($mantra as $pegawai) {
                    if (is_null(Pegawai::where('nip', $pegawai['nip'])->first())) {
                        $myRequest->request->add(['username'=>$pegawai['nip'], 'password'=>base64_encode(1)]);
                        try {
                            $response=(new userController)->masuk($myRequest) ?? NULL;
                        } catch (\Exception $exception) {
                            $error[]=$myRequest->username.': '.$exception->getMessage();
                        }
                    }
                    $bar->advance();
                }
                $bar->finish();
                $this->info('Selesai');
                if (isset($error)) {
                    $this->error('Terjadi kesalahan pada: '.count($error).' data');
                    foreach ($error as $item) {
                        $this->error($item);
                    }
                }
            }
            else {
                $this->error('Gagal mengunduh data pegawai');
            }
        } catch (\Exception $error) {
            $this->alert($error->getMessage());
        }
        return $response ?? NULL;
    }
}
