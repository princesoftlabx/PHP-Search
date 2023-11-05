<?php
include ("incl/header.php");
if(isset($_GET['q'])){

   echo $data = getSearchData($_GET['q']);
  
}
?>