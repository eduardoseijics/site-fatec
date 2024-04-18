<?php

namespace App\Controller\Admin\Noticias;

use App\Core\View;
use App\Core\Paginacao;
use App\Controller\Admin\Page;
use App\Model\Entity\Noticia as ModelNoticia;

class NoticiasListagem extends Noticias {
    
  public static function getModuloNoticias($request) {

    $content = View::render('admin/conteudo-modulo', [
      'titulo'            => 'Noticias',
      'modulo'            => 'noticias',
      'adicionarEntidade' => self::getBotaoAdicionarNoticia(),
      'status'            => parent::getStatus($request),
      'conteudo'          => self::getListagemNoticias($request, $paginacao),
      'paginacao'         => parent::getPaginacao($request, $paginacao),
    ]);
    
    return Page::getPage($content);
  }

  public static function getBotaoAdicionarNoticia() {
    return View::render('admin/components/botao-adicionar', [
      'link' => URL_ADMIN.'/noticias/criar'
    ]);
  }

  public static function getListagemNoticias($request, &$paginacao) {
    return View::Render('admin/pages/noticias', [
      'itens' =>  self::getNoticiasItens($request, $paginacao)
    ]);
  }

  public static function getNoticiasItens($request, &$paginacao) {
    // Quantidade total de registros
    $totalRows = ModelNoticia::getNoticias(null, null, null, 'COUNT(*) as total')->fetchObject()->total;

    // Obtendo a página atual
    $queryParams = $request->getQueryParams();
    $currentPage = $queryParams['page'] ?? 1;

    // Instância de paginação
    $paginacao = new Paginacao($totalRows, $currentPage, 5);    
    
    // Resultado da consulta da tabela de noticias
    $tableRows = ModelNoticia::getNoticias(null, 'id DESC', $paginacao->getLimit());

    $itens = '';
    while ($noticia = $tableRows->fetchObject(ModelNoticia::class)) {
      $varsItem          = [];      
      $varsItem['id']        = $noticia->getId();
      $varsItem['titulo']    = $noticia->getTitulo();
      $varsItem['subtitulo'] = $noticia->getSubtitulo();
      $varsItem['noticia']   = substr($noticia->getNoticia(), 0, 100);          
      $varsItem['data']      = $noticia->getData();
      $itens .= View::render('admin/components/noticias/noticias-item', $varsItem);
    }
    return $itens;
  }
}