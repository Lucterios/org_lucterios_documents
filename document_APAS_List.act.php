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
//  // Action file write by SDK tool
// --- Last modification: Date 09 December 2008 22:35:26 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
require_once('extensions/org_lucterios_documents/document.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des documents
//@PARAM@ categorie=0
//@PARAM@ IsSearch=0


//@LOCK:0

function document_APAS_List($Params)
{
$categorie=getParams($Params,"categorie",0);
$IsSearch=getParams($Params,"IsSearch",0);
$self=new DBObj_org_lucterios_documents_document();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_documents","document_APAS_List",$Params);
$xfer_result->Caption="Liste des documents";
//@CODE_ACTION@
$img=new  Xfer_Comp_Image("img");
$img->setLocation(0,0);
$img->setValue("document.png");
$xfer_result->addComponent($img);
$lbl=new  Xfer_Comp_LabelForm("titre");
$lbl->setLocation(1,0,3);
$xfer_result->addComponent($lbl);
$readonly=true;
if ($IsSearch!=0)
{
	global $LOGIN_ID;
	$self->setForSearch($Params,'categorie',"org_lucterios_documents_document.categorie=org_lucterios_documents_visualisation.categorie AND
 org_lucterios_documents_visualisation.Groupe=CORE_users.groupId AND CORE_users.id=$LOGIN_ID",array('org_lucterios_documents_visualisation','CORE_users'));
	$lbl->setValue("{[center]}{[bold]}Résultat de la recherche{[/bold]}{[/center]}");
}
else {
	$lbl->setValue("{[center]}{[bold]}Liste des documents{[/bold]}{[/center]}");

	$lbl=new  Xfer_Comp_LabelForm('lblcat');
	$lbl->setValue("{[bold]}Catégorie{[/bold]}");
	$lbl->setLocation(1,1,2);
	$lbl->setSize(20,120);
	$xfer_result->addComponent($lbl);
	$DBcat=new DBObj_org_lucterios_documents_categorie;
	$list=$DBcat->getVisuList();
	if (count($list)==0) {
		require_once('CORE/Lucterios_Error.inc.php');
		throw new LucteriosException(IMPORTANT,"Aucune catégorie n'est accessible!");
	}
	if ($categorie==0) {
		$key=array_keys($list);
		$categorie=$key[0];
	}
	$lbl=new Xfer_Comp_Select('categorie');
	$lbl->setSelect($list);
	$lbl->setValue($categorie);
	$lbl->setSize(20,100);
	$lbl->setLocation(1,2,2);
	$lbl->setAction($self->NewAction('','','List',FORMTYPE_REFRESH,CLOSE_NO));
	$xfer_result->addComponent($lbl);
	$self->categorie=$categorie;
	$self->find();

	$DBcat=new DBObj_org_lucterios_documents_categorie;
	$DBcat->get($categorie);
	$readonly=$DBcat->readonly();
	$lbl=new  Xfer_Comp_LabelForm('lbldesc');
	$lbl->setValue("{[center]}{[italic]}".$DBcat->description."{[/italic]}{[/center]}");
	$lbl->setLocation(3,1,1,2);
	$xfer_result->addComponent($lbl);
}
$grid = $self->getGrid($IsSearch,$readonly,$Params);
$grid->setLocation(0,3,4);
$xfer_result->addComponent($grid);
$lbl=new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0, 4,4);
$lbl->setValue("Nombre affichés : ".count($grid->m_records));
$xfer_result->addComponent($lbl);
if ($IsSearch!=0)
	$xfer_result->addAction($self->NewAction("Nouvelle _Recherche","search.png","Search",FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Fermer", "close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
