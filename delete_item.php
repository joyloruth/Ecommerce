
<?php 
    session_start();
    
    $con = new mysqli("localhost", "root", "", "eodb");
    $st = $con->prepare("DELETE from temp_order where email = ? and itemid = ?");
    $st->bind_param("si",$_SESSION[user], $_GET[id]);
    $st->execute();
    echo "<script>window.location = 'menu.php'</script>"
?>