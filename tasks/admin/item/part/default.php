<div id="noback">
    <script type="text/javascript" src="js/admin/sorttable.js"></script>
    <script type="text/javascript" src="js/admin/parts.js"></script>
    <?php
    require_once 'functions/lists.php';
    require_once 'classes/Part.php';
    $parts = array();
    $part = new Part();
    $default = 0;
    if( isset($_GET['partId']) ) { $partId = $_GET['partId']; } else { $partId = ''; }

    switch($action) {
        case  'new':
            include 'tasks/admin/item/part/edit.php';
            break;

        case 'delete':
            $result = $part->deletePart($conn,$partId);
            outputResult($result,'deleted','part');
            $default = 1;
            break;

        case 'edit':
            include 'tasks/admin/item/part/edit.php';
            break;

        case 'addPartType':
            include 'tasks/admin/item/part/addPartType.php';
            break;
        
        case 'clone':
            include 'tasks/admin/item/part/clone.php';
            break;

        default:
            $default = 1;
            break;
    }

    if ($default == 1) {
        $parts = array();
        $partIds = array();
        $partCount = $part->countParts($conn,'','','');
        $partIds = $part->getPartIds($conn, '');

        for ($i=0; $i<=$partCount-1; $i++) {       
            $part = new Part();
            $parts[] = $part->getPart($conn,$partIds[$i]);
        }

        ?>
    <div class="contentSection">
        <div class="contentSectionTitle"><h2>View All Parts</h2> <a href="index.php?task=admin&item=part&action=edit&option=new">Add New Part</a></div>

        <table class="sortable">
            <tr>
                <th>ID</th>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Price</th>
                <th>Profit</th>
                <th>SubType</th>
                <th>ShortDescRaw</th>
                <th>ShortDesc</th>
                <th>LongDesc</th>
                <th>Tags</th>
                <th>Active</th>
                <th>Action</th>

            </tr>

                <?php
                foreach ($parts as $part) {
                    ?>
            <tr>
     
                <td>
                    <div class="rowheight" style="width:20px">
                                <?php echo $part->id ?>&nbsp;
                    </div>
                </td>
                <td>
                    <div class="rowheight" style="width:120px">
                        <?php $part->getImages($conn);
                            if(isset($part->images[0])){
                            echo '<img src="images/parts/tn/' . $part->images[0]->imageUrl . '" />';
                            }
                        ?>&nbsp;
                    </div>
                </td>

                <td>
                    <div class="rowheight" style="width:120px;">
                                <?php echo $part->title ?>&nbsp;
                    </div>
                </td>
                <td>
                    <div class="rowheight" style="width:75px;margin:0">
                        <input class="narrow2 partCost ajaxInput" type='text' style="width:40px;margin:0" name='partCost' value='<?php echo $part->partCost?>' />
                        <span class="hidden"><?php echo $part->partCost ?></span>
                        <input class="ajax-save-button" fieldname="partCost" partid="<?php echo $part->id; ?>" type="submit" />
                    </div>
                </td>
                <td >
                    <div class="rowheight"style="width:75px;margin:0">
                         <input class="narrow2 profitPercent ajaxInput" type='text' style="margin:0;width:40px;" name='profitPercent' value='<?php echo $part->profitPercent ?>' />
                         <input class="ajax-save-button" fieldname="profitPercent" partid="<?php echo $part->id; ?>" type="submit" />
                    </div>
                </td>
                <td>
                    <div class="rowheight" style="width:120px;"
>
                                <?php
                                //if ($new != 1) {
                                    $part->getSubTypes($conn);
                                    foreach ($part->subTypes as $subType) {
                                        echo $subType->title . '<a name="' . $subType->title . '"></a><br>';
                                    }
                                //}
                                ?>
                    </div>
                </td>
                <td class="nopad">
                    <div class="rowheight" style="width:180px;">
                        <textarea class="shortDesc ajaxInput" name='shortDesc' style="width:150px; height:75px; margin:0;padding:0;"><?php echo htmlentities($part->shortDesc) ?></textarea>
                        <input class="ajax-save-button" fieldname="shortDesc" partid="<?php echo $part->id; ?>" type="submit" />
                    </div>
                </td>
                <td >
                    <div class="rowheight" style="width:120px;">
                                <?php echo $part->shortDesc ?>&nbsp;
                    </div>
                </td>
                
                <td>
                    <div class="rowheight" style="width:199px;">
                                <?php  echo $part->longDesc ?>&nbsp;
                    </div>
                </td>
                
                 <td class="nopad">
                    <div class="rowheight" style="width:450px;">
                        <textarea class="tags ajaxInput" name='tags' style="width:400px; height:75px; margin:0;padding:0;"><?php echo htmlentities($part->tags) ?></textarea>
                        <input class="ajax-save-button" fieldname="tags" partid="<?php echo $part->id; ?>" type="submit" />
                    </div>
                </td>            
                
                <td>
                    <div class="rowheight" style="width:55px;">
                        <input class="narrow2 active ajaxInput" type='text' style="width:20px;margin:0" name='active' value='<?php echo $part->active; ?>' />
                        <span class="hidden"><?php echo $part->active ?></span>
                        <input class="ajax-save-button" value=">" fieldname="active" partid="<?php echo $part->id; ?>" type="submit" />
                    </div>
                </td>
                
                <td>
                    <div class="rowheight" style="width:50px">
                        <a href="index.php?task=admin&item=part&action=edit&partId=<?php echo $part->id ?>">Edit</a>&nbsp;
                        <a href="index.php?task=admin&item=part&action=delete&partId=<?php echo $part->id ?>">Delete</a>&nbsp;
                        <a href="index.php?task=admin&item=part&action=clone&partId=<?php echo $part->id ?>">Clone</a>&nbsp;
                    </div>
                </td>

            </tr>
                    <?php } ?>
        </table>

    </div>
        <?php } ?>

</div>
<div id="builderNavCntA">
    
</div>