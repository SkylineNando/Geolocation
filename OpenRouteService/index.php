<?php
if (isset($_GET['origin']) && isset($_GET['destination'])) {
    $origin = urlencode($_GET['origin']);
    $destination = urlencode($_GET['destination']);

    // Chave da API do OpenRouteService (se necessário)
    $apiKey = 'SUA_CHAVE_DE_API_DO_OPENROUTESERVICE';

    // Montar a URL da requisição à API de roteamento
    $apiUrl = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$apiKey&start=$origin&end=$destination";

    // Fazer a requisição à API
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    // Verificar se a requisição foi bem-sucedida
    if (isset($data['features'][0]['properties']['segments'][0]['distance'])) {
        $distance = $data['features'][0]['properties']['segments'][0]['distance'] / 1000; // Converter para quilômetros
        echo "Distância pela estrada: " . round($distance, 2) . " km";
    } else {
        echo "Não foi possível calcular a distância pela estrada.";
    }
} else {
    echo "Origem e destino não fornecidos.";
}
?>
