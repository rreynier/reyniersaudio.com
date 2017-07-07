<?php


if($partId) {
    
    $newPartId = $part->clonePart($conn,$partId);   
    header( 'Location: /index.php?task=admin&item=part&action=edit&partId=' . $newPartId ) ;
    
} else {
    echo '<p>an error has occured</p>';
}
