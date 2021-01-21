






   






<?php
ob_start();
session_start();



if(isset($_SESSION['userSession'])){

include 'init.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'manage';

if($do == 'manage'){


////////////////////////////////////////////////est3lam////////////////////////////////////////////////////////////////

//mal7oza trick of ASC and DESC

$sort='DESC';
$sort_array = array('ASC','DESC');
if(isset($_GET['sort'])&& in_array($_GET['sort'],$sort_array)){
$sort = $_GET['sort'];

}


$stmt = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY ordering $sort");

$stmt->execute();
$cats = $stmt->fetchAll();
$count = $stmt->rowCount();

?>
<br>
<h2 class="text-center manageh"> Manage Categories </h2>
<br>
<div class="container mmm">

    <div class="c-panel">
        <div class="c-panel-head">
            <h5>  Categories</h5>

            <div class='rb'>
               <strong style="font-size:16px;"> Ordering By : &nbsp; </strong>
                 <a href='?sort=ASC' class="<?php if($sort == 'ASC'){echo 'gray';} ?>"> Asc <i class="fas fa-angle-double-up"></i>  </a>   &nbsp;   <a href='?sort=DESC' class="<?php if($sort == 'DESC'){echo 'gray';} ?>">  Desc <i class="fas fa-angle-double-down"></i>  </a>
             &nbsp;  |  &nbsp;
                 <strong style="font-size:16px;"> View BY : &nbsp; </strong>

                 <span class='gray' data-view='full'> Full </span> &nbsp;  <span data-view='classic'> Classic </span>
             
             
             </div> <!--  end of div of calss of rb -->
        </div> <!-- panel head -->

            <div class="c-panel-body">
                                    

                        <?php

                        foreach($cats as $cat){
                        echo "<div class='cat'>";
                        echo "<h2 style='display:inline-block;'>" . $cat['name'] . "</h2>";

                        /////////////////////////////////////////////
                        $subs = getAll('*' , 'categories' , "where parent = {$cat['id']}" , "" , "id" , $sort );
                           echo "<span  class='all'>"; //the all class used to hold the span that contain dropdown 
                                                      //to make the j query function of classic and full to each one only
                            
                            
                                if(!empty($subs)){  //-------------the arrow making--------------//
                                echo '<span class="togPress"   
                                style="width:fit-content; padding:1px 6px 1px 6px;   
                                background-color:rgb(78, 75, 75); 
                                border-radius:3px; color:white;" 
                                selected><i class="fas fa-caret-down"></i>
                                </span>';


                                //----------------the drop down making---------------//
                        echo '<ul class="togCat">';
                            
                        foreach($subs as $c){
                            echo " <li> <a href='categories.php?do=edit&id=". $c['id'] ."' > ". $c['name'] ."</a> </li>";
                        }//the end of foreach of subs     

                        echo '</ul>';
                                }else{echo "<span style='display:none;'></span>                                 
                                    <span style='display:none;'></span>";}// the end of  if(!empty($subs)){ 
                                   
                                    echo "</span>"; //the end of the span of class all
                       
                                    //////////////////////////////////////////////


                        echo "<div class='fd-in-out'>";// the div of the function of the fade toggle which is the //next// inside the function refer to

                                    echo "<section>";

                        if(empty($cat['describtion'])){

                            echo " This Category Has No Description ";

                            }else{

                            echo "<p>" . $cat['describtion'] . "</p>";   }//of else of if(empty($cat['name']))


                               echo "<div id='div1'>"; //group of visibility and ads and comments

                        if($cat['visibility']==1){
                            echo "<span class='visible'> Hidden </span>";

                        }

                        
                        if($cat['allow_ads']==1){
                            echo "<span class='ads'> No Ads </span>";


                        }

                        
                        if($cat['allow_comments']==1){
                            echo "<span class='comments'> No Comments </span>";

                        }

                        echo "</div>";  //group of visibility and ads and comments
                      echo "</div>"; //the end div of the function of the fade toggle which is the //next// inside the function refer to
                            echo "</section>";
                        echo "<div class='ed-group'> <a href='categories.php?do=edit&id=" . $cat['id']  .  "' class='btn bg-info'> Edit </a>
                        
                        <a href='?do=delete&id=". $cat['id'] ."' class='btn bg-danger confirm' > Delete </a></div>";

                        echo "</div>"; // .cat
                       

                        echo "<hr>";

                                                } //foreach 
                                                ?>
            
            </div> <!-- panel body -->
       
        

    </div>        
    <br>
    <a class="btn btn-info" href="categories.php?do=add"> <i class="fa fa-plus"></i> Add Category </a>
</div>








<?php

}elseif($do == 'add'){ ?>

<!-- ////////////////////////////////////////////start add page /////////////////////////////////////////////////////////-->

 
<br>

<h2 class="text-center"> Add Category </h2>
<div class="container">
<form class="form-horizontal" action="?do=insert" method="POST">





<div class="row form-group">
<label class="col-sm-2 control-label"> Name
</label>
<div class="col-sm-10">
<input type="text" name="name" class="form-control" autocomplete="off" required="required" placeholder=" Enter Name Of Category "/>

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the user name end -->



<!-- the describtion start -->

<div class="row form-group">

<label class="col-sm-2 control-label"> Describtion 
</label>
<div class="col-sm-10">
 
<input type="text" name="describtion" class="form-control"  placeholder=" Enter Category describtion " />



</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the describtion end -->


<!-- the parent start -->

<div class="row form-group">

<label class="col-sm-2 control-label"> Parent 
</label>
<div class="col-sm-10">
 
<select name='parent' class='p-1'>
    <?php 
 $parents = getAll("*" , "categories" , "where parent = 0" , "" , "id" ,"ASC");
?>
<option value='0'> None </option> 
<?php    
foreach($parents as $parent){

echo "<option value='". $parent['id'] ."'> ". $parent['name'] ." </option> ";

}

?>   
</select>


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the parent end -->




<!-- the email start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Ordering 
</label>
<div class="col-sm-10">
<input type="text" name="ordering"  class="form-control"  placeholder=" Enter The Order Of The Category "/>
</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the email end -->



<!-- the visibility start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Visibility 
</label>
<div class="col-sm-10">


<div> <!-- the start of radio button outer div -->
<input type="radio" id="visible-yes" value="0" name="visibility" checked /> 
<label for="visible-yes"> Yes </label>
</div> <!-- the end of radio button outer div -->


<div><!-- the start of radio button outer div -->
<input type="radio" value="1" id="visible-no" name="visibility"/>
<label for="visible-no" > No </label>
</div> <!-- the end of radio button outer div -->


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the  visibility end -->



<!-- the allow_ads start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Ads 
</label>
<div class="col-sm-10">


<div> <!-- the start of radio button outer div -->
<input type="radio" id="ads-yes" value="0" name="ads" checked /> 
<label for="ads-yes"> Yes </label>
</div> <!-- the end of radio button outer div -->


<div><!-- the start of radio button outer div -->
<input type="radio" value="1" id="ads-no" name="ads"/>
<label for="ads-no" > No </label>
</div> <!-- the end of radio button outer div -->


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the  allow_ads  end -->





<!-- the visibility start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Comments  
</label>
<div class="col-sm-10">


<div> <!-- the start of radio button outer div -->
<input type="radio" id="comments-yes" value="0" name="comments" checked /> 
<label for="comments-yes"> Yes </label>
</div> <!-- the end of radio button outer div -->


<div><!-- the start of radio button outer div -->
<input type="radio" value="1" id="comments-no" name="comments"/>
<label for="comments-no" > No </label>
</div> <!-- the end of radio button outer div -->


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the  visibility end -->




<!-- the button start -->
<div class="row form-group">

<div class="col-sm-10 offset-sm-2">
<input type="submit" value="Add Category" class="btn btn-primary" />
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

        


      
        $name = $_POST['name'];
        $desc = $_POST['describtion'];
        $parent = $_POST['parent'];
        $order = $_POST['ordering'];
        $visible = $_POST['visibility'];
        $ads = $_POST['ads'];
        $comments = $_POST['comments'];
        
                $checkErrors = array();

                if(empty($name)){

                    $checkErrors[] = " You Must Insert The Name Here ";                   
                }   
                
                if(strlen($name)>20){

                    $checkErrors[] = " Please, Insert A Reasonable Name ";
                }

                 
                if(strlen($name)<2){

                    $checkErrors[] = " Your Name Is Too Short, Try Again ";

                }


                foreach($checkErrors as $error){

                    $theMsg = "<div class='alert alert-success'>" . $error . "</div>";
                     redirectHome($theMsg , 'back');
                }

                   if(empty($checkErrors)){ 

                        
    //////////////////////////////////////est3lam////////////////////////


                        $check = checkItem('name','categories',$name);


                        if($check === 1){

                                $theMsg = "<div class='alert alert-danger'> This Category
                                 Name Is Already Taken Choose Another One</div>";
                                redirectHome($theMsg, 'back');
                        }else{

                  $stmt = $con->prepare("INSERT INTO categories(name, describtion, parent ,ordering, visibility, allow_ads, allow_comments)
                                VALUES (:zname, :zdescribe, :zparent ,:zorder, :zvisible, :zads, :zcomments) ");

                                $stmt->execute(array(
                                
                                    'zname'         => $name,
                                    'zdescribe'     => $desc,
                                    'zparent'       => $parent,
                                    'zorder'        => $order,
                                    'zvisible'      => $visible,
                                    'zads'          => $ads,
                                    'zcomments'     => $comments



                                ));
                                $count = $stmt->rowCount();
        ////////////
                

        //////////////////////////est3lam////////////////////////

                                 $theMsg = '<div class="alert alert-success">' . $count . ' Category is inserted </div>'; 

                                redirectHome($theMsg,'back');


                                } //the end of the else of the if of $check ===1

                                            } //the end of the empty checherrors if

    
       } else{
           
        
        
        $theMsg = 'sorry you cant go to this page directly but by post method only';

        redirectHome($theMsg);
        
        echo '</div>';  //the end of div container



       }  //the  else of the fourth if $_SERVER


}elseif($do == 'edit'){ 




    

    $catId = isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']) : 0;
        

       



    //////////////////////////////////////////est3lam//////////////////////////////////////////////

                $stmt = $con->prepare("SELECT 
                *


                FROM 

                categories 
                WHERE id = ? 
                
                ");

                $stmt ->execute(array($catId));
                $cat = $stmt->fetch();
                $count = $stmt->rowCount();
                    if($count>0){                                 //the third if
                  /*  $_SESSION['catId'] = $cat['id'];*/

        ///////////////////////////////////////////est3lam///////////////////////////////////////////////////
      

                ?>
                <!------------------------------------------------------------------------ the beggining of the form   ---------------------------------------------->
 
                <br>

<h2 class="text-center"> Edit Category </h2>
<div class="container">
<form class="form-horizontal" action="?do=update" method="POST">


<input type="hidden" name="id"  value="<?php echo $catId;?>" />


<div class="row form-group">
<label class="col-sm-2 control-label"> Name
</label>
<div class="col-sm-10">
<input type="text" name="name" class="form-control" autocomplete="off" required="required" placeholder=" Enter Name Of Category " value="<?php echo $cat['name']; ?>" />

</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the user name end -->



<!-- the password start -->

<div class="row form-group">

<label class="col-sm-2 control-label"> Describtion 
</label>
<div class="col-sm-10">
 
<input type="text" name="describtion" class="form-control"  placeholder=" Enter Category describtion " value="<?php echo $cat['describtion']; ?>"/>



</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the password end -->



<!-- the parent start -->

<div class="row form-group">

<label class="col-sm-2 control-label"> Parent 
</label>
<div class="col-sm-10">
 
<select name='parent2' class='p-1'>
    <?php 
 $parents2 = getAll("*" , "categories" , "where parent = 0" , "" , "id" ,"ASC");
?>
<option value='0'> None </option> 
<?php    
foreach($parents2 as $parent2){

echo "<option value='". $parent2['id'] ."'> ". $parent2['name'] ." </option> ";

}

?>   
</select>


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the parent end -->



<!-- the email start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Ordering 
</label>
<div class="col-sm-10">
<input type="text" name="ordering"  class="form-control"  placeholder=" Enter The Order Of The Category " value="<?php echo $cat['ordering']; ?> "/>
</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the email end -->



<!-- the visibility start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Visibility 
</label>
<div class="col-sm-10">


<div> <!-- the start of radio button outer div -->
<input type="radio" id="visible-yes" value="0" name="visibility"  <?php if($cat['visibility']==0){echo "checked";} ?> /> 
<label for="visible-yes"> Yes </label>
</div> <!-- the end of radio button outer div -->


<div><!-- the start of radio button outer div -->
<input type="radio" value="1" id="visible-no" name="visibility" <?php if($cat['visibility']==1){echo "checked";} ?>/>
<label for="visible-no" > No </label>
</div> <!-- the end of radio button outer div -->


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the  visibility end -->



<!-- the allow_ads start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Ads 
</label>
<div class="col-sm-10">


<div> <!-- the start of radio button outer div -->
<input type="radio" id="ads-yes" value="0" name="ads" <?php if($cat['allow_ads']==0){echo "checked";} ?> /> 
<label for="ads-yes"> Yes </label>
</div> <!-- the end of radio button outer div -->


<div><!-- the start of radio button outer div -->
<input type="radio" value="1" id="ads-no" name="ads" <?php if($cat['allow_ads']==1){echo "checked";} ?>/>
<label for="ads-no" > No </label>
</div> <!-- the end of radio button outer div -->


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the  allow_ads  end -->





<!-- the visibility start -->

<div class="row form-group">
<label class="col-sm-2 control-label"> Comments  
</label>
<div class="col-sm-10">


<div> <!-- the start of radio button outer div -->
<input type="radio" id="comments-yes" value="0" name="comments" <?php if($cat['allow_comments']==0){echo "checked";} ?> /> 
<label for="comments-yes"> Yes </label>
</div> <!-- the end of radio button outer div -->


<div><!-- the start of radio button outer div -->
<input type="radio" value="1" id="comments-no" name="comments" <?php if($cat['allow_comments']==1){echo "checked";} ?>/>
<label for="comments-no" > No </label>
</div> <!-- the end of radio button outer div -->


</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the  visibility end -->




<!-- the button start -->
<div class="row form-group">

<div class="col-sm-10 offset-sm-2">
<input type="submit" value="Update" class="btn btn-primary" />
</div> <!--  end col-sm-10 -->
</div> <!--   end form-group  -->
<!-- the button end -->

</form> <!-- end form-horizontal -->

</div> <!--  end container  -->

                <!------------------------------------------------------------------------ the end of th form   ---------------------------------------------->

                <?php 
                   
///////////////////////////////////////////howa dh ////////////////////////////////////////////////////////////////////////////
        }else{
            
            
            echo "<div class='container'> <br>";

            $theMsg = "<div class='alert alert-danger'> there is no data to that id </div>";
            
            redirectHome($theMsg, 'back');
            
            echo"</div>";
        
        
        }  ///the end of the third if
    


   




    

}elseif($do=='update'){

   
if($_SERVER['REQUEST_METHOD']== 'POST'){

$catId2 = $_POST['id'];
$name = $_POST['name'];
$desc = $_POST['describtion'];
$parent2 = $_POST['parent2'];
$order = $_POST['ordering'];
$visibility =$_POST['visibility'];
$ads = $_POST['ads'];
$comments = $_POST['comments'];


$stmt = $con->prepare("UPDATE categories SET name = ?, describtion = ?, parent = ?, ordering = ?, visibility = ?, allow_comments = ?, allow_ads = ?

WHERE id = ?
");
$stmt->execute(array($name,$desc, $parent2,$order,$visibility,$comments,$ads,$catId2));
$count = $stmt->rowCount();


    echo "<div class='container'>";
    $theMsg = "<div class='alert alert-success'> you Updated ". $count ." Category </div>";  

    redirectHome($theMsg,'back');
    echo "</div>";


} else{// $_SERVER['REQUEST_METHOD']
    echo "<div class='container'>";
    $theMsg = "<div class='alert alert-danger'> Sorry, You Must Go to That page By Post Method only </div>";
    redirectHome($theMsg,"back");
    echo "</div>";


}
//////////////////////////////////////////end of updata page/////////////////////////////////////////

}elseif($do=='delete'){

    echo "<div class='container'>";

$catId=isset($_GET['id'])&&is_numeric($_GET['id'])?intval($_GET['id']):0;

$checkItem = checkItem('id','categories',$catId);
if($checkItem == 1){
$stmt = $con->prepare("DELETE FROM categories WHERE id=:zid");
$stmt->bindParam(":zid",$catId);
$stmt->execute();
$count = $stmt->rowCount();

$theMsg = "<div class='alert alert-success'> You Have Deleted ". $count ." Category </div>";
redirectHome($theMsg,'back');
echo "</div>";
}else{ 
echo "<div class='container'>";
$theMsg="<div class='alert alert-danger'> There Is No Such Id </div>";
redirectHome($theMsg,'back');
echo "</div>";
}//end of the if of $checkItem==1

}//$do==delete

include $tpl.'footer.php';
}else{

header("Location: index.php");
exit();

}

ob_end_flush();











?>