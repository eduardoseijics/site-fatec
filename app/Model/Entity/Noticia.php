<?php

namespace App\Model\Entity;

use App\Model\interfaces\InterfaceModel;
use App\Core\Database;

class Noticia  implements InterfaceModel{

  /**
   * ID da notícia
   * @var integer
   */
  private $id = 1;

  /**
   * Titulo da noticia
   * @var string
   */
  private $titulo;

  /**
   * Subtitulo da noticia
   * @var string
   */
  private $subtitulo;
  
  /**
   * Texto da noticia
   * @var string
   */
  private $noticia;

  /**
   * Nome do arquivo da capa da noticia
   * @var string
   */
  private $foto_capa;

  /**
   * Data da noticia
   * @var string
   */
  private $data;

  /**
   * Retorna o subtitulo da notícia
   * @return string
   */
  public function getSubtitulo() {
    return $this->subtitulo;
  }

  /**
   * @return string Titulo da notícia
   */
  public function getTitulo() {
    return $this->titulo;
  }

  /**
   * @return int $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Retorna o conteudo da notícia
   * @return string
   */
  public function getNoticia() {
    return $this->noticia;
  }

  /**
   * Retorna a data da noticia
   * @return string
   */
  public function getData() {
    return $this->data;
  }

    /**
   * Retorna o subtitulo da notícia
   * @return string
   */
  public function setSubtitulo($subtitulo) {
    $this->subtitulo = $subtitulo;
    return $this;
  }

  /**
   * @param string $titulo
   * @return this
   */
  public function setTitulo($titulo) {
    $this->titulo = $titulo;
    return $this;
  }

  /**
   * Retorna o conteudo da notícia
   * @return string
   */
  public function setNoticia($noticia) {
    $this->noticia = $noticia;
    return $this;
  }

    /**
   * Retorna a data da noticia
   * @return string
   */
  public function getFotoCapa() {
    return $this->foto_capa;
  }

  /**
   * Seta a foto de capa da noticia
   * @return string
   */
  public function setFotoCapa($fotoCapa) {
    $this->foto_capa = $fotoCapa;
    return $this;
  }

  public static function getNoticias($where = null, $order = null, $limit = 10, $fields = '*') {
    return (new Database('noticias'))->select($where, $order, $limit, $fields);
  }

  /**
   * Método responsável por obter os dados de uma noticia
   * @param int $id
   * @param string $campos
   * @return self
   */
  public static function getNoticiaPorId($id, $campos = '*') {
    return self::getNoticiaPorQuery('id = "'.$id.'"', null, null, $campos)->fetchObject(self::class);
  }

  /**
   * Método responsável por retornar as noticias de acordo com os parâmetros
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @param  string $fields
   * @return PDOStatement
   */
  public static function getNoticiaPorQuery($where = null, $order = null, $limit = null, $fields = null) {
    return (new Database('noticias'))->select($where,$order,$limit,$fields);
  }

    /**
   * Método responsável por cadastrar um cliente
   * @method cadastrar
   * @param  mixed     $dadosCliente    Instancia de Cliente ou array de dados
   * @return integer   ID do cliente criado
   */
  public static function cadastrar(array $dadosNoticia = null){

    $obDatabaseNoticia = new Database('noticias');
    $obDatabaseNoticia->insert($dadosNoticia);

    return true;
  }

  public function delete() {
    return (new Database('noticias'))->delete("id = {$this->id}");
  }

  /**
   * Atualiza os dados do banco com os dados da instância atual
   * @return bool
   */
  public function update() {
    return (new Database('noticias'))->update("id = ".$this->id, [
      'titulo'    => $this->titulo,
      'subtitulo' => $this->subtitulo,
      'noticia'   => $this->noticia
    ]);
  }

  public static function gravarUrl($titulo = '') {
    if(empty($titulo)) throw new \DomainException('Titulo inválido');

    $url = self::gerarUrlAmigavel($titulo);
  }

  function gerarUrlAmigavel($titulo) {
    // Substituir espaços por hífens e remover caracteres especiais
    $urlAmigavel = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $titulo), '-'));

    // Remover múltiplos hífens consecutivos
    $urlAmigavel = preg_replace('/-+/', '-', $urlAmigavel);

    return $urlAmigavel;
  }

  public function verificarUrl($slug = null, $add = 0){

    $condicao = 'url = "'.$slug.'"';
    $obTabelaUrl = new Database('noticias');
    $url         = $obTabelaUrl->select($condicao)->rowCount();

    if($url > 0){
      $add++;
      $slug = $url->url.'-'.$add;
      return $this->verificarUrl( $url, $add);
    }
    return $slug;
  }

  public static function getLinkNoticia($url) {
    return URL.'/noticia/'.$url;
  }

  /**
   * Método responsável por obter os dados de uma noticia
   * @param int $id
   * @param string $campos
   * @return self
   */
  public static function getNoticiaPorUrl($url, $campos = '*') {
    return self::getNoticiaPorQuery('url = "'.$url.'"', null, null, $campos)->fetchObject(self::class);
  }
}