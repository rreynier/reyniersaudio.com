<script src="js/admin/sorttable.js"></script>
<?php

include 'classes/SubType.php';
require_once 'classes/PartType.php';
$partType = new PartType();
$subType = new SubType();
$default = 0;
$subTypeId = $_GET['subTypeId'];

switch($_GET['action']) {
    case  'new':
        include 'tasks/admin/item/subType/edit.php';
        break;

    case 'delete':
        if($subType->deleteSubType($conn,$subTypeId)!=0){
            echo "<p><span class='success'>Part Type ID $subTypeId was deleted.</span></p>";
        }
        else echo "<p><span class='failure'>Nothing was deleted</span></p>";
        break;

    case 'edit';
        include 'tasks/admin/item/subType/edit.php';
        break;

    case 'viewParts';
        include 'tasks/admin/item/subType/viewParts.php';
        break;
}


$subTypes = $subType->getSubTypes($conn);
?>

<div class="contentSection">
<div class="contentSectionTitle"><h2>View All Sub Types</h2></div>
<p><a href="index.php?task=admin&item=subType&action=edit&option=new">Add New Sub Type</a></p>
<p>
<table class="sortable">
    <tr>
        <th>Part Type Name</th>
        <th>Subtype Title</th>
        <th>Part Type Titel</th>
        <th>Full</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php
    foreach ((array)$subTypes as $subType) {
    ?>
    <tr>
        <td><?php
                $partType = new PartType;
                $partType->getPartType($conn,$subType->partTypeId);
                echo $partType->name;
              ?></td>
        <td><?php echo $subType->title ?></td>
        
        <td>
            <?php
                $partType->getPartType($conn, $subType->partTypeId);
                echo $partType->title;
            ?>
        </td>
        

        <td>
            <?php
                $partType = new PartType;
                $partType->getPartType($conn,$subType->partTypeId);
                echo $partType->title . ' / ' . $subType->title .' / ' . $partType->name;
              ?>
            
        </td>
        <td><a href="index.php?task=admin&item=subType&action=viewParts&subTypeId=<?php echo $subType->id ?>">View Parts</a></td>
        <td><a href="index.php?task=admin&item=subType&action=edit&subTypeId=<?php echo $subType->id ?>">Edit</a></td>
        <td><a href="index.php?task=admin&item=subType&action=delete&subTypeId=<?php echo $subType->id ?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>
</p>
</div>	