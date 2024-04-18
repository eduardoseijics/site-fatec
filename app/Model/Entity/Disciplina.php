<?php

namespace App\Model\Entity;

class Disciplina {

  private $id;

  private $idProfessor;

  private $nome;


  public function getId() {
    return $this->idProfessor;
  }

  public function getIdProfessor() {
    return $this->idProfessor;
  }

  public function getNome() {
    return $this->nome;
  }
}