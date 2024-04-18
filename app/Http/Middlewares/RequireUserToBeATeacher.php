<?php

namespace App\Http\Middlewares;

use Closure;
use App\Http\Request;
use App\Http\Response;
use App\Session\Admin\User as UserSession;

class RequireUserToBeATeacher {

  /**
   * Executar as ações do middleware
   *
   * @param  Request $request
   * @param  Closure $next
   * @return Response
   */
  public function handle($request, $next) {
    // Verifica se o usuário está logado
    if (!UserSession::isTeacher()) {
      // Se já estiver logado, redireciona para a página admin
      $request->getRouter()->redirect('/admin');
    }

    return $next($request);
  }
}
