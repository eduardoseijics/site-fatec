<?php

namespace App\Controller\Admin\Noticias;

use App\Core\Upload;
use App\Http\Request;
use App\Controller\Alert;
use App\Controller\Admin\Page;
use App\Model\Entity\Noticia as ModelNoticia;

class Noticias extends Page {

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
        return Alert::getSuccess('Noticia <b>criada</b> com sucesso!');
      case 'updated':
        return Alert::getSuccess('Noticia <b>atualizada</b> com sucesso!');
      case 'deleted':
        return Alert::getSuccess('Noticia <b>excluída</b> com sucesso!');
      default:
        return '';
    }
  }
  
  public static function criar($request) {
    $postVars = $request->getPostVars();
    ModelNoticia::cadastrar($postVars);
    $request->getRouter()->redirect('/admin/noticias?status=created');

  }

  public static function deletarNoticia($request, $id) {
    $obNoticia = ModelNoticia::getNoticiaPorId($id);
    
    // Valida se existe uma instância de depoimento
    if (!$obNoticia instanceof ModelNoticia) {
      $request->getRouter()->redirect('/admin/noticias');
    }

    // Exclui o depoimento
    $obNoticia->delete();

    $request->getRouter()->redirect('/admin/noticias?status=deleted');
  }

  public static function editarNoticia(Request $request, int $idNoticia) {
    
    $obNoticia = ModelNoticia::getNoticiaPorId($idNoticia);
    // Valida se existe uma instância de depoimento
    if (!$obNoticia instanceof ModelNoticia) {
      $request->getRouter()->redirect('/admin/noticias');
    }

    $postVars  = $request->getPostVars();
    $filesVars = $request->getFilesVars();

    // self::enviarImagens($filesVars);
    if(!empty($filesVars['fotoCapa']['name'])) {
      $obNoticiasUpload = new NoticiasUpload($idNoticia);
      $obNoticiasUpload->enviarFotoCapa($filesVars);
    }

    $titulo    = isset($postVars['titulo'])    ? trim($postVars['titulo'])    : $obNoticia->getTitulo();
    $subtitulo = isset($postVars['subtitulo']) ? trim($postVars['subtitulo']) : $obNoticia->getSubtitulo();
    $noticia   = isset($postVars['noticia'])   ? $postVars['noticia']                 : $obNoticia->getNoticia();
        
    $obNoticia->setTitulo($titulo)
              ->setSubtitulo($subtitulo)
              ->setNoticia($noticia)
              ->update();

    $request->getRouter()->redirect('/admin/noticias/editar/'.$idNoticia.'?status=updated');
  }
}