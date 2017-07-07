<?php


if($_SERVER['SERVER_NAME'] == 'reyniersaudio.local') {    

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
}


// Get configuration settings
require_once 'constants.php';

// Connect to Database
$conn = new mysqli(RA_DB_SERVER, RA_DB_USER, RA_DB_PASSWORD, RA_DB_NAME) or  die('There was a problem connecting to the database.');

// Get all possible GET variables
if( isset($_GET['task']) ) { $task = $_GET['task']; } else { $task = ''; }
if( isset($_GET['view']) ) { $view = $_GET['view']; } else { $view = ''; }
if( isset($_GET['action']) ) { $action = $_GET['action']; } else { $action = ''; }
if( isset($_GET['option']) ) { $option = $_GET['option']; } else { $option = ''; }
if( isset($_GET['computerId']) ) { $computerId = $_GET['computerId']; } else { $computerId = ''; }
if( isset($_GET['modelId']) ) { $modelId = $_GET['modelId']; $modelIdXpl = explode('-',$modelId); $modelId = $modelIdXpl[0]; } else { $modelId = ''; }
if( isset($_GET['subView']) ) { $subView = $_GET['subView']; } else { $subView = ''; }
if( isset($_GET['cart']) ) { $cart = $_SESSION['cart']; } else { $cart = ''; }

// Figure out if we are on a subsite. (main site, or blog subsite)
$uri = explode('/',$_SERVER['REQUEST_URI']);
if(isset($uri[1])) { $sub_site = $uri[1]; } else { $sub_site = ''; }

if( isset($_POST['submit']) && $_POST['submit'] == 'Check Out') { header( 'Location: index.php?task=viewCart' ); }

switch ($task) {

    case "browse":
        include 'tasks/browse/default.php';
        break;

    case "login":
        require_once 'classes/Customer.php';
        $customer = new Customer();
        if( isset($_SESSION['accessLevel']) ) {
            if( $_SESSION['accessLevel'] == 'admin' || $_SESSION['accessLevel'] == 'customer' ) {
                $customer->getCustomer($conn, $_SESSION['customerId']);
            }
        }
        include 'tasks/login/default.php';
        break;

    case "logout":
        include 'tasks/logout/default.php';
        break;

    case "admin":
        require_once 'classes/Customer.php';
        $customer = new Customer();
        if( isset($_SESSION['accessLevel']) ) {
            if( $_SESSION['accessLevel'] == 'admin' || $_SESSION['accessLevel'] == 'customer' ) {
                $customer->getCustomer($conn, $_SESSION['customerId']);
            }
        }
        include 'tasks/admin/default.php';
        break;

    case 'checkout';
        include 'tasks/checkout/default.php';
        break;

    case 'viewCart';
        include 'tasks/checkout/default.php';
        break;

    default:
        include 'tasks/browse/default.php';
        break;
}
	