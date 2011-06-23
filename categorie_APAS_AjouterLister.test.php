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
// Test file write by SDK tool
// --- Last modification: Date 23 June 2011 12:26:00 By  ---


//@TABLES@
require_once('extensions/org_lucterios_documents/categorie.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ 

function org_lucterios_documents_categorie_APAS_AjouterLister(&$test)
{
//@CODE_ACTION@
$rep=$test->CallAction("org_lucterios_documents","categorie_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Fermer",$act->m_title,'Titre action #1');
$test->assertEquals("",$act->m_extension,'Ext action #1');
$test->assertEquals("",$act->m_action,'Act action #1');
$test->assertEquals(4,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_documents/images/documentConf.png","".$comp->m_value,"Valeur de img");
//LABELFORM - titre
$comp=$rep->getComponents('titre');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de titre");
$test->assertEquals("{[center]}{[bold]}Liste des dossiers{[/bold]}{[/center]}","".$comp->m_value,"Valeur de titre");
//GRID - categorie
$comp=$rep->getComponents('categorie');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de categorie");
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de categorie");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de categorie");
$act=$comp->m_actions[0];
$test->assertEquals("_Modifier",$act->m_title,'Titre grid action #1');
$test->assertEquals("org_lucterios_documents",$act->m_extension,'Ext grid action #1');
$test->assertEquals("categorie_APAS_AddModify",$act->m_action,'Act grid action #1');
$act=$comp->m_actions[1];
$test->assertEquals("_Supprimer",$act->m_title,'Titre grid action #2');
$test->assertEquals("org_lucterios_documents",$act->m_extension,'Ext grid action #2');
$test->assertEquals("categorie_APAS_Del",$act->m_action,'Act grid action #2');
$act=$comp->m_actions[2];
$test->assertEquals("_Ajouter",$act->m_title,'Titre grid action #3');
$test->assertEquals("org_lucterios_documents",$act->m_extension,'Ext grid action #3');
$test->assertEquals("categorie_APAS_AddModify",$act->m_action,'Act grid action #3');
$act=$comp->m_actions[3];
$test->assertEquals("_Import",$act->m_title,'Titre grid action #4');
$test->assertEquals("org_lucterios_documents",$act->m_extension,'Ext grid action #4');
$test->assertEquals("categorie_APAS_ImportZip",$act->m_action,'Act grid action #4');
$headers=$comp->m_headers;
$test->assertEquals("Nom",$headers["nom"]->m_descript,'Header #1');
$test->assertEquals("Description",$headers["description"]->m_descript,'Header #2');
$test->assertEquals("Dossier Parent",$headers["parent"]->m_descript,'Header #3');
$test->assertEquals("Groupes de consultation",$headers["visualisation"]->m_descript,'Header #4');
$test->assertEquals("Groupes de modification",$headers["modification"]->m_descript,'Header #5');
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 0","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_documents","categorie_APAS_AddModify",array(),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Ok",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_documents",$act->m_extension,'Ext action #1');
$test->assertEquals("categorie_APAS_AddModifyAct",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Annuler",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->assertEquals(11,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_documents/images/documentConf.png","".$comp->m_value,"Valeur de img");
//EDIT - nom
$comp=$rep->getComponents('nom');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de nom");
$test->assertEquals("","".$comp->m_value,"Valeur de nom");
//MEMO - description
$comp=$rep->getComponents('description');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de description");
$test->assertEquals("","".$comp->m_value,"Valeur de description");
//SELECT - parent
$comp=$rep->getComponents('parent');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de parent");
$test->assertEquals("0","".$comp->m_value,"Valeur de parent");
$test->assertEquals(1,COUNT($comp->m_select),'Nb select de parent');
//CHECKLIST - visualisation
$comp=$rep->getComponents('visualisation');
$test->assertClass("Xfer_Comp_CheckList",$comp,"Classe de visualisation");
$test->assertEquals(2,COUNT($comp->m_select),'Nb check de visualisation');
//CHECKLIST - modification
$comp=$rep->getComponents('modification');
$test->assertClass("Xfer_Comp_CheckList",$comp,"Classe de modification");
$test->assertEquals(2,COUNT($comp->m_select),'Nb check de modification');
$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_documents_categorie",),"Xfer_Container_Acknowledge");

$test->CallAction("org_lucterios_documents","categorie_APAS_AddModifyAct",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_documents_categorie","description"=>"Premier","modification"=>"1","nom"=>"AAA","parent"=>"0","visualisation"=>"1;99",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_documents","categorie_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - categorie
$comp=$rep->getComponents('categorie');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de categorie");
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de categorie");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de categorie");
$rec=$comp->m_records[100];
$test->assertEquals("AAA",$rec["nom"],"Valeur de grid [109,nom]");
$test->assertEquals("Premier",$rec["description"],"Valeur de grid [109,description]");
$test->assertEquals("",$rec["parent"],"Valeur de grid [109,parent]");
$test->assertEquals("Admin{[newline]}Visiteur{[newline]}",$rec["visualisation"],"Valeur de grid [109,visualisation]");
$test->assertEquals("Admin{[newline]}",$rec["modification"],"Valeur de grid [109,modification]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 1","".$comp->m_value,"Valeur de nb");

$test->CallAction("org_lucterios_documents","categorie_APAS_AddModifyAct",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_documents_categorie","description"=>"Sous AAA","modification"=>"1","nom"=>"BBB","parent"=>"100","visualisation"=>"1;99",),"Xfer_Container_Acknowledge");
$test->CallAction("org_lucterios_documents","categorie_APAS_AddModifyAct",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_documents_categorie","description"=>"Deuxieme","modification"=>"99","nom"=>"CCC","parent"=>"0","visualisation"=>"99",),"Xfer_Container_Acknowledge");
$test->CallAction("org_lucterios_documents","categorie_APAS_AddModifyAct",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_documents_categorie","description"=>"Sous CCC","modification"=>"99","nom"=>"DDD","parent"=>"102","visualisation"=>"99",),"Xfer_Container_Acknowledge");
$test->CallAction("org_lucterios_documents","categorie_APAS_AddModifyAct",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_documents_categorie","description"=>"Egalement sous CCC","modification"=>"99","nom"=>"EEE","parent"=>"102","visualisation"=>"99",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_documents","categorie_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - categorie
$comp=$rep->getComponents('categorie');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de categorie");
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de categorie");
$test->assertEquals(5,count($comp->m_records),"Nb grid records de categorie");
$rec=$comp->m_records[100];
$test->assertEquals("AAA",$rec["nom"],"Valeur de grid [100,nom]");
$test->assertEquals("Premier",$rec["description"],"Valeur de grid [100,description]");
$test->assertEquals("",$rec["parent"],"Valeur de grid [100,parent]");
$test->assertEquals("Admin{[newline]}Visiteur{[newline]}",$rec["visualisation"],"Valeur de grid [100,visualisation]");
$test->assertEquals("Admin{[newline]}",$rec["modification"],"Valeur de grid [100,modification]");
$rec=$comp->m_records[102];
$test->assertEquals("CCC",$rec["nom"],"Valeur de grid [102,nom]");
$test->assertEquals("Deuxieme",$rec["description"],"Valeur de grid [102,description]");
$test->assertEquals("",$rec["parent"],"Valeur de grid [102,parent]");
$test->assertEquals("Visiteur{[newline]}",$rec["visualisation"],"Valeur de grid [102,visualisation]");
$test->assertEquals("Visiteur{[newline]}",$rec["modification"],"Valeur de grid [102,modification]");
$rec=$comp->m_records[101];
$test->assertEquals("BBB",$rec["nom"],"Valeur de grid [101,nom]");
$test->assertEquals("Sous AAA",$rec["description"],"Valeur de grid [101,description]");
$test->assertEquals("AAA",$rec["parent"],"Valeur de grid [101,parent]");
$test->assertEquals("Admin{[newline]}Visiteur{[newline]}",$rec["visualisation"],"Valeur de grid [101,visualisation]");
$test->assertEquals("Admin{[newline]}",$rec["modification"],"Valeur de grid [101,modification]");
$rec=$comp->m_records[103];
$test->assertEquals("DDD",$rec["nom"],"Valeur de grid [103,nom]");
$test->assertEquals("Sous CCC",$rec["description"],"Valeur de grid [103,description]");
$test->assertEquals("CCC",$rec["parent"],"Valeur de grid [103,parent]");
$test->assertEquals("Visiteur{[newline]}",$rec["visualisation"],"Valeur de grid [103,visualisation]");
$test->assertEquals("Visiteur{[newline]}",$rec["modification"],"Valeur de grid [103,modification]");
$rec=$comp->m_records[104];
$test->assertEquals("EEE",$rec["nom"],"Valeur de grid [104,nom]");
$test->assertEquals("Egalement sous CCC",$rec["description"],"Valeur de grid [104,description]");
$test->assertEquals("CCC",$rec["parent"],"Valeur de grid [104,parent]");
$test->assertEquals("Visiteur{[newline]}",$rec["visualisation"],"Valeur de grid [104,visualisation]");
$test->assertEquals("Visiteur{[newline]}",$rec["modification"],"Valeur de grid [104,modification]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 5","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_documents","categorie_APAS_AddModify",array("categorie"=>"101",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
//EDIT - nom
$comp=$rep->getComponents('nom');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de nom");
$test->assertEquals("BBB","".$comp->m_value,"Valeur de nom");
//MEMO - description
$comp=$rep->getComponents('description');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de description");
$test->assertEquals("Sous AAA","".$comp->m_value,"Valeur de description");
//SELECT - parent
$comp=$rep->getComponents('parent');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de parent");
$test->assertEquals("100","".$comp->m_value,"Valeur de parent");
$test->assertEquals(6,COUNT($comp->m_select),'Nb select de parent');
//CHECKLIST - visualisation
$comp=$rep->getComponents('visualisation');
$test->assertClass("Xfer_Comp_CheckList",$comp,"Classe de visualisation");
$test->assertEquals(2,COUNT($comp->m_select),'Nb check de visualisation');
//CHECKLIST - modification
$comp=$rep->getComponents('modification');
$test->assertClass("Xfer_Comp_CheckList",$comp,"Classe de modification");
$test->assertEquals(2,COUNT($comp->m_select),'Nb check de modification');
$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"110","TABLE_NAME"=>"org_lucterios_documents_categorie","categorie"=>"110",),"Xfer_Container_Acknowledge");

$test->CallAction("org_lucterios_documents","categorie_APAS_AddModifyAct",array("ORIGINE"=>"categorie_APAS_AddModify","RECORD_ID"=>"101","TABLE_NAME"=>"org_lucterios_documents_categorie","categorie"=>"101","description"=>"Sous AAA","modification"=>"1","nom"=>"BBB","parent"=>"100","visualisation"=>"1",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_documents","categorie_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - categorie
$comp=$rep->getComponents('categorie');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de categorie");
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de categorie");
$test->assertEquals(5,count($comp->m_records),"Nb grid records de categorie");
$rec=$comp->m_records[101];
$rec=$comp->m_records[101];
$test->assertEquals("BBB",$rec["nom"],"Valeur de grid [101,nom]");
$test->assertEquals("Sous AAA",$rec["description"],"Valeur de grid [101,description]");
$test->assertEquals("AAA",$rec["parent"],"Valeur de grid [101,parent]");
$test->assertEquals("Admin{[newline]}",$rec["visualisation"],"Valeur de grid [101,visualisation]");
$test->assertEquals("Admin{[newline]}",$rec["modification"],"Valeur de grid [101,modification]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 5","".$comp->m_value,"Valeur de nb");
//@CODE_ACTION@
}

?>
