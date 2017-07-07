<?php
require_once 'functions/lists.php';
require_once 'classes/Model.php';
$model = new Model();
$modelId = $_GET['modelId'];


# Check the action in the url string. Do something accordingly.
switch ($_GET['action']) {
    case 'viewPartTypes':
        include 'tasks/admin/item/model/viewPartTypes.php';
        break;

    case 'edit':
        include 'tasks/admin/item/model/edit.php';
        break;

    case 'delete':        
        $result = Model::deleteModel($conn,$_GET['modelId']);
        outputResult($result,'deleted','model');
        break;

    default:
        break;
}
$models = getModelList($conn);
?>

<div class="contentSection">
<div class="contentSectionTitle"><h2>All Computer Models</h2></div>
<p>
   <?php
        echo '<a href="index.php?task=admin&item=model&action=edit&option=new">Add New Model</a>';
   ?>
</p>


<table class='modelList'>
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Short Description</th>
    <th>Base Price</th>
    <th>Discount</th>
    <th>PartTypes</th>
    <th>Active</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>

<?php
foreach ($models as $model) {
    echo '<tr>';
    echo '<td>' . $model->id . '</td>';
    echo '<td>' . $model->title . '</td>';
    echo '<td>' . $model->shortDesc . '</td>';
    echo '<td>' . $model->basePrice . '</td>';
    echo '<td>' . $model->discount . '</td>';
    echo '<td><a href="index.php?task=admin&item=model&action=viewPartTypes&modelId=' . $model->id . '">View</a></td>';
    echo '<td>' . $model->active . '</td>'; 
    echo '<td><a href="index.php?task=admin&item=model&action=edit&modelId=' . $model->id . '&option=edit">Edit</a></td>';
    echo '<td><a href="index.php?task=admin&item=model&action=delete&modelId=' . $model->id . '">Delete</a></td>';
    echo '</tr>';
}
?>

</table>

</div>
