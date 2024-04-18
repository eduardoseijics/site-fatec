<?php

namespace App\Controller\Pages;

use App\Core\View;

class TrabalhoDeGraduacao extends Page {

  public static function getTrabalhoDeGraduacao() {

    $documentos = self::getListaDocumentosTrabalhoDeGraduacao();

    $varsLayout = '';
    foreach ($documentos as $arquivo => $titulo) {
      $varsItem = [
        'linkDocumento' => URL.'/upload/pdf/trabalho-de-graduacao/'.$arquivo.'.pdf',
        'titulo' => $titulo
      ];
      $varsLayout .= View::render('pages/components/trabalho-de-graduacao/trabalho-de-graduacao-documentos-item', $varsItem);
    }
    $content = View::render('pages/trabalho-de-graduacao', ['itens' => $varsLayout]);
    return parent::getPage($content);
  }

  /**
   * Responsável por retornar a lista de documentos necessários para a realização de um trabalho de graduação
   * @return array
   */
  public static function getListaDocumentosTrabalhoDeGraduacao() {
    return [
      'declaracao_orientacao'                  => 'Declaração de Orientação',
      'declaracao_boneco'                      => 'Declaração da Entrega de Boneco',
      'manual_apresentacao_tg'                 => 'Manual de Apres. de Trabalho de Graduação',
      'manual_normas_abnt'                     => 'Normas ABNT',
      'modelo_boneco_2014'                     => 'Modelo de Boneco',
      'autorizacao_entrega_tg_publicacao'      => 'Autorização de Entrega do TG e Publicação',
      'requerimento_troca_orientacao'          => 'Declaração de troca de orientação',
      'regulamento_trabalho_graduacao_abr2013' => 'Regulamento do TG',
      'declaracao_entrega_tg_formacao_banca'   => 'Declaração de entrega de TG e formação de banca',
      'novas_regras_elaboracao_tg'             => 'Novas regras para elaboração do TG - ADS',
      'RAP_template'                           => 'Relatório de Atividades do Projeto - A partir do 2º Semetre de 2022'
    ];
  }
}