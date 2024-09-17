<?php
require_once("BO/SimpleXLSXGen.php");
$books = [
    ['Sl No', 'Name', 'Address', 'Phone 1', 'Phone 2' ,'GST Number','Product Details','Price','Remarks'],
];
$add=[1,"test","test2","test3","test4","test5","test6","test7","test8"];
array_push($books,$add);
$xlsx = SimpleXLSXGen::fromArray( $books );
//$xlsx->saveAs('books.xlsx');

$xlsx->downloadAs('books.xlsx');
?>