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
// --- Last modification: Date 23 February 2010 11:48:03 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Import multiple depuis un fichier zip
//@PARAM@ zipfile
//@PARAM@ modification
//@PARAM@ visualisation
//@INDEX:parent


//@LOCK:0

function categorie_APAS_ImportZipAct($Params)
{
if (($ret=checkParams("org_lucterios_documents", "categorie_APAS_ImportZipAct",$Params ,"zipfile","modification","visualisation"))!=null)
	return $ret;
$zipfile=getParams($Params,"zipfile",0);
$modification=getParams($Params,"modification",0);
$visualisation=getParams($Params,"visualisation",0);
$self=new DBObj_org_lucterios_documents_categorie();
$parent=getParams($Params,"parent",-1);
if ($parent>=0) $self->get($parent);
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_documents","categorie_APAS_ImportZipAct",$Params);
$xfer_result->Caption="Import multiple depuis un fichier zip";
//@CODE_ACTION@
if (array_key_exists('zipfile',$Params)) {
	global $rootPath;
	if(!isset($rootPath))
		$rootPath = "";
	$path = $rootPath."tmp";
	if(!is_dir($path))
		@mkdir($path,0777);
	$destination_file = $path."/import.zip";
	if (is_file($destination_file))
		@unlink($destination_file);
	require_once("CORE/saveFileDownloaded.mth.php");
	$ret = saveFileDownloaded($xfer_result,$Params,'zipfile',$destination_file,true);
	if (!is_file($destination_file)) {
		require_once "CORE/Lucterios_Error.inc.php";
		throw new LucteriosException(IMPORTANT,"fichier non sauvé!");
	}

	$destination_zip_path = $path."/import_zip/";
	require_once("CORE/extensionManager.inc.php");
	if (!is_dir($destination_zip_path))
		deleteDir($destination_zip_path);

	try {
		$zip = new ZipArchive;
	     	if ($zip->open($destination_file)===true) {
			$zip->extractTo($destination_zip_path);
			$zip->close();
			List($nbDir,$nbFile)=$self->importDirectory($destination_zip_path,$modification, $visualisation);
			$xfer_result->message("{[italic]}Import terminé{[/italic]}{[newline]} - $nbDir dossier(s) créé(s).{[newline]} - $nbFile fichier(s) importée(s).");
     		}
		@unlink($destination_file);
		deleteDir($destination_zip_path);
	} catch(Exception $e) {
		@unlink($destination_file);
		deleteDir($destination_zip_path);
		throw $e;
	}
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
