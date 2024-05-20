<?php

namespace App\Livewire;

use GuzzleHttp\Client; // Pastikan untuk mengimpor Client dari GuzzleHttp
use Livewire\Component;

class AjuanDarah extends Component
{
    public $result; // Deklarasikan variabel $result sebagai properti publik
    public $inputNama;
    public $NomorHandphone;
    public $inputProvinsi;
    public $inputKota;
    public $inputKecamatan;
    public $inputKelurahan;
    public $inputAlamat;
    public $inputGolonganDarah;
    public $inputProdukDarah;
    public $inputKepentingan;
    public $inputDeskripsi;

    public function render()
    {
        $villageId = 123; // Ganti dengan id desa yang sesuai
        $locationUrl = "https://wilayah.skripsi-kita.my.id/apis/village/{$villageId}";

        $client = new Client();

        $response = $client->get($locationUrl);
        $this->result = json_decode($response->getBody());

        return view('livewire.ajuan-darah', [
            'result' => $this->result, // Meneruskan $result ke view
        ]);
    }

    public function postData()
    {
        $client = new Client();
        Log::info('clicked');
        try {
            $response = $client->post('/blood/request', [
                'form_params' => [
                    'patient_name' => $this->inputNama,
                    'necessity' => $this->inputKepentingan,
                    'description' => $this->inputDeskripsi,
                    'qty' => 50, // Change to your desired quantity
                    'address' => $this->inputAlamat,
                    'village_id' => '49559', // Assuming this is where the village ID is stored in the response
                    'latitude' => '-7.3522145', // Assuming this is where the latitude is stored in the response
                    'longitude' => '112.6917595', // Assuming this is where the longitude is stored in the response
                    'blood_id' => 1, // Change to your desired blood ID
                    'blood_product_id' => 1, // Change to your desired blood product ID
                ],
            ]);

            $statusCode = $response->getStatusCode();
            // You can handle response here, if needed

            // For example, if you want to get the response body:
            $body = $response->getBody()->getContents();
            // Do something with $body
            dd($body);

            // You can add any further handling you need
        } catch (\Exception $e) {
            // Handle any exceptions here
            dd($e->getMessage()); // For example, just dumping the error message for now
        }
    }
}
