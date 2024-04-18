<?php

namespace App\Controller\Admin\Cursos;

use App\Core\View;
use App\Http\Request;
use App\Controller\Alert;
use App\Controller\Admin\Page;
use App\Core\Upload;

class Cursos extends Page{

  public static function getPaginaCurso($request, $message = '') {
    $vars = ['status' => !empty($message) ? Alert::getError($message) : ''];
    
    $conteudo = View::render('admin/cursos', $vars);

    return parent::getPage($conteudo);
  }

    /**
   * Retorna mensagem de status
   *
   * @param  Request $request
   * @return string
   */
  public static function getStatus($request) {
    $queryParams = $request->getQueryParams();

    if (!isset($queryParams['status'])) return '';

    switch ($queryParams['status']) {
      case 'created':
        return Alert::getSuccess('Curso <b>criada</b> com sucesso!');
      case 'updated':
        return Alert::getSuccess('Curso <b>atualizado</b> com sucesso!');
      case 'deleted':
        return Alert::getSuccess('Curso <b>excluído</b> com sucesso!');
      default:
        return '';
    }
  }

  public static function atualizarCurso(Request $request, $hash = '') {
    if(!isset($_FILES)) $request->getRouter()->redirect('/admin/cursos/'.$hash);   

    if(!empty($_FILES['calendario'])) {
      self::enviarArquivo($hash, 'calendario');
    }
    
    if(!empty($_FILES['horario'])) {
      self::enviarArquivo($hash, 'horario');
    }

    $request->getRouter()->redirect('/admin/cursos/'.$hash.'?status=updated');
  }
  
  public static function enviarArquivo($hash, $tipo) {
    $diretorio = ROOT.'/upload/pdf/cursos/'.$tipo.'/'.$hash;
    if(!empty($_FILES[$tipo])) {
      self::removerArquivosAntigos($diretorio.'/*');
      $obUpload = new Upload($_FILES[$tipo]); 
      $obUpload->setName($tipo.'-'.$hash);   
      $obUpload->upload($diretorio);
    }
  }

  public static function removerArquivosAntigos($diretorio) {
    $arquivosAntigos = glob($diretorio);
    foreach($arquivosAntigos as $arquivoAntigo){
      if(is_file($arquivoAntigo)) {
        unlink($arquivoAntigo);
      }
    }
  }
}