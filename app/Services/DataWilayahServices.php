<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DataWilayahServices
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://bagus1508.github.io/api-wilayah-indonesia/api/']);
    }
    
    public function getProvinces()
    {
        $response = $this->client->get('provinces.json');
        $data = json_decode($response->getBody(), true);
        Log::info('Provinces data:', ['data' => $data]); // Log data
        return $data;
    }

    public function getRegencies($provinceId)
    {
        $response = $this->client->get("regencies/{$provinceId}.json");
        $data = json_decode($response->getBody(), true);
        Log::info('Regencies data:', ['data' => $data]); // Log data
        return $data;
    }

    public function getDistricts($regencyId)
    {
        $response = $this->client->get("districts/{$regencyId}.json");
        $data = json_decode($response->getBody(), true);
        Log::info('Districts data:', ['data' => $data]); // Log data
        return $data;
    }

    public function getVillages($districtId)
    {
        $response = $this->client->get("villages/{$districtId}.json");
        $data = json_decode($response->getBody(), true);
        Log::info('Villages data:', ['data' => $data]); // Log data
        return $data;
    }
}
