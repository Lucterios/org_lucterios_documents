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
// --- Last modification: Date 15 October 2009 20:37:17 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@

//@DESC@Retour la visualisation sous forme d'arbre
//@PARAM@ folder=0

function categorie_APAS_getVisuTree(&$self,$folder=0)
{
//@CODE_ACTION@
define('ROOT','--/');
define('SUB' ,'--');
$tree=array();
$prefix="";
if ($folder==0) {
	$tree[0]="/";
	$prefix1=ROOT;
	$prefix2=SUB;
}
$DBCat=new DBObj_org_lucterios_documents_categorie;
$DBCat->parent=$folder;
$DBCat->find();
while ($DBCat->fetch()) {
	$id=$DBCat->id;
	$name=$DBCat->nom;
	$tree[$id]=$prefix1.$name;
	$sub_tree=$self->getVisuTree($id);
	foreach($sub_tree as $sub_id=>$value) {
		if (substr($value,0,3)==ROOT)
			$value=$prefix2.SUB.$value;
		else
			$value=$prefix2.ROOT.$value;
		$tree[$sub_id]=$value;
	}
}
return $tree;
//@CODE_ACTION@
}

?>
