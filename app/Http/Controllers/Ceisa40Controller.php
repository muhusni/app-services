<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Ceisa40Controller extends Controller
{
    use ApiTraits;

    public function show($id)
    {
        $query = (object) [
            "kodeKantor" => "050100",
            "kodeJalur" => "",
            "namaPerusahaan" => "",
            "nomorAju" => $id,
            "status" => "",
            "kodeDokumen" => "",
            "nomorDaftar" => "",
            "tanggalDokumenStart" => "",
            "tanggalDokumenEnd" => "",
        ];
        $dataPIB = $this->getDokumenCeisa40($query);
        return $dataPIB;
    }

    public function showCeisa40(Request $request) 
    {
        $query = (object) [
            "kodeKantor" => "050100",
            "kodeJalur" => $request->kodeJalur,
            "namaPerusahaan" => $request->namaPerusahaan,
            "nomorAju" => $request->nomorAju,
            "status" => $request->status,
            "kodeDokumen" => $request->kodeDokumen,
            "nomorDaftar" => $request->nomorDaftar,
            "tanggalDokumenStart" => $request->tanggalDokumenStart,
            "tanggalDokumenEnd" => $request->tanggalDokumenEnd,
        ];
        $dataPIB = $this->getDokumenCeisa40($query);
        return $dataPIB;
    }

    public function showDocCount($kodeDokumen)
    {
        $query = (object) [
            "kodeKantor" => "050100",
            "kodeJalur" => "",
            "namaPerusahaan" => "",
            "nomorAju" => "",
            "status" => "terdaftar",
            "kodeDokumen" => $kodeDokumen,
            "nomorDaftar" => "",
            "tanggalDokumenStart" => date("Y-m-d"),
            "tanggalDokumenEnd" => date("Y-m-d"),
        ];
        $dataPIB = $this->getDokumenCeisa40($query);
        return $dataPIB->size;
    }

    public function showV1()
    {
        $dataPIB = $this->getDokumenCeisa40V1();
        return $dataPIB;
    }

    public function downloadRespon($idAju, $idRespon)
    {
        $externalApiUrl = 'https://example.com/api/get-pdf'; // Replace with the actual external API URL
        $URL = env('API_CEISA40') . '/v2/report-service/respon/' . $idAju . '/' . $idRespon;
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        // "https://apis-gw.customs.go.id/v2/report-service/respon/da2bf91f-6b76-4c70-9c44-03be6d5c6f46/a9d82fca-9c66-482f-bbc6-44518078c7dd"
        // Make a request to the external API to retrieve the PDF file
        $response = Http::acceptJson()->withToken(env('CEISA40_TOKEN'))->withHeaders($HEADERS)
            ->get($URL);

        if ($response->successful()) {
            // Get the content of the PDF from the response
            $pdfContent = $response->body();

            // Return the PDF as a response with the appropriate headers
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="downloaded.pdf"');
        } else {
            return response()->json(['message' => 'Unable to retrieve PDF from the external API.'], 500);
        }
    }

    public function downloadResponAwal($nomorAju, $idResponAwal)
    {
        $URL = env('API_CEISA40') . '/v2/report-service/respon/awal/' . $nomorAju . '/' . $idResponAwal;
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        // "https://apis-gw.customs.go.id/v2/report-service/respon/da2bf91f-6b76-4c70-9c44-03be6d5c6f46/a9d82fca-9c66-482f-bbc6-44518078c7dd"
        // Make a request to the external API to retrieve the PDF file
        $response = Http::acceptJson()->withToken(env('CEISA40_TOKEN'))->withHeaders($HEADERS)
            ->get($URL);

        if ($response->successful()) {
            // Get the content of the PDF from the response
            $pdfContent = $response->body();

            // Return the PDF as a response with the appropriate headers
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="downloaded.pdf"');
        } else {
            return response()->json(['message' => 'Unable to retrieve PDF from the external API.'], 500);
        }
    }

    // https://apis-gw.customs.go.id/v2/report-service/formulir/20/da2bf91f-6b76-4c70-9c44-03be6d5c6f46
    public function downloadDrafDokumen($kodeDokumen, $idHeader)
    {
        $URL = env('API_CEISA40') . '/v2/report-service/formulir/' . $kodeDokumen . '/' . $idHeader;
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        // "https://apis-gw.customs.go.id/v2/report-service/respon/da2bf91f-6b76-4c70-9c44-03be6d5c6f46/a9d82fca-9c66-482f-bbc6-44518078c7dd"
        // Make a request to the external API to retrieve the PDF file
        $response = Http::acceptJson()->withToken(env('CEISA40_TOKEN'))->withHeaders($HEADERS)
            ->get($URL);

        if ($response->successful()) {
            // Get the content of the PDF from the response
            $pdfContent = $response->body();

            // Return the PDF as a response with the appropriate headers
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="downloaded.pdf"');
        } else {
            return response()->json(['message' => 'Unable to retrieve PDF from the external API.'], 500);
        }
    }

    public function getRiwayatRespon($idHeader, $nomorAju)
    {
        // https://apis-gw.customs.go.id/v2/parser/v1/Respon/getRespon/41a75fce-1ae8-4b2f-8c76-5d896f56f845/04030000122320231020000313
        $URL = env('API_CEISA40') . '/v2/parser/v1/Respon/getRespon/' . $idHeader . '/' . $nomorAju;
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        $response = Http::acceptJson()->withToken(env('CEISA40_TOKEN'))->withHeaders($HEADERS)
            ->get($URL);

        return json_decode($response);
    }

    public function getRiwayatStatus($idHeader)
    {
        $URL = env('API_CEISA40') . '/v2/parser/v1/proses/getRiwayatStatus/' . $idHeader;
        // $URL = "https://apis-gw.customs.go.id/v2/parser/v1/proses/getRiwayatStatus/0695b730-c6b4-4397-925c-7132b61d4648";
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        $response = Http::acceptJson()
            ->withToken(env('CEISA40_TOKEN'))
            ->withHeaders($HEADERS)
            ->get($URL);

        return json_decode($response);
    }

    public function kirimUlangInsw($idHeader)
    {
        $URL = env('API_CEISA40') . '/v2/parser/v1/lnsw/responLNSW/?idHeader=' . $idHeader;
        // $URL = "https://apis-gw.customs.go.id/v2/parser/v1/proses/getRiwayatStatus/0695b730-c6b4-4397-925c-7132b61d4648";
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        $response = Http::acceptJson()
            // ->withToken(env('CEISA40_TOKEN'))
            ->withHeaders($HEADERS)
            ->post($URL);

        return response()->json(json_decode($response), $response->getStatusCode());
    }

    public function loginPortal()
    {
        $URL = env('API_URL') . '/v2/authws/user/login';
        $data = [
            "username" => env("H2H_USER"),
            "password" => env("H2H_PASSWORD")
        ];
        $response = Http::acceptJson()
            // ->withToken(env('CEISA40_TOKEN'))
            ->post($URL, $data);
        
        return json_decode($response->status());
    }

    public function loginCeisa40()
    {
        $URL = env('API_CEISA40') . '/v3/authws/user/login';
        $HEADERS = ['beacukai-api-key' => env("BC_API_KEY")];
        $data = [
            "username" => env("USER_CEISA40"),
            "password" => env("PASS_CEISA40")
        ];
        $response = Http::acceptJson()
            // ->withToken(env('CEISA40_TOKEN'))
            ->withHeaders($HEADERS)
            ->post($URL, $data);
        
        return json_decode($response->status());
    }
}
