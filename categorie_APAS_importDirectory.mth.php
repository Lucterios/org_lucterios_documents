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
// --- Last modification: Date 23 February 2010 11:45:30 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/document.tbl.php');
require_once('extensions/org_lucterios_documents/modification.tbl.php');
require_once('extensions/org_lucterios_documents/visualisation.tbl.php');
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@

//@DESC@Importer une arborescence complete
//@PARAM@ currentPath
//@PARAM@ modification
//@PARAM@ visualisation
//@PARAM@ name=''

function categorie_APAS_importDirectory(&$self,$currentPath,$modification,$visualisation,$name='')
{
//@CODE_ACTION@
$nbDir=0;
$nbFile=0;
if ($name!='') {
	$NewCat=new DBObj_org_lucterios_documents_categorie;
	$NewCat->nom=$name;
	$NewCat->parent=$self->id;
	if ($NewCat->find()>0)
		$NewCat->fetch();
	else {
		$NewCat=new DBObj_org_lucterios_documents_categorie;
		$NewCat->nom=$name;
		$NewCat->description='';
		$NewCat->parent=$self->id;
		$NewCat->insert();
		$visu_list=split(';',$visualisation);
		foreach($visu_list as $visu_item) {
			$visu_item=(int)$visu_item;
			if ($visu_item>0) {
				$DBVisu=new DBObj_org_lucterios_documents_visualisation;
				$DBVisu->categorie=$NewCat->id;
				$DBVisu->groupe=$visu_item;
				$DBVisu->insert();
			}
		}
		$modif_list=split(';',$modification);
		foreach($modif_list as $modif_item) {
			$modif_item=(int)$modif_item;
			if ($modif_item>0) {
				$DBVisu=new DBObj_org_lucterios_documents_modification;
				$DBVisu->categorie=$NewCat->id;
				$DBVisu->groupe=$modif_item;
				$DBVisu->insert();
			}
		}
		$nbDir++;
	}
}
else
	$NewCat=$self;

$dh = opendir($currentPath);
while(($file = readdir($dh)) != false) {
	if (($file[0] != '.') && is_dir($currentPath.$file)) {
		List($subNbDir,$subNbFile)=$NewCat->importDirectory($currentPath.$file.'/',$modification, $visualisation, $file);
		$nbDir+=$subNbDir;
		$nbFile+=$subNbFile;
	}
	else if (is_file($currentPath.$file)) {
		global $LOGIN_ID;
		$new_doc=new DBObj_org_lucterios_documents_document;
		$new_doc->categorie=$NewCat->id;
		$new_doc->nom=$file;
		if ($new_doc->find()>0)
			$new_doc->fetch();
		else {
			$new_doc=new DBObj_org_lucterios_documents_document;
			$new_doc->categorie=$NewCat->id;
			$new_doc->nom=$file;
			$new_doc->description="Fichier '$file' importé en lot.";
			$new_doc->modificateur=$LOGIN_ID;
			$new_doc->dateModification=date('Y-m-d G:i:s');
			$new_doc->createur=$LOGIN_ID;
			$new_doc->dateCreation=date('Y-m-d G:i:s');
			$new_doc->insert();
			global $rootPath;
			if(!isset($rootPath))
				$rootPath = "";
			$path = $rootPath."usr/org_lucterios_documents";
			if(!is_dir($path))
				@mkdir($path,0777);
			$destination_file = $path."/document".$new_doc->id;
			if(!is_file($destination_file))
				@unlink($destination_file);
			$zip = new ZipArchive;
			if ($zip->open($destination_file, ZipArchive::CREATE) === TRUE) {
			    $zip->addFile($currentPath.$file, $file);
			    $zip->close();
			}
			$nbFile++;
		}
	}
}
closedir($dh);

return array($nbDir,$nbFile);
//@CODE_ACTION@
}

?>
