<?php
// If this is loaded by our blog, lets load all the stuff to allow this menu to pull data from MODELS and BLOG
$uri = explode('/',$_SERVER['REQUEST_URI']);
if ($uri[1] == 'blog') { require_once( $_SERVER['DOCUMENT_ROOT'] . '/index.php'); } 
?>

<!--<div id="mainNavCnt">
    <ul id="mainNav">
        <li class="subMenu superMenu computer<?php if($uri[1] == 'daw') { echo ' active'; }?>">
            <a href="/daw/digital-audio-workstation-computer-comparison">Computers</a>
            <ul>
                <li>
                    <h4>Reyniers Audio Models</h4>
                    <ul>
                        <li>
                            <h5 class="navmodeltitle"><a href="/daw/24-Artista-i5-Song-Writer">Artista Sandy Bridge - Song Writer</a></h5>
                            <span class="navmodelspecs">Intel Core i3-i5 - </span>
                            <span class="navmodelbase">
                                <?php echo $models_min['24']['base_price_html']  ; ?>
                            </span>
                            <div class="customizeButton"><a href="/daw/24-Artista-i5-Song-Writer">Customize Your Intel i5 i7 Recording Computer</a></div>

                        </li>
                        <li>
                            <h5 class="navmodeltitle"><a href="/daw/25-Savant-Vishera-FX-Project-Studio">Savant Vishera FX - Project Studio</a></h5>
                            <span class="navmodelspecs">AMD AM3+ - </span>
                            <span class="navmodelbase">
                                <?php echo $models_min['25']['base_price_html']  ; ?>
                            </span>
                            <div class="customizeButton"><a href="/daw/25-Savant-Vishera-FX-Project-Studio">Customize Your AMD Phenom II DAW Computer</a></div>

                        </li>
                        <li>
                            <h5 class="navmodeltitle"><a href="/daw/19-Virtuoso-i5-i7-Pro-Studio">Virtuoso Ivy Bridge - Pro Studio</a></h5>
                            <span class="navmodelspecs">Intel Core i5-i7 - </span>
                            <span class="navmodelbase">
                                <?php echo $models_min['19']['base_price_html']  ; ?>
                            </span>
                            <div class="customizeButton"><a href="/daw/19-Virtuoso-i5-i7-Pro-Studio">Customize Your Intel i5 i7 DAW PC</a></div>
                        </li>
                        <li>
                            <h5 class="navmodeltitle"><a href="/daw/22-Virtuoso-i7-Pro-Studio">Virtuoso Sandy Bridge-E - Pro Studio</a></h5>
                            <span class="navmodelspecs">Intel Core i7 - </span>
                            <span class="navmodelbase">
                                <?php echo $models_min['22']['base_price_html']  ; ?>
                            </span>
                            <div class="customizeButton"><a href="/daw/22-Virtuoso-i7-Pro-Studio">Customize Your Intel i7 Recording PC</a></div>
                        </li>
                        <li class="bottom">
                            <h5 class="navmodeltitle"><a href="/daw/18-Maestro-DX-Film-Scoring">Maestro Sandy Bridge-EP - Film Scoring</a></h5>
                            <span class="navmodelspecs">Intel Dual Xeon - </span>
                            <span class="navmodelbase">
                                <?php echo $models_min['18']['base_price_html']  ; ?>
                            </span>
                            <div class="customizeButton"><a href="/daw/18-Maestro-DX-Film-Scoring">Customize Your Dual Xeon Digital Audio Workstation</a></div>
                        </li>
                    </ul>
                </li>
                <li class="bottom">
                    <a class="boldlink" href="/daw/digital-audio-workstation-computer-comparison">DAW Computer Comparison & Benchmarks</a>
                </li>
                
            </ul>
        </li>

        <li class="subMenu gear<?php if($uri[1] == 'gear') { echo ' active'; }?>"><a href="#">Gear</a>
            <ul>
                <li><a href="/recording-computer-studio-gear/audio-interfaces">Audio Interfaces</a></li>
                <li class="bottom"><a href="/recording-computer-studio-gear/audio-software">Software</a></li>
            </ul>
        </li>
        <li class="subMenu about<?php if($uri[1] == 'about') { echo ' active'; }?>"><a href="/about/company-info">About</a>
            <ul>
                <li><a href="/about/company-info">Company Info</a></li>
                <li><a href="/about/why-reyniers-audio">Why Reyniers Audio?</a></li>
                <li><a href="/about/customer-testimonials">Customer Testimonials</a></li>
                <li><a href="/about/frequently-asked-questions">FAQ</a></li>
                <li class="bottom"><a href="/about/terms-of-service" >Terms of Service</a></li>
            </ul>
        </li>
        <li class="subMenu support<?php if($uri[1] == 'support') { echo ' active'; }?>"><a href="/support/support-warranty">Support</a>
            <ul>
                <li><a href="/support/support-warranty" >Support &amp; Warranty</a></li>
                <li><a class="ask" href="/support/support-warranty">Ask Reyniers Audio</a></li>
                <li><a href="/support/remote-support" >Remote Support</a></li>
                <li><a href="/support/compatibility">Compatibility</a></li>
                <li class="bottom"><a href="/support/tweaked-for-audio">Tweaked for Audio</a></li>

            </ul>
        </li>
        <li class="subMenu superMenu blog blogMenu<?php if($uri[1] == 'blog') { echo ' active'; }?>">
            <a href="/blog/">Blog</a><span class="newitem">New!</span>
            <ul>
                <li>                    
                    <h4>Recent Posts</h4>
                    <ul id="recentPosts">
                        <?php foreach($blog->latest_blog_posts as $post) { ?>
                        <?php
                            $month = substr($post['post_date'], 5, 2);                            
                            $month_string = date('M', mktime(0, 0, 0, $month, 1, 2000));
                            $day_string = substr($post['post_date'], 8, 2);
                        ?>
                        <li>
                            <h5>
                                <span class="blogdate"><span class="blogmonth"> <?php echo $month_string; ?> </span><span class="blogday"> <?php echo $day_string; ?> </span></span>
                                <a class="blogtitle" href="/blog/recording-computer/<?php echo $post['post_name']; ?>"><?php echo $post['post_title']; ?></a>
                            </h5>
                            <p><?php echo get_snippet($post['post_content'],200); ?></p>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a class="boldlink" href="/blog/">View Full Blog</a></li>
            </ul>
        </li>

    </ul>
</div> -->