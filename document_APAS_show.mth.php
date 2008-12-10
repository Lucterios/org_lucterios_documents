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
// --- Last modification: Date 08 December 2008 22:41:18 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/document.tbl.php');
//@TABLES@

//@DESC@Voir un document
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function document_APAS_show(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$path = "usr/org_lucterios_documents";
$destination_file = $path."/document".$self->id;
if (!is_file($destination_file)) {
	require_once "CORE/Lucterios_Error.inc.php";
	throw new LucteriosException(IMPORTANT,"fichier non trouvé!");
}
$DBcat=$self->getfield("categorie");
$readonly=$DBcat->readonly();

$xfer_result->setDBObject($self,"categorie",true,$posY++,$posX);
$xfer_result->setDBObject($self,"description",true,$posY++,$posX);
$xfer_result->setDBObject($self,"modificateur",true,$posY++,$posX);
$xfer_result->setDBObject($self,"dateModification",true,$posY++,$posX);
$xfer_result->setDBObject($self,"createur",true,$posY++,$posX);
$xfer_result->setDBObject($self,"dateCreation",true,$posY++,$posX);

$down=new Xfer_Comp_DownLoad('docfile');
$down->compress=true;
$down->HttpFile=true;
$down->setValue($self->nom);
$down->setFileName($destination_file);
if (!$readonly)
	$down->setAction($self->NewAction('','','AddModifyAct'));
$down->setLocation($posX,$posY++,2);
$xfer_result->addComponent($down);
$xfer_result->readonly=$readonly;

return $xfer_result;
//@CODE_ACTION@
}

?>
