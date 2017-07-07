<?php


if ($_GET[partTypeId]){
    $part->getPart($conn, $id);    
    $part->updatePartType($conn, $_GET[partTypeId]);
}

else {
    require_once 'classes/PartType.php';
    $partTypes = new PartType();
    $partTypeIds = $partTypes->getPartTypeIds($conn, '');

    echo '<p><table><tr><th>Title</th><th>Sub Category</th><th>Description</th><th></th></tr>';
    foreach ($partTypeIds as $partTypeId) {
        $partType = new PartType();
        $partType->getPartType($conn, $partTypeId);
        echo '<tr><td>' . $partType->title . '</td>';
        echo '<td>' . $partType->name . '</td>';
        echo '<td>' . $partType->desc . '</td>';
        echo '<td><a href="index.php?task=admin&item=part&action=addPartType&id=' . $part->id . '&partTypeId=' . $partType->id . '">Add</a></td></tr>';
    }
    echo '</table></p>';
}
 ?>


