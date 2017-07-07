<?php 

if($customer->accessLevel == 'admin') {

    include 'includes/adminHeader.php';
    include 'functions/result.php';



    switch ($_GET['item']) {

        case "part":
            include 'tasks/admin/item/part/default.php';
            break;

        case "partType":
            include 'tasks/admin/item/partType/default.php';
            break;

        case "model":
            include 'tasks/admin/item/model/default.php';
            break;

        case "subType":
            include 'tasks/admin/item/subType/default.php';
            break;

    }


    include 'includes/adminFooter.php';

}
else { echo "Restricted Access"; }
?>