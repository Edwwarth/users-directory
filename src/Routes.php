<?php declare(strict_types = 1);

return [
    ['GET', '/', ['App\Controllers\Homepage', 'show']],
    ['POST', '/login', ['App\Controllers\Homepage', 'login']],
    ['GET', '/registro', ['App\Controllers\Homepage', 'registro']],
    ['POST', '/registro', ['App\Controllers\Homepage', 'registro']],
    ['GET', '/buscar', ['App\Controllers\UserController', 'buscar']],
    ['GET', '/buscarAjax/{search}', ['App\Controllers\UserController', 'buscarAjax']],
    ['GET', '/logout', ['App\Controllers\UserController', 'logout']],
    
];
