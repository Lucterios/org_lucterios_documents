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
// --- Last modification: Date 17 October 2009 19:48:39 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@
//@PARAM@ 
//@INDEX:categorie


//@LOCK:0

function categorie_APAS_Add($Params)
{
$self=new DBObj_org_lucterios_documents_categorie();
$categorie=getParams($Params,"categorie",-1);
if ($categorie>=0) $self->get($categorie);
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_documents","categorie_APAS_Add",$Params);
$xfer_result->Caption="";
//@CODE_ACTION@
$xfer_result->m_context['parent']=$categorie;
unset($xfer_result->m_context['categorie']);
$xfer_result->redirectAction($self->NewAction('','','AddModify',FORMTYPE_MODAL,CLOSE_YES));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
