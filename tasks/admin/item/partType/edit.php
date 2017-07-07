

<div class="contentSection">

    <?php
    $new = 0;

    switch ($_GET['option']) {
        case 'new';
            echo '<div class="contentSectionTitle"><h2>Enter New Part Type</h2></div>';
            $new = 1;
            $partType = new PartType();
            break;

        case 'submit';
            echo '<div class="contentSectionTitle"><h2>Edit Part Type</h2></div>';
            // Lets grab the image
            include 'includes/imageHandling.php';
            $imgTitleUrlTemp = uploadImage($_FILES,"images/part_types/",'','','','');
            if ($imgTitleUrlTemp != null) {
                // Delete old image if exists
                if( $_POST['img_title_url'] != null ) {
                    unlink('images/part_types/full/' . $_POST['img_title_url']);
                }
                $imgTitleUrl = $imgTitleUrlTemp;
            }
            else {
                $imgTitleUrl = $_POST['img_title_url'];
            }

            // Now grab the rest of the form
            $partTypeId = $_POST['part_type_id'];
            $title = $_POST['title'];
            $shortTitle = $_POST['short_title'];
            $name = $_POST['name'];
            $shortDesc = $_POST['short_desc'];
            $longDesc = $_POST['long_desc'];
            $decisionFactors = $_POST['decision_factors'];
            $helpMeDecide = $_POST['help_me_decide'];
            $customTabTitle = $_POST['custom_tab_title'];
            $customTabContent = $_POST['custom_tab_content'];
            $customTabTitle2 = $_POST['custom_tab_title_2'];
            $customTabContent2 = $_POST['custom_tab_content_2'];
            $customTabTitle3 = $_POST['custom_tab_title_3'];
            $customTabContent3 = $_POST['custom_tab_content_3'];
            $customTabTitle4 = $_POST['custom_tab_title_4'];
            $customTabContent4 = $_POST['custom_tab_content_4'];
            $customTabTitle5 = $_POST['custom_tab_title_5'];
            $customTabContent5 = $_POST['custom_tab_content_5'];
            $profitPercentage = $_POST['profit_percentage'];
            $order = $_POST['order'];
            $new = $_POST['new'];

            // Set our partType object with stuff collected from form and then either add or update the database
            $partType->setPartType($partTypeId,$title,$shortTitle,$name,$shortDesc,$longDesc,$decisionFactors,$helpMeDecide,$customTabTitle,$customTabContent,$customTabTitle2,$customTabContent2,$customTabTitle3,$customTabContent3,$customTabTitle4,$customTabContent4,$customTabTitle5,$customTabContent5,$profitPercentage,$imgTitleUrl,$order);
            if ($new == 1) {
                $partTypeId = $partType->addPartType($conn);
                $new = 0;
                if ($partTypeId > 0) {
                    $partType->getPartType($conn,$partTypeId);
                    outputResult(1,'added' , 'part type');
                }
                else {
                    outputResult(0, 'added', 'part type');
                }
            }
            else {
                $result = $partType->updatePartType($conn);
                outputResult($result, 'updated', 'part type');
            }

            break;

        default:
            $partTypeId = $_GET['partTypeId'];
            $partType->getPartType($conn,$partTypeId);
            echo '<div class="contentSectionTitle"><h2>Edit Part Type</h2></div>';
            break;
    }



    ?>
    <script type="text/javascript">
        tinyMCE.init({
            mode : "exact",
            theme : "advanced",
            elements : "long_desc,decision_factors,help_me_decide,custom_tab_content,custom_tab_content_2,custom_tab_content_3,custom_tab_content_4,custom_tab_content_5",
            plugins : "safari,style,layer,table,advimage,advlink,inlinepopups,searchreplace,contextmenu,paste,fullscreen,noneditable,nonbreaking,tabfocus,autosave",
            theme_advanced_buttons1 : "fullscreen,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect|,bullist,numlist,|,outdent,indent,|,charmap,styleprops,|",
            theme_advanced_buttons2 : "pastetext,|,undo,redo,|,link,cleanup,code,|,replace,tablecontrols,|,removeformat,visualaid",
            theme_advanced_buttons3 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing_use_cookie : false,
            theme_advanced_resizing : true,
            content_css : "/css/info.css,/css/master.css,/css/cartSideBar.css,/css/nyroModal.css,/css/model.css",
            body_class : "parttype",
            tab_focus : ':prev,:next',
            visual_table_class : "tableEditor",
            convert_urls: false
        });
    </script>
