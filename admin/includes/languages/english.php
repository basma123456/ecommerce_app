
<?php

function lang($phrase){

static $lang = array(

////////////////////////////////////////////////
///dashboard page///////////////////////

'homeAdmin' => 'Home',
'categories' => 'Categories',
'settings' => 'Settings',
'logOut' => 'Log Out',
'editProfile' => 'Edit Profile',
'items' => 'Items',
'members' => 'Members',
'logs' => 'Logs',
'statistics' => 'Statistics',
'comments' => 'comments'

);

return $lang[$phrase];
}


?>