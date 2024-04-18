<?php

namespace App\Controller\Admin\Cursos;

use App\Core\View;
use App\Model\Entity\Curso;
use App\Controller\Admin\Page;
use App\Controller\Admin\Cursos\Cursos;

class CursosListagem extends Cursos {
    
  public static function getModuloCursos($request) {

    $content = View::render('admin/conteudo-modulo', [
      'titulo'            => 'Cursos',
      'modulo'            => 'cursos',
      'adicionarEntidade' => '',
      'status'            => parent::getStatus($request),
      'conteudo'          => self::getListagemCursos($request, $paginacao),
      'paginacao'         => ''
    ]);
    
    return Page::getPage($content);
  }

  public static function getListagemCursos($request, &$paginacao) {
    return View::Render('admin/pages/cursos', [
      'itens' =>  self::getCursosItens($request, $paginacao)
    ]);
  }

  public static function getCursosItens() {

    $cursos = Curso::CURSOS;
    
    $itens = '';
    foreach ($cursos as $hash => $label) {
      $varsItem          = [];
      $varsItem['label'] = $label;
      $varsItem['hash']  = $hash;
      $itens .= View::render('admin/components/cursos/cursos-item', $varsItem);
    }
    return $itens;
  }
}