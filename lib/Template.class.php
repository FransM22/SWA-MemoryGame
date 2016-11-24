<?php

class Template {
  private $values = array();

  function assign($key, $value) {
    $this->values[$key] = $value;
  }

  function display($filename) {
    $html = file_get_contents($filename);

    foreach ($this->values as $key => $value) {
      $search_term = '{$' . $key . '}';
      $html = str_replace($search_term, $value, $html);
    }

    echo $html;
  }
}

?>
