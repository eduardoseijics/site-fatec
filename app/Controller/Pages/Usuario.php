<?php

namespace App\Controller\Pages;

use App\Model\interfaces\InterfaceModel;
use App\Model\Entity\Usuario as ModelUsuario;

class Usuario implements InterfaceModel {

  public static function cadastrar($dados) {
    $dados = [
      'nome' => 'eduardo seiji',
      'email' => 'eduardo@wapstore.com.br',
      'senha' => '123456789',
      'foto' => '',
      'telefone' => '18981007888',
      'tipo' => 'admin'
    ];

    $obModelUsuario = new ModelUsuario();
    $obModelUsuario->cadastrar($dados);
  }

  public static function excluir($id) {
    return true;
  }

  public function delete() {}
}