<?php

namespace App\Traits;
// use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

trait ApiTraits
{
    public function getPib($aju)
    {
        $dataPIB = Http::acceptJson()->withBasicAuth(env('INSW_USER'), env('INSW_PASS'))
            ->get(
                env('API_INSW') . '/cms/pib?no_pengajuan=' . $aju
            );
        return json_decode($dataPIB);
    }

    public function getDokumenCeisa40($query)
    {
        $URL = env('API_CEISA40') . "/v2/browse-service/v1/browse/dokumen-pabean-inhouse-new?kodeKantor={$query->kodeKantor}&kodeJalur={$query->kodeJalur}&namaPerusahaan={$query->namaPerusahaan}&nomorAju={$query->nomorAju}&status={$query->status}&kodeDokumen={$query->kodeDokumen}&nomorDaftar={$query->nomorDaftar}&tanggalDokumenEnd={$query->tanggalDokumenEnd}&tanggalDokumenStart={$query->tanggalDokumenStart}";
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        $dataPIB = Http::acceptJson()->withToken(env('CEISA40_TOKEN'))->withHeaders($HEADERS)
            ->get($URL);
        return json_decode($dataPIB);
    }

    public function getDokumenCeisa40V1()
    {
        $URL = env('API_CEISA40') . "/v2/browse-service/v1/browse/dokumen-pabean-inhouse?kodeKantor=050100&";
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        $dataPIB = Http::acceptJson()->withToken(env('CEISA40_TOKEN'))->withHeaders($HEADERS)
            ->get($URL);
        return json_decode($dataPIB);
    }

    public function getPeb($aju)
    {
        $dataPIB = Http::acceptJson()->withBasicAuth(env('INSW_USER'), env('INSW_PASS'))
            ->get(
                env('API_INSW') . '/cms/peb?no_pengajuan=' . $aju
            );
        return json_decode($dataPIB);
    }

    private function getToken()
    {
        $credentials = (object) [
            'username' => env('H2H_USER'),
            'password' => env('H2H_PASSWORD')
        ];
        $token = Http::acceptJson()->post(env('API_URL') . '/auth-amws/v1/user/login', $credentials);
        $decodedToken = json_decode($token);

        return $decodedToken->item->access_token;
    }
}
