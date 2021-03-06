<?php
// setup file write by Lucterios SDK tool

$extention_name="org_lucterios_documents";
$extention_description="Gestion de documents et de fichiers partag�s";
$extention_appli="";
$extention_famille="";
$extention_titre="Gestion documentaires";
$extension_libre=true;

$version_max=1;
$version_min=4;
$version_release=1;
$version_build=176;

$depencies=array();
$depencies[0] = new Param_Depencies("CORE", 1, 6, 1, 4, false);

$rights=array();
$rights[0] = new Param_Rigth("Visualisation",0);
$rights[1] = new Param_Rigth("Ajout/modification",0);
$rights[2] = new Param_Rigth("Supression",85);
$rights[3] = new Param_Rigth("Parametrages",90);

$menus=array();
$menus[0] = new Param_Menu("Gestion documentaires", "Bureautique", "", "document.png", "", 51 , 0, "Gestion de documents et de fichiers partag�s");
$menus[1] = new Param_Menu("Liste des documents", "Gestion documentaires", "document_APAS_List", "document.png", "ctrl D", 10 , 0, "Liste des documents et fichiers.");
$menus[2] = new Param_Menu("Recherche", "Gestion documentaires", "document_APAS_Search", "documentFind.png", "", 20 , 1, "Recherche de documents");
$menus[3] = new Param_Menu("Document", "_Extensions (conf.)", "", "", "", 51 , 0, "");
$menus[4] = new Param_Menu("Documentation", "Document", "categorie_APAS_List", "documentConf.png", "", 20 , 1, "Configuration du gestionnaire de documentation");
$menus[5] = new Param_Menu("Bureautique", "", "", "bureau.png", "", 60 , 0, "Outils bureautiques");

$actions=array();
$actions[0] = new Param_Action("Valider un dossier", "categorie_APAS_AddModifyAct", 3);
$actions[1] = new Param_Action("Ajouter/Modifier un dossier", "categorie_APAS_AddModify", 3);
$actions[2] = new Param_Action("", "categorie_APAS_Add", 1);
$actions[3] = new Param_Action("Supprimer un dossier", "categorie_APAS_Del", 3);
$actions[4] = new Param_Action("Import multiple depuis un fichier zip", "categorie_APAS_ImportZipAct", 3);
$actions[5] = new Param_Action("Import multiple depuis un fichier zip", "categorie_APAS_ImportZip", 3);
$actions[6] = new Param_Action("Liste des dossiers", "categorie_APAS_List", 3);
$actions[7] = new Param_Action("Valider un document", "document_APAS_AddModifyAct", 1);
$actions[8] = new Param_Action("Ajouter/Modifier un document", "document_APAS_AddModify", 1);
$actions[9] = new Param_Action("Supprimer un document", "document_APAS_Del", 2);
$actions[10] = new Param_Action("Fiche d'un document", "document_APAS_Fiche", 0);
$actions[11] = new Param_Action("Liste des documents", "document_APAS_List", 0);
$actions[12] = new Param_Action("Rechercher un document", "document_APAS_Search", 0);

$params=array();

$extend_tables=array();
$extend_tables["categorie"] = array("org_lucterios_documents.categorie","",array("org_lucterios_documents_categorie"=>"parent",));
$extend_tables["document"] = array("org_lucterios_documents.document","",array("org_lucterios_documents_categorie"=>"categorie","CORE_users"=>"createur",));
$extend_tables["modification"] = array("org_lucterios_documents.modification","",array("org_lucterios_documents_categorie"=>"categorie","CORE_groups"=>"groupe",));
$extend_tables["visualisation"] = array("org_lucterios_documents.visualisation","",array("org_lucterios_documents_categorie"=>"categorie","CORE_groups"=>"groupe",));
$signals=array();

?>