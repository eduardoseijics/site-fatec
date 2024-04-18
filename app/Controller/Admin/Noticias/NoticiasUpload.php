<?php

namespace App\Controller\Admin\Noticias;

use App\Core\Upload;

class NoticiasUpload {
  
  public $idNoticia;

  public $diretorio = '';

  public $diretorioFotoCapa = '';

  public $url = '';

  public $urlFotoCapa = '';

  public function __construct($idNoticia) {
    $this->idNoticia         = $idNoticia;
    $this->diretorio         = UPLOAD.'/imagens/noticias/'.$idNoticia;
    $this->diretorioFotoCapa = $this->diretorio.'/foto-capa';
    $this->url               = URL_UPLOAD.'/imagens/noticias/'.$idNoticia;
    $this->urlFotoCapa       = URL_UPLOAD.'/imagens/noticias/'.$idNoticia.'/foto-capa';
  }

  public function getDiretorio() {
    return $this->diretorio;
  }

  public function getUrl() {
    return $this->url;
  }

  public function getUrlFotoCapa() {
    return $this->urlFotoCapa;
  }

  public function getDiretorioFotoCapa() {
    return $this->diretorioFotoCapa;
  }

  public function enviarFotoCapa($filesVars = []) {
    
    $diretorio = $this->criarDiretorioImagensNoticia($this->diretorioFotoCapa);
    array_map('unlink', array_filter((array) glob($diretorio.'/*')));
    // $quantidadeArquivos = count($_FILES['fotoCapa']['name']);
    $obUpload = new Upload($filesVars['fotoCapa']);
    $obUpload->upload($diretorio);
  }

  public function criarDiretorioImagensNoticia($diretorio = '') {
    // VERIFICA SE O DIRETÓRIO EXISTE
    if(file_exists($diretorio)) return $diretorio;

    
    $x = mkdir($diretorio, 0755, true);
    chmod($diretorio, 0755);

    return $diretorio;
  }

    /**
   * Responsável por criar um nome amigável para o arquivo
   * @return void
   */
  public function setNomeAmigavel($nomeArquivo) {
    $nomeAmigavel = preg_replace( '/[^a-z0-9]+/i', '-', $nomeArquivo);
    $nomeAmigavel = preg_replace( '/-+/i', '-', $nomeAmigavel );
    return strtolower(trim($nomeAmigavel,'-'));
  }

  public function excluirMidia($arquivo) {
    $caminho = $this->getDiretorio().'/'.$arquivo;
    return unlink($caminho);
  }
}