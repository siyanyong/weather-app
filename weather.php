<?php

use App\WeatherService;

require_once __DIR__ . '/vendor/autoload.php';

if ($argc < 2) { // must have two arguments
    echo "Correct Usage: php weather.php city\n";
    exit(1); // 0 is success and 1 is generic error
}

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

Other possible improvements:

1. Include apiKey in env variable
2. There are frameworks to build CLI appllcations!
3. May want to handle exceptions

*/
