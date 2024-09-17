<?php
$row = 1;
if (($handle = fopen("product3.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    //echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    /*for ($c=0; $c < $num; $c++) {
        echo $data[$c] . "<br />\n";
    }*/
    $sql="INSERT INTO products (pname, brandID, category, model, price, sprice, `status`)
            VALUES ('$data[2]','$data[1]','$data[0]','$data[3]',$data[4],$data[5],1);<br>";
            echo $sql;
  }
  fclose($handle);
}
?>