<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Action file write by SDK tool
// --- Last modification: Date 06 February 2009 23:57:34 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/modification.tbl.php');
require_once('extensions/org_lucterios_documents/visualisation.tbl.php');
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un dossier
//@PARAM@ categorie
//@PARAM@ visualisation
//@PARAM@ modification

//@TRANSACTION:

//@LOCK:0

function categorie_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_documents", "categorie_APAS_AddModifyAct",$Params ,"categorie","visualisation","modification"))!=null)
	return $ret;
$categorie=getParams($Params,"categorie",0);
$visualisation=getParams($Params,"visualisation",0);
$modification=getParams($Params,"modification",0);
$self=new DBObj_org_lucterios_documents_categorie();

global $connect;
$connect->begin();
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_documents","categorie_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un dossier";
//@CODE_ACTION@
if($categorie>0)
	$find=$self->get($categorie);
$self->setFrom($Params);
if ($find)
	$self->update();
else
	$self->insert();

global $connect;

$connect->execute('DELETE FROM org_lucterios_documents_visualisation WHERE categorie='.$self->id,true);
$visu_list=explode(';',$visualisation);
foreach($visu_list as $visu_item) {
	$DBVisu=new DBObj_org_lucterios_documents_visualisation;
	$DBVisu->categorie=$self->id;
	$DBVisu->groupe=$visu_item;
	$DBVisu->insert();
}

$connect->execute('DELETE FROM org_lucterios_documents_modification WHERE categorie='.$self->id,true);
$modif_list=explode(';',$modification);
foreach($modif_list as $modif_item) {
	$DBVisu=new DBObj_org_lucterios_documents_modification;
	$DBVisu->categorie=$self->id;
	$DBVisu->groupe=$modif_item;
	$DBVisu->insert();
}
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
