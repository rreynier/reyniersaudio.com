<?php 
$site->addCss('../css/about.css');
$site->addJs('../js/faq.min.js');


// Start Output buffer and collect html content //
ob_start();

switch ($subView) {
    case "company-info":
        $site->addToTitle('Reyniers Audio - Company Information');
        $site->addToMeta('Reyniers Audio is based out of Brandon, FL. We specialize in custom built recording computers. It is our goal to build the fastest, most reliable Digital Audio Workstations (DAW) available. We strive to provide the best customer service and warranty for your purchase.');
        include 'tasks/browse/views/html/about.company-info.html.php';
        break;
    case "why-reyniers-audio":
        $site->addToTitle('Why Reyniers Audio? Optimized - Professional DAW Computers');
        $site->addToMeta('Our computers are optimized for audio.  Our computers are whisper quiet. Our recording computers are fully compatible with all major audio recording software and hardware products on the market.');
        include 'tasks/browse/views/html/about.why-reyniers-audio.html.php';
        break;
    case "customer-testimonials":
        $site->addToTitle('Reyniers Audio Customer Testimonials');
        $site->addToMeta('Hear what some of our clients have to say about Reyniers Audio');
        include 'tasks/browse/views/html/about.customer-testimonials.html.php';
        break;
    case "frequently-asked-questions":
        $site->addToTitle('Common questions about digital audio workstation computers');
        $site->addToMeta('Answers to common question regarding DAW computers, music recording, how we tset our systems, antivirus on your DAW and laptop DAWs');
        include 'tasks/browse/views/html/about.faq.html.php';
        break;
    case "terms-of-service":
        $site->addToTitle('Reyniers Audio - Terms Of Service');
        include 'tasks/browse/views/html/about.terms-of-service.html.php';
        break;
    case "privacy-policy":
        $site->addToTitle('Reyniers Audio - Privacy Policy');
        include 'tasks/browse/views/html/about.privacy-policy.html.php';
        break;
}

// Set the Site Object content to what we just collected  with the output buffer //
$site->setContent(ob_get_contents());
ob_end_clean();
