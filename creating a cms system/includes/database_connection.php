<?php
$server="localhost";
$user = 'jonathan';
$password = 'removed it due to security concerns';
$db = 'cms_system';

// Create connection
$conn = mysqli_connect($server,$user,$password,$db);

/*this is optional

// Check connection
if(!$conn){
    die("Connection Failed!".mysqli_connect_error());
}
else{
    echo "connected successfully";
}
*/
?>
