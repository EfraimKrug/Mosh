<?php
include 'Command.php';
$cc = new PageChain();
$cc->addPage( new AboutNowDB() );
//$cc->addPage( new MailCommand() );
$cc->getPage( 'AboutNowDB', null );
//$cc->getPage( 'mail', null );
?>
