<?php
session_start();
require_once 'vendor/autoload.php';

$_SESSION['id_data'] = $_GET['id'];

function render_php($path)
{
    ob_start();
    include($path);
    $var=ob_get_contents();
    ob_end_clean();
    return $var;
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML(render_php('page/'.$_GET['file'].'.php'));
$mpdf->Output();