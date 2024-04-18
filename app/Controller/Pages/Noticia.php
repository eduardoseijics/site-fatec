<?php

namespace App\Controller\Pages;

use App\Controller\Admin\Noticias\NoticiasFormulario;
use PDO;
use App\Core\View;
use App\Model\Entity\Noticia as ModelNoticia;
use App\Controller\Admin\Noticias\NoticiasUpload;

class Noticia extends Page {

  public static function getPageNoticias() {
    $obNoticias = new ModelNoticia;
    $noticias   = $obNoticias->getNoticias(null, null, 20);
    $varsLayout = '';
    while ($noticia = $noticias->fetchObject(ModelNoticia::class)) {
      $varsItem = [
        'subtitulo' => $noticia->getSubtitulo(),
        'titulo'    => $noticia->getTitulo(),
        'data'      => $noticia->getData(),
        'src'       => Noticia::getFotoCapa($noticia->getId()),
        'noticia'   => $noticia->getNoticia(),
        'link'      => ModelNoticia::getLinkNoticia($noticia->url)
      ];
      $varsLayout .= View::render('pages/components/noticias/noticias-item', $varsItem);
    }

    $content = View::render('pages/noticias', ['noticias' => $varsLayout]);
    return parent::getPage($content, 'Fatec Araçatuba');
  }

  public static function getLinkNoticia($url) {
    return URL.'/noticia/'.$url;
  }

  public static function getNoticiaPorUrl($request, $url) {
    $obModelNoticia = new ModelNoticia;
    $noticia = $obModelNoticia->getNoticiaPorUrl($url);      
    if(!($noticia instanceof ModelNoticia)) return $request->getRouter()->redirect('/noticias');
    $content = View::render('pages/noticia', [
      'titulo' => $noticia->getTitulo(),
      'subtitulo' => $noticia->getSubtitulo(),
      'noticia' => $noticia->getNoticia(),
      'fotos' => self::getFotosNoticia($noticia->getId()),
      'fotoCapa' => self::getFotoCapa($noticia->getId())
    ]);
    return parent::getPage($content, 'Fatec Araçatuba');
  }

  public static function getFotosNoticia($idNoticia) {
    $obNoticiaArquivo = new NoticiasUpload($idNoticia);
    $diretorio        = $obNoticiaArquivo->getDiretorio();
    $ignorarDiretorio = glob($diretorio.'/*', GLOB_ONLYDIR);
    $urlBase          = $obNoticiaArquivo->getUrl();
    
    $arquivos = glob($diretorio.'/*');
    $fotos = '';
    foreach ($arquivos as $key => $arquivo) {
      if (is_file($arquivo) && !in_array(dirname($arquivo), $ignorarDiretorio)) {
        $fotos .= View::render('pages/components/noticias/noticia-img', [
          'src' => $urlBase.'/'.basename($arquivo),
          'alt' => $arquivo
        ]);
      }
    }
    return $fotos;
  }

  public static function getFotoCapa($idNoticia) {
    $foto = NoticiasFormulario::getSrcFotoCapa($idNoticia);
    $src = (!empty($foto)) ? $foto : URL.'/resources/img/fatec-placeholder.png';
    return '<img src="'.$src.'">';
  }

}