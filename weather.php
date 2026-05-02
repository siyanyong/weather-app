<?php

use App\WeatherService;

require_once __DIR__ . '/vendor/autoload.php';

$weatherService = new WeatherService();
$city = $argv['1']; // get the second argument
$weather = $weatherService->getWeather($city);
// var_dump($weather);
echo "\n";
echo "City: " . $weather['city'] . "\n";
echo "Temperature: " . $weather['temperature'] . "°C\n";
echo "Description: " . $weather['description'] . "\n";
echo "Humidity: " . $weather['humidity'] . "%\n";

/*
🔥 MOST IMPORTANT STEP (people miss this)

After ANY change to:

file names
namespaces
composer.json

You MUST run:

composer dump-autoload

Without this → Composer still uses old class map → class “not found”.
*/
