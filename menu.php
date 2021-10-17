<?php include "header.php" ?>

<div id = "menu-layout">
    
    <div id = "side-menu">
        <?php 
                    $con=new mysqli("localhost","root","","eodb");
                    $st=$con->prepare("select distinct category from items ");
                    $st->execute();
                    $rs=$st->get_result();
                    while($row=$rs->fetch_assoc())
                    {
                        echo '<li><a href="?cat='.$row["category"].'">'.$row["category"].'</a></li>';
                    }
        ?>
    </div>
    
    <div id = "menu-items">
        
         <?php 
                    if(!isset($_GET["cat"])){
                        $cat = "Pizza";
                    }
                    else
                        $cat=$_GET["cat"];
                        
                        $con=new mysqli("localhost","root","","eodb");
                        $st=$con->prepare("select *  from items where category = ? ");
                        $st->bind_param("s", $cat);
                        $st->execute();
                        $rs=$st->get_result();
                        
                        while($row=$rs->fetch_assoc())
                        {
                            echo '<div class ="product">
                                 <div class ="thumbnail">
                                    <img src="images/'.$row["photo"].'" id = "photo"/>
                                    <h3>'.$row["name"].'</h3>
                                    <p> $'.$row["price"].'</p>
                                    <a href="add_item.php?id='.$row["id"].'" id = "addToCart">Add to cart</a>
                                    </div>
                                  </div>';
                        }
                ?>
    </div>
    
    <div id = "grocery-cart">
        
            
            <?php
            
                        $con=new mysqli("localhost","root","","eodb");
                        $st=$con->prepare("select * from temp_order join items on items.id = temp_order.itemid where email = ? group by temp_order.itemid");
                        $st->bind_param("s",$_SESSION["user"]);
                        $st->execute();
                        $rs=$st->get_result();
                        $total = 0;
                       
                        while($row=$rs->fetch_assoc())
                        {
                            $total = $total + $row["price"] * $row["qty"];
                            echo '<div class =" cart-item">
                                 <div class ="thumbnail">
                                    <img src="images/'.$row["photo"].'" id = "photo"/>
                                    <p class = "cartItemName">'.$row["name"].'</p>
                                    <p>$'.$row["price"] * $row["qty"] .'</p>
                                    <div class = "addDelete">
                                        <a href="add_item.php?id='.$row["itemid"].'" id= "cartButton">+</a>
                                        <p class="qtyBox">'.$row["qty"].'</p>
                                        <a href="subtract_item.php?id='.$row["itemid"].'" id= "cartButton">-</a>
                                    </div>
                                        <a href="delete_item.php?id='.$row["itemid"].'" >Delete</a>
                                    </div>
                                  </div>';
                            
                        }
                        
                          echo "<div class = 'total'>TOTAL: $ $total".
                                 
                                    '<form action="add_order.php" method="post">
                                    <input type="submit" value="Check Out" >
                                    </form>' .
                                  "</div>";
                       
                        
        ?>
        
    </div>
    
  
</div>
