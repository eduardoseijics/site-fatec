<?php

namespace App\Controller\Pages;

use App\Controller\Admin\Noticias\NoticiasFormulario;
use App\Core\View;
use App\Model\Entity\Noticia as ModelNoticia;

class Home extends Page {

  public static function getHome() {
    
    $content = View::render('pages/home', [
      // 'noticias' => self::getNoticiasHome()
      'noticias' => ''
    ]);
    return parent::getPage($content);
  }

  public static function getNoticiasHome() {
    // Resultado da consulta da tabela de noticias
    $tableRows = ModelNoticia::getNoticias(null, 'id DESC', 6);

    $itens = '';
    
    while ($noticia = $tableRows->fetchObject(ModelNoticia::class)) {
      $varsItem          = [];      
      $varsItem['id']        = $noticia->getId();
      $varsItem['titulo']    = $noticia->getTitulo();
      $varsItem['subtitulo'] = $noticia->getSubtitulo();
      $varsItem['noticia']   = substr($noticia->getNoticia(), 0, 100);          
      $varsItem['data']      = $noticia->getData();
      $varsItem['src']       = Noticia::getFotoCapa($noticia->getId());
      $varsItem['link']      = ModelNoticia::getLinkNoticia($noticia->url);
      $itens .= View::render('pages/components/noticias/noticias-item', $varsItem);
    }
    return $itens;
  }

  public static function getImgNoticia(ModelNoticia $noticia) {
    return URL.'/resources/img/fatec-placeholder.png';
  }
}