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
// --- Last modification: Date 18 February 2010 22:37:29 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@

//@DESC@Editer un dossier
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function categorie_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
if ($self->parent==null)
	$self->parent=0;
$xfer_result->setDBObject($self,"nom",false,$posY++,$posX);
$xfer_result->setDBObject($self,"description",false,$posY++,$posX);

$xfer_result=$self->fillParentAndRights($posX, $posY, $xfer_result);

return $xfer_result;
//@CODE_ACTION@
}

?>
