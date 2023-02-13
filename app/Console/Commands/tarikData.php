<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Model\Berita;
use App\Model\foto;
use App\Model\Profil;

class tarikData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarik:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $this->materi();
        // $this->foto();
        // $this->berita();
        // $this->artikel();
    }

    public function materi(){
        $this->info("\n" .'Menarik data.');
        $domain         = file_get_contents('https://kesbangpol.riau.go.id/download.json');
        $datas= json_decode($domain,true);
        if($profil = Profil::whereJenis(config('master.jenis_profil.download'))->whereStatus(3)->first()){
            foreach($datas['data'] as $dt){
                $this->info($dt['judul']);
                $link_image = 'https://kesbangpol.riau.go.id/download/'.$dt['nama_file'];
                $exploded = explode('.', $link_image);
                $extention = '.'.end($exploded);
                $filename = Str::uuid()->toString().$extention;
                $this->download_materi($link_image,$filename, 'upload', $dt);
                $profil->file()->updateOrCreate(['name' => $dt['judul']],[
                    'data'                      =>  [
                        'disk'      => config('filesystems.default'),
                        'target'    => 'upload/file/'.date('Y').'/'.date('m').'/'.date('d').'/'.$filename,
                    ]
                ]);
            }
        }
        $this->info('Selesai..');
    }

    public function foto(){
        $this->info("\n" .'Menarik data.');
        $domain         = file_get_contents('https://kesbangpol.riau.go.id/as_gallery.json');
        $datas= json_decode($domain,true);

        foreach($datas['data'] as $dt){
            if($dt['galeri_gambar']!=''){
                $array = @get_headers('https://kesbangpol.riau.go.id/galeri_foto/'.$dt['galeri_gambar']);
                $string = $array[0];
                if(strpos($string, "200")) {
                    $this->info($dt['title']);
                    $foto = foto::updateOrCreate(['nama' => $dt['title']], ['status'=>config('master.status_foto.galeri')]);
                    $link_image = 'https://kesbangpol.riau.go.id/galeri_foto/'.$dt['galeri_gambar'];
                    $exploded = explode('.', $link_image);
                    $extention = '.'.end($exploded);
                    $filename = Str::uuid()->toString().$extention;
                    $this->download_galeri($link_image,$filename, 'foto', $dt);
                    $foto->file()->updateOrCreate(['morph_id' => $foto->id],[
                        'data'                      =>  [
                            'disk'      => config('filesystems.default'),
                            'target'    => 'foto/foto/'.date('Y', strtotime($dt['created_date'])).'/'.date('m', strtotime($dt['created_date'])).'/'.date('d', strtotime($dt['created_date'])).'/'.$filename,
                        ]
                    ]);
                }
            }  
        }
        $this->info('Selesai..');
    }

    public function artikel(){
        $this->info("\n" .'Menarik data.');
        $domain         = file_get_contents('https://kesbangpol.riau.go.id/as_artikel.json');
        $datas= json_decode($domain,true);

        foreach($datas['data'] as $dt){
            if($dt['active']=='Y'){
                $artikel = Berita::updateOrCreate(['nama' => $dt['title']], ['isi'=>$dt['description'], 'tanggal'=>$dt['post_date'], 'status'=>1]);
                $this->info($dt['title']);
                if($dt['image']!=''){
                    $array = @get_headers('https://kesbangpol.riau.go.id/artikel/'.$dt['image']);
                    $string = $array[0];
                    if(strpos($string, "200")) {
                        $link_image = 'https://kesbangpol.riau.go.id/artikel/'.$dt['image'];
                        $exploded = explode('.', $link_image);
                        $extention = '.'.end($exploded);
                        $filename = Str::uuid()->toString().$extention;
                        $this->download($link_image,$filename, 'artikel', $dt);
                        $artikel->file()->updateOrCreate(['morph_id' => $artikel->id],[
                            'data'                      =>  [
                                'disk'      => config('filesystems.default'),
                                'target'    => 'artikel/artikel/'.date('Y', strtotime($dt['post_date'])).'/'.date('m', strtotime($dt['post_date'])).'/'.date('d', strtotime($dt['post_date'])).'/'.$filename,
                            ]
                        ]);
                    }
                }   
            }
        }
        $this->info('Selesai..');
    }

    public function berita(){
        $this->info("\n" .'Menarik data.');
        $domain         = file_get_contents('https://kesbangpol.riau.go.id/as_news.json');
        $datas= json_decode($domain,true);

        foreach($datas['data'] as $dt){
            if($dt['active']=='Y'){
                $berita = Berita::updateOrCreate(['nama' => $dt['title']], ['isi'=>$dt['description'], 'tanggal'=>$dt['post_date']]);
                $this->info($dt['title']);
                if($dt['image']!=''){
                    $array = @get_headers('https://kesbangpol.riau.go.id/berita/'.$dt['image']);
                    $string = $array[0];
                    if(strpos($string, "200")) {
                        $link_image = 'https://kesbangpol.riau.go.id/berita/'.$dt['image'];
                        $exploded = explode('.', $link_image);
                        $extention = '.'.end($exploded);
                        $filename = Str::uuid()->toString().$extention;
                        $this->download($link_image,$filename, 'berita', $dt);
                        $berita->file()->updateOrCreate(['morph_id' => $berita->id],[
                            'data'                      =>  [
                                'disk'      => config('filesystems.default'),
                                'target'    => 'berita/berita/'.date('Y', strtotime($dt['post_date'])).'/'.date('m', strtotime($dt['post_date'])).'/'.date('d', strtotime($dt['post_date'])).'/'.$filename,
                            ]
                        ]);
                    }
                }   
            }
        }
        $this->info('Selesai..');
    }

    public function download($link_image,$filename, $code, $dt)
    {
        File::makeDirectory(storage_path('app/'.$code.'/'.$code.'/'.date('Y', strtotime($dt['post_date'])).'/'.date('m', strtotime($dt['post_date'])).'/'.date('d', strtotime($dt['post_date']))), 0777, true, true);
        (new Client)->request('GET', $link_image, [
            'verify' => false,
            'sink'=>storage_path('app/'.$code.'/'.$code.'/'.date('Y', strtotime($dt['post_date'])).'/'.date('m', strtotime($dt['post_date'])).'/'.date('d', strtotime($dt['post_date'])).'/'.$filename),
        ]);
    }

    public function download_galeri($link_image,$filename, $code, $dt)
    {
        File::makeDirectory(storage_path('app/'.$code.'/'.$code.'/'.date('Y', strtotime($dt['created_date'])).'/'.date('m', strtotime($dt['created_date'])).'/'.date('d', strtotime($dt['created_date']))), 0777, true, true);
        (new Client)->request('GET', $link_image, [
            'verify' => false,
            'sink'=>storage_path('app/'.$code.'/'.$code.'/'.date('Y', strtotime($dt['created_date'])).'/'.date('m', strtotime($dt['created_date'])).'/'.date('d', strtotime($dt['created_date'])).'/'.$filename),
        ]);
    }    

    public function download_materi($link_image,$filename, $code, $dt)
    {
        File::makeDirectory(storage_path('app/'.$code.'/file/'.date('Y').'/'.date('m').'/'.date('d')), 0777, true, true);
        (new Client)->request('GET', $link_image, [
            'verify' => false,
            'sink'=>storage_path('app/'.$code.'/file/'.date('Y').'/'.date('m').'/'.date('d').'/'.$filename),
        ]);
    }
}
