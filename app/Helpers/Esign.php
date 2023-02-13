<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class Esign
{
    public function checkStatus($nik='')
    {
        return (new Client)->request('GET', config('master.esign.host').'/api/user/status/'.$nik, [
            'auth'   =>[
                config('master.esign.client_id'), config('master.esign.client_secret'),
            ], 'curl'=>[
                CURLOPT_SSL_VERIFYHOST=>FALSE, CURLOPT_SSL_VERIFYPEER=>FALSE,
            ],
        ])->getBody()->getContents();
    }

    public function signInvisible($nik='', $pass='', $pdf='', $tag='', $linkQR='')
    {
        $client=new Client;
        $response=$client->request('POST', config('master.esign.host').'/api/sign/pdf', [
            'auth'        =>[
                config('master.esign.client_id'), config('master.esign.client_secret'),
            ], 'multipart'=>[
                [
                    'name'=>'file', 'contents'=>fopen($pdf, 'r'), 'filename'=>basename($pdf),
                ], [
                    'name'=>'nik', 'contents'=>$nik,
                ], [
                    'name'=>'passphrase', 'contents'=>$pass,
                ], [
                    'name'=>'tampilan', 'contents'=>'invisible',
                ], [
                    'name'=>'linkQR', 'contents'=>'',
                ], [
                    'name'=>'width', 'contents'=>'',
                ], [
                    'name'=>'height', 'contents'=>'',
                ],
            ], 'curl'     =>[
                CURLOPT_SSL_VERIFYHOST=>FALSE, CURLOPT_SSL_VERIFYPEER=>FALSE,
            ],
        ]);
        return $response->getBody()->getContents();
    }

    public function esignResult($esign)
    {
        if ($esign['status_code'] == 1111) {
            $res=[
                'status'=>TRUE, 'data'=>[
                    'code'=>$esign['status_code'], 'message'=>ucwords(strtolower($esign['message'])),
                ], 'msg'=>'NIP is valid',
            ];
        }
        else {
            if ($esign['status_code'] == 1110) {
                $res=[
                    'status'=>FALSE, 'data'=>[
                        'code'=>$esign['status_code'], 'message'=>ucwords(strtolower($esign['message'])),
                    ], 'msg'=>'Anda belum terdaftar sebagai pengguna e-sign, segera menghubungi Bidang Persandian Diskominfotik Provinsi Riau untuk penerbitan e-sign, Terimakasih.',
                ];
            }
            else {
                $res=[
                    'status'=>FALSE, 'data'=>[
                        'code'=>$esign['status_code'], 'message'=>ucwords(strtolower($esign['message'])),
                    ], 'msg'=>$esign['message'],
                ];
            }
        }
        return $res;
    }
}
