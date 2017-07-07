<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta name="Description" content="<?php echo $this->meta ?>"/>
        <meta name="Keywords" content="daw, professional audio workstations, professional audio pc, pro audio, daw, turnkey workstations, professional audio, audio pc, daw computer, recording computer"/>
        <meta name="Robots" content="index,follow"/>
        <meta name="Revisit-after" content="30"/>
        <meta name="google-site-verification" content="lUQ9lX-5uh8SP_O_UZB3Nk3Z-e3q0dosVxd54C-aJz8" />
        <title><?php echo $this->title ?></title>
        <link rel="stylesheet" type="text/css" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/css/master.css?v=1" />
        <?php foreach ((array)$this->css as $css) {
            echo $css;
}?>
<?php foreach ((array)$this->cssIe6 as $cssIe6) {
    echo $cssIe6;
}?>
        <!--[if lte IE 6]>
                    <style type="text/css">
                    #ie6msg{display:block;position:absolute;z-index:99999999;top:0;left:0;border:3px solid #090;margin:50px; padding:10px; background:#cfc; color:#000;}
                    #ie6msg h4{margin:20px; padding:0;}
                    #ie6msg p{margin:20px; padding:0;}
                    #ie6msg p a.getie8{font-weight:bold; color:#006;}
                    #ie6msg p a.ie6expl{font-weight:bold; color:#006;}
                    </style>
        <![endif]-->

        <!-- Start of Woopra Code -->
        <script type="text/javascript">
            var woo_settings = {idle_timeout:'300000', domain:'reyniersaudio.com'};
            (function(){
                var wsc = document.createElement('script');
                wsc.src = document.location.protocol+'//static.woopra.com/js/woopra.js';
                wsc.type = 'text/javascript';
                wsc.async = true;
                var ssc = document.getElementsByTagName('script')[0];
                ssc.parentNode.insertBefore(wsc, ssc);
            })();
        </script>
        <!-- End of Woopra Code -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/jquery.nyroModal-1.5.0.min.js"></script>
        <script type="text/javascript" src="/js/myjs.js"></script>
<?php foreach ((array)$this->js as $js) {
    echo $js;
}?>
<?php foreach ((array)$this->jsIe6 as $jsIe6) {
    echo $jsIe6;
}?>
    </head>

    <body style="position:relative;">
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            var pageTracker = _gat._getTracker("UA-5235600-2");
            pageTracker._setDomainName("none");
            pageTracker._setAllowLinker(true);
            pageTracker._trackPageview();
        </script>
		<div id="closed" style="display:none;position:absolute; width: 500px; background: white; border: 2px solid #538815; z-index:9999999; left:217px;  top: 117px; padding:20px; cursor:pointer;" >
			<span class="close" style="position:absolute; display:block; background: grey; right:10px; top:10px;font-size:17px; color:#fff; width:25px; height:25px;line-height:25px;text-align:center;">X</span>
			<p><b>Thank you for visiting Reyniers Audio.</b></p>
			
			<p>We will be closed from September 7, 2013 to September 30, 2013 as we are on vacation.
			All orders placed between these dates will be fulfilled after our return. </p>
			
			<p>We will be periodically checking emails for urgent issues, and we will do our best to answer them as quickly as possible.
			We apologize for the inconvenience.</p>	
			
			<p>Wouter Reyniers<br>
			Owner, Reyniers Audio</p>
		</div>

        <div id="<?php echo $this->uniquePageId; ?>">
            <div id="mainCnt">
                <div id="headerCnt">
                    <div id="logo">
                        <a href="/"><img src="/images/logo.gif" alt="Reyniers Audio | Digital Audio Workstations" /></a>
                    </div>
                    <div id="topNav">
						<?php echo $this->mainNav; ?>
                        <div id="topNavContact">
                            <!--<h5><img src="/images/head_phone.gif" alt="Phone" />813-421-2061</h5>-->
                            <h6><a href="mailto:support@reyniersaudio.com">support@reyniersaudio.com</a></h6>
                        </div>
                    </div>
                </div>
                <div id="bodyCnt">
                    <div id="breadCrumb">
