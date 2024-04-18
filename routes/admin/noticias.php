<?php

use App\Http\Response;
use App\Controller\Admin\Noticias\Noticias;
use App\Controller\Admin\Noticias\NoticiasListagem;
use App\Controller\Admin\Noticias\NoticiasFormulario;

$obRouter->get('/admin/noticias', [
  'middlewares' => [
    'required-admin-login',
    'required-user-collaborator'
  ],
  function ($request, $id) {
    return new Response(200, NoticiasListagem::getModuloNoticias($request, $id));
  }
]);

$obRouter->get('/admin/noticias/excluir/{id}', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request, $id) {
    return new Response(200, Noticias::deletarNoticia($request, $id));
  }
]);

$obRouter->get('/admin/noticias/criar', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request) {
    return new Response(200, NoticiasFormulario::getFormularioCriarNoticia($request));
  }
]);

$obRouter->post('/admin/noticias/criar', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request) {
    return new Response(200, Noticias::criar($request));
  }
]);

$obRouter->get('/admin/noticias/editar/{id}', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request, $id) {
    return new Response(200, NoticiasFormulario::getFormularioEditarNoticia($request, $id));
  }
]);

$obRouter->post('/admin/noticias/editar/{id}', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request, $id) {
    return new Response(200, Noticias::editarNoticia($request, $id));
  }
]);


$obRouter->get('/admin/noticias/noticias/foto-capa/excluir/', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request, $id) {
    return new Response(200, Noticias::editarNoticia($request, $id));
  }
]);