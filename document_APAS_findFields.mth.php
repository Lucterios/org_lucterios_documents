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
// Method file write by SDK tool
// --- Last modification: Date 10 November 2011 20:43:49 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
require_once('extensions/org_lucterios_documents/document.tbl.php');
//@TABLES@

//@DESC@Recherche un document
//@PARAM@ 

function document_APAS_findFields(&$self)
{
//@CODE_ACTION@
$listCat="";
$DBCat=new DBObj_org_lucterios_documents_categorie;
$visuList=$DBCat->getVisuList();
foreach($visuList as $visuId=>$visuItem)
	  $listCat.="$visuId||$visuItem;";
$categorieDesc=array();
$categorieDesc['fieldname']='categorie';
$categorieDesc['description']='Dossier';
$categorieDesc['type']='list';
$categorieDesc['table.name']='org_lucterios_documents_document.categorie';
$categorieDesc['tables']=array('org_lucterios_documents_document');
$categorieDesc['wheres']=array();
$categorieDesc['list']=$listCat;

$fields=array();
$fields[]="nom";
$fields[]=$categorieDesc;
$fields[]="description";
$fields[]="dateModification";
$fields[]="dateCreation";
$fields[]="modificateur[realName]";
$fields[]="createur[realName]";
$fields[]="modificateur[login]";
$fields[]="createur[login]";
return $fields;
//@CODE_ACTION@
}

?>
