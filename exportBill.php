<?php
require_once("BO/auth.php");
if(isset($_GET["enqID"]))
{
    $enqID=$_GET["enqID"];
    require_once("BO/mysqli.php");
    require_once("BO/SimpleXLSXGen.php");
			$enquiry = [
				['Sl No', 'Name', 'Address', 'Phone 1', 'Phone 2' ,'GST Number','Product Details','Price','Remarks'],
			];
			$sql="SELECT c.name,e.address,e.primaryContact,e.contact2,e.gstno,e.notes FROM enquiry e
			JOIN customers c ON c.ID=e.customerID WHERE e.enqID=$enqID";
			$result=mysqli_query($con,$sql);
			if($row=mysqli_fetch_array($result))
			{
				$slno=1;
				$name=$row[0];
				$address=$row[1];
				$phone1=$row[2];
				$phone2=$row[3];
				$gstno=$row[4];
				$product="";
				$price="";
				$remarks=$row[5];

				$sql="SELECT p.pname,p.`description`,pc.category,ed.price,ed.qty,p.model,p.includeGST FROM enquiry_details ed
				JOIN enquiry e ON e.enqID=ed.enqID
				JOIN products p ON ed.productID=p.ID
				JOIN product_categories pc ON p.category=pc.ID WHERE e.enqID=$enqID order by ed.ID";
				$prodResult=mysqli_query($con,$sql);
				if($prow=mysqli_fetch_array($prodResult))
				{
					$product=$prow[0]." ( ".$prow[5]." )";
					$includeGST=$prow[6];
					$price=$prow[3];
					if($includeGST==0)
					{
						$price=$price+($price*.18);
						$price=round($price,2);
					}
				}
				$add=[$slno,$name,$address,$phone1,$phone2,$gstno,$product,$price,$remarks];
				array_push($enquiry,$add);
				while($prow=mysqli_fetch_array($prodResult))
				{
					$product=$prow[0]."( ".$prow[5]." )";
					$includeGST=$prow[6];
					$price=$prow[3];
					if($includeGST==0)
					{
						$price=$price+($price*.18);
						$price=round($price,2);
					}
					$add=['','','','','','',$product,$price,''];
					array_push($enquiry,$add);
				}
				$xlsx = SimpleXLSXGen::fromArray( $enquiry );
				$xlsx->downloadAs('enquiryBill_'.$name.'.xlsx');
			}

}

?>