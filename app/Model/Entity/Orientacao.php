<?php

namespace App\Model\Entity;

use App\Core\Database;
use App\Model\interfaces\InterfaceModel;

class Orientacao implements InterfaceModel {

  private $id;

  private $idTrabalhoGraduacao;

  private $ativo;

  private $aceito;

  private $autorizado;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getIdTrabalhoGraduacao() {
    return $this->idTrabalhoGraduacao;
  }

  public function setIdTrabalhoGraduacao($idTrabalhoGraduacao) {
    $this->idTrabalhoGraduacao = $idTrabalhoGraduacao;
  }

  public function getAtivo() {
    return $this->ativo;
  }

  public function setAtivo($ativo) {
    $this->ativo = $ativo;
    return $this;
  }

  public function getAceito() {
    return $this->aceito;
  }

  public function setAceito($aceito) {
    $this->aceito = $aceito;
    return $this;
  }

  public function getAutorizado() {
    return $this->autorizado;
  }

  public function setAutorizado($autorizado) {
    $this->autorizado = $autorizado;
    return $this;
  }


  public static function cadastrar($dados) {

    $obDatabaseOrientacao = new Database('orientacao');
    $idUsuario = $obDatabaseOrientacao->insert($dados);

    return $idUsuario;
  }

  public function delete() {
    return true;
  }
}