<?php

namespace izv\app;

class App {
    
    const DATABASE = 'link',
          HOST = 'localhost',    
          PASSWORD = 'link',
          USER = 'link',
          APPLICATION_NAME = 'CorreoWeb',
          CLIENT_ID = '123796518941-ptgju1jq1a68ll00ek7harhmn8jps1ee.apps.googleusercontent.com',
          CLIENT_SECRET = 'eACBhPjTM7Vvjg_m3eXodfJO',
          EMAIL_ORIGIN = 'nacho.pena1985@gmail.com',
          EMAIL_ALIAS = 'Proyecto usuarios MVC',
          EMAIL_TOKEN_FILE = 'https://dwes-navarrete.c9users.io/proyecto/gmail/token.conf',
          
          JWT_KEY = 'Proyecto_App_Usuarios',
          USER_SESSION_KEY = 'App_users',
          
          SESSION_NAME = 'APP_MVC_SESSION',
          
          BASE = 'https://dwes-navarrete.c9users.io/proyectoLinks/',
          FILTER = [
            'c.categoria' => '',
            'l.href' => '',
            'l.comentario' => '',
            'l.id' => ''
          ];
}