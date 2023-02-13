<?php

namespace App\Helpers;

use App\Model\Aksesgrup;
use App\Model\JabatanPenempatan;
use App\Model\UnorJenisDetail;

class Mapping
{
    /**
     * Method ini belum selesai masih akan dikembangkan jika diperlukan
     * @param          $list_opd  // List penerima pertama
     * @param          $list_lingkungan_setda  // List penerima kedua
     * @param  string  $jenis      // Sususan nama yang ingin ditampilkan
     * @param  bool    $merge      // Gabungkan $list_opd dan $list_lingkungan_setda
     * @return array
     */
    public static function susunPenerima($list_opd, $list_lingkungan_setda, string $jenis, bool $merge=TRUE)
    {
        switch ($jenis) {
            case 'nama_kantor':
                if ($merge) {
                    $list_opd =collect($list_opd)->except($list_opd->search('SEKRETARIAT DAERAH'));
                    foreach ($list_lingkungan_setda as $key=>$value) {
                        $responses[$key]=$value;
                    }
                }
                foreach ($list_opd as $key=>$value) {
                    if ($ujd=UnorJenisDetail::where('unor_id', $key)->first()) {
                        if($akses=Aksesgrup::where('alias', ($ujd->unor_jenis_id == 1) ? 'admin_setda' : 'admin')->first()){
                            if ((new JabatanPenempatan)->getAksesGrupPegawai($key, $akses->id)->select('users.pegawai_id')->first()) {
                                if ($merge) {
                                    if (collect($responses)->search($value) === FALSE) {
                                        $responses[$key]=$value;
                                    }
                                }else{
                                    $responses[$key]=$value;
                                }
                            }
                        }
                    }
                }
                break;
            case 'nama_jabatan':
                if ($merge) {
                    foreach ($list_lingkungan_setda as $key=>$value) {
                        $responses[$key]=$value;
                    }
                }
                foreach ($list_opd as $key=>$value) {
                    $responses[$key]=$value;
                }
                break;
            case 'nama_pegawai':
                if ($merge) {
                    foreach ($list_lingkungan_setda as $key=>$value) {
                        $responses[$key]=$value;
                    }
                }
                foreach ($list_opd as $key=>$value) {
                    $responses[$key]=$value;
                }
                break;
            default:
                $responses=[];
                break;
        }
        return $responses ?? [];
    }
}
