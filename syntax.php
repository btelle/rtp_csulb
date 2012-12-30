<?php

/**
 * syntax.php
 * 
 * Syntax highlighting controller
 * 
 * @author Brandon Telle
 */

require_once('./lib/init.inc.php');

$file = array('name'=>$_GET['file']);

// Make sure the file is local to this directory
if($file['name'][0] == '/') 
    $file['name'] = ".".$file['name'];
else
    $file['name'] = "./".$file['name'];

// Can't find file
if(!file_exists($file['name']))
{
    $header_data['title'] = "File not found";
    $smarty -> assign('header', $header_data);
    $smarty -> display('static/file_not_found.tpl');
    die();
}

// File extension determines file type
switch(substr($file['name'], strrpos($file['name'], '.')+1))
{
    case 'php':
        $file['type'] = 'php';
        break;
    case 'js':
        $file['type'] = 'javascript';
        break;
    case 'css':
        $file['type'] = 'css';
        break;
    case 'sql':
        $file['type'] = 'sql';
        break;
    case 'tpl':
    case 'html':
        $file['type'] = 'html';
        break;
    case 'pdf':
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename={$file['name']}");
        header("Content-Type: application/pdf");
        header("Content-Transfer-Encoding: binary");

        $fh = fopen($file['name'], 'r');
        $file['contents'] = fread($fh, filesize($file['name']));
        fclose($fh);
        die($file['contents']);
        break;
    default:
        $file['type'] = 'txt';
        break;
}

// Get file contents
$fh = fopen($file['name'], 'r');
$file['contents'] = htmlentities(fread($fh, filesize($file['name'])));
fclose($fh);

// Name readability fix
$file['name'] = str_replace('./', '', $file['name']);
$header_data['title'] = $file['name']." Source Code";

// Replace passwords and private keys with *'s
$file['contents'] = preg_replace("/_PASS', '[^']+'/", "_PASS', '********'", $file['contents']);
$file['contents'] = preg_replace("/_PRIVKEY', '[^']+'/", "_PRIVKEY', '*******************'", $file['contents']);

// Smarty pass off
$smarty -> assign('file', $file);
$smarty -> assign('header', $header_data);
$smarty -> display('static/syntax.tpl');

?>
