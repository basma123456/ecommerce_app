
<?php 

session_start();

if(isset($_SESSION['userSession'])){

    $pageTitle='Home';

    include 'init.php';



    ///////////////////est3lam countItem////////////////////////////////////////////////////////////////////

   


    

    ////////////////end est3lam countItem////////////////////////////////////////////////////////////////////


?>


<div class="container home-stats text-center">




<br>
 <h2 class="manageh"> Dashboard </h2> 
 
 

 

<div class="row">
<div class="col-md-3">
<div class="stat">
Total Members
<a href="members.php?do=manage" target="_blank">
<span>
<?php    echo countItems('user_id','users'); 

?>


</span>
</a>
</div> <!-- stat -->



</div> <!-- col-md-3 -->

<!--  ////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="col-md-3">

<div class="stat">
Pending Members
<a href="members.php?do=manage&page=pending">
<span>
 <?php echo checkItem('reg_status','users',0);  
?>

</span>
</a>
</div> <!-- stat -->




</div> <!-- col-md-3 -->

<!--  ////////////////////////////////////////////////////////////////////////////////////////////////-->


<div class="col-md-3">

<div class="stat">
Total Items
<a href="items.php">
<span>

<?php echo countItems('item_id','items'); ?>

</span>
</a>

</div> <!-- stat -->


</div> <!-- col-md-3 -->

<!--  ////////////////////////////////////////////////////////////////////////////////////////////////-->


<div class="col-md-3">

<div class="stat">
Total Comments
<a href="comments.php">
<span>


<?php echo countItems('c_id','comments'); ?>
</span>
</a>
</div> <!-- stat -->




</div> <!-- col-md-3 -->

<!--  ////////////////////////////////////////////////////////////////////////////////////////////////-->

</div> <!-- row -->
</div> <!-- container -->




<div class="container latest">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default panel-dash">
                <div class="panel-heading">
                    <i class="fa fa-users"></i> Latest Users <span class="float-right tog"> <i class="fa fa-minus fa-lg"></i> </span>
                
                </div>    <!-- panel-heading -->

                <div class="panel-body panel-body-dash">

                <div class="hidee">
                <ul>

                
                   <?php 
                   
                   
                   
                   /////////////////////////////////////////////////////////////////
                   /*
                   $stmt = $con->prepare("SELECT * FROM users WHERE group_id != 1 LIMIT 6");
                   $count = $stmt->rowCount();
                   $latests = $stmt->fetchAll();
                 */
                $latests = getLatest('*','users' , 'user_id' , 6);



                   
                   
                    
                if( !empty($latests)){

                                foreach($latests as $latest){

                                    echo "<li class='li1'>" . $latest['user_name'] .
                                    "<a href='members.php?do=edit&id=" . $latest['user_id'] . 
                                    "'><span class='btn float-right mm1'> <i class='fa fa-edit'></i> Edit </span></a> ";

                                        if($latest['group_id'] == 0){
                                        echo "<a href='members.php?do=delete&id=" . $latest['user_id'] . "'>
                                        <span class='btn float-right mm1'> <i class='fa fa-edit'></i> Delete </span></a>
                                        </a>";
                                        }
                                    
                                    
                                            if($latest['reg_status']==0){
                                                echo"<a href='members.php?do=activate&id=" .$latest['user_id'] . "'><span class='btn mm mr-1'> Activate </span></a>";
                                            }

                                       
                                            

                                    echo "</li>";
                                                                    
                                }


                }else{//the end of $latets > 0

                    echo " <p>There Is No Users</p> ";


                }
                   /////////////////////////////////////////////////////////////////




                   ?>
                    </ul>
                    </div>


                </div> <!-- panel body -->
            </div> <!-- panel panel-default -->
            <br>
               <br>
              
        </div><!-- col-md-6 -->
              

       

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                <i class="fas fa-sitemap"></i>   Latest Items <span class="float-right tog2"><i class="fa fa-minus fa-lg"></i></span>
                
                </div>    <!-- panel-heading -->

                <div class="panel-body2 panel-body panel-body-dash">
                    <ul>
                   <?php $latestItems = getLatest('*','items','item_id',6); 
    if(! empty($latestItems)){                       
        foreach($latestItems as $latestItem){                                      

                        echo "<li class='pd li1'> <span>". $latestItem['name'] ."</span>";
                                        
                        echo " <a class='btn float-right mm1' href='items.php?do=edit&id=". $latestItem['item_id'] ."'><i class='fa fa-edit'></i> Edit </a>";
                        if($latestItem['approve']==0){echo "<a class='btn float-right mm mr-1' href='items.php?do=approve&id=". $latestItem['item_id'] ."'>Approve</a>";}

                        echo "</li>";


                                        

                                        

        }//foreach                                   
    }else{//!empty  
        
        
        
        echo "<p>There Is No Items</p>";
        
        




    }    
                   
                   ?>
                   </ul>
                </div> <!-- panel body -->
            </div> <!-- panel panel-default -->
        </div><!-- col-md-6 -->



    </div> <!-- row -->



      

<div class="row">
<!----------------------------------------------------------------------------------------------------------------->
<div class="col-md-6">
            <div class="panel panel-default panel-dash">
                <div class="panel-heading">
                    <i class="fa fa-users"></i> Latest Users <span class="float-right tog"> <i class="fa fa-minus fa-lg"></i> </span>
                
                </div>    <!-- panel-heading -->

                <div class="panel-body panel-body-dash panel-body-dash-c">

                <div class="hidee">
                

                
                   <?php 
                   

                   $stmt = $con->prepare("SELECT comments.*,
                                        users.user_name AS member_name
                                        FROM
                                        comments
                                        INNER JOIN
                                        users
                                        ON
                                        users.user_id = comments.member_id 
                                        ORDER BY c_id 
                                        DESC
                                        LIMIT
                                        6
                                         ");

                   $stmt->execute();

                   $comments = $stmt->fetchAll();


                if(! empty($comments)){

                   /////////////////////////////////////////////////////////////////
                 
                        foreach($comments as $comment){

                            echo "";

                            echo "<div class='comment-n'>"."<a class='a-members' href='members.php?do=edit&id=".$comment['member_id']."'>". $comment['member_name']."</a>" ."</div>";
                            echo "<div class='comment-c'>". $comment['comment'] ."   <span class='span-c'>
                            <a class='btn btn-success' href='comments.php?do=edit&cid=". $comment['c_id'] ."'>Edit</a>
                            <a class='btn btn-danger' href='comments.php?do=delete&cid=". $comment['c_id'] ."'>Delete</a>
                        
                        </span>   </div>  ";

                        }//foreach


                }else{//! empty  

                    echo "<ul style='color:white;'><p>There Is No Comments<p></ul>";

                }    

                   /////////////////////////////////////////////////////////////////




                   ?>
                    
                    </div>


                </div> <!-- panel body -->
            </div> <!-- panel panel-default -->
            <br>
               <br>
              
        </div><!-- col-md-6 -->
           <!--------------------------------------------------------------------------------------------->   



 </div>
   
    

</div> <!-- container latest -->



    
 




<?php
include $tpl . 'footer.php';


}else{


header('Location: index.php');
exit();
}













?>