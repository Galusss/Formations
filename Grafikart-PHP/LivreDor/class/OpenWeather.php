<?php
require_once 'CurlException.php';
class OpenWeather {

    private $apiKey;

    public function __construct(string $apiKey) 
    {
        $this->apiKey = $apiKey;
    }
    
    /**
     * Récupère les informations météorologique du jour
     *
     * @param  string $city Ville (ex: "Grenoble,fr")
     * @return array
     */
    public function getToday(string $city): ?array 
    {
        $data = $this->callAPI("weather?q={$city}");
        return [
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description']
        ];
    }
    
    /**
     * Définis la structure d'un appel vers l'API OpenWeather
     *
     * @param  string $endpoint Action a appeller (ex: weather, weather/forecast)
     * 
     * @throws CurlException Curl a rencontré une erreur
     * 
     * @return array
     */
    private function callAPI(string $endpoint): ?array
    {
        $curl = curl_init("http://api.openweathermap.org/data/2.5/{$endpoint}?q={$city},fr&appid={$this->apiKey}&units=metric&lang=fr");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);
        if ($data === false) {
            throw new CurlException($curl);
        }
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($status !== 200 ) {
            curl_close($curl);
            if ($status === 401) {
                json_decode($data, true);
                throw new Exception($data, 401);
            }
            throw new HTTPException ($data, $status);
        }
        curl_close($curl);
        return json_decode($data, true);
    }

}