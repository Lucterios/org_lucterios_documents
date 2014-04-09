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
// --- Last modification: Date 18 February 2010 23:06:38 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Import multiple depuis un fichier zip
//@PARAM@ 


//@LOCK:0

function categorie_APAS_ImportZip($Params)
{
$self=new DBObj_org_lucterios_documents_categorie();
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_documents","categorie_APAS_ImportZip",$Params);
$xfer_result->Caption="Import multiple depuis un fichier zip";
//@CODE_ACTION@
$img=new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,2);
$img->setValue("documentConf.png");
$xfer_result->addComponent($img);

$zipfile=new Xfer_Comp_UpLoad('zipfile');
$zipfile->compress=false;
$zipfile->HttpFile=true;
include_once("CORE/fichierFonctions.inc.php");
$zipfile->maxsize=taille_max_dl_fichier();
$zipfile->needed=true;
$zipfile->setValue('Fichier zip à inserer');
$zipfile->addFilter('zip');
$zipfile->addFilter('ZIP');
$zipfile->setLocation(1,1,2);
$xfer_result->addComponent($zipfile);

$self->parent=0;
$xfer_result=$self->fillParentAndRights(1, 2, $xfer_result);

$xfer_result->addAction($self->newAction("_Ok", "ok.png", "ImportZipAct",FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Annuler", "cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
