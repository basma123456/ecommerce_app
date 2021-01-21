

<?php 

ob_start();

session_start();

$pageTitle = 'members';

if(isset($_SESSION['userSession'])){   //the start of the first if (usersession)
include 'init.php';

////////////////////////////////////////////////
$do = isset($_GET['do'])? $_GET['do']:'manage';        //the start of the second if
/////////////////////////////////////////

    if($do == 'manage'){     //the start of the second if     



///////////////////////est3lam/////////////////////

$query='';

if(isset($_GET['page']) && $_GET['page']=='pending'){

$query = 'AND reg_status = 0';

}






$stmt = $con->prepare("SELECT * FROM users WHERE group_id != 1 $query ORDER BY user_id DESC");
$stmt->execute();
$rows = $stmt->fetchAll();

?>



        <br>
     <h2 class="text-center manageh"> Manage Members </h2>
    <br>
        <div class="container">
            <div class="table-responsive">
                <table class="table tbl">
                    <tr>
                        <td> #ID </td>
                        <td> User Name </td>
                        <td> Email </td>
                        <td> Full Name </td>
                        <td> Date </td>
                        <td> Registered Date </td>
                        <td> Control </td>
                    </tr>


                        <?php

                        ////////////////////////est3lam///////////////which is related to dynamic table rows

                        foreach($rows as $row){

                        echo "<tr class='membersTr'>";

                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['user_name'] . "</td>";
                            echo "<td>" .$row['email'] . "</td>";
                            echo "<td>" .$row['full_name'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td></td>";
                            echo "
                                     <td class='g-btn'>
                                    <a href='members.php?do=edit&id=" . $row['user_id'] . "' class='btn btn-sm btn-success'> <i class='fas fa-user-edit'></i> Edit </a>
                                   <a href='members.php?do=delete&id=" . $row['user_id'] . "' class='btn btn-sm btn-danger confirm'> <i class='fas fa-user-minus'></i> Delete </a>";

                                    if($row['reg_status']==0){
                                    echo "<a href='members.php?do=activate&id=" .$row['user_id']. "' class='btn btn-sm btn-info activate'> Activate </a>";
                                        }  //the end of if of activate button 
                            echo  "</td>";
                        
                        echo "</tr>";

                        }  //the end of foreach


                        ?>

                  


                   

                </table>
            </div> <!-- table-responsive -->
        </div><!--  the end of container -->


   
    <?php     echo '<br> &nbsp; &nbsp; <a class="btn textadd" href="members.php?do=add"> <i class="fas fa-user-plus"></i> Add Member </a>';



    }elseif($do == 'add'){ ?>

       
        <br>

        <h2 class="text-center"> Add Member </h2>
        <div class="container">
        <form class="form-horizontal" action="?do=insert" method="POST">
        
        
        
        
        
        <div class="row form-group">
        <label class="col-sm-2 control-label">User Name
        </label>
        <div class="col-sm-10">
        <input type="text" name="userName" class="form-control" autocomplete="off" required="required" placeholder=" Enter your name "/>
        
    </div> <!--  end col-sm-10 -->
        </div> <!--   end form-group  -->
        <!-- the user name end -->



        <!-- the password start -->

        <div class="row form-group">

        <label class="col-sm-2 control-label">Password
        </label>
        <div class="col-sm-10">
         
        <input type="password" name="password" class="form-control password"  autocomplete="new-password" placeholder=" Enter your password " required="required"/>
        <i class="eye far fa-eye"></i>
        
        
        </div> <!--  end col-sm-10 -->
        </div> <!--   end form-group  -->
        <!-- the password end -->


        <!-- the email start -->

        <div class="row form-group">
        <label class="col-sm-2 control-label">Email
        </label>
        <div class="col-sm-10">
        <input type="email" name="email"  class="form-control" required="required" placeholder=" Enter a valid email "/>
        </div> <!--  end col-sm-10 -->
        </div> <!--   end form-group  -->
        <!-- the email end -->



        <!-- the full name start -->

        <div class="row form-group">
        <label class="col-sm-2 control-label">Full Name
        </label>
        <div class="col-sm-10">
        <input type="text" name="fullName"  class="form-control" required="required" placeholder=" Enter your full name "/>
        </div> <!--  end col-sm-10 -->
        </div> <!--   end form-group  -->
        <!-- the full name end -->


        <!-- the button start -->
        <div class="row form-group">

        <div class="col-sm-10 offset-sm-2">
        <input type="submit" value="Add Member" class="btn btn-primary" />
        </div> <!--  end col-sm-10 -->
        </div> <!--   end form-group  -->
        <!-- the button end -->

        </form> <!-- end form-horizontal -->

        </div> <!--  end container  -->

        <!------------------------------------------------------------------------ the end of th form   ---------------------------------------------->
        <?php
    
    
   
    }elseif($do == 'insert'){
    /*
    echo $_POST['userName'] . $_POST['password'] . $_POST['email'] . $_POST['fullName'];
    */
   
    
   
       if($_SERVER['REQUEST_METHOD']=='POST'){

        echo '<br><br><h2 class="text-center"> Update Member </h2>';
        echo '<div class="container">';  

        


      
        $user = $_POST['userName'];
        $pass = $_POST['password'];
        $email = $_POST['email'];
        $full = $_POST['fullName'];
        $hashedPass = sha1($_POST['password']);
                
                    $checkErrors = array();
                    

                    if(strlen($user)<4){
                        $checkErrors[] = '  You must put a User Name more than <strong> 4 characters </strong>';
                    }

                    if(strlen($user)>20){
                        $checkErrors[] = '  You must put a User Name which is less than <strong> 20 characters</strong> ';
                    }
                    
                    if(empty($user)){
                        $checkErrors[] = '  User Name is <strong>  required </strong> ';
                    }

                    if(empty($email)){
                        $checkErrors[] = '  Email is <strong>  required </strong> ';
                    }

                    if(empty($pass)){
                        $checkErrors[] = '  password is <strong>  required </strong> ';
                    }

                    if(empty($full)){
                        $checkErrors[] = '  Full Name is <strong>  required </strong> </div>';
                    }

                    foreach($checkErrors as $error){
                        $theMsg = '<div class="alert alert-danger">' . $error . '</div>' ;

                        redirectHome($theMsg, 'back');

                    }


                   
                    if(empty($checkErrors)){
    //////////////////////////////////////est3lam////////////////////////

                        $check = checkItem('user_name','users',$user);


                        if($check === 1){

                                $theMsg = "<div class='alert alert-danger'> This User Name Is Already Taken Choose Another One</div>";
                                redirectHome($theMsg, 'back');
                        }else{


                                $stmt = $con->prepare("INSERT INTO users(user_name, email, full_name, password, reg_status, date)
                                VALUES (:zuser, :zemail, :zfull, :zpass, 1, now()) ");

                                $stmt->execute(array(
                                
                                    'zuser' => $user,
                                    'zemail' => $email,
                                    'zfull' => $full,
                                    'zpass' => $hashedPass



                                ));
                                $count = $stmt->rowCount();
        ////////////
                

        //////////////////////////est3lam////////////////////////

                                 $theMsg = '<div class="alert alert-success">' . $count . ' count is inserted </div>'; 

                                redirectHome($theMsg,'back');


                                } //the end of the else of the if of $check ===1

    } //the end of the empty checherrors if

    

       } else{
           
        
        
        $theMsg = 'sorry you cant go to this page directly but by post method only';

        redirectHome($theMsg);
        
        echo '</div>';  //the end of div container



       }  //the  else of the fourth if $_SERVER


  


    
    
    
    
    
    }elseif($do == 'edit'){



        $userId = isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']) : 0;
        

       



    //////////////////////////////////////////est3lam//////////////////////////////////////////////

                $stmt = $con->prepare("SELECT 
                *


                FROM 

                users 
                WHERE user_id = ? 
                
                LIMIT 1");

                $stmt ->execute(array($userId));
                $row = $stmt->fetch();
                $count = $stmt->rowCount();
                    if($count>0){                                 //the third if
                    $_SESSION['userId'] = $row['user_id'];

        ///////////////////////////////////////////est3lam///////////////////////////////////////////////////
      

                ?>
                <!------------------------------------------------------------------------ the beggining of the form   ---------------------------------------------->

                <!-- the user name start -->
                <br>

                

                <h2 
                class="text-center text-light"> <b>Edit Member </b></h2>
                <div class="container">
                <form class="form-horizontal" action="?do=update" method="POST">
                
                
                <input type="hidden" value="<?php echo $userId; ?>" name="id1" />
                
                
                
                <div class="row form-group">
                <label class="col-sm-2 control-label"> <h4>User Name</h4>
                </label>
                <div class="col-sm-10">
                <input type="text" name="userName" class="form-control" value="<?php echo $row['user_name']; ?>" autocomplete="off" required="required"/>
                </div> <!--  end col-sm-10 -->
                </div> <!--   end form-group  -->
                <!-- the user name end -->



                <!-- the password start -->

                <div class="row form-group">
                <label class="col-sm-2 control-label"><h4>Password</h4>
                </label>
                <div class="col-sm-10">
                <input type="hidden" name="oldpassword" value="<?php echo $row['password']; ?>" />
                <input type="password" name="newpassword" class="form-control"  autocomplete="new-password"/>
                </div> <!--  end col-sm-10 -->
                </div> <!--   end form-group  -->
                <!-- the password end -->


                <!-- the email start -->

                <div class="row form-group">
                <label class="col-sm-2 control-label"><h4>Emai</h4>
                </label>
                <div class="col-sm-10">
                <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" required="required"/>
                </div> <!--  end col-sm-10 -->
                </div> <!--   end form-group  -->
                <!-- the email end -->



                <!-- the full name start -->

                <div class="row form-group">
                <label class="col-sm-2 control-label"><h4>Full Name</h4>
                </label>
                <div class="col-sm-10">
                <input type="text" name="fullName" value="<?php echo $row['full_name']; ?>" class="form-control" required="required"/>
                </div> <!--  end col-sm-10 -->
                </div> <!--   end form-group  -->
                <!-- the full name end -->


                <!-- the button start -->
                <div class="row form-group">

                <div class="col-sm-10 offset-sm-2">
                <input type="submit" value="save" class="btn btn-primary" />
                </div> <!--  end col-sm-10 -->
                </div> <!--   end form-group  -->
                <!-- the button end -->

                </form> <!-- end form-horizontal -->

                </div> <!--  end container  -->

                <!------------------------------------------------------------------------ the end of th form   ---------------------------------------------->

                <?php 





        }else{
            
            
            echo "<div class='container'> <br>";

            $theMsg = "<div class='alert alert-danger'> there is no data to that id </div>";
            
            redirectHome($theMsg, 'back');
            
            echo"</div>";
        
        
        }  ///the end of the third if
    


    } elseif($do == 'update'){                          // the elseif of the second if
    
        echo '<br><br><h2 class="text-center"> Update Member </h2>';
        echo '<div class="container">';  
        
       
           if($_SERVER['REQUEST_METHOD']=='POST'){

            $id1 = $_POST['id1'];
            $user = $_POST['userName'];
          
            $email = $_POST['email'];
            $full = $_POST['fullName'];
            
                     //the password trick

                     $pass='';
                    if(empty($_POST['newpassword'])){
                    $pass = $_POST['oldpassword'];

                    }else{
                        $pass = sha1($_POST['newpassword']);
                    }
                  ////////////////the end of the password trick
                        $checkErrors = array();
                        

                        if(strlen($user)<4){
                            $checkErrors[] = '  <div class="alert alert-danger"> You must put a User Name more than <strong> 4 characters </strong></div>';
                        }

                        if(strlen($user)>20){
                            $checkErrors[] = ' <div class="alert alert-danger"> You must put a User Name which is less than <strong> 20 characters</strong> </div>';
                        }
                        
                        if(empty($user)){
                            $checkErrors[] = ' <div class="alert alert-danger"> User Name is <strong>  required </strong> </div>';
                        }

                        if(empty($email)){
                            $checkErrors[] = ' <div class="alert alert-danger"> Email is <strong>  required </strong> </div>';
                        }

                        if(empty($pass)){
                            $checkErrors[] = ' <div class="alert alert-danger"> password is <strong>  required </strong> </div>';
                        }

                        if(empty($full)){
                            $checkErrors[] = ' <div class="alert alert-danger"> Full Name is <strong>  required </strong> </div>';
                        }

                        foreach($checkErrors as $error){
                            $theMsg = $error;
                            redirectHome($theMsg,'back');

                        }


                       
                        if(empty($checkErrors)){
        //////////////////////////////////////est3lam////////////////////////
            $stmt = $con->prepare("UPDATE users SET user_name=?, email=?, full_name=?, password=? WHERE user_id=?");

            $stmt->execute(array($user, $email, $full, $pass, $id1));
            $count = $stmt->rowCount();
            //////////////////////////////////////est3lam////////////////////////

            $theMsg = '<div class="alert alert-success">' . $count . ' count is updated </div>'; 
             redirectHome($theMsg , 'back');

        } //the end of the empty checherrors if

        

           } else{
               
            
            $theMsg = 'sorry you cant go to this page directly but by post method only';
            redirectHome($theMsg);
            echo '</div>';  //the end of div container



           }  //the  else of the fourth if $_SERVER


        
    }elseif($do == 'delete'){                            //the end of the second if  --update--
                  

            $userId=isset($_GET['id'])&&is_numeric($_GET['id'])?intval($_GET['id']):0;
            
          /*  $stmt = $con->prepare("SELECT * FROM users WHERE user_id = ? LIMIT 1");
            $stmt->execut
            e(array($userId));
            $count = $stmt->rowCount();

            if($count>0){  */


            $check = checkItem("user_id", "users", $userId );    //this function is instead of the uppr codes of requirements
            if($check == 1){

                    $stmt = $con->prepare("DELETE FROM users WHERE user_id = :zuser");
                    $stmt->bindParam(':zuser',$userId); 
                    $stmt->execute();
                    
                    echo "<div class='container'>";
                    $theMsg = "<div class='alert alert-success'>" . $check . " Record is Deleted </div>";
                    redirectHome($theMsg, 'back');
                    echo "</div>";

            }else{    //end of if $check
                  
                echo "<div class='container'>";
               $theMsg = '<div class="alert alert-danger">this id is not exist</div>';
                redirectHome($theMsg);
               echo "</div>";
            } //else of   end of if $count




    }elseif($do=='activate'){

        $userId=isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']):0;


        $check = checkItem("user_id","users",$userId);


                if($check > 0) {

                     $stmt =$con->prepare("UPDATE users SET reg_status = 1 WHERE user_id = ?");

                   $stmt->execute(array($userId));
                   

                   echo "<div class='container'>";
                   $theMsg = "<div class='alert alert-success'>" . $check . " Record is Activated </div>";
                   redirectHome($theMsg, 'back');
                   echo "</div>";


                }else{    //end of if $check
                  
                    echo "<div class='container'>";
                   $theMsg = '<div class="alert alert-danger">this id is not exist</div>';
                    redirectHome($theMsg);
                   echo "</div>";
                } //else of   end of if $check
    


    }//if of do == activate

   




                

      





include $tpl .'footer.php';


}else{                                 //the else of the first if

header('Location: index.php');
exit();
}//the end of the first if (usersession)





ob_end_flush();




?>


