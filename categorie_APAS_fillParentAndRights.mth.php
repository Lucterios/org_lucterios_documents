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
// --- Last modification: Date 18 February 2010 22:42:27 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/groups.tbl.php');
require_once('CORE/users.tbl.php');
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function categorie_APAS_fillParentAndRights(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBObject($self,"parent",false,$posY++,$posX);
$parent=$xfer_result->getComponents("parent");
$parent->m_select[0]="---";

if ($self->id==0) {
	global $LOGIN_ID;
	$DBUser=new DBObj_CORE_users;
	$DBUser->get($LOGIN_ID);
	$current_group=$DBUser->groupId;
}

$lbl=new xfer_comp_LabelForm('labelvisualisation');
$lbl->setLocation($posX,$posY);
$lbl->setValue("{[bold]}Groupes de consultation{[/bold]}");
$xfer_result->addComponent($lbl);

$sel=new Xfer_Comp_CheckList('visualisation');
$sel->setLocation($posX+1,$posY++);
$val=array();
if ($self->id>0) {
	$visu=$self->getField('visualisation');
	while($visu->fetch())
		$val[]=$visu->groupe;
}
else
	$val[]=$current_group;
$sel->setValue($val);
$select=array();
$DBGroup=new DBObj_CORE_groups;
$DBGroup->find();
while ($DBGroup->fetch())
	$select[$DBGroup->id]=$DBGroup->toText();
$sel->setSelect($select);
$xfer_result->addComponent($sel);

$lbl=new xfer_comp_LabelForm('labelmodification');
$lbl->setLocation($posX,$posY);
$lbl->setValue("{[bold]}Groupes de modification{[/bold]}");
$xfer_result->addComponent($lbl);

$sel=new Xfer_Comp_CheckList('modification');
$sel->setLocation($posX+1,$posY++);
$val=array();
if ($self->id>0) {
	$modif=$self->getField('modification');
	while($modif->fetch())
		$val[]=$modif->groupe;
}
else
	$val[]=$current_group;
$sel->setValue($val);
$select=array();
$DBGroup=new DBObj_CORE_groups;
$DBGroup->find();
while ($DBGroup->fetch())
	$select[$DBGroup->id]=$DBGroup->toText();
$sel->setSelect($select);
$xfer_result->addComponent($sel);

return $xfer_result;
//@CODE_ACTION@
}

?>
