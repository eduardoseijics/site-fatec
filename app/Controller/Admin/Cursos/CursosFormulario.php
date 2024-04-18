<?php

namespace App\Controller\Admin\Cursos;

use App\Core\View;
use App\Http\Request;
use App\Model\Entity\Curso;
use App\Controller\Admin\Page;
use App\Controller\Admin\Cursos\Cursos;

class CursosFormulario extends Cursos {
    
  /**
   * @param Request $request
   * @param string $hash
   * @return HTML
   */
  public static function getFormulariosCursos(Request $request, string $hash) {
    if(!array_key_exists($hash, Curso::CURSOS)) $request->getRouter()->redirect('/admin/cursos');
    $content = View::render('admin/components/cursos/cursos-formulario', [      
      'h1'     => 'Editar Curso - '.Curso::CURSOS[$hash],
      'status' => parent::getStatus($request),
      'curso'  => $hash
    ]);

    return Page::getPage($content);  
  }
}