<?php echo $this->breadCrumb; ?>
                    </div>
					<div style="background:#fff; padding:20px; width:1000px;">
					<p> Dear Visitor,</p>
					<p>Regrettably, we have made the decision to close down Reyniers Audio indefinetely effective November 12, 2013. We would like to thank you for your business with Reyniers Audio. It has been a pleasure to serve you.</p>
					<p>Although Reyniers Audio will no longer build digital audio workstation computers, it will honor existing warranties until they expire. However, there will be changes in the processing of warranty-related customer support:</p>
						<ul>
							<li>1. All warranty requests must be initiated via email at wouter@reyniersaudio.com. All attempts will be made to reply within 48 hours of receiving the request.</li>
							<li>2. If your computer malfunctions or if any or all components fail within the warranty period you have with Reyniers Audio, please contact me at wouter@reyniersaudio.com. </li>
							<li>3. If your computer malfunctions or if any or all components fail outside of the warranty period you have with Reyniers Audio, you will need to contact the manufacturer of the defective part for an RMA and request replacement or repair. Alternatively, you can email me at wouter@reyniersaudio.com and I will consult with you at $100/hr to get you back up and running.</li>
							<li>4. If your computer is out of warranty, I will still be available for paid consultation at the rate of $100/hr (minimum of 1 hour).</li>
							<li>5. Reyniers Audio will not sell extended warranties on computers already sold and delivered, effective immediately.</li>
						</ul>
					<p>Thank you very much for your business, and I hope you will continue to enjoy working with your Reyniers Audio computer(s) for a long time to come.</p>
					<p>Respectfully,</p>
					Wouter Reyniers,<br>
					Owner of Reyniers Audio
					</div>
<?php /*echo $this->content;*/ ?>
                </div>
                <div id="footerCnt" style="display:none;>
                    <div id="footerLeft">
                        SITE<br />
                        <div id="footerNavL">
                            <ul class="footerNav">
                                <li><a href="/daw/digital-audio-workstation-computer-comparison">DAW Computers</a></li>
                                <li><a href="/about/company-info">Company Info</a></li>
                                <li><a href="/support/support-warranty">Support</a></li>
                                <li><a href="/blog">AudioFiles Blog</a></li>
                            </ul>
                        </div>
                        <div id="footerNavR">
                            <ul class="footerNav">
                                <li><a class="ask" href="/support/support-warranty">Contact Us</a></li>
                                <li><a href="/about/terms-of-service">Terms of Service</a></li>
                                <li><a href="/about/privacy-policy">Privacy Policy</a></li>
                                <li><a href="/about/frequently-asked-questions">FAQ</a></li>
                            </ul>
                        </div>
						<div id="resellerratings">
						<div id="ratings_alt1" class="alt1"></div>
							<script>var rr_rating_widget_setup = {'div':"ratings_alt1"};</script>
							<script src="https://widget.resellerratings.com/widget/javascript/rating/Reyniers_Audio.js"></script>
						</div>
                    </div>
                    <div id="footerRight" style="display:none;>
                        <h3>REYNIERS AUDIO</h3>
                        <p>Reyniers Audio builds specialized turnkey Digital Audio Workstation solutions.  With passion and dedication, we design professional
                            high performance DAW computer systems optimized for recording, mixing and mastering.</p>
                        <p class="italic">We build the computer. You make the music!</p>

                    </div>
                    <div id="socialmedia" style="display:none;>
                        <h3>CONNECT WITH US</h3>
                        <p><a href="http://www.facebook.com/reyniersaudio"><img src="/images/socialmedia/facebook.png" alt="Facebook" /></a>
                            <a href="http://www.twitter.com/reyniersaudio"><img src="/images/socialmedia/twitter.png" alt="Twitter" /></a></p>
                    </div>
				
                    <div class="clrFlt" id="copyright" style="display:none;><p>&copy; 2013 ReyniersAudio.com | <a href="mailto:sales@reyniersaudio.com">sales@reyniersaudio.com</a> | Call Us: (813) 421-2061</p></div>
                    <!-- (c) 2005, 2011. Authorize.Net is a registered trademark of CyberSource Corporation -->
                    <div id="AuthorizeNetSeal" class="clrFlt" style="display:none;>
                    <div class="AuthorizeNetSeal clrFlt" style="display:none;> <script type="text/javascript" language="javascript">var ANS_customer_id="3a371d75-7aab-4888-8ee4-7e481bcf2438";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> <a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">E-Commerce Solutions</a> </div>
                    </div>
                </div>

            </div>


        </div>

        
        <div id="ie6msg">
            <h4>You are using an old browser!</h4>
            <p>To get the best possible experience using our website we recommend that you upgrade your browser to a newer version. <br/>The current version is <a class="getie8" href="http://upgradeie.s3.amazonaws.com/eng/index.html">Internet Explorer 8</a>. The upgrade is free. If you're using a PC at work you should contact your IT administrator.</p>
            <p>If you want to you may also try some other popular Internet browsers like <a class="ie6expl" href="http://getfirefox.com">Firefox</a>, <a class="ie6expl" href="http://www.opera.com">Opera</a>, or <a class="ie6expl" href="http://www.apple.com/safari/download/">Safari</a></p>
        </div>
    </body>
</html>