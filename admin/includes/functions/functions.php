<?php



function getTitle(){

global $pageTitle;

if(isset($pageTitle)){

echo $pageTitle;

}else{

echo 'Default';
}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////


/* redirectHome v2 */

function redirectHome($theMsg, $url = null, $seconds=3){


echo "<div>" . $theMsg . "</div>";

echo "<div class='alert alert-info'> The Page will be redirect automatically after " . $seconds . "seconds </div>";

if($url == null){

    $url = 'index.php';

}else{

        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){

            $url = $_SERVER['HTTP_REFERER'];

        }else{ $url = 'index.php'; } // the end of if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''

} // the end of else of if of url === null



header("refresh:$seconds; url= $url");
exit();

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////


/* checkItem   v1 */

function checkItem($select, $from, $value){


global $con;

$statement = $con->prepare("SELECT $select FROM $from WHERE $select=?");

$statement->execute(array($value));
$count = $statement->rowCount();

return $count;


}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/* countItems function v1 */

function countItems($item,$table){

    global $con;


    $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
 

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* get latest items functions */

function getLatest($select,$table,$order,$limit){

global $con;

$stmt3 = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

$stmt3->execute();
$rows = $stmt3->fetchAll();     
return $rows;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

/* this is the function of the functions which is can apply to most the cases in the est3lamat */

function getAll($select , $table , $where1=NULL , $and=NULL , $order , $ordering='DESC'){

    global $con;

    $gets = $con->prepare("SELECT $select FROM $table $where1 $and ORDER BY $order $ordering");
    $gets->execute();
    $fetchGets = $gets->fetchAll();
    return $fetchGets;
}
















?>