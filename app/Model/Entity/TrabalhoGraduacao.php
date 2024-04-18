<?php

namespace App\Model\Entity;

use App\Core\Database;
use App\Model\interfaces\InterfaceModel;

class TrabalhoGraduacao implements InterfaceModel{

  /**
   * Título do TG
   * @var string
   */
  private $titulo;

  /**
   * Descrição do TG
   * @var string
   */
  private $descricao;

  /**
   * Aluno Um do TG
   * @var int
   */
  private $idAlunoUm;

  /**
   * Aluno Um do TG
   * @var int
   */
  private $idAlunoDois;

  /**
   * Retorna o título do TG
   * @return string
   */
  public function getTitulo() {
    return $this->titulo;
  }

  /**
   * Seta o título do TG
   * 
   */
  public function setTitulo(string $titulo) {
    $this->titulo = $titulo;
    return $this;
  }

  public function getDescricao() {
    return $this->descricao;
  }

  /**
   * Seta a descrição do TG
   * @return this
   */
  public function setDescricao(string $descricao) {
    $this->descricao = $descricao;
    return $this;
  }

  /**
   * Retorna o id do aluno um
   * @return int
   */
  public function getAlunoUm() {
    return $this->idAlunoUm;
  }

  /**
   * Seta o id do aluno um
   * @return this
   */
  public function setAlunoUm(int $idAlunoUm) {
    $this->idAlunoUm = $idAlunoUm;
    return $this;
  }

  public function getAlunoDois() {
    return $this->idAlunoDois;
  }

  /**
   * Seta o id do aluno dois
   * @return this
   */
  public function setAlunoDois(int $idAlunoDois) {
    $this->idAlunoDois = $idAlunoDois;
    return $this;
  }
  
  /**
   * Método responsável por obter os dados de um usuarios
   * @param int $id
   * @param string $campos
   * @return TrabalhoGraduacao
   */
  public static function getTrabalhoGraduacaoPorId($id, $campos = '*') {
    return self::getTrabalhoGraduacaoPorQuery('id = "'.$id.'"', null, null, $campos)->fetchObject(self::class);
  }

  /**
   * Método responsável por obter os dados de um tg atraves do id de um dos alunos
   * @param int $id
   * @param string $campos
   * @return PDOStatement
   */
  public static function getTrabalhoGraduacaoPorUsuario($id, $campos = '*') {
    $where = 'id_aluno_um = '.$id.' OR id_aluno_dois = '.$id;
    return self::getTrabalhoGraduacaoPorQuery($where, null, null, $campos)->fetchObject(self::class);
  }

    /**
   * Método responsável por retornar os usuarios de acordo com os parâmetros
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @param  string $fields
   * @return PDOStatement
   */
  public static function getTrabalhoGraduacaoPorQuery($where = null, $order = null, $limit = null, $fields = null) {
    return (new Database('trabalho_graduacao'))->select($where,$order,$limit,$fields);
  }


  public static function cadastrar(array $dados) {
    return true;
  }
  
  public function delete() {
    return true;
  }
}