<script type="text/javascript">
    $('#slideshow').cycle({
        fx:'scrollUp',
        /*sync: false,*/
        speed: 1500,
        pager: '#nav',
        pagerEvent: 'click',
        pause: 1,
        /*fastOnEvent:   1,*/
        timeoutFn: calculateTimeout
    });
    var timeouts = [20,15,10,10,10];
    function calculateTimeout(currElement, nextElement, opts, isForward) {
        var index = opts.currSlide;
        return timeouts[index] * 1000;
    }
</script>


<div id="preload">
    <img src="/images/slide1.gif" alt="We Build The Computer - You Make The Music" width="1" height="1"/>
    <img src="/images/cell1bg.gif" width="1" height="1"/>
    <img src="/images/cell1hoverbg.gif" width="1" height="1"/>
    <img src="/images/cell2bg.gif" width="1" height="1"/>
    <img src="/images/cell2hoverbg.gif" width="1" height="1"/>
    <img src="/images/cell3bg.gif" width="1" height="1"/>
    <img src="/images/cell3hoverbg.gif" width="1" height="1"/>
    <img src="/images/tourcorebg.gif" width="1" height="1"/>
    <img src="/images/testimonialbg.gif" width="1" height="1"/>
</div>
<div id="main">
    <div id="slideshow" class="pics">
        <!--<div id="taxsale">
			<h2>Save BIG on our top sellers!</h2>
			<ul>
				<li>Save from $75 to $200 on our Digital Audio Workstations</li>
				<li>Save on all <a href="http://www.reyniersaudio.com/recording-computer-studio-gear/audio-interfaces/&filters=Brand::RME&order_by=">RME</a> and <a href="http://www.reyniersaudio.com/recording-computer-studio-gear/audio-interfaces/&filters=Brand::Lynx&order_by=">Lynx</a> audio interfaces</li>
			</ul>
		</div>-->
		
		<!--
		<div>
            <img src="/images/slide1.gif" width="1000" height="285" alt="We Build The Computer .. You Make The Music" />
        </div>-->
        <div id="benchmark">
            <h2>CPU Benchmarks for Recording Computers</h2>
            <a href="/blog"><div class="button"></div></a>
            <span class="readmore">Read more to find out:</span>
            <ul>
                <li>How we benchmark our DAW computers</li>
                <li>How Sandy Brige, Zambezi, Nehalem and  Xeon processors compare</li>
                <li>How to chose the best CPU for your recording computer</li>
            </ul>
            <a href="/blog/recording-computer/recording-computer-cpu-benchmarks-sandy-bridge-nehalem-and-bulldozer-processors-compared">Read our benchmark blog post now!</a>
        </div>

        <div id="sandybridge">
            <div class="prices">
                <div class="artista">
                    <div class="baseprice">Starting at</div>
                    <div class="price"><?php
                        foreach($models as $model) {
                            if ($model->id == 24) {
                                echo $model->getBasePriceHtml($conn);
                            }
                        }
                        ?></div>
                    <div class="customizeButton"><a href="/daw/24-Artista-i5-Song-Writer">Build Your Own Artista Sandy Bridge i3-i5 Recording Computer</a></div>
                </div>
                <div class="virtuoso">
                    <div class="baseprice">Starting at</div>
                    <div class="price">
                        <?php
                        foreach($models as $model) {
                            if ($model->id == 19) {
                                echo $model->getBasePriceHtml($conn);
                            }
                        }
                        ?>
                    </div>
                    <div class="customizeButton"><a href="/daw/19-Virtuoso-i5-i7-Pro-Studio">Customize Our Intel Ivy Bridge i5-i7 DAW Computer</a></div>
                </div>
            </div>
        </div>

        <div id="sixcore">
            <h2 class="indent">New 6-Core CPUs - Eat Those Plugins for Breakfast</h2>
            <ul>
                <li>Fastest single-CPU DAW computer available</li>
                <li>Silent, studio-friendly designs</li>
                <li>TurboBoost and HyperBoost automatic overclocking</li>
            </ul>
            <div class="prices">
                <div class="am3">
                    <div class="baseprice">Starting at</div>
                    <div class="price"><?php
                        foreach($models as $model) {
                            if ($model->id == 25) {
                                echo $model->getBasePriceHtml($conn);
                            }
                        }
                        ?></div>
                </div>
                <div class="customizeButton"><a href="/daw/25-Savant-Vishera-FX-Project-Studio">Build Your Own AMD Vishera Recording Computer</a></div>
                <div class="i7">
                    <div class="baseprice">Starting at</div>
                    <div class="price">
                        <?php
                        foreach($models as $model) {
                            if ($model->id == 22) {
                                echo $model->getBasePriceHtml($conn);
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="customizeButton"><a href="/daw/22-Virtuoso-i7-Pro-Studio">Customize Our Intel i7 DAW Computer</a></div>
            </div>

        </div>
        <div id="maestrodx">
            <div class="introducing">
                <h2 class="indent">Introducing the 16-Core Maestro Sandy Bridge-EP Recording Computer</h2>
                <p>Easily handles huge projects</p>
                <p>Pefect for scoring a film <br/>or composing soundtracks</p>
            </div>
            <span class="tower"></span>
            <div class="optimized">
                <div>
                    <h2>DAW Computer Optimized for EastWest PLAY</h2>
                    <ul>
                        <li>Full orchestra right at your fingertips</li>
                        <li>Fully installed and updated custom turnkey solution</li>
                        <li>Unparalelled sample playback performance</li>
                    </ul>
                    <div class="priceCont">
                        <div class="baseprice">Starting at</div>
                        <div class="price">
                            <?php
                            foreach($models as $model) {
                                if ($model->id == 18) {
                                    echo $model->getBasePriceHtml($conn);
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="customizeButton"><a href="/daw/18-Maestro-Sandy-Bridge-EP-Film-Scoring">Build Your Own Custom Recording Computer</a></div>
                </div>
            </div>
        </div>


        <!--        <div>
                    <div id="grid"><div id="fastersmarterbetter"></div></div>
                    <div id="slide2a"><h1>Reyniers Audio DAW Recording Computers</h1>
                        <p>Are you tired of having to freeze down your tracks to keep latency low? </p><p> You've come to the right place. </p>
                        <p>With a Reyniers Audio Workstation, you're getting a reliable, audio optimized, whisper quiet DAW Recording Computer. Turn it on and start making music, it's that simple. </p>
                        <p><a href="/daw/digital-audio-workstation-computer-comparison">&#62;&#62; View our Selection of Digital Audio Workstations &#60;&#60;</a></p>
                    </div>
                    <div id="slide2b"><h2>New Developments:</h2>
                        <span class="developments">Updated website to exceed the growing demands of our customers</span>
                        <span class="developments">5,000 sq foot facility with state of the art recording studio and workstations</span>
                        <span class="developments">Updated product line incorporating the latest technologies from Intel(R)</span>
                        <span class="developments">Extended warranties available on all workstations</span>
                    </div>
                </div>-->
        <div>
            <a href="/support/compatibility"><img src="/images/slide3.jpg" width="1000" height="285" alt="Compatible with all major recording DAW software such as: Pro Tools, Cubase, Sonar, Nuendo"/></a>
        </div>
        
    </div>

</div>

<div id="slidecells">
    <div id="cnt1"></div>
    <div id="cnt2"><div id="nav"></div></div>

    <div id="midcells">
        <div id="cell1" onclick="location.href='/daw/25-Savant-Vishera-FX-Project-Studio';" style="cursor:pointer;">

            
            <h3 class="indent">Savant FX - Project Studio DAW</h3>
            <div id="cell1txt">
                <span class="cpuclass">Vishera FX</span>
                <div class="baseprice">Base Price</div>
                <div class="price">
                    <?php
                    foreach($models as $model) {
                        if ($model->id == 25) {
                            echo $model->getBasePriceHtml($conn);
                        }
                    }
                    ?>
                </div>
                <div class="learnmore"><a href="/daw/25-Savant-Vishera-FX-Project-Studio">Customize<!--<span class="off">Your AMD DAW Computer</span>--></a><br/><br/><a href="/daw/digital-audio-workstation-computer-comparison#16">Compare <!--<span class="off">Our Recording PC's</span>--></a></div>
            </div>
            <div class="briefdesc">The perfect recording computer for the small project studio.  Easily record 32 tracks  simultaneously, with enough horsepower to take such project from conception to CD. </div>
        </div>
        <div id="cell2" >
            <!--<div class="ribbon-new-right"></div>-->
			<div class="ribbon-new-right"></div>
            <h3 class="indent">Virtuoso i7 - Professional Studio DAW</h3>
            <div id="cell2txt">
                <span class="cpuclass">Ivy Bridge i5-i7</span>
                <div class="baseprice">Base Price</div>
                <div class="price">
                    <?php
                    foreach($models as $model) {
                        if ($model->id == 19) {
                            echo $model->getBasePriceHtml($conn);
                        }
                    }
                    ?>
                </div>
                <div class="learnmorem"><a href="/daw/19-Virtuoso-i5-i7-Pro-Studio">Customize<!--<span class="off">DAW PC</span>--></a></div>
                <br>
                <span class="cpuclass">Sandy Bridge-E i7</span>
                <div class="baseprice">Base Price</div>
                <div class="price">
                    <?php
                    foreach($models as $model) {
                        if ($model->id == 22) {
                            echo $model->getBasePriceHtml($conn);
                        }
                    }
                    ?>
                </div>
                <div class="learnmorem"><a href="/daw/22-Virtuoso-i7-Pro-Studio">Customize<!--<span class="off">Recording Computer</span>--></a></div>
                <div class="learnmorem compare"></div>
            </div>
            <div class="briefdesc">This DAW workstation can easily handle zero latency live recording of 50+ tracks with headroom to spare for those hungry Hyper-Sampled virtual instruments (VSTi).</div>
        </div>
        <div id="cell3" onclick="location.href='/daw/18-Maestro-DX-Film-Scoring';" style="cursor:pointer;">
            <!--<div class="ribbon-new-right"></div>-->
            <h3 class="indent">Maestro SB-EP - Film Scoring DAW</h3>

            <div id="cell3txt">
                <span class="cpuclass">Sandy Bridge-EP Dual Xeon</span>
                <div class="baseprice">Base Price</div>
                <div class="price">
                    <?php
                    foreach($models as $model) {
                        if ($model->id == 18) {
                            echo $model->getBasePriceHtml($conn);
                        }
                    }
                    ?>
                </div>
                <div class="learnmore"><a href="/daw/18-Maestro-Sandy-Bridge-EP-Film-Scoring">Customize<!--<span class="off">Your Custom Film Scoring Recording Computer</span>--></a><br/><br/><a href="/daw/digital-audio-workstation-computer-comparison#18">Compare <span class="off">Our DAW Computers</span></a></div>
            </div>
            <div class="briefdesc">Get the most processing power available on one DAW computer. The perfect solution for huge instrument libraries by EastWest, Tascam,
                Vienna Symphonic etc..  </div>
        </div>
        <div id="cell4"></div>
    </div>
</div>
<div id="bottomcells">
    <div id="cnt1b" onclick="location.href='/daw/24-Artista-i5-Song-Writer';" style="cursor:pointer;">
        <!---<div class="ribbon-new-left"></div>-->
        <h3 class="indent">Artista i5 - Song Writer Recording Computer</h3>
        <div id="cell4txt" >
            <span class="baseprice">Base Price</span>
            <span class="price">
                <?php
                foreach($models as $model) {
                    if ($model->id == 24) {
                        echo $model->getBasePriceHtml($conn);
                    }
                }
                ?>
            </span> - SandyBridge i3-i5<br/>
            <span class="learnmorea"><a href="/daw/24-Artista-i5-Song-Writer">Customize<!--<span class="off">Your Recording Computer</span>--></a> | <a href="/daw/digital-audio-workstation-computer-comparison#17">Compare <span class="off">Our DAW Computers</span></a></span>
        </div>

    </div>
    <div id="cnt2b">
        <div id="cell5txt" onclick="location.href='/about/customer-testimonials';" style="cursor:pointer;">
            <span class="testimonial">&#34;...This is probably the best deal and service I have ever received from an internet business. The computer they built for me is absolutely perfect in every way. I don't have to worry about anything but making music! This box simply rocks!&#34;<br/><br/>- Owen Sands  | <a href="/about/customer-testimonials"> Read more testimonials</a></span>
        </div>
    </div>
</div>