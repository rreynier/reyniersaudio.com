<div id="viewModels">
    <div id="modelsOverview">
        <ul id="modelBoxes">
            <?php
            $place="first";
            $count=1;
            $modelCount = count($models) - 1;
            foreach((array)$models as $model) {
                ?>
            <li class="<?php echo $place; ?>">
                <div class="modelImage">
                    <img src="/images/models/full/<?php echo $model->imgTitle; ?>" alt="<?php echo $model->imgTitle; ?>"/>
                </div>
                <span class="modelName">
                        <?php echo $model->title; ?></span> <?php echo $model->shortDesc; ?><br/>
                <span class="basePrice">Base Price </span><span class="basePriceWhite">
                        <?php echo $model->getBasePriceHtml($conn); ?>
                </span>

                <br/>
                <div class="customizeButton"><a href="/daw/<?php echo $model->id; ?>-<?php echo $model->titleClean;?>-<?php echo $model->shortDescClean; ?>"></a></div>
                <a href="#<?php echo $model->id ?>" class="compareModel scroll">compare<br/>below</a>

            </li>
                <?php
                if ($count == $modelCount) {
                    $place='last';
                } else {
                    $place='';
                }
                $count++;
            }
            ?>
        </ul>
        <div id="modelDescription">

            <div id="left">
                <h3>Create with confidence</h3>
                <p>Unleash the full potential of your creative mind with a Reyniers Audio DAW!
				With today's Intel Processors you no longer have to freeze tracks to keep the latency low, just keep tracking. 
				Configure your system with the market's fastest processors and largest hard drives to take your musical talents to new heights.</p>
                <h3>Our DAWs lead the industry in compatibility</h3>
                <p>As we run our own professional recording studio, Crooked Tree, we get the chance to test the software and hardware used in the music industry.
				As we find incompatibilities, we tweak our configurations to ensure everything works well together.
				We pride ourselves on being compatible with virtually all DAW software, including Pro Tools, Nuendo, Sonar and Samplitude, to name a few.<br/>
                    <a href="/support/compatibility">Compatibility Information</a></p>
                <h3>Windows XP and Windows 7 tweaked for audio production</h3>
                <p>The Reyniers Audio workstations come fully tweaked for music production and we ensure that all services
				not vital to audio production are disabled. <br/>
                    <a href="/support/tweaked-for-audio">Tweaked for Audio</a></p>
                <h3>Whisper quiet operation</h3>
                <p>Keeping the noise floor in the control room to a minimum is a crucial element of a good mixing environment.
				For this, we only select components that meet our very strict standard.  We sometimes get calls from customers asking if 
				there's a problem with the fans as they can't hear the system at all - we take this as a compliment.</p>
                <h3>Dual monitor support</h3>
                <p>All Reyniers Audio workstations support dual monitors.  Moving mixers and plugins to the second screen
				drastically improves workflow and reduces screen clutter.</p>
            </div>
            <div id="right">
                <h3>CPU Performance Benchmark</h3>
                <p>Shown below are the results of benchmark tests using the PassMark PerformanceTest&trade;.  A CPU with a higher PassMark score will yield a higher plugin count at lower latencies.</p><br/>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("div.group div em").each(function (i) {
                            var capacity = Math.round($(this).text().replace(/\,/,"") / 112); // Divide by 350 to scale to desired widths.
                            /*$(this).width(capacity).css("background","#FFE399 none repeat scroll 0 0");*/
                            $(this).width(capacity).css("background","url(../images/breadCrumb_bg_lt.gif) repeat-x");
                            $(this).width(capacity).css("border","1px solid #FFE399");
                        }).animate({'width':'toggle'},4000);
                    });
                </script>

                <div class="group">
                    <div class="spacer">
                        <h5>Artista - Core i5/i7 Z77 Chipset (2-4 Cores)<a href="#24" class="scroll compareModel"> compare below</a></h5>
                        <div><label>Intel i3 2100</label><em>3510</em></div>
                        <div><label>Intel i3 2120</label><em>3966</em></div>
                        <div><label>Intel i5 2300</label><em>5552</em></div>
                        <div><label>Intel i5 2400</label><em>6032</em></div>
                    </div>
                    <div class="spacer">
                        <h5>Savant - AMD Zambezi FX/X6 970 Chipset (4-8 Cores)<a href="#25" class="scroll compareModel"> compare below</a></h5>
                        <div><label>AM3+ FX-4100</label><em>4384</em></div>
                        <div><label>AM3+ FX-6100</label><em>5187</em></div>
                        <div><label>AM3 X6 1100T</label><em>6300</em></div>
                        <div><label>AM3+ FX-8120</label><em>7222</em></div>
                        <div><label>AM3+ FX-8150</label><em>8627</em></div>
                    </div>
                    <div class="spacer">
                        <h5>Virtuoso - i5/i7 P67 Chipset (4 Cores)<a href="#19" class="scroll compareModel"> compare below</a></h5>
                        <div><label>Intel i5 3450</label><em>7168</em></div>
                        <div><label>Intel i5 3570K</label><em>7756</em></div>
                        <div><label>Intel i5 2600K</label><em>9085</em></div>
                        <div><label>Intel i7 2700K</label><em>9307</em></div>
						<div><label>Intel i7 3770K</label><em>10406</em></div>
                    </div>
                    <div class="spacer">
                        <h5>Virtuoso - i7 x79 Chipset (4-6 Cores)<a href="#22" class="scroll compareModel"> compare below</a></h5>
                        <div><label>X79 i7 3820</label><em>9609</em></div>
                        <div><label>X79 i7 3930K</label><em>13488</em></div>
                        <div><label>X79 i7 3960X</label><em>14052</em></div>
                    </div>
                    <div class="spacer">
                        <h5>Maestro - Dual Xeon (12-16 Cores)<a href="#18" class="scroll compareModel"> compare below</a></h5>
                        <div><label>DX 2xE5-2620</label><em>16851</em></div>
                        <div><label>DX 2xE5-2650</label><em>21662</em></div>
                        <div><label>DX 2xE5-2670</label><em>27943</em></div>
                        <div><label>DX 2xE5-2687W</label><em>31859</em></div>
                        <div><label>DX 2xE5-2690</label><em>32246</em></div>                       
                    </div>
                </div>
            </div>
        </div>
        <div id="modelsCompTable">
            <h2 class="whiteBar">Reyniers Audio Computer Line-Up | <span>Comparison Chart</span></h2>

            <table class="table1">
                <tr class="d2">
                    <td></td>
                    <?php foreach((array)$models as $model) {
                        echo '<td class="model' . $model->id . '" id="' . $model->id . '" >';
                        $defaultParts = $model->getDefaultParts($conn);
                        foreach((array)$defaultParts as $defaultPart) {
                            $subTypeId = $defaultPart['sub_type_id_fk'];
                            $subType = new SubType();
                            $subType->getSubType($conn,$subTypeId);
                            if($subType->title == 'Case') {
                                $part = new Part();
                                $part->getPart($conn,$defaultPart['part_id_fk']);
                                $part->getImages($conn);
                                foreach((array)$part->images as $image) {
                                    if($image->order == 1) {
                                        echo '<a href="/daw/' . $model->id . '-' . $model->titleClean . '-' . $model->shortDescClean .'"><img src="/images/parts/tn/' . $image->imageUrl . '" alt="' . $image->title . '" /></a>';
                                        break;
                                    }
                                }
                            }
                        }
                        echo '</td>';
                    } ?>
                </tr>

                <tr class="d2">
                    <td></td>
                    <?php foreach((array)$models as $model) {?>
                        <th class="model<?php echo $model->id ?>">
                            <span class="modelTitle"><?php echo $model->title; ?></span>
                            <span class="modelDesc"><?php echo $model->shortDesc; ?></span>
                            <span class="modelPrice"><?php echo $model->getBasePriceHtml($conn); ?></span>
                            <div class="customizeButton">
                            <a href="/daw/<?php echo $model->id; ?>-<?php echo $model->titleClean;?>-<?php echo $model->shortDescClean; ?>"></a>
                        </div>
                        </th>
                    <?php } ?>
                </tr>

                <tr class="d1">
                    <td>Processor</td>
                    <?php foreach((array)$models as $model) {
                        echo '<td class="model' . $model->id . '" >';
                        $defaultParts = $model->getDefaultParts($conn);
                        foreach((array)$defaultParts as $defaultPart) {
                            $subTypeId = $defaultPart['sub_type_id_fk'];
                            $subType = new SubType();
                            $subType->getSubType($conn,$subTypeId);
                            if($subType->title == 'CPU') {
                                echo '<strong>';
                                echo $defaultPart['title'] . '<br /></strong>';
                                echo $defaultPart['short_desc'];
                            }
                        }
                        echo '</td>';
                    }
                    ?>
                </tr>
                <tr class="d0">
                    <td>Memory</td>
                    <?php foreach((array)$models as $model) {
                        echo '<td class="model' . $model->id . '" >';
                        $defaultParts = $model->getDefaultParts($conn);
                        foreach((array)$defaultParts as $defaultPart) {
                            $subTypeId = $defaultPart['sub_type_id_fk'];
                            $subType = new SubType();
                            $subType->getSubType($conn,$subTypeId);
                            if($subType->title == 'RAM') {
                                echo '<strong>';
                                echo $defaultPart['title'] . '<br /></strong>';
                                echo $defaultPart['short_desc'];
                            }
                        }
                        echo '</td>';
                    }
                    ?>
                </tr>
                <tr class="d1">
                    <td>System Hard Drive</td>
                    <?php foreach((array)$models as $model) {
                        echo '<td class="model' . $model->id . '" >';
                        $defaultParts = $model->getDefaultParts($conn);
                        foreach((array)$defaultParts as $defaultPart) {
                            $subTypeId = $defaultPart['sub_type_id_fk'];
                            $subType = new SubType();
                            $subType->getSubType($conn,$subTypeId);
                            if($subType->title == 'System HDD') {
                                echo '<strong>';
                                echo $defaultPart['title'] . '<br /></strong>';
                                echo $defaultPart['short_desc'];
                            }
                        }
                        echo '</td>';
                    }
                    ?>
                </tr>
                <tr class="d0">
                    <td>Project Hard Drive</td>
                    <?php foreach((array)$models as $model) {
                        echo '<td class="model' . $model->id . '" >';
                        $defaultParts = $model->getDefaultParts($conn);
                        foreach((array)$defaultParts as $defaultPart) {
                            $subTypeId = $defaultPart['sub_type_id_fk'];
                            $subType = new SubType();
                            $subType->getSubType($conn,$subTypeId);
                            if($subType->title == 'Project HDD') {
                                echo '<strong>';
                                echo $defaultPart['title'] . '<br /></strong>';
                                echo $defaultPart['short_desc'];
                            }
                        }
                        echo '</td>';
                    }
                    ?>
                </tr>
                <tr class="d1">
                    <td>Video Card</td>
                    <?php foreach((array)$models as $model) {
                        echo '<td class="model' . $model->id . '" >';
                        $defaultParts = $model->getDefaultParts($conn);
                        foreach((array)$defaultParts as $defaultPart) {
                            $subTypeId = $defaultPart['sub_type_id_fk'];
                            $subType = new SubType();
                            $subType->getSubType($conn,$subTypeId);
                            if($subType->title == 'VGA') {
                                echo '<strong>';
                                echo $defaultPart['title'] . '<br /></strong>';
                                echo $defaultPart['short_desc'];
                            }
                        }
                        echo '</td>';
                    }
                    ?>
                </tr>
                <tr class="d0">
                    <td>Motherboard</td>
                    <?php foreach((array)$models as $model) {
                        echo '<td class="model' . $model->id . '" >';
                        $defaultParts = $model->getDefaultParts($conn);
                        foreach((array)$defaultParts as $defaultPart) {
                            $subTypeId = $defaultPart['sub_type_id_fk'];
                            $subType = new SubType();
                            $subType->getSubType($conn,$subTypeId);
                            if($subType->title == 'Motherboard') {
                                echo '<strong>';
                                echo $defaultPart['title'] . '<br /></strong>';
                                echo $defaultPart['short_desc'];
                            }
                        }
                        echo '</td>';
                    }
                    ?>
                </tr>
                <tr class="d1">
                    <td></td>
                    <?php foreach((array)$models as $model) { ?>
                    <td class="model<?php echo $model->id; ?>" >
                        <div class="customizeButton">
                            <a href="/daw/<?php echo $model->id; ?>-<?php echo $model->titleClean;?>-<?php echo $model->shortDescClean; ?>"></a>
                        </div>
                    </td>
                        <?php }
                    ?>
                </tr>

            </table>
        </div>

    </div>


    <?php


    ?>
</div>