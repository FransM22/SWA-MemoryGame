<?php

require('User.class.php');

class Template {
  private $values = array();

  function assign($key, $value) {
    $this->values[$key] = $value;
  }

  /**
   * Convenience method for loading menu
   */
  function assignMenu() {
    $menu_template = new Template();
    $user = new User();
    $user->fromSession();

    $menu_template->assign('username', $user->getName());

    $menu_section = $menu_template->get('templates/menu.inc.tpl');
    $this->assign('menu_section', $menu_section);
  }

  function get($filename) {
    $html = file_get_contents($filename);

    foreach ($this->values as $key => $value) {
      $search_term = '{$' . $key . '}';
      $html = str_replace($search_term, $value, $html);
    }

    return $html;
  }

  function display($filename) {
    echo $this->get($filename);
  }
}

?>
