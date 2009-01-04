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
//  // setup file write by SDK tool
// --- Last modification: Date 16 December 2008 23:51:49 By  ---

$extention_name="org_lucterios_documents";
$extention_description="Gestion de documents et de fichiers partagés";
$extention_appli="";
$extention_famille="";
$extention_titre="Gestion documentaires";
$extension_libre=true;

$version_max=0;
$version_min=11;
$version_release=0;
$version_build=25;

$depencies=array();
$depencies[0] = new Param_Depencies("CORE", 0, 20, 0, 16, false);

$rights=array();
$rights[0] = new Param_Rigth("Visualisation",0);
$rights[1] = new Param_Rigth("Ajout/modification",0);
$rights[2] = new Param_Rigth("Supression",85);
$rights[3] = new Param_Rigth("Parametrages",90);

$menus=array();
$menus[0] = new Param_Menu("Gestion documentaires", "Bureautique", "", "document.png", "", 51 , 0, "Gestion de documents et de fichiers partagés");
$menus[1] = new Param_Menu("Liste des documents", "Gestion documentaires", "document_APAS_List", "document.png", "ctrl D", 10 , 0, "Liste des documents et fichiers.");
$menus[2] = new Param_Menu("Recherche", "Gestion documentaires", "document_APAS_Search", "documentFind.png", "", 20 , 1, "Recherche de documents");
$menus[3] = new Param_Menu("Document", "_Extensions (conf.)", "", "", "", 51 , 0, "");
$menus[4] = new Param_Menu("Documentation", "Document", "categorie_APAS_List", "documentConf.png", "", 20 , 1, "Configuration du gestionnaire de documentation");
$menus[5] = new Param_Menu("Bureautique", "", "", "bureau.png", "", 60 , 0, "Outils bureautiques");

$actions=array();
$actions[0] = new Param_Action("Valider une catégorie", "categorie_APAS_AddModifyAct", 3);
$actions[1] = new Param_Action("Ajouter/Modifier une catégorie", "categorie_APAS_AddModify", 3);
$actions[2] = new Param_Action("Supprimer une catégorie", "categorie_APAS_Del", 3);
$actions[3] = new Param_Action("Liste des catégories", "categorie_APAS_List", 3);
$actions[4] = new Param_Action("Valider un document", "document_APAS_AddModifyAct", 1);
$actions[5] = new Param_Action("Ajouter/Modifier un document", "document_APAS_AddModify", 1);
$actions[6] = new Param_Action("Supprimer un document", "document_APAS_Del", 2);
$actions[7] = new Param_Action("Fiche d'un document", "document_APAS_Fiche", 0);
$actions[8] = new Param_Action("Liste des documents", "document_APAS_List", 0);
$actions[9] = new Param_Action("Rechercher un document", "document_APAS_Search", 0);

$params=array();

$extend_tables=array();
$extend_tables["categorie"] = array("org_lucterios_documents.categorie","",array());
$extend_tables["document"] = array("org_lucterios_documents.document","",array("org_lucterios_documents_categorie"=>"categorie","CORE_users"=>"createur",));
$extend_tables["modification"] = array("org_lucterios_documents.modification","",array("org_lucterios_documents_categorie"=>"categorie","CORE_groups"=>"groupe",));
$extend_tables["visualisation"] = array("org_lucterios_documents.visualisation","",array("org_lucterios_documents_categorie"=>"categorie","CORE_groups"=>"groupe",));

?>