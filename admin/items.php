<?php
ob_start();
session_start();
$pageTitle="items";
if(isset($_SESSION['userSession'])){


    include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'manage'; 

        if($do == 'manage'){ ?>

           

<!-- /////////////////////////////////////////////////est3lam/////////////////////////////////////////////////////////////-->
<?php   


                        $query = "";
                        if(isset($_GET['page'])&& $_GET['page']=='pending'){

                            $query = "AND approve=0";

                        }



                        $stmt2 = $con->prepare("SELECT 
                                                items.*,
                                                categories.name AS category_name,
                                                users.user_name AS member_name
                                                FROM items
                                                INNER JOIN
                                                categories
                                                ON 
                                                categories.id = items.cat_id
                                                INNER JOIN
                                                users
                                                ON
                                                users.user_id = items.member_id $query ORDER BY item_id DESC");
                
                        $stmt2->execute();
                        $items = $stmt2->fetchAll();
                if(! empty($items)){

                  /////////////////////////////////////////////////est3lam/////////////////////////////////////////////////////////////
                    ?>


<div class="container">
<br>
<h2 class="text-center manageh">Manage items</h2>
<br>
        <div class="table-responsive">
            <table class="table tbl">
                <tr>

                    <td>#ID</td>
                    <td>Photo</td>
                    <td>Item Name</td>
                    <td>Item Description</td>
                    <td>Price</td>
                    <td>Country</td>
                    <td>Status</td>
                    <td>Date</td>
                    <td>Member</td>
                    <td>Category</td>
                    <td>Tag</td>

                    <td>Control</td>
                   
                </tr>

            

                <?php 
                      

                
                foreach($items as $item){

                   

                    //////////////////////////////////////////

                    if(isset($item['status'])){

                        $status = array( str_replace(1,"New",$item['status']) ,
                        str_replace(2,"Light used",$item['status']) ,
                        str_replace(3,"Used",$item['status']) ,
                        str_replace(4,"Hard used",$item['status'])); 

                        $number = $item['status'];                          /*trick of str_replace of the status
                                                                                and i make it by my self */
                        $newStatus = $status[$number - 1];

                        $item['status'] = $newStatus;
                       
                    }


                    //////////////////////////////////////////

                    
                    echo "<tr  class='imgTbl'>";
                        echo "<td> ". $item['item_id'] ." </td>";

                                if(!empty($item['itemPhoto'])){
                        echo "<td style='padding:0px;'>
                                    <a style='height:100%; width:100%; display:block; text-align:center;' target='_blank' href='uploads/photos/". $item['itemPhoto'] ."'>
                                    <img class='itemPhoto' src='uploads/photos/". $item['itemPhoto'] ."' alt='itemPhoto'/></a> </td>";
                                }else{ echo "<td><h4>No image</h4></td>"; }


                        echo "<td> ". $item['name'] ." </td>";
                        echo "<td> <div> ". $item['describtion'] ."</div> </td>";
                        echo "<td> ". $item['price'] ." $ </td>";
                        echo "<td> ". $item['country_made'] ." </td>";
                        echo "<td> ". $item['status'] ." </td>";
                        echo "<td> <div>". $item['add_date'] ."</div> </td>";
                        echo "<td> <div class='memberName'>".$item['member_name']."</div> </td>";
                        echo "<td>".$item['category_name']."</td>";
?>
                        <td>
                        <?php

                        //  the trick of seperate the tags from the string

                        $tags = explode("," ,$item['tag']);

                            foreach($tags as $tag){

                        echo "<a style='color:navy; float:left;' href='..\bag.php?tagName=" . $tag . "'>" . $tag ."</a>";
                            }// foreach($tags as $tag){
                        ?>
                        </td>
<?php
                       
                        echo "<td><a class='btn btn-success btn-sm' href='items.php?do=edit&id=". $item['item_id'] ."'>Edit</a>
                        
                        <a class='btn btn-danger btn-sm' href='items.php?do=delete&id=". $item['item_id'] ."'>Delete</a>";

                        if($item['approve']==0){echo "<a class='btn btn-info btn-sm' href='items.php?do=approve&id=". $item['item_id'] ."'>Approve</a>";}

                    echo "</tr>";
                }//($items as $item){

                  

                    
                ?>

               

            </table>
        </div> <!-- end of div of table-responsive -->
<a class="btn btn-primary" href="?do=add"> <i class="fas fa-plus"></i> Add New Item </a>

</div> <!-- end of container -->




      <?php      }else{//!empty 


        echo "<div class='container'>";
        echo "<br><br><h2 class='text-center'>";
        echo "There Is No Items";
        echo "</h2>";
        
       

        echo "<a href='items.php?do=add' class='btn btn-primary'>Add New Item</a>";
        echo "</div>";
      }


                        

      ?>



<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

       <?php }elseif($do == 'add'){   ?>

            
<!-- ////////////////////////////////////////////start add page /////////////////////////////////////////////////////////-->

 
<br>

<h2 class="text-center"> Add New Item </h2>
<div class="container">
<form class="form-horizontal" action="?do=insert" method="POST" enctype="multipart/form-data">





<div class="row form-group">
<label class="col-sm-2 control-label"> Name
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="name" 
        class="form-control" 
      
        
        placeholder=" Enter Name Of Item "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->



<!--   the start of the photo       -->
<div class="row form-group">
<label class="col-sm-2 control-label"> Photo
</label>
<div class="col-sm-10">
<input  
        type="file" 
        name="itemPhoto" 
        class="form-control" 
      
        
        placeholder=" Enter a Photo Of the Item "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the end of the photo-->









<div class="row form-group">
<label class="col-sm-2 control-label"> description
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="describtion" 
        class="form-control" 
       
        placeholder=" Enter Description Of Item "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item description end -->





<div class="row form-group">
<label class="col-sm-2 control-label"> Price
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="price" 
        class="form-control" 
        placeholder=" Enter Price Of Item "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item price end -->





<div class="row form-group">
<label class="col-sm-2 control-label"> Country
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="country" 
        class="form-control" 
        placeholder=" Enter Name Of Country "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->



<div class="row form-group">
<label class="col-sm-2 control-label"> Status
</label>
<div class="col-sm-10">
<select class="form-control" name="status">
<option value="0"> ..... </option>
<option value="1"> New </option>
<option value="2"> Light Used </option>
<option value="3"> used </option>
<option value="4"> Hard Used </option>

</select>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->




<div class="row form-group">
<label class="col-sm-2 control-label"> Member
</label>
<div class="col-sm-10">
<select class="form-control" name="member">
<option value="0"> ..... </option>
 <?php
$stmt2 = $con->prepare('SELECT * FROM users');
$stmt2->execute();
$rows = $stmt2->fetchAll();
$count = $stmt2->rowCount();
foreach($rows as $row){
echo "<option value=' " . $row['user_id'] . " '>  " . $row['user_name'] . " </option>";
}
?>
</select>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item member end -->





<div class="row form-group">
<label class="col-sm-2 control-label"> Category
</label>
<div class="col-sm-10">
<select class="form-control" name="category">
<option value="0"> ..... </option>
<?php

$cats = getAll('*' , 'categories' , 'WHERE parent = 0 ' , '' , 'id' , 'ASC');

foreach($cats as $cat){

echo "<option value='". $cat['id'] ."'> ". $cat['name'] ." </option>";
}

?>
</select>

</div> <!--  end control-label col-sm-10 -->
</div> <!--   end form-group row  -->
<!-- the item name end -->





<div class="row form-group">
<label class="col-sm-2 control-label"> Tag
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="tag" 
        class="form-control" 
        placeholder=" Enter a tag or more but put after each a comma "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->





<!-- the button start -->
<div class="row form-group">

<div class="col-sm-10 offset-sm-2">
<input  
        type="submit" 
        value="Add Item" 
        class="btn btn-primary" />
</div> <!--  end col-sm-10 -->

</div> <!--   end form-group  -->
<!-- the button end -->


</form> <!-- end form-horizontal -->

</div> <!--  end container  -->





<!-- ////////////////////////////////////////////end add page /////////////////////////////////////////////////////////-->

<?php


        }elseif($do == 'insert'){



            
   
       if($_SERVER['REQUEST_METHOD']=='POST'){

        echo '<br><br><h2 class="text-center"> Update Member </h2>';
        echo '<div class="container">';  


        $itemPhoto = $_FILES['itemPhoto'];

        $pName = $_FILES['itemPhoto']['name'];
        $pTmp = $_FILES['itemPhoto']['tmp_name'];
        $pType = $_FILES['itemPhoto']['type'];
        $pSize = $_FILES['itemPhoto']['size'];

        $allowedExtensions = array("jpg" , "jpeg" , "png" , "gif");


        $myExplode = explode("." , $pName);


        $extension = strtolower(end($myExplode));



        


$name   = filter_var($_POST['name'] , FILTER_SANITIZE_STRING);
$desc       = filter_var($_POST['describtion'] , FILTER_SANITIZE_STRING);
$price = $_POST['price'];
$country    = filter_var($_POST['country'] , FILTER_SANITIZE_STRING);
$status     = filter_var($_POST['status'] , FILTER_SANITIZE_NUMBER_INT);
$memberId = $_POST['member'];

$catId   = filter_var($_POST['category'] , FILTER_SANITIZE_NUMBER_INT);

$tagPost        = filter_var($_POST['tag'] , FILTER_SANITIZE_STRING);

      

////////////////////////////////////////////







        if(isset($tagPost)){



            $stripped = preg_replace('/\s/', '', $tagPost);     //mal7oza trick of remove all white spaces from a text of the tag
            $stripped2 = strtoupper($stripped);

            $tag = $stripped2;

        }
////////////////////////////////////////////

                
                    $checkErrors = array();





                    
                    

                    if(empty($name)){
                        $checkErrors[] = 'You Must Insert The<strong> Name </strong>Of The Item';
                    }


///////the extension of the photo/////////////


                    if(!isset($pName)){

                        $checkErrors[] = "You must insert a photo to the item";
                       

                    }


                    if(isset($pName) && empty($pName)){

                        $checkErrors[] = "You must insert a photo to the item";
                    }


                    if (!in_array($extension, $allowedExtensions) && !empty($extension)){

                        $checkErrors[] = "<p class='alert alert-danger'>You can only insert an image with types .... &nbsp; jpg , jpeg , png and gif </p>";
                    }
////////////the size of the photo////////////////

                    if($pSize > 5194304){

                        $checkErrors[] = "The size of your photo must be less than 4MG";
                    }




/////////////////////////////////////////////
                    
                    if(empty($desc)){
                        $checkErrors[] = 'You Must Insert The<strong> Description </strong>Of The Item';
                    }
                    
                    
                    if(empty($price)){
                        $checkErrors[] = 'You Must Insert The<strong> Price </strong>Of The Item';
                    }

                    if(empty($country)){
                        $checkErrors[] = 'You Must Insert The<strong> Country </strong>Of Where The Item Was Made';
                    }

                    if($status == '0'){
                        $checkErrors[] = 'You Must Choose Any <strong>Value</strong> To The Status Of The Item';
                    }


                    if($memberId == 0){
                        $checkErrors[] = 'You Must Choose Any <strong>Value</strong> To The Member Of The Item';
                    }


                    if($catId == 0){
                        $checkErrors[] = 'You Must Choose Any <strong>Value</strong> To The Category Of The Item';
                    }


                    foreach($checkErrors as $error){
                         $theMsg = "<div class='alert alert-danger'>" . $error . "</div>" ;

                      redirectHome($theMsg, 'back');

                    }


                   
                    if(empty($checkErrors)){
    //////////////////////////////////////est3lam////////////////////////
                                $photo = rand(0, 100000000) . '_' . $pName;

                                move_uploaded_file($pTmp, "uploads\photos\\" . $photo);


                                $stmt4 = $con->prepare("INSERT INTO items(name, describtion, price, country_made, status, add_date, member_id, cat_id, tag , itemPhoto)
                                VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zmid, :zcid, :ztag, :zitemPhoto)");

                                $stmt4->execute(array(
                                
                                    'zname' => $name,
                                    'zdesc' => $desc,
                                    'zprice' => $price,
                                    'zcountry' => $country,
                                    'zstatus' => $status,
                                    'zmid'    => $memberId,  
                                    'zcid'    => $catId,
                                    'ztag'    => $tag,
                                    'zitemPhoto' => $photo

                                ));
                                $count = $stmt4->rowCount();
        ////////////
                

        //////////////////////////est3lam////////////////////////

                                 $theMsg = '<div class="alert alert-success"> ' . $count . ' Item Is Inserted </div>'; 

                                redirectHome($theMsg,'back');


                                
    } //the end of the empty checherrors if  

    

       } else{
           
        
        
        $theMsg = 'sorry you cant go to this page directly but by post method only';

        redirectHome($theMsg);
        
        echo '</div>';  //the end of div container


       }  //the  else of the fourth if $_SERVER


  


    

            
        }elseif($do == 'edit'){

            $itemId = isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']) : 0;


            /////////////////////////////////// est3lam //////////////////////////////////////////////////////////

            $stmt5 = $con->prepare("SELECT * FROM items WHERE item_id = ?");
            $stmt5->execute(array($itemId));
            $items = $stmt5->fetch();
            $count = $stmt5->rowCount();

            if($count > 0){



                ?>

<br>

<h2 class="text-center"> Edit Item </h2>
<div class="container">
        <!------------------------------------------------------------------------ the start of th form   ---------------------------------------------->

<form class="form-horizontal" action="?do=update" method="POST">


<input type="hidden" value="<?php  echo $items['item_id'];  ?>" name="itemId" />


<div class="row form-group">
<label class="col-sm-2 control-label"> Name
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="name" 
        class="form-control" 
        value="<?php echo $items['name'];  ?>"
        
        placeholder=" Enter Name Of Item "/>
        

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->




<div class="row form-group">
<label class="col-sm-2 control-label"> description
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="describtion" 
        class="form-control" 
        value="<?php echo $items['describtion'];  ?>"

        placeholder=" Enter Description Of Item "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item description end -->





<div class="row form-group">
<label class="col-sm-2 control-label"> Price
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="price" 
        class="form-control" 
        value="<?php echo $items['price'];  ?>"

        placeholder=" Enter Price Of Item "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item price end -->





<div class="row form-group">
<label class="col-sm-2 control-label"> Country
</label>
<div class="col-sm-10">
<input  
        type="text" 
        name="country" 
        class="form-control" 
        value="<?php echo $items['country_made'];  ?>"

        placeholder=" Enter Name Of Country "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->



<div class="row form-group">
<label class="col-sm-2 control-label"> Status
</label>
<div class="col-sm-10">
<select class="form-control" name="status">
<option value="1" <?php if($items['status']==1){echo"selected";}  ?> > New </option>
<option value="2"  <?php if($items['status']==2){echo"selected";}  ?> > Light Used </option>
<option value="3"  <?php if($items['status']==3){echo"selected";}  ?> > used </option>
<option value="4"  <?php if($items['status']==4){echo"selected";}  ?> > Hard Used </option>

</select>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->




<div class="row form-group">
<label class="col-sm-2 control-label"> Member
</label>
<div class="col-sm-10">
<select class="form-control" name="member">

 <?php
$stmt2 = $con->prepare('SELECT * FROM users');
$stmt2->execute();
$rows = $stmt2->fetchAll();
$count = $stmt2->rowCount();
foreach($rows as $row){
echo "<option value=' " . $row['user_id'] . " ' "; 

if($items['member_id']==$row['user_id']){echo "selected";}

echo " >  " . $row['user_name'] . " </option>";
}
?>
</select>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item member end -->







<div class="row form-group">
<label class="col-sm-2 control-label"> Category
</label>
<div class="col-sm-10">
<select class="form-control" name="category">
<?php

$stmt3 = $con->prepare("SELECT * FROM categories");
$stmt3->execute();
$cats = $stmt3->fetchAll();
foreach($cats as $cat){

echo "<option value='". $cat['id'] ."' ";  
if($cat['id']==$items['cat_id']){echo "selected";}
echo "> ". $cat['name'] ." </option>";
}

?>
</select>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item name end -->





<div class="row form-group">
<label class="col-sm-2 control-label"> Tag
</label>
<div class="col-sm-10">

<?php   $items['tag']  ?>
<input  
        type="text" 
        name="tag" 
        class="form-control" 
        value="<?php echo $items['tag'];  ?>"

        placeholder=" Enter a tag or more but you must put a comma after each one "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the item price end -->







<!-- the button start -->
<div class="row form-group">

<div class="col-sm-10 offset-sm-2">
<input  
        type="submit" 
        value="Edit Item" 
        class="btn btn-primary" />
</div> <!--  end col-sm-10 -->

</div> <!--   end form-group  -->
<!-- the button end -->


</form> <!-- end form-horizontal -->




<!-------------------------------------------------------that----------------------------------------------------------->












<?php
////////////////////////////est3lam///////////////////////////////////////////

$stmt = $con->prepare("SELECT 
                        comments.*,
                      
                        users.user_name AS member_name
                        FROM
                        comments
                     
                        INNER JOIN
                        users
                        ON
                        users.user_id = comments.member_id
                        WHERE item_id = ?
                        ");
$stmt->execute(array($itemId));
$rows = $stmt->fetchALL();

?>



        <br>
     <h2 class="text-center"> Comments  </h2>
    <br>
       
            <div class="table-responsive">
                <table class="table tbl">
                    <tr>
                       
                        <td> Comment </td>
                        
                      
                        <td> Member Name </td>
                        <td> Data </td>
                        <td> Control </td>
                    </tr>




                        <?php

                        ////////////////////////est3lam///////////////which is related to dynamic table rows

                        foreach($rows as $row){

                        echo "<tr>";

                          
                           
                            echo "<td>" .$row['comment'] . "</td>";
                           
                            echo "<td>" . $row['member_name'] . "</td>";
                            echo "<td>" . $row['comment_date'] . "</td>";
                            
                            echo "
                                     <td class='g-btn'>
                                    <a href='comments.php?do=edit&cid=" . $row['c_id'] . "' class='btn btn-success'> <i class='fas fa-user-edit'></i> Edit </a>
                                   <a href='comments.php?do=delete&cid=" . $row['c_id'] . "' class='btn btn-danger confirm'> <i class='fas fa-user-minus'></i> Delete </a>";

                                    if($row['status']==0){
                                    echo "<a href='comments.php?do=approve&cid=" .$row['c_id']. "' class='btn btn-info activate'> Approve </a>";
                                        }  //the end of if of activate button 
                            echo  "</td>";
                        
                        echo "</tr>";

                        }  //the end of foreach


                        ?>

                  


                   

                </table>
            </div> <!-- table-responsive -->
       


   
   







<!--------------------------------------------------------that--------------------------------------------------------->


</div> <!--  end container  -->


        <!------------------------------------------------------------------------ the end of th form   ---------------------------------------------->



                

<?php
            } // the end of if($count > 0)




        }elseif($do == 'update'){




                if(isset($_SERVER['REQUEST_METHOD'])=='POST'){
                    $id = $_POST['itemId'];
                    $name = $_POST['name'];
                    $desc = $_POST['describtion'];
                    $price = $_POST['price'];

                    $country = $_POST['country'];
                    $status = $_POST['status'];
                    $member = $_POST['member'];
                    $cat = $_POST['category'];
                    $tag = $_POST['tag'];

                    if(isset($tag)){

                        $stripped = preg_replace('/\s/', '', $tag);     //mal7oza trick of remove all white spaces from a text of the tag
                        $stripped = strtoupper($stripped);
                        $tag = $stripped;
            
                    }
            

                    ////////////////////////////////est3lam///////////////////////////////////////////////

                    $stmt = $con->prepare("UPDATE items 
                    
                                            SET 

                                            name=?,
                                            describtion=?,
                                            price=?,
                                            country_made=?,
                                            status=?,
                                            cat_id=?,                                           
                                            member_id=?,                                        
                                            tag=?
                                            WHERE
                                            item_id=?


                                            ");
                    
                    $stmt->execute(array($name,$desc,$price,$country,$status,$cat,$member,$tag,$id));

                    $count = $stmt->rowCount();

                    echo "<div class='container'> <br>";
                     $theMsg = "<div class='alert alert-success'> You Have Inserted A ". $count ." New Item </div>";
                    echo  redirectHome($theMsg,'back');

                    echo "</div>";

                }




        }elseif($do == 'delete'){
            $itemId=isset($_GET['id'])&& is_numeric($_GET['id'])?intval($_GET['id']):0;

            $check = checkItem('item_id','items',$itemId);

            if($check > 0){
                ///////////////////////////est3lam////////////////////////////
                $stmt = $con->prepare("DELETE FROM items WHERE item_id = :zid");

                $stmt->bindParam('zid',$itemId);
                $stmt->execute();
                $count = $stmt->rowCount();
                echo "<div class=container>";
              $theMsg =  "<div class='alert alert-success'> You Have Deleted" . $count ." Item </div>";
                redirectHome($theMsg,'back');
                echo "</div>";
            }


        }elseif($do == 'approve'){

            $itemId=isset($_GET['id'])&& is_numeric($_GET['id'])?intval($_GET['id']):0;


                $checkItem =     checkItem('item_id','items',$itemId);

                if($checkItem>0){

                $stmt = $con->prepare("UPDATE items SET approve= 1 WHERE item_id=?");
                $stmt->execute(array($itemId));
                $count = $stmt->rowCount();

               if($count > 0){
                $theMsg="you will be returned";

                redirectHome($theMsg, 'back');
            }//the if of checkitem
            }
       


        } // the end of elseif of activate



    include $tpl . 'footer.php';

}else{
header('Location: index.php');
exit();


}

ob_end_flush();
?>