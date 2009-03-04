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
// --- Last modification: Date 07 February 2009 0:00:38 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_documents_document extends DBObj_Basic
{
	var $Title="";
	var $tblname="document";
	var $extname="org_lucterios_documents";
	var $__table="org_lucterios_documents_document";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $categorie;
	var $nom;
	var $description;
	var $modificateur;
	var $dateModification;
	var $createur;
	var $dateCreation;
	var $__DBMetaDataField=array('categorie'=>array('description'=>'Dossier', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_documents_categorie')), 'nom'=>array('description'=>'Nom du fichier', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'description'=>array('description'=>'Description', 'type'=>7, 'notnull'=>true, 'params'=>array()), 'modificateur'=>array('description'=>'Dernier modificateur', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'CORE_users')), 'dateModification'=>array('description'=>'Date dernier modification', 'type'=>6, 'notnull'=>false, 'params'=>array()), 'createur'=>array('description'=>'Créateur', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'CORE_users')), 'dateCreation'=>array('description'=>'Date de création', 'type'=>6, 'notnull'=>true, 'params'=>array()));

	var $__toText='$nom';
}

?>
