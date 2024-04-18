<?php

namespace App\Controller\Admin\Noticias;

use App\Core\View;
use App\Controller\Admin\Page;
use App\Controller\Admin\Noticias\Noticias;
use App\Model\Entity\Noticia as ModelNoticia;

class NoticiasFormulario extends Noticias {

  public static function getFormularioCriarNoticia() {
    $content = View::render('admin/components/noticias/noticias-formulario', [
      'h1'               => 'Criar Notícia',
      'titulo'           => '',
      'subtitulo'        => '',
      'noticia'          => '',
      'status'           => '',
      'imgFotoCapa'      => '',
      'desabilitarMidia' => 'd-none'
    ]);
    return Page::getPage($content);
  }

  public static function getFormularioEditarNoticia($request, $id) {

    $obNoticia = ModelNoticia::getNoticiaPorId($id);

    // Valida se existe uma instância de depoimento
    if (!$obNoticia instanceof ModelNoticia) {
      $request->getRouter()->redirect('/admin/noticias');
    }
    
    $content = View::render('admin/components/noticias/noticias-formulario', [      
      'h1'          => 'Editar Notícia',
      'titulo'      => $obNoticia->getTitulo(),
      'subtitulo'   => $obNoticia->getSubtitulo(),
      'noticia'     => $obNoticia->getNoticia(),
      'status'      => parent::getStatus($request),
      'imgFotoCapa' => self::getFotoCapa($obNoticia->getId(), false)
    ]);
    return Page::getPage($content);
  }

  public static function getFotoCapa($idNoticia, $esconderBotao = true) {

    $src = self::getSrcFotoCapa($idNoticia);
    if(empty($src)) return '';
    return View::render('admin/components/noticias/noticias-img', [
      'src' => $src,
      'alt' => 'Foto de capa',
      'id'  => $idNoticia,
      'nome' => self::getNomeFotoCapa($idNoticia),
      'hideButton' => $esconderBotao
    ]);
  }

  public static function getSrcFotoCapa($idNoticia) {
    $obNoticiasUpload  = new NoticiasUpload($idNoticia);
    $urlFotoCapa       = $obNoticiasUpload->getUrlFotoCapa();
    $diretorioFotoCapa = $obNoticiasUpload->getDiretorioFotoCapa();
    if(!is_dir($diretorioFotoCapa)) return '';
    $nomeFotoCapa      = self::getNomeFotoCapa($idNoticia);
    if(!$nomeFotoCapa) return '';
    if(file_exists($diretorioFotoCapa.'/'.$nomeFotoCapa)) 
      return $urlFotoCapa.'/'.$nomeFotoCapa;

    return '';
  }

  public static function getNomeFotoCapa($idNoticia) {
    $obNoticiasUpload  = new NoticiasUpload($idNoticia);
    $diretorioFotoCapa = $obNoticiasUpload->getDiretorioFotoCapa();
    return self::getNomeArquivo($diretorioFotoCapa);
  }
  
  public static function getNomeArquivo($diretorio) {
    return current(array_diff(scandir($diretorio), array('.', '..')));
  }
}