<?php
// 	This file is part of Lucterios/Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Lucterios/Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Lucterios/Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// table file write by SDK tool
// --- Last modification: Date 26 October 2011 6:04:44 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_documents_categorie extends DBObj_Basic
{
	public $Title="";
	public $tblname="categorie";
	public $extname="org_lucterios_documents";
	public $__table="org_lucterios_documents_categorie";

	public $DefaultFields=array();
	public $NbFieldsCheck=1;
	public $Heritage="";
	public $PosChild=-1;

	public $nom;
	public $description;
	public $parent;
	public $visualisation;
	public $modification;
	public $files;
	public $folders;
	public $__DBMetaDataField=array('nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>50, 'Multi'=>false)), 'description'=>array('description'=>'Description', 'type'=>7, 'notnull'=>false, 'params'=>array()), 'parent'=>array('description'=>'Dossier Parent', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_categorie')), 'visualisation'=>array('description'=>'Groupes de consultation', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_visualisation', 'RefField'=>'categorie')), 'modification'=>array('description'=>'Groupes de modification', 'type'=>9, 'notnull'=>true, 'params'=>array('TableName'=>'org_lucterios_documents_modification', 'RefField'=>'categorie')), 'files'=>array('description'=>'Fichiers', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_document', 'RefField'=>'categorie')), 'folders'=>array('description'=>'Sous-dossiers', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_categorie', 'RefField'=>'parent')));

	public $__toText='$nom';
}

?>
