<?php
header('Access-Control-Allow-Origin: *');
include_once 'dbconfig.php';

$queryUser="SELECT * FROM user ";
$queryProduit="SELECT * FROM produit ";
$queryTbl_uploads="SELECT * FROM tbl_uploads ";
$queryRole="SELECT * FROM role ";
$queryPrivilege="SELECT * FROM privilege ";
$queryAttr_Priv_Role="SELECT * FROM attr_priv_role ";
$queryAttr_Role_User="SELECT * FROM attrib_role_user ";

$ExecReqUser = mysql_query($queryUser);
$ExecReqProduit = mysql_query($queryProduit);
$ExecReqTbl_uploads = mysql_query($queryTbl_uploads);
$ExecReqRole = mysql_query($queryRole);
$ExecReqPrivilege = mysql_query($queryPrivilege);
$ExecReqAttr_Priv_Role = mysql_query($queryAttr_Priv_Role);
$ExecReqAttr_Role_User = mysql_query($queryAttr_Role_User);

$User;
$TProduit;
$TTbl_uploads;
$TRole;
$TPrivilege;
$TAttr_Priv_Rol;
$TAttr_Rol_User;

while ($TUser[] = mysql_fetch_assoc($ExecReqUser)) {

}
while ($TProduit[] = mysql_fetch_assoc($ExecReqProduit)) {

}
while ($TTbl_uploads[] = mysql_fetch_assoc($ExecReqTbl_uploads)) {

}
while ($TRole[] = mysql_fetch_assoc($ExecReqRole)) {

}
while ($TPrivilege[] = mysql_fetch_assoc($ExecReqPrivilege)) {

}
while ($TAttr_Priv_Rol[] = mysql_fetch_assoc($ExecReqAttr_Priv_Role)) {

}
while ($TAttr_Rol_User[] = mysql_fetch_assoc($ExecReqAttr_Role_User)) {

}

$jsonEncodeUser = json_encode($TUser);
$jsonEncodeProduit = json_encode($TProduit);
$jsonEncodeTbl_uploads = json_encode($TTbl_uploads);
$jsonEncodeRole = json_encode($TRole);
$jsonEncodePrivilege = json_encode($TPrivilege);
$jsonEncodeAttr_Priv_Rol = json_encode($TAttr_Priv_Rol);
$jsonEncodeAttr_Rol_User = json_encode($TAttr_Rol_User);

echo "{" . "\"user\"" . ":" . $jsonEncodeUser . "}";


?>