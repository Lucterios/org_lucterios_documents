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
//  // library file write by SDK tool
// --- Last modification: Date 09 December 2008 22:41:13 By  ---

//@BEGIN@
function org_lucterios_documents_status(&$result)
{
	$lab = new Xfer_Comp_LabelForm('documenttitle');
	$lab->setValue("{[center]}{[italc]}Gestion documentaire{[/italc]}{[/center]}");
	$lab->setLocation(0,30,2);
	$result->addComponent($lab);
	require_once"extensions/org_lucterios_documents/document.tbl.php";
	$DBdoc = new DBObj_org_lucterios_documents_document;
	$nb=$DBdoc->find();
	$lbl_doc = new Xfer_Comp_LabelForm('lbl_nbdocument');
	$lbl_doc->setLocation(0,31,2);
	$pluriel=($nb>1)?'s':'';
	$lbl_doc->setValue("{[center]}$nb fichier$pluriel actuellement disponible$pluriel{[/center]}");
	$result->addComponent($lbl_doc);
}
//@END@
?>
