<div class="contentSection">

<div class="contentSectionTitle"><h2>View Parts associated with <?php echo $partType->title ?></h2></div>
<p>
<?php



if($_GET['option'] == 'delete') {
    $partId = $_GET['partId'];
    $result = $partType->deletePart($conn,$partId);
    outputResult($result,'deleted' , 'part');
}

include 'functions/lists.php';	
$partType->getParts($conn);
if (count($partType->parts) > 0) {
    echo '<table>';
    foreach ($partType->parts as $part) {
        echo '<tr><td>' . $part->id . '</td>';
        echo '<td>' . $part->title . '</td>';
        echo '<td><a href="index.php?task=admin&item=partType&action=viewParts&option=delete&partTypeId=' . $partType->id . '&partId=' . $part->id . '">Delete</a></td>';
    }
    echo '</table>';
}

else { echo '<p>There are no items listed under this part type</p>'; }

?>
</p>
</div>