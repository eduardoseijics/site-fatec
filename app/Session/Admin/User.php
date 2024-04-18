<?php

namespace App\Session\Admin;


/**
 * Gerenciar login de usuário pela sessão de admin
 */
class User {

  /**
   * Inicia a sessão
   *
   * @return void
   */
  private static function init() {
    // Verificar se a sessão está ativa
    if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  public static function isUserAllowed($userType) {
    self::init();    
    return ($_SESSION['user']['tipo'] === 'admin' || $_SESSION['user']['tipo'] === $userType);
  } 

  /**
   * Verifica se o usuário logado é ádmin
   *
   * @return boolean
   */
  public static function isAdmin() {
    return $_SESSION['user']['tipo'] == 'admin';
  }

  /**
   * Verifica se o usuário logado é professor
   *
   * @return boolean
   */
  public static function isTeacher() {
    return self::isUserAllowed('professor');
  }

  /**
   * Verifica se o usuário logado é aluno
   *
   * @return boolean
   */
  public static function isStudent() {    
    return self::isUserAllowed('aluno');
  }

  /**
   * Verifica se o usuário logado é coordenador
   *
   * @return boolean
   */
  public static function isCoordinator() {
    return self::isUserAllowed('coordenador');
  }

  /**
   * Verifica se o usuário logado é colaborador
   *
   * @return boolean
   */
  public static function isCollaborator() {
    return self::isUserAllowed('coalborador');
  }
}