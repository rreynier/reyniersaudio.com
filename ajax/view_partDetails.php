<?php

// Get configuration settings
require_once $_SERVER['DOCUMENT_ROOT'] .  '/constants.php';

// Connect to Database
$conn = new mysqli(RA_DB_SERVER, RA_DB_USER, RA_DB_PASSWORD, RA_DB_NAME) or  die('There was a problem connecting to the database.');

include '../classes/Part.php';
include '../classes/Image.php';
$part = New Part();
$id_xpl = explode('-',$_GET['id']);
$id = $id_xpl[0];
$part->getPart($conn,$id);
$part->getImages($conn);
?>


<?php if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {?>
<html>
    <head>
        <title>Part - <?php echo $part->title; ?></title>
    </head>
    <link rel="stylesheet" type="text/css" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/css/info.css" />
    <link rel="stylesheet" type="text/css" href="/css/modeloffsite.css" />
    <link rel="stylesheet" type="text/css" href="/css/master.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery.nyroModal-1.5.0.min.js"></script>
    <script type="text/javascript" src="/js/myjs.js"></script>
    <!-- Woopra Code Start -->
    <script type="text/javascript" src="//static.woopra.com/js/woopra.v2.js"></script>
    <script type="text/javascript">
        woopraTracker.setDomain("reyniersaudio.com"); // define your root domain.
        woopraTracker.track();
    </script>
    <!-- Woopra Code End -->
    <body>
        <div id="headerCnt">
            <div id="logo">
                <a href="/"><img src="/images/logo.gif" alt="Reyniers Audio | Digital Audio Workstations" /></a>
            </div>
            <div id="topNav">
                <div id="mainNavCnt">
                    <ul id="mainNav">
                        <li class="subMenu"><a href="/daw/digital-audio-workstation-computer-comparison">Computers</a>

   
                        </li>

                        <li class="subMenu"><a href="/about/company-info">About</a>
                            <ul>
                                <li><a href="/about/company-info">Company Info</a></li>
                                <li><a href="/about/why-reyniers-audio">Why Reyniers Audio?</a></li>
                                <li><a href="/about/customer-testimonials">Customer Testimonials</a></li>
                                <li><a href="/about/frequently-asked-questions">FAQ</a></li>

                                <li><a class="bottomLink" href="/about/terms-of-service" >Terms of Service</a></li>
                            </ul>
                        </li>
                        <li class="subMenu"><a href="/support/support-warranty">Support</a>
                            <ul>
                                <li><a href="/support/support-warranty" >Support &amp; Warranty</a></li>

                                <li><a class="ask" href="/support/support-warranty">Ask Reyniers Audio</a></li>
                                <li><a href="/support/remote-support" >Remote Support</a></li>
                                <li><a href="/support/compatibility">Compatibility</a></li>
                                <li><a class="bottomLink" href="/support/tweaked-for-audio">Tweaked for Audio</a></li>

                            </ul>
                        </li>

                    </ul>
                </div>
                <div id="subNavCnt">
                    <ul id="subNav">
                        <li><a href="http://www.ewebcart.com/~13951/cgi-bin/cart.cgi?view=1">Shopping Cart</a></li>
                        <li><a class="orderstatus" href="#">My Order Status</a></li>
                        <li><a class="signup" href="#">Sign Up for Newsletter</a></li>
                        <li><a href="/about/why-reyniers-audio">Why Reyniers Audio?</a></li>

                        <li><a href="/about/frequently-asked-questions">FAQ</a></li>
                        <li><a class="ask" href="#question">Ask Reyniers Audio</a></li>
                    </ul>
                </div>                <div id="topNavContact">
                    <h5><img src="/images/head_phone.gif" alt="Phone" />813-421-2061</h5>
                    <h6><a href="mailto:sales@reyniersaudio.com"><img src="/images/head_email.gif" alt="Email" /></a><a href="mailto:sales@reyniersaudio.com">sales@reyniersaudio.com</a></h6>
                </div>

            </div>
        </div>
<div id="partDetailsHeader">
            <h1>Part Details: <?php echo $part->title; ?></h1>
        </div>
            <?php } ?>

        <script>
            $(document).ready(function() {
                $('a.tn').click( function(e){
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $('#partDetails #details').hide();
                    $('#partDetails #fullImage').remove();
                    $('#partDetails #content').append('<div id="fullImage"><img src="' + href + '"></div>');
                });
                $('a.details').click( function(e) {
                    e.preventDefault();
                    $('#partDetails #fullImage').remove();
                    $('#details').show();

                });
            });
        </script>
        <script>
            woopraTracker.addVisitorProperty("Show Details", "Yes");
            woopraTracker.track("/part/<?php echo $part->title; ?>", "View Part Details: <?php echo $part->title; ?>");
        </script>
        
        <div id="partDetailsCont">

            <div id="partDetails">

                <div id="leftNav">
                    <ul>
                        <li>
                            <a href="#" class="details">View Details</a>
                        </li>
                        <?php foreach((array)$part->images as $image) { ?>
                        <li>
                            <a href="/images/parts/resized/<?php echo $image->imageUrl; ?>" class="tn">
                                <img src="/images/parts/tn/<?php echo $image->imageUrl; ?>" alt="<?php echo $image->title ?>" />
                            </a>
                        </li>
                            <?php } ?>
                    </ul>
                </div>
                <div id="content">
                    <div id="details">
                        <div class="info">
                            <?php echo $part->longDesc; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {?>


    </body>
</html>
    <?php } ?>