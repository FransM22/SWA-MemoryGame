<?php

class Template {
  private $values = array();

  function assign($key, $value) {
    $this->values[$key] = $value;
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
