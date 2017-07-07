<?php 
$site->addCss('../css/about.css');


// Start Output buffer and collect html content //
ob_start();


if( isset($_POST['form_submit'])) {

	// Modify this to change who the email goes to ( also change it in the header further down )
	$email['to'] = 'wouter@reyniersaudio.com';
	$email['subject'] = 'Ask a Question ' . date("F j, Y, g:i a");
	$email['body'] = '<ul>';
	foreach($_POST as $fieldName=>$fieldContent) {
		if($fieldName != 'form_submit') {
			$email['body'] .= '<li>' . $fieldName . ' => ' . $fieldContent . '</li>';
		}
	}
	$email['body'] .= '</ul>';
	$email['headers'] =
	$headers  =
		'MIME-Version: 1.0' . "\r\n".
          'Content-type: text/html; charset=iso-8859-1' . "\r\n".
		'From: wouter@reyniersaudio.com' . "\r\n" .
		'To: wouter@reyniersaudio.com' . "\r\n" .
		'Reply-To: wouter@reyniersaudio.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	mail($email['to'], $email['subject'], $email['body'], $email['headers']);

	// The message that shows when someone successfully submits a question.
	include('html/submit-question.html.php');


	exit();
}

else {
    switch ($subView) {
        case "support-warranty":
            $site->addToTitle('Reyniers Audio - Support And Warranty');
            $site->addToMeta('Each Reyniers Audio computer comes with a one year Limited Warranty and Support - Free!.');
            include 'tasks/browse/views/html/support.support-warranty.html.php';
            break;
        case "remote-support":
            $site->addToTitle('Reyniers Audio - Remote Support');
            $site->addToMeta('With state of the art remote desktop utilities, Reyniers Audio technicians are able to solve customer problems quickly and painlessly (internet connection required).');
            include 'tasks/browse/views/html/support.remote-support.html.php';
            break;
        case "compatibility":
            $site->addToTitle('DAW Software and Hardware compatible with Reyniers Audio Workstations');
            $site->addToMeta('Reyniers Digital Audio Workstations are optimized and compatible with all the industry standard hardware and software.  We pride ourselves on being compatible with virtually all DAW software, including Pro Tools, Nuendo, Sonar and Samplitude, to name just a few. ProTools compatible DAWs.');
        include 'tasks/browse/views/html/support.compatibility.html.php';
            break;
        case "tweaked-for-audio":
            $site->addToTitle('Recording Computers Tweaked For Digital Audio Production');
            $site->addToMeta('Reyniers Digital Audio Workstations come fully tweaked for music production. We minimalize the CPU and RAM footprint of Windows 7 and XP by optimizing and disabling services not need for recording music on the computer. Your DAW comes ready to go; plug it in and record.' );
            include 'tasks/browse/views/html/support.tweaked-for-audio.html.php';
            break;
    }
}

// Set the Site Object content to what we just collected  with the output buffer //
$site->setContent(ob_get_contents());
ob_end_clean();
?>