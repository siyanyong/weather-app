<?php

namespace App;

use GuzzleHttp\Client;

class WeatherService
{
    private Client $client;

    public function __construct(
        private readonly string $apiKey = '22b6c497f1d70bab11b5a851154465d6',
        private readonly string $apiUrl = 'https://api.openweathermap.org/data/2.5/weather',
    ) {
        $this->client = new Client(); // tightly couples to Guzzle
    }

    public function getWeather(string $city): array
    {
        $response = $this->client->get($this->apiUrl, [
            // Add query parameters to the URL... ?q=city&appid
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
            ]
        ]);

        // $weatherData = json_decode($response->getBody()->getContents(), true); // true to return as associative array
        $weatherData = json_decode((string)$response->getBody(), true); // better practice is to cast to string instead of reading fm stream

        return [
            'city' => $weatherData['name'],
            'temperature' => $weatherData['main']['temp'],
            'description' => $weatherData['weather'][0]['description'],
            'humidity' => $weatherData['main']['humidity']
        ];
    }
}

// We want to run it as such:
// php weather.php Vienna

/* DI
public function __construct(
    private readonly Client $client,
    private readonly string $apiKey,
    private readonly string $apiUrl
) {}

new WeatherService(
    new Client(),
    'key',
    'url'
);

Streams are consumable. If you do this:

$response->getBody()->getContents();
$response->getBody()->getContents(); // ← likely empty

The second call may return nothing unless you rewind the stream.
*/
