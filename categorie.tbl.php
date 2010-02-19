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
//  // table file write by SDK tool
// --- Last modification: Date 18 February 2010 23:53:07 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_documents_categorie extends DBObj_Basic
{
	var $Title="";
	var $tblname="categorie";
	var $extname="org_lucterios_documents";
	var $__table="org_lucterios_documents_categorie";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $nom;
	var $description;
	var $parent;
	var $visualisation;
	var $modification;
	var $files;
	var $folders;
	var $__DBMetaDataField=array('nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>50, 'Multi'=>false)), 'description'=>array('description'=>'Description', 'type'=>7, 'notnull'=>false, 'params'=>array()), 'parent'=>array('description'=>'Dossier Parent', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_categorie')), 'visualisation'=>array('description'=>'Groupes de consultation', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_visualisation', 'RefField'=>'categorie')), 'modification'=>array('description'=>'Groupes de modification', 'type'=>9, 'notnull'=>true, 'params'=>array('TableName'=>'org_lucterios_documents_modification', 'RefField'=>'categorie')), 'files'=>array('description'=>'Fichiers', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_document', 'RefField'=>'categorie')), 'folders'=>array('description'=>'Sous-dossiers', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_categorie', 'RefField'=>'parent')));

	var $__toText='$nom';
}

?>
