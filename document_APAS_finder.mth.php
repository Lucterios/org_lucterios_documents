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
// --- Last modification: Date 16 December 2008 23:51:49 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
require_once('extensions/org_lucterios_documents/document.tbl.php');
//@TABLES@

//@DESC@Recherche un document
//@PARAM@ posY
//@PARAM@ simple
//@PARAM@ xfer_result

function document_APAS_finder(&$self,$posY,$simple,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBSearch($self,"nom",$posY++);
$xfer_result->setDBSearch($self,"categorie",$posY++);
$cat=$xfer_result->getComponents("categorie_value1");
$DBCat=new DBObj_org_lucterios_documents_categorie;
$cat->setSelect($DBCat->getVisuList());

$xfer_result->setDBSearch($self,"description",$posY++);
$xfer_result->setDBSearch($self,"modificateur",$posY++);
$xfer_result->setDBSearch($self,"dateModification",$posY++);
$xfer_result->setDBSearch($self,"createur",$posY++);
$xfer_result->setDBSearch($self,"dateCreation",$posY++);
return $xfer_result;
//@CODE_ACTION@
}

?>