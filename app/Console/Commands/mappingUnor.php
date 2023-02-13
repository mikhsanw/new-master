<?php

namespace App\Console\Commands;

use App\Model\Unor;
use Illuminate\Console\Command;

class mappingUnor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mapping:unor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Untuk menyusun organisasi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $unor = Unor::all();
        foreach ($unor as $item) {
            $pecah = explode(' ', $item->nama);
            if(strtoupper($pecah[0]) == 'BIRO' || is_null($item->parent_id)){
                $item->update(['opd_id' => $item->id]);
                $this->info($item->nama.' => '.$item->id);
            }
        }
    }
}
