<?php
include_once 'db.php';

function main() {
  $link_to_html = function (array $link): string {
    $html_link =
      '<a href="' .
      $link['url'] .
      '" target="_blank" rel="noopener noreferrer"><div class="card"><span>' .
      $link['name'] .
      '</span></div></a>';
    return $html_link;
  };

  $links = DB::getLinks();
  $html_links = array_map($link_to_html, $links);

  $html_favorites = join($html_links);

  $html_template = file_get_contents('../templates/index.html');
  $html = preg_replace('/\[\%favorite\%\]/', $html_favorites, $html_template);
  return $html;
}

?>