<a href="index.php?task=admin&amp;item=partType&amp;action=edit&amp;option=new">Add New Part Type</a>
    <form action='index.php?task=admin&item=partType&action=edit&option=submit&partTypeId=<?php echo $partType->id ?>' method='post' enctype='multipart/form-data' class='editItem'>
        
        <ul class="left" style ="height:103px;margin-right:5px;">
             
            <li class="left">
                <label class="narrow3" for='title'>Title</label><br/>
                <input type='text' name='title' value='<?php echo $partType->title?>' />
            </li>
            <li class="left">
                <label class="narrow3" for='short_desc'>Short Description</label><br/>
                <input type='text' name='short_desc' value='<?php echo $partType->shortDesc; ?>' />
            </li>
            <li class=>
                <label class="narrow3" for='short_title'>Short Title</label><br/>
                <input type='text' name='short_title' value='<?php echo $partType->shortTitle;?>' />
            </li>

            <li class="left">
                <label class="narrow3" for='name'>Unique Name</label><br/>
                <input type='text' name='name' value='<?php echo $partType->name;?>' />
            </li>
            <li class="left">
                <label class="narrow3" for='order'>Order</label><br/>
                <input type='text' name='order' value='<?php echo $partType->order;?>' />
            </li>
            <li class="left">
                <label class="narrow3" for='profit_percentage'>Profit Percentage</label><br/>
                <input type='text' name='profit_percentage' value='<?php echo $partType->profitPercentage; ?>' />
            </li>
        </ul>
        <ul class="left">
            <div class="left">
                    <ul class="editPartType" style="margin:0;">
                        <li class="left">
                            <h4>Model Overview Image</h4>
                            <div class="subType">
                                <span class="left">
                                    <label for='img_title_url'>Image Title</label><br>
                                    <input type='text' style="width:150px; height: 15px" name='img_title_url' value='<?php echo $partType->imgTitleUrl?>' readonly  /><br>
                                    <label for='img' class="uploadImageBox">Upload Image</label><br>
                                    <input type="file" name="img" class="browseImageButton" style="width:45px;"/><br>
                                 </span>
                                <div class="left"><img src='/images/part_types/full/<?php echo $partType->imgTitleUrl?>'/></div>
                            </div>
                        </li>
                    </ul>
                	<li>
		<label for='img_title_url'>Url to title image</label>
		<input type='text' name='img_title_url' value='<?php echo $partType->imgTitleUrl?>' readonly  />
	</li>

                </div>
        </ul>
            <ul style="clear:both;">
                <li class="left">
                    <label class="labelTextarea" for='long_desc'>Long Description</label>
                    <textarea name='long_desc' id='long_desc' rows="3" cols="70" style="width:574px;height:300px;"><?php echo $partType->longDesc; ?></textarea>
                </li>
                <li class="left">
                    <label class="labelTextarea" for='decision_factors'>Decision Factors</label>
                    <textarea name='decision_factors' id='decision_factors' rows="6" cols="70" style="width:574px;height:300px;"><?php echo $partType->decisionFactors; ?></textarea>
                </li>
                <li class="left">
                    <label class="labelTextarea" for='help_me_decide'>Help Me Decide</label>
                    <textarea name='help_me_decide' id='help_me_decide' rows="6" cols="70" style="width:574px;height:300px;"><?php echo $partType->helpMeDecide; ?></textarea>
                </li>
                <li class="left">
                    <label class="labelTextarea" for='custom_tab_title'>Custom Tab 1</label>
                    <input type='text' name='custom_tab_title' value='<?php echo $partType->customTabTitle ?>' />
                    <textarea name='custom_tab_content' id='custom_tab_content' rows="6" cols="70" style="width:574px;height:300px;"><?php echo $partType->customTabContent; ?></textarea>
                </li>
                <li class="left">
                    <label class="labelTextarea" for='custom_tab_title_2'>Custom Tab 2</label>
                    <input type='text' name='custom_tab_title_2' value='<?php echo $partType->customTabTitle2 ?>' />
                    <textarea name='custom_tab_content_2' id='custom_tab_content_2' rows="6" cols="70" style="width:574px;height:300px;"><?php echo $partType->customTabContent2; ?></textarea>
                </li>
                <li class="left">
                    <label class="labelTextarea" for='custom_tab_title_3'>Custom Tab 3</label>
                    <input type='text' name='custom_tab_title_3' value='<?php echo $partType->customTabTitle3 ?>' />
                    <textarea name='custom_tab_content_3' id='custom_tab_content_3' rows="6" cols="70" style="width:574px;height:300px;"><?php echo $partType->customTabContent3; ?></textarea>
                </li>
                <li class="left">
                    <label class="labelTextarea" for='custom_tab_title_4'>Custom Tab 4</label>
                    <input type='text' name='custom_tab_title_4' value='<?php echo $partType->customTabTitle4 ?>' />
                    <textarea name='custom_tab_content_4' id='custom_tab_content_4' rows="6" cols="70" style="width:574px;height:300px;"><?php echo $partType->customTabContent4; ?></textarea>
                </li>
                <li class="left">
                    <label class="labelTextarea" for='custom_tab_title_5'>Custom Tab 5</label>
                    <input type='text' name='custom_tab_title_5' value='<?php echo $partType->customTabTitle5 ?>' />
                    <textarea name='custom_tab_content_5' id='custom_tab_content_5' rows="6" cols="70" style="width:574px;height:300px;"><?php echo $partType->customTabContent5; ?></textarea>
                </li>
            </ul>


        <ul>

            <li class="hidden">

                <input type='text' name='img_title_url' value='<?php echo $partType->imgTitleUrl?>' readonly  />

            </li>
        </ul>
    <input type="submit" text="submit" name="submit" value="submit" class="submitButton"/>
                <input type="hidden" name="new" value="<?php echo $new ?>" />
                <input type="hidden" name="part_type_id" value="<?php echo $partType->id ?>" />
            
    </form>
</div>
