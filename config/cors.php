<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Aqui podes configurar as tuas definições para "Cross-Origin Resource
    | Sharing". Isto controla como o teu backend responde a pedidos
    | vindos de outros domínios (como a tua app Vue.js).
    |
    | Documentação: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        // !! IMPORTANTE !!
        // Adiciona aqui o URL do teu frontend Vue.js
        // Se o teu Vue corre em http://localhost:5173, adiciona-o:
        
        'http://localhost:5173', 
        
        // Se estiveres a usar outra porta, como 3000, adiciona-a:
        // 'http://localhost:3000',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];