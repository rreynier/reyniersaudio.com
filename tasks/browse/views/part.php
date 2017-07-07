<?php

$site->addToTitle('');
$site->addToMeta('');

$temp = explode('-', $_GET['part']);
$part_id = $temp[0];

$part = new Part();
$part->getPart($conn, $part_id);
$part->getImages($conn);
$part->getSubTypes($conn);
$tags_temp = explode(',,', $part->tags);
foreach ($tags_temp as $tag) {
    $tags[] = explode('::', $tag);
}
$site->addToTitle($part->title);
$site->addBreadCrumb('&raquo; <a href="#">Recording Computer Studio Gear</a> &raquo; <a href="/recording-computer-studio-gear/audio-interfaces">Audio Interface</a> &raquo; <a href="#">' . $part->title . '</a>');
// Start Output buffer and collect html content //
ob_start();

include 'tasks/browse/views/html/part.html.php';

// Set the Site Object content to what we just collected  with the output buffer //
$site->setContent(ob_get_contents());
ob_end_clean();
?>