<?php
// 	This file is part of Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
// table file write by SDK tool
// --- Last modification: Date 11 November 2011 10:54:30 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_documents_document extends DBObj_Basic
{
	public $Title="";
	public $tblname="document";
	public $extname="org_lucterios_documents";
	public $__table="org_lucterios_documents_document";

	public $DefaultFields=array();
	public $NbFieldsCheck=1;
	public $Heritage="";
	public $PosChild=-1;

	public $categorie;
	public $nom;
	public $description;
	public $modificateur;
	public $dateModification;
	public $createur;
	public $dateCreation;
	public $__DBMetaDataField=array('categorie'=>array('description'=>'Dossier', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_categorie')), 'nom'=>array('description'=>'Nom du fichier', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'description'=>array('description'=>'Description', 'type'=>7, 'notnull'=>true, 'params'=>array()), 'modificateur'=>array('description'=>'Dernier modificateur', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'CORE_users')), 'dateModification'=>array('description'=>'Date dernier modification', 'type'=>6, 'notnull'=>false, 'params'=>array()), 'createur'=>array('description'=>'Créateur', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'CORE_users')), 'dateCreation'=>array('description'=>'Date de création', 'type'=>6, 'notnull'=>true, 'params'=>array()));

	public $__toText='$nom';
}

?>
