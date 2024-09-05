<?php
session_start();

function admin_button(){
if (isset($_SESSION['admin_button']) === true){
echo '<a href="admin_dashboard.php">To Admin</a>';
}
?>
<div calss="alert alert-danger">
    <?php $_SESSION['message']='You are not an admin!';?>
</div>
<?php 

     
       
}