<?php

namespace App\Controller\Admin;

use App\Core\View;
use App\Controller\Admin\Page;

class Menu extends Page {

  public static function getMenuLateral() {
    return View::render('admin/components/menu-lateral');
  }
}