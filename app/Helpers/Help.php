<?php

namespace App\Helpers;

use App\Model\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use OjiSatriani\Fungsi;
use setasign\Fpdi\Tcpdf\Fpdi;

class Help extends Fungsi
{

    public static function menu(): ?array
    {
        if ($menu=Menu::whereKode(explode(".", Route::currentRouteName())[0])->first()) {
            $data=[
                'kode'=>$menu->kode ?? NULL, 'model'=>$menu->detail ? ('App\\Model\\'.$menu->detail['model'] ?? NULL) : NULL,
            ];
        }
        return $data ?? NULL;
    }

    /**
     * @param $extension array //type file yang akan ditampilkan
     * @return array
     */
    public static function listFile($path, $extension): array
    {
        $model=[];
        foreach (File::files($path) as $files) {
            if (in_array($files->getExtension(), $extension)) {
                foreach ($extension as $ext) {
                    $name=str_replace('.'.$ext, '', $files->getFilename());
                    $model[$name]=$name;
                }
            }
        }
        return $model;
    }

    public static function shortDescription($content, $length)
    {
        $sentence=strip_tags($content);
        if (str_word_count($sentence) > $length) {
            $limit_sentence=implode(" ", array_slice(explode(" ", $sentence), 0, $length))." ...";
        }
        return $limit_sentence ?? $sentence;
    }

    public static function formatSizeUnits($binner)
    {
        if ($binner >= 1073741824) {
            $binner=number_format($binner / 1073741824, 2).' GB';
        } elseif ($binner >= 1048576) {
            $binner=number_format($binner / 1048576, 2).' MB';
        } elseif ($binner >= 1024) {
            $binner=number_format($binner / 1024, 2).' KB';
        } elseif ($binner > 1) {
            $binner=$binner.' bytes';
        } elseif ($binner == 1) {
            $binner=$binner.' byte';
        } else {
            $binner='0 bytes';
        }
        return $binner;
    }

    public static function generateSeoURL($string, $wordLimit = 0){ 
        $separator = '-'; 
         
        if($wordLimit != 0){ 
            $wordArr = explode(' ', $string); 
            $string = implode(' ', array_slice($wordArr, 0, $wordLimit)); 
        } 
     
        $quoteSeparator = preg_quote($separator, '#'); 
     
        $trans = array( 
            '&.+?;'                 => '', 
            '[^\w\d _-]'            => '', 
            '\s+'                   => $separator, 
            '('.$quoteSeparator.')+'=> $separator 
        ); 
     
        $string = strip_tags($string); 
        foreach ($trans as $key => $val){ 
            $string = preg_replace('#'.$key.'#iu', $val, $string); 
        } 
     
        $string = strtolower($string); 
     
        return trim(trim($string, $separator)); 
    }
    public function alamatIp()
    {
        $ipaddress = '';
        //($_SERVER['SERVER_NAME'])
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

}
