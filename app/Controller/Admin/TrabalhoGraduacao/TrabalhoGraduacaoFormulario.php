<?php

namespace App\Controller\Admin\TrabalhoGraduacao;

use PDO;
use App\Core\View;
use App\Controller\Admin\Page;
use App\Model\Entity\Usuario as ModelUsuario;
use App\Controller\Admin\TrabalhoGraduacao\TrabalhoGraduacao;
use App\Model\Entity\TrabalhoGraduacao as ModelTrabalhoGraduacao;

class TrabalhoGraduacaoFormulario extends TrabalhoGraduacao {

  public static function getFormTrabalhoGraduacao($request) {

    $idTrabalhoGraduacao = 7;

    $obTrabalhoGraduacao = ModelTrabalhoGraduacao::getTrabalhoGraduacaoPorId($idTrabalhoGraduacao);

    // Valida se existe uma instância de depoimento
    if (!$obTrabalhoGraduacao instanceof ModelTrabalhoGraduacao) {
      $request->getRouter()->redirect('/admin');
    }

    $varsLayout = [
      'titulo'    => $obTrabalhoGraduacao->getTitulo(),
      'descricao' => $obTrabalhoGraduacao->getDescricao(),
      'alunoUm'   => $obTrabalhoGraduacao->getAlunoUm(),
      'alunoDois' => $obTrabalhoGraduacao->getAlunoDois(),
      'status'    => parent::getStatus($request),
      'select'    => self::getSelectAlunos()
    ];
    $content = View::render('admin/components/trabalho-graduacao/trabalho-graduacao-formulario', $varsLayout);
    return Page::getPage($content);
  }

  public static function getSelectAlunos() {
    $idUsuarioAtual = $_SESSION['user']['id'];
    $tgUsuarioAtual = ModelTrabalhoGraduacao::getTrabalhoGraduacaoPorUsuario($idUsuarioAtual);
    $where          = 'tipo = "aluno"';
    $obAlunos       = ModelUsuario::getUsuariosPorQuery($where, null, null, 'id, nome')->fetchAll(PDO::FETCH_CLASS);
    
  }
}
