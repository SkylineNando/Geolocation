
<?php
    // Montar a URL da requisição à API Nominatim
    $apiUrl = "https://nominatim.openstreetmap.org/reverse?format=json&lat=-23.6824124&lon=-46.5952992";


    // Inicializar o cURL
    $curl = curl_init($apiUrl);
    
    // Configurar opções do cURL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'SeuUserAgent'); // Substitua pelo seu User-Agent
    
    // Fazer a requisição à API
    $response = curl_exec($curl);
    
    // Verificar se a requisição foi bem-sucedida
    if ($response !== false) {
        $data = json_decode($response, true);

        if (isset($data['address']['village'])) {
            $city = $data['address']['village'];
            echo "Cidade: " . $city;
        } else {
            echo "Cidade não encontrada para essas coordenadas.";
        }
    } else {
        echo "Erro na requisição à API Nominatim.";
    }

    // Fechar a sessão cURL
    curl_close($curl);

 
?>
