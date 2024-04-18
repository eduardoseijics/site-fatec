<?php

use App\Controller\Admin\Cursos\Cursos;
use App\Controller\Admin\Cursos\CursosFormulario;
use App\Http\Response;
use App\Controller\Admin\Cursos\CursosListagem;

$obRouter->get('/admin/cursos', [
  'middlewares' => ['required-admin-login'],
  function ($request) {
    return new Response(200, CursosListagem::getModuloCursos($request));
  }
]);

$obRouter->get('/admin/cursos/{hash}', [
  'middlewares' => ['required-admin-login'],
  function ($request, $hash) {
    return new Response(200, CursosFormulario::getFormulariosCursos($request, $hash));
  }
]);

$obRouter->post('/admin/cursos/{hash}', [
  'middlewares' => ['required-admin-login'],
  function ($request, $hash) {
    return new Response(200, Cursos::atualizarCurso($request, $hash));
  }
]);
