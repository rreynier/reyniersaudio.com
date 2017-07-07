<?php 
$site->addCss('/css/about.css');
$site->addCss('/css/slides.css');
$site->addJs('/js/jquery.cycle.min.js');
$site->addToTitle('Recording Computers, Pro Audio DAW Computer PC, Digital Audio Workstations');
$site->addToMeta ('Reyniers Audio builds specialized turnkey Digital Audio Workstation solutions. We design professional high performance DAW computer systems optimized for recording, mixing and mastering.');

// Start Output buffer and collect html content //
ob_start();

include 'tasks/browse/views/html/default.html.php';

// Set the Site Object content to what we just collected  with the output buffer //
$site->setContent(ob_get_contents());
ob_end_clean();

?>