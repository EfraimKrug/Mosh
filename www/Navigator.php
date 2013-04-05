<?php
include 'Command.php';
$pageName = $_GET["page"];
$pageChain = new PageChain();
if($pageName == "AboutNowDB"){
	$pageChain->addPage( new AboutNowDB() );
	$pageChain->getPage( 'AboutNowDB', null );
	}
if($pageName == "GetDate"){
	$args = array($_GET["SdKey"]);
	$pageChain->addPage( new GetDate() );
	$pageChain->getPage( 'GetDate',  $args);
	}
if($pageName == "EditCommit"){
	$args = array($_GET["CoSdKey"], $_GET["CoMoKey"]);
	$pageChain->addPage( new EditCommit() );
	$pageChain->getPage( 'EditCommit',  $args);
	}
if($pageName == "InsertCommit"){
	$args = array($_POST["date"], $_POST["meal"], $_POST["fname"], $_POST["lname"], $_POST["SdKey"], $_POST["MoKey"]);
	$pageChain->addPage( new InsertCommit() );
	$pageChain->getPage( 'InsertCommit',  $args);
	}
if($pageName == "ListMoshgichim"){
	$args = array();
	$pageChain->addPage( new ListMoshgichim() );
	$pageChain->getPage( 'ListMoshgichim',  $args);
	}
if($pageName == "ListCommit"){
	$args = array();
	$pageChain->addPage( new ListCommit() );
	$pageChain->getPage( 'ListCommit',  $args);
	}
if($pageName == "GetMoshgiach"){
	$args = array($_GET["MoKey"]);
	$pageChain->addPage( new GetMoshgiach() );
	$pageChain->getPage( 'GetMoshgiach',  $args);
	}
if($pageName == "AddDate"){
	$args = array();
	$pageChain->addPage( new AddDate() );
	$pageChain->getPage( 'AddDate',  $args);
	}

?>
