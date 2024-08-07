<?php
function eis_main_news_section_title($title = "প্রধান খবর", $title_class = null, $cat_class = null)
{
  return sprintf(
    '<div class="bg-black-light border-none mb-3 %2$s">
        <span class="main_section_cat %3$s">%1$s</span>
     </div>',
    strtoupper($title),
    $title_class,
    $cat_class
  );
}

function eis_news_section_title($title = "Category One", $section_class = null, $cat_class = null, $link_class = null)
{
  return sprintf(
    '<div class="flex justify-between items-center border-b mb-3 section_title %2$s">
      <a href="%5$s" class="text-lg px-2 pt-2 pb-[5px] text-white ml-2 %3$s">%1$s</a>
      <a href="%5$s" class="text-black flex items-center gap-2 %4$s">
        <span class="text-lg pt-[2px]">আরোও</span> <span>%6$s</span>
      </a>
    </div>',
    strtoupper(eis_get_category_name($title)),
    $section_class,
    $cat_class,
    $link_class,
    eis_get_category_link($title),
    get_svg_icon('right-angle'),
  );
}

function eis_display_border($size = 2)
{
  printf('<div class="border-top my-%s"></div>', $size);
}

function eis_section_title($template = null)
{
  if (!is_null($template) && "main_news" === $template) {
    eis_main_news_section_title();
  } else {
    eis_news_section_title();
  }
}

function eis_short_title(string $title, int $length): string {
  return substr($title, 0);
}

function eis_get_category_name($slug)
{
  $term = get_category_by_slug($slug);
  return $term->name;
}

function eis_get_category_link($slug)
{
  $term = get_category_by_slug($slug);
  return get_category_link($term);
}


function get_template_part_as_string(string $slug, string|null $name = null, array $args = []): string
{
  ob_start();
  get_template_part($slug, $name, $args);
  return ob_get_clean();
}

function dd($args)
{
  echo "<pre>";
  print_r($args);
  echo "</pre>";
  wp_die();
}

function get_svg_icon(string $name, int $size = 20)
{
  $icon_path = get_template_directory() . "/src/images/icons/{$name}.svg";
  if (file_exists($icon_path)) {
    $icon_content = file_get_contents($icon_path);
    return $icon_content;
  } else {
    return '';
  };
};

