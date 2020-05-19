<?php
header("Content-type:text/html; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
echo $_POST['checkinID'];

//if(isset($_POST['checkinID']) && $_POST['checkinID']!=""){
//    echo $_POST['checkinID']; // ตัวอย่าง
}
?>