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
// --- Last modification: Date 03 February 2010 9:08:26 By  ---

//@BEGIN@
function org_lucterios_documents_status(&$result)
{
	$lab = new Xfer_Comp_LabelForm('documenttitle');
	$lab->setValue('{[center]}{[bold]}{[underline]}Gestion documentaire{[/underline]}{[/bold]}{[/center]}');
	$lab->setLocation(0,70,4);
	$result->addComponent($lab);
	require_once"extensions/org_lucterios_documents/document.tbl.php";
	$DBdoc = new DBObj_org_lucterios_documents_document;
	$nb=$DBdoc->find();
	$lbl_doc = new Xfer_Comp_LabelForm('lbl_nbdocument');
	$lbl_doc->setLocation(0,71,4);
	$pluriel=($nb>1)?'s':'';
	$lbl_doc->setValue("{[center]}$nb fichier$pluriel actuellement disponible$pluriel{[/center]}");
	$result->addComponent($lbl_doc);

	require_once "CORE/fichierFonctions.inc.php";
     $remaining_size=getRemainingStorageSize();
     if (is_array($remaining_size)) {
		$size_value=convert_taille($remaining_size[0]);
		$max_size=convert_taille($remaining_size[1]);
		$lbl_doc = new Xfer_Comp_LabelForm('lbl_remainingsize');
		$lbl_doc->setLocation(0,72,4);
		$lbl_doc->setValue("{[center]}{[italic]}Taille de stockage: restant $size_value sur $max_size{[/italic]}{[/center]}");
		$result->addComponent($lbl_doc);
	}
	$lab = new Xfer_Comp_LabelForm('documentend');
	$lab->setValue('{[center]}{[hr/]}{[/center]}');
	$lab->setLocation(0,73,4);
	$result->addComponent($lab);
}
//@END@
?>
