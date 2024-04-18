<?php

include('../../../bootstrap/app.php');

use App\Controller\Admin\Noticias\NoticiasUpload;

$dados = $_POST;


$retorno = [
  'sucesso' => false,
  'mensagem' => 'Problema ao excluir a midia. Tente novamente mais tarde'
];

if(!isset($_POST['idNoticia']) || !isset($_POST['nomeArquivo'])) echo json_encode($retorno);

$obNoticiasUpload = new NoticiasUpload($_POST['idNoticia']);
$exclusao = $obNoticiasUpload->excluirMidia($_POST['nomeArquivo'], true);
if($exclusao) {
  $retorno = [
    'sucesso' => true,
    'mensagem' => 'Foto excluida com sucesso!'
  ];
}

echo json_encode($retorno);