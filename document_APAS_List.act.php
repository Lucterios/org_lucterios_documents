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
// --- Last modification: Date 08 February 2009 13:16:22 By  ---

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
$lbl->setLocation(1,0,4);
$xfer_result->addComponent($lbl);
$readonly=true;
if ($IsSearch!=0)
{
	global $LOGIN_ID;
	$self->setForSearch($Params,'categorie',"org_lucterios_documents_document.categorie=org_lucterios_documents_visualisation.categorie AND
 org_lucterios_documents_visualisation.Groupe=CORE_users.groupId AND CORE_users.id=$LOGIN_ID",array('org_lucterios_documents_visualisation','CORE_users'));
	$lbl->setValue("{[center]}{[bold]}Résultat de la recherche{[/bold]}{[/center]}");
	$grid_x=0;
}
else {
	$lbl->setValue("{[center]}{[bold]}Liste des documents{[/bold]}{[/center]}");

	$lbl=new  Xfer_Comp_LabelForm('lblcat');
	$lbl->setValue("{[bold]}Dossier courant:{[/bold]}");
	$lbl->setLocation(0,1);
	$xfer_result->addComponent($lbl);

	$DBcat=new DBObj_org_lucterios_documents_categorie;
	$DBcat->get($categorie);
	$readonly=$DBcat->readonly();
	$list_folders=array();
	if ($categorie>0)
		$list_folders[$DBcat->parent]="..";

	$lbl=new  Xfer_Comp_LabelForm('lbltitlecat');
	if ($categorie>0)
		$lbl->setValue($DBcat->getTitle());
	else
		$lbl->setValue('>');
	$lbl->setLocation(1,1,2);
	$xfer_result->addComponent($lbl);

	$lbl=new  Xfer_Comp_LabelForm('lbldesc');
	$lbl->setValue("{[center]}{[italic]}".$DBcat->description."{[/italic]}{[/center]}");
	$lbl->setLocation(3,1);
	$xfer_result->addComponent($lbl);

	$grid_x=2;
	$DBcat=new DBObj_org_lucterios_documents_categorie;
	$list=$DBcat->getVisuList((int)$categorie);
	foreach($list as $id=>$name)
		$list_folders[$id]=$name;
	$lbl=new Xfer_Comp_CheckList('categorie');
	$lbl->simple=true;
	$lbl->setSelect($list_folders);
	$lbl->setLocation(0,3,$grid_x);
	$lbl->setSize(100,50);
	$lbl->setAction($self->NewAction('','','List',FORMTYPE_REFRESH,CLOSE_NO));
	$xfer_result->addComponent($lbl);

	$lbl=new  Xfer_Comp_Button('btnConfig');
	$lbl->setLocation(0,4,$grid_x);
	$lbl->setAction($DBcat->NewAction('_Dossiers...','','List',FORMTYPE_MODAL,CLOSE_NO));
	$xfer_result->addComponent($lbl);

	$self->categorie=$categorie;
	$self->find();
}
$grid = $self->getGrid($IsSearch,$readonly,$Params);
$grid->setLocation($grid_x,3,4-$grid_x);
$xfer_result->addComponent($grid);
$lbl=new Xfer_Comp_LabelForm("nb");
$lbl->setLocation($grid_x,4,4-$grid_x);
$lbl->setValue("Nombre total : ".$grid->mNbLines);
$xfer_result->addComponent($lbl);
if ($IsSearch!=0)
	$xfer_result->addAction($self->NewAction("Nouvelle _Recherche","search.png","Search",FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Fermer", "close.png"));
$xfer_result->m_context['current_categorie']=$categorie;
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
