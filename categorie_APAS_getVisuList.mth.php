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
// --- Last modification: Date 09 January 2010 14:28:48 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ Folder=0

function categorie_APAS_getVisuList(&$self,$Folder=0)
{
//@CODE_ACTION@
$result=array();

global $LOGIN_ID;
$DBCat=new DBObj_org_lucterios_documents_categorie;
$Q="SELECT org_lucterios_documents_categorie.*
FROM org_lucterios_documents_categorie,org_lucterios_documents_visualisation,CORE_users
WHERE org_lucterios_documents_categorie.id=org_lucterios_documents_visualisation.categorie
AND org_lucterios_documents_visualisation.groupe=CORE_users.groupId
AND CORE_users.id=$LOGIN_ID";
if ($Folder>0)
	$Q.=" AND org_lucterios_documents_categorie.parent=$Folder";
else
	$Q.=" AND org_lucterios_documents_categorie.parent IS NULL";
$Q.=" ORDER BY org_lucterios_documents_categorie.nom";
$DBCat->query($Q);

while ($DBCat->fetch())
	$result[$DBCat->id]=$DBCat->toText();

return $result;
//@CODE_ACTION@
}

?>
