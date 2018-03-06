<?php
if(mysqli_connect('localhost','speedd6f_eems','Ems@1q2w3e','speedd6f_ems_11'))
{
   echo 'connected.';	
}

else
{
  echo mysql_error();	
}
?>