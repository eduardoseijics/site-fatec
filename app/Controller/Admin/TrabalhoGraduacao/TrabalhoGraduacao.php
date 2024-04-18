<?php

namespace App\Controller\Admin\TrabalhoGraduacao;

use App\Core\View;
use App\Controller\Alert;
use App\Controller\Admin\Page;

class TrabalhoGraduacao extends Page {

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
        return Alert::getSuccess('Noticia <b>criada<b/> com sucesso!');
      case 'updated':
        return Alert::getSuccess('Noticia <b>atualizada</b> com sucesso!');
      case 'deleted':
        return Alert::getSuccess('Noticia <b>excluída</b> com sucesso!');
      default:
        return '';
    }
  }


}
