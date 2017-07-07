<?php
$modelId = $_GET['modelId'];
$model->getModel($conn,$modelId);

if ($_GET['option'] ==  'delete') {
        $result = $model->deletePartType($conn,$_GET['partTypeId']);
        outputResult($result,'deleted','part type');
}

$partTypes = getPartTypeListByModel($conn, $modelId);

echo '<div class="contentSection">';
echo '<div class="contentSectionTitle"><h2>View Part Types for ' . $model->title . ' (ID: ' . $model->id . ')</h2></div>';
if (count($partTypes) > 0) {
    echo '<p><table>';
    echo '<tr><th>ID</th><th>Title</th><th>Delete</th></tr>';
    foreach($partTypes as $partType) {
       echo '<tr>';
       echo '<td>' . $partType->id . '</td>';
       echo '<td>' . $partType->title . '</td>';
       echo '<td><a href="index.php?task=admin&item=model&action=viewPartTypes&option=delete&';
       echo 'partTypeId=' . $partType->id;
       echo '&modelId=' . $modelId . '">Delete</a></td>';
       echo '</tr>';
    }
    echo '</table></p>';
}
else { echo '<p>There are no items listed under this computer model</p>'; }
echo '</div>'

?>
