<?php 
// Add CSS and JS for the current page //
$site->addCss('/css/viewModels.css');
$site->addJs('/js/viewModels.js');
$site->addToTitle('Compare DAW Recording Computers - DAW PC Benchmarks');
$site->addToMeta('Compare Reyniers Audio Workstation computer lineup.');
$models = getModelListActive($conn);

// Start Output buffer and collect html content //
ob_start();

include 'tasks/browse/views/html/models.html.php';

// Set the Site Object content to what we just collected  with the output buffer //
$site->setContent(ob_get_contents());
ob_end_clean();
?>