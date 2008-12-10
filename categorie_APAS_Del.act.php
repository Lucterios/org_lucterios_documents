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
// --- Last modification: Date 08 December 2008 0:02:05 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Supprimer une catégorie
//@PARAM@ 
//@INDEX:categorie

//@TRANSACTION:

//@LOCK:2

function categorie_APAS_Del($Params)
{
$self=new DBObj_org_lucterios_documents_categorie();
$categorie=getParams($Params,"categorie",-1);
if ($categorie>=0) $self->get($categorie);

$self->lockRecord("categorie_APAS_Del");

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_documents","categorie_APAS_Del",$Params);
$xfer_result->Caption="Supprimer une catégorie";
$xfer_result->m_context['ORIGINE']="categorie_APAS_Del";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->canBeDelete()!=0)
	$xfer_result->message("Suppression impossible: cette catégorie est utilisée!");
else if($xfer_result->confirme("Etes vous sûre de vouloir supprimer cette catégorie?"))
	$self->deleteCascade();
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	$self->unlockRecord("categorie_APAS_Del");
	throw $e;
}
return $xfer_result;
}

?>
