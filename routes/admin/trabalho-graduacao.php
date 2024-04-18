<?php 

use App\Http\Response;
use App\Controller\Admin\TrabalhoGraduacao\TrabalhoGraduacao;
use App\Controller\Admin\TrabalhoGraduacao\TrabalhoGraduacaoFormulario;

// Rota admin
$obRouter->get('/admin/trabalho-graduacao', [
  'middlewares' => ['required-admin-login'],
  function ($request) {
    return new Response(200, TrabalhoGraduacaoFormulario::getFormTrabalhoGraduacao($request));
  }
]);
