<script type="text/javascript">

    // HTML to Entities (form) script- By JavaScriptKit.com (http://www.javascriptkit.com)
    // For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
    // This notice must stay intact for use

    function html2entities(){
        var re=/['��]/g
        for (i=0; i<arguments.length; i++)
            arguments[i].value=arguments[i].value.replace(re, function(m){return replacechar(m)})
    }

    function replacechar(match){
        if (match=="'")
            return "&#039;"
        else if (match=="�")
            return "&#039;"
        else if (match=="�")
            return "&deg;"
    }

</script>


<script type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        editor_selector : "short_desc",
        theme_advanced_toolbar_location : "bottom",
        theme_advanced_buttons1 : "code",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : ""
    });
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        editor_selector : "long_desc",
        plugins : "style,table,inlinepopups,searchreplace,contextmenu,paste,tabfocus,codemagic, template",
        theme_advanced_buttons1 : "fullscreen,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect|,bullist,numlist,|,outdent,indent,|,charmap,styleprops,|",
        theme_advanced_buttons2 : "pastetext,|,undo,redo,|,link,cleanup,code,|,replace,tablecontrols,|,removeformat,visualaid,|,codemagic,template",
        theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing_use_cookie : false,
        theme_advanced_resizing : true,
        paste_postprocess : function(pl, o) {
            // remove extra line breaks
            o.node.innerHTML = o.node.innerHTML.replace(/<p.*>\s*(<br>|&nbsp;)\s*<\/p>/ig, "");
        },
        //content_css : "/css/info.css,/css/master.css,/css/cartSideBar.css,/css/nyroModal.css,/css/table.css,css/model.css",//
        content_css : "/css/info.css,/css/master.css,/css/cartSideBar.css,/css/nyroModal.css,/css/table.css,css/model.css",
        apply_source_formatting : true,
        body_class : "info",
        tab_focus : ':prev,:next',
        visual: false,
        template_templates : [
        {
                title : "Tabs",
                src : "/tasks/admin/item/part/template.html",
                description : "Creates Tabs to Paste Data In To"
        }
]

    });
</script>
<div class="contentSection">

    <?php
    require_once 'classes/PartType.php';
    require_once 'classes/Image.php';
    $new = 0;
    $part->getPart($conn,$partId);
