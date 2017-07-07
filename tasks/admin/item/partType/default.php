<?php 

	include 'classes/PartType.php';	
	$partType = new PartType();
	$default = 0;
	$partTypeId = $_GET['partTypeId'];
    $partType->getPartType($conn,$partTypeId);
	
	switch($_GET['action']) {
		case  'new':
			include 'tasks/admin/item/partType/edit.php';
			break;
			
		case 'delete':
			if($partType->deletePartType($conn,$partTypeId)!=0){
				echo "<p><span class='success'>Part Type ID $partTypeId was deleted.</span></p>";
			}
			else echo "<p><span class='failure'>Nothing was deleted</span></p>";			
			break;
			
		case 'edit';
			include 'tasks/admin/item/partType/edit.php';
			break;
		
		case 'viewParts';
			include 'tasks/admin/item/partType/viewParts.php';
			break;
		
		default:			
			break;
	}
		
	
		$partTypeCount = $partType->countpartTypes($conn,'');
		$partTypeIds = $partType->getPartTypeIds($conn,'');

		for ($i=0; $i<=$partTypeCount-1; $i++)
		{
			$partType = new partType();	
			$partTypes[] = $partType->getPartType($conn,$partTypeIds[$i]);		
		}
	
		?>

    <div class="contentSection">
    <div class="contentSectionTitle"><h2>View All Part Types</h2></div>
    <p><a href="index.php?task=admin&item=partType&action=edit&option=new">Add New Part Type</a></p>
    <p>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Name</th>
            <th>Order #</th>
            <th>View Parts</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php
        foreach ($partTypes as $partType) {
        ?>
        <tr>
            <td><?php echo $partType->id ?></td>
            <td><?php echo $partType->title ?></td>
            <td><?php echo $partType->name ?></td>
            <td><?php echo $partType->order ?></td>
            <td><a href="index.php?task=admin&item=partType&action=viewParts&partTypeId=<?php echo $partType->id ?>">View Parts</a></td>
            <td><a href="index.php?task=admin&item=partType&action=edit&partTypeId=<?php echo $partType->id ?>">Edit</a></td>
            <td><a href="index.php?task=admin&item=partType&action=delete&partTypeId=<?php echo $partType->id ?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    </p>
   </div>