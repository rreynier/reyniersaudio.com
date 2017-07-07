<div class="contentSection">
<?php
$new = 0;

switch ($_GET['option']) {
    case 'new';
        echo '<div class="contentSectionTitle"><h2>Enter New Sub Type</h2></div>';
        $new = 1;
        $subType = new SubType();
        break;

    case 'submit';
        echo '<div class="contentSectionTitle"><h2>Edit Sub Type</h2></div>';
        $subTypeId = $_POST['sub_type_id'];
        $partTypeId = $_POST['part_type_id'];
        $title = $_POST['title'];
        $shortTitle = $_POST['short_title'];
        $desc = $_POST['desc'];       
        $selectVerbage = $_POST['select_verbage'];
        $order = $_POST['order'];
		$inputType = $_POST['input_type'];
		echo 'inputType = ' . $inputType;
        $new = $_POST['new'];
        $subType->setSubType($subTypeId,$partTypeId,$title,$shortTitle,$desc,$selectVerbage,$order,$inputType);
        if ($new == 1) {
            $new = 0;
            $subTypeId = $subType->addSubType($conn);
            if ($subTypeId > 0) {
                $subType->getSubType($conn,$result);
                outputResult(1,'added' , 'sub type');
            }
            else { outputResult(0, 'added', 'sub type'); }
        }
        else {            
            $result = $subType->updateSubType($conn);
            outputResult($result, 'updated', 'sub type');
        }

        break;

    default:
        $subTypeId = $_GET['subTypeId'];
        $subType->getSubType($conn,$subTypeId);
        echo '<div class="contentSectionTitle"><h2>Edit Sub Type</h2></div>';
        break;
}



?>
<a href="index.php?task=admin&amp;item=subType&amp;action=edit&amp;option=new">Add New Sub Type</a>

<form action='index.php?task=admin&item=subType&action=edit&option=submit&subTypeId=<?php echo $subType->id ?>' method='post' class='editItem'>
<ul>
	<li class="left">
		<label for='title'>Title</label><br/>
		<input type='text' name='title' value='<?php echo $subType->title?>'></input>
	</li>


    
	<li class="left">
		<label for='short_title'>Short Title for Cart</label><br/>
		<input type='text' name='short_title' value='<?php echo $subType->shortTitle?>'></input>
	</li>    

	<li style="display:none;">
		<label for='desc'>Description</label><br/>
		<textarea name='desc' rows="2" cols="70"><?php echo $subType->desc ?></textarea>
		<label for='select_verbage'>Select Verbage</label><br/>
		<input type='text' name='select_verbage' value='<?php echo $subType->selectVerbage ?>'></input>
	</li>

    <li>
		<label for='order'>Order</label><br/>
		<input type='text' name='order' value='<?php echo $subType->order ?>'></input>
	</li>

    <li class="left">
		<label for='input_type'>Input Type</label><br/>
		<select name='input_type'>
			<option value='radio' <?php if ($subType->inputType == 'radio') { echo 'selected="selected"'; }?>>Radio Button</option>
			<option value='check' <?php if ($subType->inputType == 'check') { echo 'selected="selected"'; }?>>Check Box</option>
		</select>
	</li>	
  
    <li>
        <label for="part_type_id">Assigned Part Type</label><br/>
        <select name="part_type_id">
            <?php
                echo '<option value="' . $subType->partTypeId . '">';
                require_once 'classes/PartType.php';
                $partType = new PartType;
                $partType->getPartType($conn,$subType->partTypeId);
                echo $partType->name . ' / ' . $partType->title;
                echo '</option>';
                echo '<option value=NULL>none</option>';
                $partTypes =  $partType->getPartTypes($conn);                
                foreach((array)$partTypes as $partType){
                    echo '<option value="' . $partType->id . '">' . $partType->name . ' / ' . $partType->title . '</option>';
                }


            ?>

        </select>
    </li>

	<li>
		<input type="submit" text="submit" name="submit" value="submit" class="submitButton"/>
        <input type="hidden" name="new" value="<?php echo $new ?>" />
		<input type="hidden" name="sub_type_id" value="<?php echo $subType->id ?>" />
	</li>
</ul>
</form>
</div>
