
<?php
$db = mysqli_connect('localhost', 'root', '', 'ivm');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
<?php

if (isset($_GET['id']))
{

$result = mysqli_query($db,"DELETE FROM product WHERE product_id=".$_GET['id']);
if($result==true)
	echo "success";
header("Location:table.php");
}

?>