#figure out what action is needed (add part type, delete part type, new part, edit

    switch($_GET['option']) {

        case 'submit':
            $submit = $_POST['submit'];
            $new = $_POST['new'];
            $title = $_POST['title'];
            $shortTitle = $_POST['short_title'];
            $shortDesc = $_POST['short_desc'];
            $longDesc = $_POST['long_desc'];
            $partCost = $_POST['part_cost'];
            $mapPrice = $_POST['map_price'];
            $discount = $_POST['discount'];
            $profitPercent = $_POST['profit_percent'];
            $order = $_POST['order'];
            $subTypeId = $_POST['sub_type'];
            $option1Text = $_POST['option1_text'];
            $option1Cost = $_POST['option1_cost'];
            $option2Text = $_POST['option2_text'];
            $option2Cost = $_POST['option2_cost'];
            $option3Text = $_POST['option3_text'];
            $option3Cost = $_POST['option3_cost'];
            $active = $_POST['active'];   
            $tags = $_POST['tags'];
      
            $part->setPart($partId,$title,$shortTitle,$shortDesc,$longDesc,$partCost,$mapPrice,$discount,$profitPercent,$order,$option1Text,$option1Cost,$option2Text,$option2Cost,$option3Text,$option3Cost,$active,$tags);
            if ( $new == 1 ) {
                $partId = $part->addPart($conn);
                if ($partId > 0) {
                    $result = 1;
                }
                $new = 0;
                $part->getPart($conn,$partId);
            }
            else {
                $result = $part->updatePart($conn);                
                outputResult($result,'updated' , 'part');
            }
            if ( $submit == 'add') {
                if ($subTypeId > 0) {
                    $result2 = $part->addSubType($conn, $subTypeId);
                    if ($result1 != 1) {
                        $result=$result2;
                    }
                    outputResult($result,'added' , 'sub types');
                }
            }

            // If we are uploading an image...
            if ( $submit == 'upload image') {
                $image = new Image();
                $imageTitle = $_POST['image_title'];
                $imageDesc = $_POST['image_short_desc'];
                $imageOrder = $_POST['image_order'];
                require_once 'includes/imageHandling.php';
                $imageUrl = uploadImage($_FILES,'images/parts/','600','600','120','75');
                if ($imageUrl != null && $imageUrl != '') {
                    $image->set($imageUrl,$imageTitle,$imageDesc,$imageOrder,$partId);
                    if ($image->add($conn) != null) {
                        $result = 1;
                    } else {
                        $result = 0;
                    }
                    outputResult($result,'added' , 'picture');
                }
            }

            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $part->title . ' ( ID: ' . $part->id . ' )</h2></div>';
            break;


        case 'deleteSubType':
            $subTypeId = $_GET['subTypeId'];
            $result = $part->deleteSubType($conn,$subTypeId);
            outputResult($result,'deleted' , 'part types');
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $part->title . ' ( ID: ' . $part->id . ' )</h2></div>';
            break;

        case 'deleteImage';
            $imageId = $_GET['imageId'];
            require_once 'classes/Image.php';
            $image = new Image();
            $image->get($conn,$imageId);
            $result = $image->delete($conn);
            outputResult($result,'deleted', 'picture');
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $part->title . ' ( ID: ' . $part->id . ' )</h2></div>';
            break;

        case 'new':
            echo '<div class="contentSectionTitle"><h2>Enter New Part</h2></div>';
            $part = new Part();
            $new = 1;
            break;

        default:
            echo '<div class="contentSectionTitle">';
            echo '<h2>Edit ' . $part->title . ' ( ID: ' . $part->id . ' )</h2></div>';
            break;
    }

    ?>
    <form onSubmit="html2entities(this.long_desc, this.short_desc)" action='index.php?task=admin&item=part&action=edit&option=submit&partId=<?php echo $part->id ?>' method='post' enctype='multipart/form-data' class='editItem'>
    <a style="float:right;"href="index.php?task=admin&amp;item=part&amp;action=edit&amp;option=new">Add New Part</a>
        <ul>
            
            <li  class="left" >
                <label for='title'>Title</label><br/>
                <input type='text' name='title' style="width:150px"value='<?php echo $part->title?>'></input>
            </li>
            <li class="left">
                <label for='short_title'>Short Title</label><br/>
                <input type='text' name='short_title'  style="width:150px"value='<?php echo $part->shortTitle?>'></input>
            </li >
            <li class="left">
                    <label for='price'>Part Cost</label><br/>
                    <input class="narrow3" type='text' name='part_cost' value='<?php echo $part->partCost?>'></input>
            </li>
            <li class="left hidden">
                    <label for='price'>Map Price</label><br/>
                    <input class="narrow2" type='text' name='map_price' value='<?php echo $part->mapPrice?>'></input>
            </li>
            <li class="left">
                    <label for='discount'>Discount</label><br/>
                    <input class="narrow3" type='text' name='discount' value='<?php echo $part->discount ?>'></input>
            </li>
            <li class="left">
                    <label for='profit_percent'>Profit %</label><br/>
                    <input class="narrow3" type='text' name='profit_percent' value='<?php echo $part->profitPercent ?>'></input>
            </li>
            <li class="left">
                    <label for='order'>Order</label><br/>
                    <input class="narrow2" type='text' name='order' value='<?php echo $part->order ?>'></input>
            </li>
            
            <li class="">
                    <label for='active'>Active</label><br/>
                    <input class="narrow2" type='text' name='active' value='<?php echo $part->active ?>'/>
                    <a target="_blank" href="http://wouter.reyniersaudio.local/tasks/admin/item/part/codescrubber.php">Code Scrubber</a>
            </li>

            <li class="left">
                <label for='long_desc'>Long Description</label><br/>
                <textarea class="long_desc" id="long_desc" name='long_desc' rows='21' style="width:1350px; height:470px;" ><?php echo htmlentities($part->longDesc) ?></textarea>
            </li>
            <li class="left">
                <label for='short_desc'>Short Description</label><br/>
                <textarea class="short_desc" id="short_desc" name='short_desc' style="width:240px"><?php echo htmlentities($part->shortDesc) ?></textarea>
            </li>
            <li class="left">
                <label for='option1_text'>Option 1 Text</label>
                <textarea class="narrow" name='option1_text' rows="1" cols="50" style="width:150px;height:30px;" ><?php echo htmlentities($part->option1Text)?></textarea><br/>
                <label for='option1_cost'>Option 1 Cost</label>
                <input class="narrow" type='text' name='option1_cost' style="width:150px" value='<?php echo $part->option1Cost ?>'></input><br/><br/>
                <label for='option2_text'>Option 2 Text</label>
                <textarea class="narrow" name='option2_text' rows="1" cols="50" style="width:150px;height:30px; "><?php echo htmlentities($part->option2Text)?></textarea><br/>
                <label for='option2_cost'>Option 2 Cost</label>
                <input class="narrow" type='text' name='option2_cost' style="width:150px;" value='<?php echo $part->option2Cost ?>'></input><br/><br/>
                <label for='option3_text'>Option 3 Text</label>
                <textarea class="narrow" name='option3_text' rows="1" cols="50" style="width:150px;height:30px; "><?php echo htmlentities($part->option3Text)?></textarea><br/>
                <label for='option3_cost'>Option 3 Cost</label>
                <input class="narrow" type='text' name='option3_cost' style="width:150px" value='<?php echo $part->option3Cost ?>'></input>
            </li>
            <li class="left">
                <label for='tags'>Tags</label><br/>
                <textarea class="tags" id="tags" name='tags' style="width:230px; height: 120px;"><?php echo $part->tags; ?></textarea>
            </li>            
            
        </ul>

        <ul>
            <li class="left">
                <h2>Add a SubType</h2>
                <ul>
                    <li style="padding-top:0;">
                        
                        <select name='sub_type'>
                            <option></option>
                            <?php
                            require_once 'classes/SubType.php';
                            $subTypes = SubType::getSubTypes($conn);
                            foreach ($subTypes as $subType) {
                                $used = 0;
                                foreach ($part->subTypes as $assignedSubType) {
                                    if ($assignedSubType->id == $subType->id) {
                                        $used=1;
                                    }
                                }
                                if ($used != 1) {
                                    require_once 'classes/PartType.php';
                                    $partType = new PartType();
                                    $partTypeId = $subType->getPartType($conn);
                                    $partType->getPartType($conn,$partTypeId);
                                    echo '<option value="' . $subType->id  . '">' . $partType->name . ' -> ' . $subType->title . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <input type="submit" name="submit" value="add" class="submitButton" style="margin:1px 0;" />
                    </li>
                </ul>
            </li>
            <li class="subtypePart" style="padding-left:100px" >
                <h2 style="width:400px;padding-bottom:5px;clear:both;">Assigned Sub Type(s)</h2>
                <ul>
                    <?php
                    if ($new != 1) {
                        $part->getSubTypes($conn);
                        foreach ($part->subTypes as $subType) {
                            $partType = new PartType();
                            $partTypeId = $subType->getPartType($conn);
                            $partType->getPartType($conn,$partTypeId);
                            echo '<li>' . $partType->title . ' (' . $partType->name . ') -> ';
                            echo $subType->title . ' - <a href="index.php?task=admin&item=part&action=edit&option=deleteSubType';
                            echo '&partId=' . $part->id . '&subTypeId=' . $subType->id . '">delete</a>';
                        }
                    }
                    ?>
                </ul>
            </li>
            

        </ul>

        <ul>
            <li>
                <h2>Add a Picture</h2>
            <li class="addPictures">
                <label class="narrow2" for='image_title'>Title</label><br/>
                <input class="narrow3" type='text' name='image_title' value='' /><br/>
                <label class="narrow2" for='image_order'>Order</label><br/>
                <input class="narrow3" type='text' name='image_order' value='' /><br/>
                <label class="narrow2" for='img'>Upload</label><br/>
                <input class="narrow3" style="width:auto;"type="file" name="img" /><br/>
                <input type="submit" name="submit" value="upload image" class="submitButton" />
                <?php
                $part->getImages($conn);
                foreach($part->images as $image) {
                    echo '<li class="addPictures"><img src="images/parts/tn/' . $image->imageUrl . '" />';
                    echo '<p>Title: ' . $image->title . '<br />Order: ' . $image->order;
                    echo '<br /><a href="index.php?task=admin&item=part&action=edit&option=deleteImage&partId='.$part->id.'&imageId='.$image->id.'">delete</a>';
                    echo '</p></li>';
                }
                ?>
        </ul>


        <input type="submit" name="submit" value="submit" class="submitButton"/>
        <input type="hidden" name="id" value="<?php echo $part->id ?>">
        <input type="hidden" name="new" value="<?php echo $new ?>">

    </form>
</div>
<STYLE type="text/css">
    #builderNavCntA {display:none}
</STYLE>
