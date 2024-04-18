<?php 

use App\Http\Response;
use App\Controller\Admin\Admin;
use App\Controller\Pages\Noticia;


$obRouter->get('/noticias', [
  function() {
    return new Response(Response::HTTP_OK, Noticia::getPageNoticias());
  }
]);

$obRouter->get('/noticia/{url}', [
  function ($request, $url) {
    return new Response(Response::HTTP_OK, Noticia::getNoticiaPorUrl($request, $url));
  }
]);