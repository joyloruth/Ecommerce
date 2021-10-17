


<?php 
    session_start();
    $con=new mysqli("localhost","root","","eodb");
    $st=$con->prepare("update temp_order set qty=qty-1 where itemid = ? and email=?");
    $st->bind_param("is", $_GET["id"], $_SESSION["user"]);
    $st->execute();
    
    echo "<script>window.location='menu.php'</script>";
//    
//    $st=$con->prepare("select qty from temp_order where itemid = ? and email=?");
//    $st_check->bind_param("is", $_GET["id"], $_SESSION["user"]);
//    $st_check->execute();
//    $rs=$st_check->get_result();
//    
//  
//
//    if($row=$rs){
//        $st=$con->prepare("delete from temp_order where itemid = ? and email=?");
//        $st->bind_param("is", $_GET["id"], $_SESSION["user"]);
//        $st->execute();
//    }
//    
//    else{
//        

        
    
    
    
    
     
?>
