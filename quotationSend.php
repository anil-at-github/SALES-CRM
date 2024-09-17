<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    if(isset($_POST["ID"]))
    {
        session_start();
        $FULLNAME=$_SESSION["fullname"];
        require_once('bo/tcpdfapi/tcpdf.php');
        require_once("bo/mysqli.php");

        require 'bo/mailer/Exception.php';
        require 'bo/mailer/PHPMailer.php';
        require 'bo/mailer/SMTP.php';
    
        //TCPDF Settings
        class MYPDF extends TCPDF {
            public function Header() {
                $image_file = K_PATH_IMAGES.'header.png';
                $this->Image($image_file, 5, 5, 200, '', 'PNG', '', 'T', false, 500, '', false, false, 0, false, false, false); 
            }
            public function Footer() {
                $logoX = 5; 
                $logoFileName = K_PATH_IMAGES.'footer.png';
                $logoWidth = 190;
                $logo =  $this->Image($logoFileName, $logoX, $this->GetY()-15, $logoWidth);
                $this->Cell(0,0, $logo, 0, 0, '');
            }
        }
        $ID=$_POST["ID"];
        $pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf->SetCreator("ADMIN");
        $pdf->SetAuthor("ADMIN");
        $pdf->SetTitle("QUOTATION $ID");
        $pdf->SetSubject('Report');
        //$pdf->SetKeywords('');
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER+3);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+10, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM+5);

        // set default header data
        //$pdf->SetHeaderData('header.png', '190', '', '');
        //$pdf->setHeaderData('header.png',190,'','',array(0,0,0), array(255,255,255) );  


        $pdf->SetFont('times', '', '12');

         //setting quatation data
         
         $sql="SELECT date_format(qm.qdate,'%d/%m/%Y'),c.`name`,qm.address,qm.refNo,qm.validity,qm.preparedBy,qm.`status`,qm.type,e.email
         FROM quatation_mster qm 
         JOIN enquiry e ON qm.customer=e.enqID 
         JOIN customers c ON e.customerID=c.ID
         WHERE qm.ID=$ID";
         $result=mysqli_query($con,$sql);
         $date="";
         $name="";
         $address="";
         $refNo="";
         $validity="";
         $pby="";
         if($row=mysqli_fetch_array($result))
         {
             $date=$row[0];
             $name=$row[1];
             //$address=$row[2];
             $address=str_replace("\n",", ",$row[2]);
             $refNo=$row[3];
             $validity=$row[4];
             $pby=$row[5];
             $status=$row[6];
             $type=$row[7];if($type!="")$type .= ' ';
             $email=$row[8];
         }
         if($status>0)
         {
            if($name!="")
            $pdf->SetTitle("QUOTATION $ID : ".strtoUpper($name));
            //htmlData
            $html='<h3 align="center"><u>'.$type.'Quotation for Electronic Weighing Machine and Peripherals</u></h3>
            <table cellpadding="5px" border="1"><tr><td>To<br><strong>'.$name.'</strong><br>'.$address.'</td><td>Date : '.$date.'<br>Ref No : '.$refNo.'<br>Validity : '.$validity.'<br>Prepared By : '.$pby.'</td></tr></table>
            <p style="text-align: justify;">Dear Sir,<br>
            Accurate Trade Links started in 1998 as the brainchild of Mr. Harish. It is an ISO 9001 company that provides complete total weighing & billing solutions for retail, industries, laboratories and weighing bridges. 
            The company started out as a dealer for the brand ‘Asthra’ and gradually acquired major players in the commercial arena thus expanding their clientele. Our own brand “ATL Casio” was launched with the sole commitment towards customer satisfaction. This brand has the legal metrology manufacturing approval for more than six models. The newest development is the addition of the POS (point of sale) system for simplifying the interactions with customers.
            With 20 years of experience and over 100,000 satisfied customers, ATL is a veritable electronic weighing scales Manufacturer & Dealer that offers excellent customer support & service to both government and private undertakings.</p>
            <ul style="text-align: justify;">
            <li>Sales, Services, Stamping & Spares for all types of Electronic Weighing Scales</li>
            <li>Sales & Services of Billing Machines, Currency Counting Machines, Fake Note Detectors,Sealing Machines, Touch POS Systems & Peripherals and KIOSKS</li>
            <li>Onsite Stamping Assistance for Weighing Scales</li>
            <li>Supply and Installation of Weighing Bridges</li> 
            <li>1 Year Company Warranty</li></ul>
            <p style="text-align: justify;">Further to the requirement and as per the meeting and discussion, please find the below our best competitive price offer. Hope the offer is in line with your expectation and a waiting for your valuable order confirmation.
            Kindly contact for any further clarification if required.</p>
            <table  cellpadding="5px" border="1"><tr><td><h4>Terms & Conditions</h4></td></tr>
            <tr><td>
            Delivery : Within 3 weeks after getting confirmed order<br>
            Payment  : 50% in advance, 50% against delivery<br>
            Warranty : One Year </td></tr>
            </table>
            <br><br>
            <table cellpadding="5px" border="1" align="center"><tr><td align="center"><h4>Bank Details</h4></td><td align="center"><h4>UPI Payment QR</h4></td></tr>
            <tr><td>
            Account Name  : ACCURATE TRADE LINKS<br>
            Bank Account no : 514044034877<br>
            Bank Name : KOTAK MAHINDRA<br>
            Branch : Thiruvananthapuram<br>
            IFSC Code : KKBK0009206 </td>
            <td align="center"><img src="dist/img/report/qrcode.png" width="80px" height="80px"></td></tr>
            </table>'
            ;
            $sql="SELECT p.pname,p.`description`,p.`imgThumb`,pc.category,ed.price,p.model,p.includeGST FROM enquiry_details ed
            JOIN quatation_mster qm ON qm.customer=ed.enqID
            JOIN products p ON ed.productID=p.ID
            JOIN product_categories pc ON p.category=pc.ID WHERE qm.ID=$ID order by pc.ID";
            $result=mysqli_query($con,$sql);
            $qdetails='<br><br><br><table cellpadding="5px" border="1">
            <tr style="background-color:#ffcccb">
            <th width="5%"><strong>Sl No</strong></th>
            <th width="35%"><strong>Description</strong></th>
            <th width="10%"><strong>Ref. Image</strong></th>
            <th width="15%"><strong>Rate per unit</strong></th>
            <th width="15%"><strong>GST<br>18%</strong></th>
            <th width="20%"><strong>Total Price</strong></th>
            </tr>';

            $i=1;
            $category="";
            while($row=mysqli_fetch_array($result))
            {
                $rate=$row[4];
                $inclGST=$row[6];
                $description=str_replace("\n","<br>",$row[1]);
                if($category!=$row[3])
                {
                    $qdetails .='<tr style="background-color:#C6C6C6"><td colspan="7" align="center"><strong>'.$row[3].' Models</strong></td></tr>';
                    $i=1;
                }
                $category=$row[3];
                $image="";
                if($row[2]=="")
                    $image='<img src="dist/img/noImage.png" width="50px" height="50px">';
                else
                    $image='<img src="'.$row[2].'" width="50px" height="50px">';
                if($inclGST==1)
                {
                    $prate=$rate/1.18;
                    $prate=round($prate,2);
                    $gst=$rate - $prate;
                    $gst=round($gst,2);
                    $rate=$prate;
                    $total=$prate+$gst;
                }
                else if($inclGST==0)
                {
                    $gst=($rate*.18);
                    $total=$rate+$gst;
                }
                $qdetails .='<tr>
                <td>'.$i.'</td>
                <td><strong>'.$row[0].'</strong><br><span class="badge">'.$row[5].'</span><br>'.$description.'</td>
                <td>'.$image.'</td>
                <td>'.$rate.'</td>
                <td>'.$gst.'</td>
                <td>'.$total.'</td>
                </tr>';
                $i++;
            }
            $qdetails .='</table>';
            $signature='<p style="text-align: justify;">Warranty does not cover accidental damages, misuse and Earthquake.</p>
            <p style="text-align: justify;">Prices are including of Kerala State Legal Metrology Department stamping charges and Installation charges.</p>
            <p style="text-align: justify;"><strong>Thanking You</strong>,<br>
            <p style="text-align: justify;"><strong>For ACCURATE TRADE LINKS</strong></p>';
           
            if($email!="")
            {
            $pdf->AddPage();
            $pdf->writeHTML($html.$qdetails.$signature, true, 0, false, 0); 
            $pdf->Output(__DIR__.'/tempImport/ATLQoutation_'.$ID.'.pdf', 'F');  

           
            //mail
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'mail.luureai.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'donotreply@luureai.com';                     //SMTP username
                    $mail->Password   = 'Q2#l43ez';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('donotreply@luureai.com',"$FULLNAME");
                    
                    $mail->addAddress('anil.k@luureai.com');     //Add a recipient
                    /*$mail->addAddress('ellen@example.com');               //Name is optional
                    $mail->addReplyTo('info@example.com', 'Information');
                    $mail->addCC('cc@example.com');
                    $mail->addBCC('bcc@example.com');*/

                    //Attachments
                    $mail->addAttachment("tempImport/ATLQoutation_$ID.pdf");         //Add attachments
                

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = "Quotation From Accurate Trade Links: prepared by $FULLNAME";
                    $mail->Body    = 'Dear Sir/Madam<br>As per your enquiry, we have prepared a Quotation.<br>Please find the attachment.';
                    $mail->AltBody = 'Dear Sir/Madam,As per your enquiry, we have prepared a Quotation.Please find the attachment.';

                    $mail->send();
                    echo "Done";

                    if($_SESSION["role"]!="ADMIN")
                    {
                        $sql="UPDATE quatation_mster SET `status`=3 WHERE ID=$ID";
                        mysqli_query($con,$sql);
                    }
                    
                    if(file_exists(__DIR__.'/tempImport/ATLQoutation_'.$ID.'.pdf'))
                    {
                        unlink(__DIR__.'/tempImport/ATLQoutation_'.$ID.'.pdf');
                    }

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            } 
        }
        else
        {
            echo "No Email";
        }
    }      
}   
?>