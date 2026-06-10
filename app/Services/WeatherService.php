<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService{
    protected string $apiKey = "";
    protected string $baseUrl = "";
    public function __construct() {
        $this->apiKey  = env('WEATHER_API_KEY', '');
        $this->baseUrl = env('WEATHER_API_BASE_URL', '');
    }
    public function getWeatherByCoordinates(float $lat, float $lon): ?array
    {
        try {
            $response = Http::get($this->baseUrl.'data/2.5/weather',
                [
                    'lat'   => $lat,
                    'lon'   => $lon,
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]
            );
            if ($response->successful()) {
                return $response->json();
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}