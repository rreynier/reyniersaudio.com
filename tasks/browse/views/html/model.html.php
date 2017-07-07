<div id="top"></div>
<form name="modelForm" id="modelForm" method="post" action="http://www.ewebcart.com/13951/cart" onsubmit="_gaq.push(['_linkByPost', this]);">
    <input type="hidden" name="item_id" value="55" />

    <div id="compBuilder">
        <div id="leftCol">

            <input type="hidden" name="basePrice" id="basePrice" value="<?php echo $model->basePrice; ?>" />
            <input type="hidden" name="modelDiscount" id="modelDiscount" value="<?php echo $model->discount; ?>" />
            <input type="hidden" name="option0.5|<b><?php echo $model->title; ?></b>" value="<b><?php echo $model->shortDesc; ?></b>|0" />
            <div class="compItem">
                <div id="modelInfoCont">
                    <div id="modelInfoLeftCol">
                        <div id="modelHeader">
                            <h1>Digital Audio Workstations:<img src="/images/bars.gif" alt="Soundbars Graphic" /></h1>
                            <p><?php echo $model->title ?></p>
                        </div>
                        <div id="modelInfo">
                            <script type="text/javascript">

                                $(document).ready(function(){
                                    $("#modelInfoTabs").tabs();
                                });
                            </script>
                            <div id="modelInfoTabs">
                                <ul>
                                    <li><a href="#modelTab1"><?php echo $model->tab1Title; ?></a></li>
                                    <li><a href="#modelTab2"><?php echo $model->tab2Title; ?></a></li>
                                    <li><a href="#modelTab3"><?php echo $model->tab3Title; ?></a></li>
                                </ul>
                                <div id="modelTab1">
                                    <div class="tabBg">
                                        <div class="info"><?php echo $model->tab1Content; ?></div>
                                    </div>
                                </div>
                                <div id="modelTab2">
                                    <div class="tabBg">
                                        <div class="info"><?php echo $model->tab2Content; ?></div>
                                    </div>
                                </div>
                                <div id="modelTab3">
                                    <div class="tabBg">
                                        <div class="info"><?php echo $model->tab3Content; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modelInfoRightCol">
                        <p><img alt="<?php echo $model->title . ' ' . $model->shortDesc; ?>" src="/images/models/full/<?php echo $model->imgTitle2; ?>" /></p>
                        <h4>Base Price</h4>
                        <p>
                            <input type="hidden" name="option0|Base Price" id="base-price" baseprice="<?php echo ($model->getTotalBasePrice($conn) - $model->discount); ?>"
                                   value="Default Parts|<?php echo ($model->getTotalBasePrice($conn) - $model->discount); ?>" />
                            <?php echo $model->getBasePriceHtml($conn); ?><br />
                            (Plus S/H)
                        </p>
                        <br />
                    </div>
                </div>
            </div>

            <?php
            $model->getPartTypes($conn);
            foreach((array)$model->partTypes as $partType) {
                $partTypeNavs[] = $partType->shortTitle;
                $rightBar .= '<h6><a class="scroll" href="#'. $partType->shortTitle .'">' . $partType->title . '</a></h6><ul class="partType partType'.$partType->id.'" >';
                ?>
            <div class="compItem" id="<?php echo $partType->shortTitle; ?>">
                <div class="header">
                    <h2>
                        <span class="subTypeTitle"><?php echo $partType->title ?></span>|<span class="subTypeDesc"><?php echo $partType->shortDesc ?></span>
                        <img src="/images/part_types/full/<?php echo $partType->imgTitleUrl; ?>" />
                    </h2>
                </div>
                <div class="partTypeInfo">
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#partTypeInfo-<?php echo $partType->id ?>").tabs();
                        });
                    </script>
                    <div class="partTypeInfoTabs">
                        <span class="overlay"></span>
                        <div id ="partTypeInfo-<?php echo $partType->id ?>">
                            <ul>
                                <?php if ($partType->longDesc != '') { ?>
                                <li><a href="#briefDescription-<?php echo $partType->id ?>">Brief Description</a></li>
                                <?php } ?>
                                <?php if ($partType->decisionFactors != '') { ?>
                                <li><a href="#decisionFactors-<?php echo $partType->id ?>">Decision Factors</a></li>
                                <?php } ?>
                                <?php if ($partType->helpMeDecide != '') { ?>
                                <li><a href="#helpMeDecide-<?php echo $partType->id ?>">Help Me Decide</a></li>
                                <?php } ?>
                                <?php if ($partType->customTabContent != '') { ?>
                                <li><a href="#customTab-<?php echo $partType->id ?>"><?php echo $partType->customTabTitle; ?></a></li>
                                <?php } ?>
                                <?php if ($partType->customTabContent2 != '') { ?>
                                <li><a href="#customTab2-<?php echo $partType->id ?>"><?php echo $partType->customTabTitle2; ?></a></li>
                                <?php } ?>
                                <?php if ($partType->customTabContent3 != '') { ?>
                                <li><a href="#customTab3-<?php echo $partType->id ?>"><?php echo $partType->customTabTitle3; ?></a></li>
                                <?php } ?>
                                <?php if ($partType->customTabContent4 != '') { ?>
                                <li><a href="#customTab4-<?php echo $partType->id ?>"><?php echo $partType->customTabTitle4; ?></a></li>
                                <?php } ?>
                                <?php if ($partType->customTabContent5 != '') { ?>
                                <li><a href="#customTab5-<?php echo $partType->id ?>"><?php echo $partType->customTabTitle5; ?></a></li>
                                <?php } ?>
                            </ul>
                            <div id="briefDescription-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                        <?php echo $partType->longDesc ?>
                                </div>
                            </div>
                            <div id="decisionFactors-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                    <div class="parttype"><?php echo $partType->decisionFactors ?></div>
                                </div>
                            </div>
                            <div id="helpMeDecide-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                    <div class="parttype"><?php echo $partType->helpMeDecide ?></div>
                                </div>
                            </div>
                            <div id="customTab-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                    <div class="parttype"><?php echo $partType->customTabContent ?></div>
                                </div>
                            </div>
                            <div id="customTab2-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                    <div class="parttype"><?php echo $partType->customTabContent2 ?></div>
                                </div>
                            </div>
                            <div id="customTab3-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                    <div class="parttype"><?php echo $partType->customTabContent3 ?></div>
                                </div>
                            </div>
                            <div id="customTab4-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                    <div class="parttype"><?php echo $partType->customTabContent4 ?></div>
                                </div>
                            </div>
                            <div id="customTab5-<?php echo $partType->id ?>">
                                <div class="tabBg">
                                    <div class="parttype"><?php echo $partType->customTabContent5 ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php $partType->getSubTypes($conn);?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#subTypeTabs-<?php echo $partType->id ?>").tabs();
                    });
                </script>
                <div class="subTypeTabs">
                    <div id="subTypeTabs-<?php echo $partType->id ?>">
                        <ul>
                                <?php foreach((array)$partType->subTypes as $subType) {
                                    echo '<li><div class="overLap"></div><a href="#tab-' . $partType->id . '-' . $subType->id .'">' . $subType->title . '</a></li>';
                                }?>
                        </ul>

                            <?php
                            // LOOP THROUGH SUBTYPES //
                            foreach((array)$partType->subTypes as $subType) {
                                $rightBar .= '<li class="subType subType'.$subType->id.'"><ul>';
                                ?>
                        <div id="tab-<?php echo $partType->id ?>-<?php echo $subType->id ?>">
                            <div class="subTypeHeader">
                                Select your <?php echo $subType->title ?> below:
                            </div>
                            <div class="partList">
                                        <?php
                                        //SHOW DEFAULT PART FIRST
                                        $defaultCost = 0;
                                        $assignedParts = $model->getParts($conn,$subType->id);
                                        $partCount = count($assignedParts);
                                        switch($partCount) {
                                            case 1:case 2:case 3:case 4:
                                                $partClass = "part";
                                                break;
                                            case 5:
                                                $partClass = "partMedium";
                                                break;
                                            case 6: case 7: case 8: default:
                                                $partClass = "partSmall";
                                                break;
                                        }
                                        foreach((array)$assignedParts as $part) {
                                            if ($part->checkDefault($conn,$subType->id,$model->id)) {
                                                $defaultCost = $part->partCost * ($part->profitPercent + 1);
                                                ?>
                                <div class="selectedPart <?php echo $partClass; ?>">
                                    <h4><?php echo $part->title?></h4>
                                                    <?php
                                                    echo $part->shortDesc;
                                                    // Check if the part is 'none'..
                                                    if ($part->title == 'none' || $part->title == 'None') {
                                                        echo '<div class="thmbContNone"><div class="thmbImg"><img src="/images/none.jpg" alt="placeholder!!" /></div></div>';
                                                    } else { ?>
                                    <a title="Show Details: <?php echo $part->titleClean; ?>" href="/part/<?php echo $part->id; ?>-<?php echo $part->titleClean; ?>" class="showDetails nyroModal">Show Details</a>
                                    <div class="thmbCont"><div class="thmbImg">
                                                                <?php

                                                                // Print Default Image
                                                                printPartImage($conn, $part);
                                                                ?>
                                        </div></div>
                                                        <?php
                                                    } // End If statement for 'none' logic
                                                    // Print the part input box (radio or check);
                                                    echo '<div class="inputSelect">';
                                                    printPartInput($partType,$subType,$part,1,$defaultCost);
                                                    // Print the options if there are any
                                                    printOptions($partType,$subType,$part,$defaultCost);
                                                    echo '</div>';
                                                    ?>
                                </div>
                                                <?php
                                            }
                                        }
                                        // END SHOW DEFAULT PART

                                        //SHOW REST OF PARTS
                                        foreach((array)$assignedParts as $part) {
                                            if (!$part->checkDefault($conn,$subType->id,$model->id)) {
                                                ?>
                                <div class="<?php echo $partClass; ?>">
                                    <h4><?php echo $part->title?></h4>
                                                    <?php
                                                    echo $part->shortDesc;
                                                    // Check if the part is 'none'..
                                                    if ($part->title == 'none' || $part->title == 'None') {
                                                        echo '<div class="thmbContNone"><div class="thmbImg"><img src="/images/none.jpg" alt="placeholder!!" /></div></div>';
                                                    } else { ?>
                                    <a title="Show Details: <?php echo $part->titleClean; ?>"  href="/part/<?php echo $part->id; ?>-<?php echo $part->titleClean; ?>" class="showDetails nyroModal">Show Details</a>
                                    <div class="thmbCont">
                                        <div class="thmbImg">
                                                                <?php
                                                                // Print Default Image
                                                                printPartImage($conn, $part);
                                                                ?>
                                        </div>
                                    </div>
                                                        <?php
                                                    } // End If statement for 'none' logic

                                                    // Pass the 3 objects, then '' to specify its not a
                                                    // default part.
                                                    echo '<div class="inputSelect">';
                                                    printPartInput($partType,$subType,$part,'',$defaultCost);
                                                    printOptions($partType,$subType,$part,$defaultCost);
                                                    echo '</div>';
                                                    ?>
                                </div>
                                                <?php
                                            }
                                        }
                                        // END SHOW REST OF PARTS

                                        ?>
                            </div>
                        </div>
                                <?php
                                $rightBar .= '</ul></li>';
                            }
                            // END LOOP THROUGH SUBTYPES
                            ?>
                    </div>
                </div>
            </div>
                <?php
                $rightBar .= '</ul>';
            }
            ?>
        </div>
        <div id="rightCol">
            <div id="cart">
                <div class="price">
                <span class="yellow asconfigured">As Configured</span>
                <span class="carttotal" id="cartTotal"></span>
                <span class="shipping">* Plus S/H</span>
                </div>
                <p>Estimated Ship Date: <br/>
                    <script type="text/javascript">
                        Number.prototype.mod = function(n) { return ((this%n)+n)%n; }
                        Date.prototype.addBusDays = function(dd) {
                            var wks = Math.floor(dd/5);
                            var dys = dd.mod(5);
                            var dy = this.getDay();
                            if (dy === 6 && dys > -1) {
                                if (dys === 0) {dys-=2; dy+=2;}
                                dys++; dy -= 6;
                            }
                            if (dy === 0 && dys < 1) {
                                if (dys === 0) {dys+=2; dy-=2;}
                                dys--; dy += 6;
                            }
                            if (dy + dys > 5) dys += 2;
                            if (dy + dys < 1) dys -= 2;
                            this.setDate(this.getDate()+wks*7+dys);
                        }
                        var due = new Date();
                        due.addBusDays(8);
                    </script>
                    <span class = "title">
                        <script type="text/javascript">
                            var m_names = new Array("January", "February", "March",
                            "April", "May", "June", "July", "August", "September",
                            "October", "November", "December");
                            var due_date = due.getDate();
                            var due_month = due.getMonth();
                            var due_year = due.getFullYear();
                            document.write(m_names[due_month] + "  "+ due_date + ", " + due_year);
                        </script>
                    </span>
                    <br/>
                </p>
                <div class="addToCartButton">
                    <!--<a href="javascript: submitform()">Add to Cart</a>-->
					<a href="#">Add to Cart</a>
                </div>
                <a class="ask" href="/support/support-warranty"><img src="/images/questionicon.png" alt="Question Icon"></a><a class="ask" href="/support/support-warranty">Have a question?</a>
                <input type="hidden" name="add" />
                <div id="cartComputer">
                    <?php echo $rightBar; ?>
                </div>
                <div class="clrFlt"></div>
            </div>

        </div>
        <div id="builderNavCnt">
            <img src="/images/builderNav_jumpTo.png" alt="Jump To"/>
            <ul id="builderNav"><li><a href='#top'>top</a></li>
                <?php
                foreach((array)$partTypeNavs as $navItem) {
                    echo '<li><span></span><a class="scroll" href="#' . $navItem . '">' . $navItem . '</a></li>';
                } ?>
            </ul>
        </div>
    </div>

</form>
<script type="text/javascript">
    $(document).ready(function() { $("#modelForm").get(0).reset(); })
</script>
