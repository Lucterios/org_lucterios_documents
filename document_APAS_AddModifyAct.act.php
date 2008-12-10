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
// --- Last modification: Date 08 December 2008 22:46:51 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/users.tbl.php');
require_once('extensions/org_lucterios_documents/document.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un document
//@PARAM@ document
//@PARAM@ docfile

//@TRANSACTION:

//@LOCK:0

function document_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_documents", "document_APAS_AddModifyAct",$Params ,"document","docfile"))!=null)
	return $ret;
$document=getParams($Params,"document",0);
$docfile=getParams($Params,"docfile",0);
$self=new DBObj_org_lucterios_documents_document();

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_documents","document_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un document";
//@CODE_ACTION@
if($document>0)
	$find=$self->get($document);
$self->setFrom($Params);

global $LOGIN_ID;

$self->modificateur=$LOGIN_ID;
$self->dateModification=date('Y-m-d G:i:s');
if ($find)
	$self->update();
else {
	$self->createur=$LOGIN_ID;
	$self->dateCreation=date('Y-m-d G:i:s');
	$self->insert();
}

if (array_key_exists('docfile',$Params)) {
	$path = "usr/org_lucterios_documents";
	if(!is_dir($path))
		@mkdir($path,0777);
	$destination_file = $path."/document".$self->id;
	if (is_file($destination_file))
		@unlink($destination_file);
	require_once("CORE/saveFileDownloaded.mth.php");
	$ret = saveFileDownloaded($xfer_result,$Params,'docfile',$destination_file,true);
	if (!is_file($destination_file)) {
		require_once "CORE/Lucterios_Error.inc.php";
		throw new LucteriosException(IMPORTANT,"fichier non sauvé!");
	}
	if (!$find) {
		if ($zip=zip_open($destination_file)) {
    			if ($zip_entry = zip_read($zip)) {
				$self->nom=zip_entry_name($zip_entry);
				$self->update();
			}
			zip_close($zip);
		}
	}
}
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
