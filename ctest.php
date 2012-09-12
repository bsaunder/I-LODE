<?

setcookie("ILOUserAuth", "yes",time()+14400);
$ILOUserAuth = $HTTP_COOKIE_VARS["ILOUserAuth"]; 
echo $ILOUserAuth;

?>