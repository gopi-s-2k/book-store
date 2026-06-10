<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function getWeatherByLatLon(Request $request, WeatherService $weatherService)
    {
        $input = $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric'
        ]);
        $weatherData = $weatherService->getWeatherByCoordinates($input['lat'], $input['lon']);
        
        if(!$weatherData){
            return response()->json([
                'status'  => 'error',
                'message' => 'Unable to fetch weather data at this time. Please try again later.'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data'   => $weatherData
        ]);
    }
}
