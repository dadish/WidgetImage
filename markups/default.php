<?php

$p = ($renderPages->count()) ? $renderPages->first() : wire('page');

$p->of(false);
$imgs = $p->get($settings->image_field);
if ($imgs instanceof PageImages && $imgs->count()) $img = $imgs->first();
else $img = null;

if (is_null($img)) return "Could not get the Image";

$width = $settings->image_width;
$height = $settings->image_height;

if ($width && $height) $thumb = $img->size($width, $height);
else if (!$width && $height) $thumb = $img->width($width);
else if ($width && !$height) $thumb = $img->height($width);
else $thumb = $img;

$imgStr = "<img src='". $thumb->url ."' alt='". $img->description ."' />";

if ($settings->link_image) {
  $imgStr = "<a class='wrapper' href='$p->url'>$imgStr</a>";
} else {
  $imgStr = "<div class='wrapper'>$imgStr</div>";
}

echo $imgStr;