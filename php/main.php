<?php
include_once 'db.php';

function main() {
  // callbacks
  $filter_info = function (array $link): bool {
    return $link['category'] == 'info';
  };
  // PRODUCTION
  $links = DB::getLinks();
  $categories = array_unique(array_column($links, 'category'));

  // DEVELOP

  $info = array_filter($links, $filter_info);
  $html_favorite = links_to_html($links);
  $html_info = links_to_html($info);

  $html_template = file_get_contents('../templates/index.html');
  $html = preg_replace('/\[\%favorite\%\]/', $html_favorite, $html_template);
  $html = preg_replace('/\[\%info\%\]/', $html_info, $html);
  return $html;
}

function links_to_html(array $links): string {
  $link_to_html = function (array $link): string {
    $html_link =
      '<a href="' .
      $link['url'] .
      '" target="_blank" rel="noopener noreferrer"><div class="card"><span>' .
      $link['name'] .
      '</span></div></a>';
    return $html_link;
  };
  return join(array_map($link_to_html, $links));
}
?>

<!--
  [%favorite%]
  [%info%]
  [%finance%]
  [%social%]
  [%shopping%]
  [%project%]
  [%webdev%]
-->