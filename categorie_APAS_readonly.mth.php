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
// --- Last modification: Date 08 December 2008 22:00:02 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/modification.tbl.php');
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ 

function categorie_APAS_readonly(&$self)
{
//@CODE_ACTION@
global $LOGIN_ID;
$DBMod=new DBObj_org_lucterios_documents_modification;
$Q="SELECT org_lucterios_documents_modification.*
FROM org_lucterios_documents_modification,CORE_users
WHERE org_lucterios_documents_modification.groupe=CORE_users.groupId
AND CORE_users.id=$LOGIN_ID
AND org_lucterios_documents_modification.categorie=".$self->id;
$DBMod->query($Q);
$DBMod->fetch();
return ($DBMod->id==0);
//@CODE_ACTION@
}

?>
