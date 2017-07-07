<script type="text/javascript">

    // HTML to Entities (form) script- By JavaScriptKit.com (http://www.javascriptkit.com)
    // For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
    // This notice must stay intact for use

    function html2entities(){
        var re=/['’°]/g
        for (i=0; i<arguments.length; i++)
            arguments[i].value=arguments[i].value.replace(re, function(m){return replacechar(m)})
    }

    function replacechar(match){
        if (match=="'")
            return "&#039;"
        else if (match=="’")
            return "&#039;"
        else if (match=="°")
            return "&deg;"
    }
</script>

<div class="contentSection">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

    <?php

    require_once 'classes/PartType.php';
    require_once 'classes/SubType.php';
    require_once 'classes/Part.php';

    $new = 0;
    $model->getModel($conn,$modelId);
    $partTypeId = $_GET['partTypeId'];
    $subTypeId = $_GET['subTypeId'];
    $partId = $_GET['partId'];

#figure out what action is needed (add part type, delete part type, new part, edit

    switch($_GET['option']) {

        case 'submit':
        // Lets grab the images
            include 'includes/imageHandling.php';

            // If user clicked 'Upload Model Builder Image'
            if ($_POST['submit'] == 'Upload Overview Image') {
                echo 'here';
                $imgTitleTemp = uploadImage($_FILES,"images/models/",'','','','');
                if ($imgTitleTemp != null) {
                    //Delete old image if exists
                    if( $_POST['img_title'] != null ) {
                        unlink('images/models/full/' . $_POST['img_title']);
                    }
                    $imgTitle = $imgTitleTemp;
                    $imgTitle2 = $_POST['img_title2'];
                }
                else {
                    $imgTitle = $_POST['img_title'];
                    $imgTitle2 = $_POST['img_title2'];
                }
            }
            else {
                $imgTitleTemp2 = uploadImage($_FILES,"images/models/",'','','','');
                if ($imgTitleTemp2 != null) {
                    //Delete old image if exists
                    if( $_POST['img_title2'] != null ) {
                        unlink('images/models/full/' . $_POST['img_title2']);
                    }
                    $imgTitle2 = $imgTitleTemp2;
                    $imgTitle = $_POST['img_title'];
                }
                else {
                    $imgTitle = $_POST['img_title'];
                    $imgTitle2 = $_POST['img_title2'];
                }
            }



            // Grab rest of form
            $submit = $_POST['submit'];
            $addPartType = $_POST['addPartType'];
            $addPart = $_POST['addPart'];
            $new = $_POST['new'];
            $title = $_POST['title'];
            $shortDesc = $_POST['short_desc'];
            $longDesc = $_POST['long_desc'];
            $basePrice = $_POST['base_price'];
            $discount = $_POST['discount'];
            $partTypeId = $_POST['part_type'];
            $tab1Title = $_POST['tab1_title'];
            $tab1Content = $_POST['tab1_content'];
            $tab2Title = $_POST['tab2_title'];
            $tab2Content = $_POST['tab2_content'];
            $tab3Title = $_POST['tab3_title'];
            $tab3Content = $_POST['tab3_content'];
            $tab4Title = $_POST['tab4_title'];
            $tab4Content = $_POST['tab4_content'];
            $tab5Title = $_POST['tab5_title'];
            $tab5Content = $_POST['tab5_content'];
            $order = $_POST['order'];
            $active = $_POST['active'];

            $model->setModel($modelId,$title,$shortDesc,$longDesc,$basePrice,$discount,
                    $tab1Title,$tab1Content,$tab2Title,$tab2Content,$tab3Title,$tab3Content,
                    $tab4Title,$tab4Content,$tab5Title,$tab5Content,$imgTitle,$imgTitle2,$order,$active
            );

            if ( $new == 1 ) {
                $modelId = $model->addModel($conn);
                if ($modelId > 0) {
                    $result = 1;
                }
                $new = 0;
                $model->getModel($conn,$modelId);
            }
            else {
                $result = $model->updateModel($conn);
                outputResult($result,'updated' , 'model');
            }
            if ( $addPartType == 'add') {
                if ($partTypeId > 0) {
                    $result2 = $model->addPartType($conn, $partTypeId);
                    if ($result1 != 1) {
                        $result=$result2;
                    }
                    outputResult($result,'added' , 'part types');
                }
            }

            if ( is_numeric($addPart)) {
                $partDetails = explode('|' , $_POST[$addPart]);
                $partTypeId = $partDetails[0];
                $subTypeId = $partDetails[1];
                $partId = $partDetails[2];
                $result = $model->addPart($conn, $subTypeId, $partId);
                outputResult($result,'added' , 'part');
            }

            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $model->title . ' ( ID: ' . $model->id . ' )</h2></div>';
            break;

        case 'deleteSubType':
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $model->title . ' ( ID: ' . $model->id . ' )</h2></div>';
            $result = $model->deleteSubType($conn,$subTypeId);
            outputResult($result,'deleted' , 'sub type');
            break;


        case 'deletePartType':
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $model->title . ' ( ID: ' . $model->id . ' )</h2></div>';
            $result = $model->deletePartType($conn,$partTypeId);
            outputResult($result,'deleted' , 'part type');
            break;

        case 'deletePart':
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $model->title . ' ( ID: ' . $model->id . ' )</h2></div>';
            $result = $model->deletePart($conn,$subTypeId,$partId);
            outputResult($result,'deleted', 'part');
            break;

        case 'makePartDefault':
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $model->title . ' ( ID: ' . $model->id . ' )</h2></div>';
            $result = $model->makePartDefault($conn,$subTypeId,$partId);
            outputResult($result,'made default', 'part');
            break;


        case 'new':
            echo '<div class="contentSectionTitle"><h2>Enter New Model</h2></div>';
            $model = new Model();
            $new = 1;
            break;

        default:
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $model->title . ' ( ID: ' . $model->id . ' )</h2></div>';
            break;
    }

    ?>
    <script type="text/javascript" src="tinymce/tiny_mce_gzip.js"></script>
    <script type="text/javascript">
        function setup() {
            tinyMCE_GZ.init({
                themes : "advanced",
                plugins : "safari,style,layer,table,advimage,advlink,inlinepopups,searchreplace,contextmenu,paste,fullscreen,noneditable,nonbreaking,tabfocus,autosave",
                languages : "en",
                disk_cache : true
            }, function() {
                tinyMCE.init({
                    mode : "exact",
                    elements : "long_desc,tab1_content,tab2_content,tab3_content,tab4_content,tab5_content",
                    theme : "advanced",
                    plugins : "safari,style,layer,table,advimage,advlink,inlinepopups,searchreplace,contextmenu,paste,fullscreen,noneditable,nonbreaking,tabfocus,autosave",
                    theme_advanced_buttons1 : "fullscreen,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect|,bullist,numlist,|,outdent,indent,|,charmap,styleprops,|",
                    theme_advanced_buttons2 : "pastetext,|,undo,redo,|,link,cleanup,code,|,replace,tablecontrols,|,removeformat,visualaid",
                    theme_advanced_buttons3 : "",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : true,
                    theme_advanced_resizing_use_cookie : false,
                    theme_advanced_resizing_max_width : 645,
                    content_css : "/css/master.css,/css/info.css,/css/cartSideBar.css,/css/nyroModal.css,/css/model.css",
                    body_class: "info",
                    tab_focus : ':prev,:next',
                    visual : false,
                    visual_table_class : "tableEditor"
                });
            });
        }
    </script>
    
          
    <form onSubmit="html2entities(this.long_desc, this.short_desc, this.tab1_content, this.tab2_content, this.tab3_content, this.tab4_content, this.tab5_content)" action='index.php?task=admin&item=model&action=edit&option=submit&modelId=<?php echo $model->id ?>' method='post' enctype="multipart/form-data">
        
        <ul>

            <li>
                <h3>Assigned Part Types</h3>
                <label for="part_type">Add Part Type</label>
                <select name = "part_type">
                    <?php
                    $partType = new PartType();
                    $partTypes = $partType->getPartTypes($conn);

                    foreach ((array)$partTypes as $partType) {
                        $used = 0;
                        foreach ((array)$model->partTypes as $assignedPartType) {
                            if ($assignedPartType->id == $partType->id) {
                                $used=1;
                            }
                        }
                        if ($used != 1) {
                            echo '<option value="' . $partType->id  . '">' . $partType->name . ' - ' . $partType->title . '</option>';
                        }
                    }
                    ?>
                </select>

                <input type="submit" name="addPartType" value="add" class="submitButton" />
            </li>
            <li>
                <div class="leftcont">
                    <?php
                    $model->getPartTypes($conn);
                    if (count($model->partTypes) > 0 ) {
                        foreach ( $model->partTypes as $partType) {
                            echo '<ul class="editPartType"><li class="header"><h4>' . $partType->title;
                            echo ' - <a href="index.php?task=admin&item=model&action=edit&option=deletePartType';
                            echo '&modelId=' . $model->id;
                            echo '&partTypeId=' . $partType->id . '">delete</a></h4>';
                            echo '<div class="subTypeCont">';
                            $subTypes = $partType->getSubTypes($conn);

                            foreach ((array)$subTypes as $subType) {
                                $assigned = 0;
                                echo '<div class="subType">';
                                $subType->getParts($conn);
                                if(count($subTypes) > 1) {
                                    echo '<h5>' . $subType->title;
                                    echo ' - <a href="index.php?task=admin&item=model&action=edit&option=deleteSubType&subTypeId=';
                                    echo $subType->id . '&modelId=' . $model->id . '">delete</a>';
                                    echo '</h5>';
                                }
                                $assignedParts = $model->getParts($conn,$subType->id);
                                echo '<ul class="modelPartList">';
                                foreach((array)$assignedParts as $assignedPart) {
                                    echo '<li>' . $assignedPart->title;
                                    if ($assignedPart->checkDefault($conn,$subType->id,$model->id) > 0) {
                                        echo '<strong> D</strong>';
                                    }
                                    else {
                                        echo ' <a href="index.php?task=admin&item=model&action=edit&option=makePartDefault';
                                        echo '&modelId=' . $model->id;
                                        echo '&subTypeId=' . $subType->id;
                                        echo '&partId=' . $assignedPart->id;
                                        echo '">D</a>';
                                    }
                                    echo '|<a href="index.php?task=admin&item=model&action=edit&option=deletePart';
                                    echo '&modelId=' . $model->id;
                                    echo '&subTypeId=' . $subType->id;
                                    echo '&partId=' . $assignedPart->id;
                                    echo '">X</a>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                                echo "\n" . '<select name="' . $subType->id . '">';

                                foreach ((array)$subType->parts as $part) {
                                    $assigned = 0;
                                    foreach ((array)$assignedParts as $assignedPart) {
                                        if ($part->id == $assignedPart->id) {
                                            $assigned = 1;
                                        }
                                    }
                                    if ($assigned != 1) {
                                        echo '<option value="' . $partType->id . '|' . $subType->id . '|' . $part->id . '">';
                                        echo $part->id . ' - ' . $part->title;
                                        echo '</option>' . "\n";
                                    }
                                }
                                echo '</select>';
                                echo '<input type="submit" name="addPart" value="' . $subType->id . '" class="addPartButton">';
                                echo '</div>';
                            }


                            echo '</div></li></ul>';

                        }
                    }

                    ?>
                </div>
            </li>

        </ul>

        <ul>

            <li>
                <h2>Basic Information</h2>
                <label for="title">Title</label>
                <input type="text" style="width:150px" name="title" value="<?php echo $model->title ?>" />
                <label for="short_desc">Short Description</label>
                <textarea name="short_desc" class="short_desc" rows="1" cols="15" style="width:150px; height:15px" ><?php echo htmlentities($model->shortDesc) ?></textarea>
                <label for="base_price">Base price</label>
                <input class="narrow2" type="text" name="base_price" value="<?php echo $model->basePrice ?>" />
                <label for="discount">Discount</label>
                <input class="narrow2" type="text" name="discount" value="<?php echo $model->discount ?>" />
                <label for="order">Order</label>
                <input class="narrow2" type="text" name="order" value="<?php echo $model->order ?>" />
                <label for="active">Active</label>
                <select name="active">
                    <option value="1"<?php if($model->active == 1) {
                        echo ' selected';
                            } ?>>Yes</option>
                    <option value="0"<?php if($model->active == 0) {
                        echo ' selected';
                            } ?>>No</option>
                </select>
            </li>

            <li>
                <div class="left hidden">
                    <label for="long_desc">Long Description</label>
                    <textarea name="long_desc" id="long_desc" rows="1" cols="1" style="width:700px; height:101px;"><?php echo htmlentities($model->longDesc) ?></textarea>
                </div>

                <div class="left">
                    <br><ul class="editPartType">
                        <li class="left">
                            <h4>Model Overview Image</h4>
                            <div class="subType">
                                <span class="left">
                                    <label for='img_title'>Image Title</label><br>
                                    <input type='text' style="width:150px; height: 15px" name='img_title' value='<?php echo $model->imgTitle?>' readonly ></input><br>
                                    <label for='img' class="uploadImageBox">Upload Image</label><br>
                                    <input type="file" name="img" class="browseImageButton" style="width:45px;"/><br>
                                    <input type="submit" name="submit" value="Upload Overview Image" class="submitButton left" />
                                </span>
                                <div class="left"><img src='images/models/full/<?php echo $model->imgTitle?>' height="100"/></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="left">
                    <br><ul class="editPartType">
                        <li class="left">
                            <h4>Model Builder Image</h4>
                            <div class="subType">
                                <span class="left">
                                    <label for='img_title2'>Image Title</label><br>
                                    <input type='text' style="width:150px;height:15px;" name='img_title2' value='<?php echo $model->imgTitle2?>' readonly ></input><br>
                                    <label for='img2' class="uploadImageBox">Upload Image</label><br>
                                    <input type="file" name="img2" class="browseImageButton" style="width:45px;"/><br>
                                    <input  type="submit" name="submit" value="Upload Builder Image" class="submitButton" />
                                </span>
                                <img src='images/models/full/<?php echo $model->imgTitle2?>' height="100"/>
                            </div>
                        </li>

                    </ul>
                </div>

            </li>

        </ul>


        <ul>
            <li><h2>Information tabs</h2><a href="javascript:setup();">Load TinyMCE</a></li>

            <li>
                <div class="left" style="padding-bottom:20px;">
                    <label for="tab1_title">Tab 1</label>
                    <input style="width:150px; height:15px" type="text" name="tab1_title" value="<?php echo $model->tab1Title ?>" /><br>
                    <textarea style="width:550px;height:200px;" name="tab1_content" id="tab1_content" rows="1" cols="14"><?php echo htmlentities($model->tab1Content) ?></textarea>
                </div>
                <div class="left" style="padding-bottom:20px;">
                    <label for="tab2_title">Tab 2</label>
                    <input style="width:150px; height:15px" type="text" name="tab2_title" value="<?php echo $model->tab2Title ?>" /><br>
                    <textarea style="width:550px;height:200px;" name="tab2_content" id="tab2_content" rows="1" cols="14"><?php echo htmlentities($model->tab2Content) ?></textarea>
                </div>
                <div class="left" style="padding-bottom:20px;">
                    <label for="tab3_title">Tab 3</label>
                    <input style="width:150px; height:15px" type="text" name="tab3_title" value="<?php echo $model->tab3Title ?>" /><br>
                    <textarea style="width:550px;height:200px;" name="tab3_content" id="tab3_content" rows="1" cols="14"><?php echo htmlentities($model->tab3Content) ?></textarea>
                </div>
                <div class="left" style="padding-bottom:20px;">
                    <label for="tab4_title">Tab 4</label>
                    <input style="width:150px; height:15px" type="text" name="tab4_title" value="<?php echo $model->tab4Title ?>" /><br>
                    <textarea style="width:550px;height:200px;" name="tab4_content" id="tab4_content" rows="1" cols="14"><?php echo htmlentities($model->tab4Content) ?></textarea>
                </div>
                <div class="left" style="padding-bottom:20px;">
                    <label for="tab5_title">Tab 5</label>
                    <input style="width:150px; height:15px" type="text" name="tab5_title" value="<?php echo $model->tab5Title ?>" /><br>
                    <textarea style="width:550px;height:200px;" name="tab5_content" id="tab5_content" rows="1" cols="14"><?php echo htmlentities($model->tab5Content) ?></textarea>
                </div>

            </li>
        </ul>

    
                <input type="hidden" id="model_id" name="model_id" value="<?php echo $modelId ?>" />
                <input type="submit" name="submit" value="submit" class="submitButton" />
                <input type="hidden" name="new" value="<?php echo $new ?>">
          
    </form>
</div>