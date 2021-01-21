

<?php 

ob_start();

session_start();

$pageTitle = 'comments';

if(isset($_SESSION['userSession'])){   //the start of the first if (usersession)
include 'init.php';

////////////////////////////////////////////////
$do = isset($_GET['do'])? $_GET['do']:'manage';        //the start of the second if
/////////////////////////////////////////

    if($do == 'manage'){     //the start of the second if     



///////////////////////est3lam/////////////////////






$stmt = $con->prepare("SELECT 
                        comments.*,
                        items.name AS item_name,
                        users.user_name AS member_name
                        FROM
                        comments
                        INNER JOIN
                        items
                        ON
                        items.item_id = comments.item_id
                        INNER JOIN
                        users
                        ON
                        users.user_id = comments.member_id
                        ORDER BY
                        c_id
                        DESC
                        ");
$stmt->execute();
$rows = $stmt->fetchAll();
$count = $stmt->rowCount();
if($count > 0){
        ?>



                <br>
            <h2 class="text-center manageh"> Manage Comments </h2>
            <br>
                <div class="container">
                    <div class="table-responsive">
                        <table class="table tbl">
                            <tr>
                                <td > ID </td>
                                <td > Comment </td>
                                
                                <td> Item Name </td>
                                <td> Member Name </td>
                                <td> Data </td>
                                <td> Control </td>
                            </tr>




                                <?php

                                ////////////////////////est3lam///////////////which is related to dynamic table rows

                                foreach($rows as $row){

                                echo "<tr class='commentsTr'>";

                                    echo "<td>" . $row['c_id'] . "</td>";
                                
                                    echo "<td>" .$row['comment'] . "</td>";
                                    echo "<td>" .$row['item_name'] . "</td>";
                                    echo "<td>" . $row['member_name'] . "</td>";
                                    echo "<td>" . $row['comment_date'] . "</td>";
                                    
                                    echo "
                                            <td class='g-btn'>
                                            <a href='comments.php?do=edit&cid=" . $row['c_id'] . "' class='btn btn-sm btn-success'> <i class='fas fa-user-edit'></i> Edit </a>
                                        <a href='comments.php?do=delete&cid=" . $row['c_id'] . "' class='btn btn-sm btn-danger confirm'> <i class='fas fa-user-minus'></i> Delete </a>";

                                            if($row['status']==0){
                                            echo "<a href='comments.php?do=approve&cid=" .$row['c_id']. "' class='btn btn-sm btn-info activate'> Approve </a>";
                                                }  //the end of if of activate button 
                                    echo  "</td>";
                                
                                echo "</tr>";

                                }  //the end of foreach


                                ?>

                        


                        

                        </table>
                    </div> <!-- table-responsive -->
                </div><!--  the end of container -->


        
            <?php    
    }else{//if($count > 0)

        echo "<div class='container'>";
        
        echo "<br><br><h2 class='text-center'>There Is No Comments</h2>";
        
        echo "</div>";

    }//else

    }elseif($do == 'edit'){

        echo '<div class="container">';

        $cid = isset($_GET['cid']) && is_numeric($_GET['cid'])?intval($_GET['cid']):0;


            /////////////////////////////////////////////////////////////////////////
            $stmt = $con->prepare("SELECT * FROM comments WHERE c_id=?");

            $stmt->execute(array($cid));

              $rows = $stmt->fetch();
            $count = $stmt->rowCount();
            if($count > 0){
        ?>
        <br>
            <h2 class="text-center text-light"><b>Edit Comment</b></h2>
            <br>
            
                <form class="form-horizontal" action="?do=update" method="POST">


                <input type="hidden" name="cid" value="<?php  echo $cid;
                 ?> " name="cid"/>

                <div class="form-group row">
                <label class="control-label col-sm-2">
                <h4>
                Comment :
            </h4>
                </label> <!-- control-label col-sm-2 -->

                <div class="col-sm-10">
                <textarea class="form-control" type="text" name="comment" rows = "8" value="<?php echo $rows['comment'];  ?>" >
                
                <?php echo $rows['comment'];  ?>
                
                </textarea>
                </div> <!-- col-sm-10 -->

                </div> <!-- form-group -->








               






                
                <div class="form-group row">
                <label class="control-label col-sm-2">

                </label> <!-- control-label col-sm-2 -->

                <div class="col-sm-10">
                <input class="btn btn-primary" type="submit" value="submit" />
                </div> <!-- col-sm-10 -->

                </div> <!-- form-group -->



      


      
                </form> <!-- form-horizontal -->
            </div> <!-- container  -->


         

<?php
            }else{

                $theMsg = "<div class='alert alert-danger'>Sorry there is no Such That Id</div>";
                redirectHome($theMsg,'back');
                echo "</div>";
            } //if $count > 0

    } elseif($do == 'update'){                          // the elseif of the second if

        if($_SERVER['REQUEST_METHOD']=='POST'){

            echo "<div class='container'>";

            $cid        = $_POST['cid'];
            $comment    = $_POST['comment'];

            $stmt = $con->prepare("UPDATE comments SET comment = ? WHERE c_id=?");
            $stmt->execute(array($comment,$cid));
            $count = $stmt->rowCount();
            if($count > 0){

                $theMsg="<div class='alert alert-success'>You Have Updated ". $count ."  Comment Successfully </div>";
                redirectHome($theMsg,'back');
                echo "</div>";
            }//$count



        }else{

            $theMsg = "<div class='alert alert-danger'> Sorry You Cant Go To This page Directly But By Post method Only </div>";
            redirectHome($theMsg);
        }
        
    }elseif($do == 'delete'){                            
        echo "<div class='container'>";     
        $cid=isset($_GET['cid'])&&is_numeric($_GET['cid'])?intval($_GET['cid']):0;
        $checkItem = checkItem('c_id' , 'comments' , $cid );
       /* $check = checkItem("user_id", "users", $userId ); */
        if($checkItem == 1){

                $stmt = $con->prepare("DELETE FROM comments WHERE c_id=:zid");
                $stmt->bindParam(':zid',$cid);
                $stmt->execute();
                 $stmt->rowCount();
               
                    $theMsg ="<div class='alert alert-success'> You Have Deleted ". $checkItem." comment </div>";
                    redirectHome($theMsg,'back');
                    echo "</div>";
                
        }else{

            $theMsg ="<div class='alert alert-danger'> There is no Such That Id </div>";
            redirectHome($theMsg,'back');
            echo "</div>";

        }

    }elseif($do=='approve'){

        $cid=isset($_GET['cid'])&& is_numeric($_GET['cid'])?intval($_GET['cid']):0;


        

        $check = checkItem('c_id','comments',$cid);
        
        if($check == 1){

            $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE c_id = ?");

            $stmt->execute(array($cid));
            $count = $stmt->rowCount();

            if($count > 0){

                $theMsg="<div class='alert alert-success'>You Approve ". $count ." Message Successfully</div>";
                redirectHome($theMsg,'back');

            }// if of $count > 0

 
            
        }else{// if of $check ==1
            $theMsg="<div class='alert alert-danger'>Sorry There Is No Such That Id</div>";
            redirectHome($theMsg);

        }

    }//if of approve

   




                

      





include $tpl .'footer.php';


}else{                                 //the else of the first if

header('Location: index.php');
exit();
}//the end of the first if (usersession)





ob_end_flush();




?>


