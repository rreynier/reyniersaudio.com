<?php
session_start();

if (isset($_POST['login_password'])) {
    $loginPassword = $_POST['login_password'];
} else {
    $loginPassword = '';
}
if (isset($_POST['login_name'])) {
    $loginName = $_POST['login_name'];
} else {
    $loginName = '';
}

// Did the user enter a password/username and click submit?
if (!empty($loginName) && !empty($loginPassword)) {
    $result = $customer->loginCustomer($conn, $loginName, $loginPassword);
}

include 'includes/adminHeader.php';
?>

<div class="contentSection">

<div id="login">
    <form method="post" action="index.php?task=login">
        <br />
        <br />
        <h2>Login <small>enter your credentials</small></h2>
        <br />
        <br />
        <label for="login_name">Username: </label>
        <input type="text" name="login_name" />

        <br />
        <br />

        <label for="login_password">Password: </label>
        <input type="password" name="login_password" />
        <br />
        <br />
        <input type="submit" id="submit" value="Login" name="submit" />
        <br />
        <br />
        <input type="hidden" id="hidden" value="yes" name="submitted" />
    </form>

<?php if (isset($result))
    echo "<h4 class='alert'>" . $result . "</h4>"; ?>
</div><!--end login-->
</div>
<?php
include 'includes/adminFooter.php';
?>