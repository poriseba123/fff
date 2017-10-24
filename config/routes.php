<?php

return[
    'terminos-y-condiciones' => 'site/terminos_y_condiciones',
    'como-funciona' => 'site/como_funciona',
    'nuestro-reglamento' => 'site/reglamento_interno',
    'preguntas-y-respuestas' => 'site/preguntas_y_respuestas',
    'quienes-somos' => 'site/quien_somos',
    'política-de-confidencialidad' => 'site/preceptos_de_confidencialidad',
    'registrate' => 'registration/index',
    'conectate' => 'site/login',
    'usuario/perfil' => 'user/profile',
    'usuario/verificaciones' => 'user/userverification',
    'usuario/vehiculo' => 'vehicle/addvehicle',
    'usuario/clasificaiones/' => 'publicprofile/opinions/',
    'usuario/micuenta' => 'user/changepassword',
    'reservas' => 'advertisements/index',
    'busqueda/detallesanuncio/' => 'search/postdetail/',
    'publicaciones' => 'reservation/index',
    'anuncio/cambioanuncio' => 'post/postedit',
    'mensajes' => 'message/index',
    'mensajes/todosmensajes' => 'message/allmessages',
    'dinero' => 'money/index',
    'anuncio/publicar' => 'post/create',
    'busqueda/busquedaviaje' => 'search/searchtrip',
    
    
    
    
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
];
?>