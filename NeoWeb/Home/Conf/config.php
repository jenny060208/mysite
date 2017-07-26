<?php
return array(

  /* Configuration for template related */
  'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__TMPL__' => __ROOT__ . '/Public' . '/template',
        '__IMG__' => __ROOT__ . '/Public' . '/images',
        '__CSS__' => __ROOT__ . '/Public' . '/css',
        '__JS__' => __ROOT__ . '/Public' . '/js'
    ),

    'URL_CASE_INSENSITIVE' => true, // url is not case sensitive

    'URL_ROUTER_ON' => ture, // enable router

    // Router rule definition
    'URL_ROUTE_RULES' => array(
        'tag/:id' => 'home/tag/tid'
    ),

    // URL parameter bond to opertaiton method as parameter
    'URL_PARAMS_BIND' => true,

    // Database config
    'DB_CONFIG' => array(
        'db_host' => 'localhost',
        'db_name' => 'neoreward',
        'db_port' => '3306',
        'db_user' => 'root',
        'db_pwd' => 'wzm12345'
    )
);

