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
//  // Method file write by SDK tool
// --- Last modification: Date 08 December 2008 22:50:07 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
require_once('extensions/org_lucterios_documents/document.tbl.php');
//@TABLES@

//@DESC@Editer un document
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function document_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
if ($self->id>0)
	$xfer_result->setDBObject($self,"nom",true,$posY++,$posX);

$xfer_result->setDBObject($self,"categorie",false,$posY++,$posX);
$cat=$xfer_result->getComponents("categorie");
$DBCat=new DBObj_org_lucterios_documents_categorie;
$cat->setSelect($DBCat->getModifList());

$xfer_result->setDBObject($self,"description",false,$posY++,$posX);
if ($self->id>0) {
	$xfer_result->setDBObject($self,"modificateur",true,$posY++,$posX);
	$xfer_result->setDBObject($self,"dateModification",true,$posY++,$posX);
	$xfer_result->setDBObject($self,"createur",true,$posY++,$posX);
	$xfer_result->setDBObject($self,"dateCreation",true,$posY++,$posX);
}

if ($self->id==0) {
	$docfile=new Xfer_Comp_UpLoad('docfile');
	$docfile->compress=true;
	$docfile->HttpFile=true;
	$docfile->needed=true;
	$docfile->setValue('Fichier à inserer');
	$docfile->setLocation($posX,$posY++,2);
	$xfer_result->addComponent($docfile);
}
return $xfer_result;
//@CODE_ACTION@
}

?>
