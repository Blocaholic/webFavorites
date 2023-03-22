<?php
include_once 'db.php';

function main() {
  // GET DATA AND TEMPLATES
  $links = DB::getLinks();
  $categories = array_unique(array_column($links, 'category'));
  $html_template = file_get_contents('../templates/index.html');

  // FAVORITES
  $html_content = '';

  // CATEGORIES
  foreach ($categories as $category) {
    $html_category = links_to_html(filter_category($links, $category));
    $html_content .=
      '<article><h2>' .
      $category .
      '</h2><section>' .
      $html_category .
      '</section></article>';
  }

  // FINAL PAGE
  $html = preg_replace('/\[\%content\%\]/', $html_content, $html_template);
  return $html;
}

function filter_category(array $links, string $category): array {
  return array_filter($links, function (array $link) use ($category): bool {
    return $link['category'] == $category;
  });
}

function links_to_html(array $links): string {
  $link_to_html = function (array $link): string {
    $style =
      strlen($link['color']) > 0
        ? ' style="border-color:' . $link['color'] . '"'
        : '';
    $name =
      strlen($link['image']) > 0
        ? '<img src="images/' . $link['image'] . '">'
        : $link['name'];
    $html_link =
      '<a href="' .
      $link['url'] .
      '" target="_blank" rel="noopener noreferrer"><div class="card"' .
      $style .
      '>' .
      $name .
      '</div></a>';
    return $html_link;
  };
  return join(array_map($link_to_html, $links));
}
?>
