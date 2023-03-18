<?php
include_once 'db.php';

function main() {
  $favorites = '<div class="card"><a href="https://www.google.de/"
  target="_blank"
  rel="noopener noreferrer">Google</a></div>';
  $html_template = file_get_contents('../templates/index.html');
  $html = preg_replace('/\[\%favorites\%\]/', $favorites, $html_template);
  return $html;
}

?>
