<?php session_start(); ?>


<?php
if(!isset($_SESSION['valid'])) {
	header('Location: /spages/login.php');
}
?>


   
<?php 
include_once("connection.php");
if(isset($_POST['send'])) {

$to_email = implode(",",$_POST['email']);
$subject = $_POST['subject'];
$stime= $_POST['stime'];
$etime= $_POST['etime'];
$period= $_POST['period'];
$message = $_POST['message'];
$headers = $_POST['sender'];
$sender=$header;
$client=$_SESSION['id'];

$zone=$_POST['zone'];
date_default_timezone_set($zone);
$timestamp = date("Y-m-d H:i:s");
if($stime==$timestamp){
    mail($to_email, $subject, $message, $headers);
    
    mysqli_query($mysqli,"INSERT INTO camp(sender,recp,subject,message,tzone,stime,etime,period,client) VALUES('$sender','$to_email','$subject','$message','$zone','$stime','$etime','$period','$client'");
}else{
      mysqli_query($mysqli,"INSERT INTO camp(sender,recp,subject,message,tzone,stime,etime,period,client) VALUES('$sender','$to_email','$subject','$message','$zone','$stime','$etime','$period','$client'");
    
}



}
?>
<?PHP include("camp_nav.php");?>
            <div class="title">
         <center>Send Unlimited Emails To Unlimited People Automatically</center>
           </div>
 
    <form action=""  method="post">
      
      <p><input class="w3-input w3-border" type="text" placeholder="From" required name="sender"></p>
      
      
     <select name='email[]' id='testSelect1' multiple> 
     
      <?PHP
      include_once("connection.php");
      $client=$_SESSION['id'];
     $res = mysqli_query($mysqli, "SELECT * FROM led WHERE client='$client'");
    while($row =mysqli_fetch_array($res)) {
     ?>
     
     <option value="<?PHP echo $row["email"];?>"><?PHP  echo $row["email"];  ?></option>
     <?PHP
         }
      ?>
     </select>
       

      
      <p><input class="w3-input w3-border" type="text" placeholder="Subject" required name="subject"></p>
       <p><input class="w3-input w3-border" type="text" placeholder="Start Time  Like YYY-mm-dd h:min:sec" required name="stime"></p>
         <p><input class="w3-input w3-border" type="text" placeholder="Set End TimeLike YYY-mm-dd h:min:sec" required name="etime"></p>
         
       <p><input class="w3-input w3-border" type="text" placeholder="Setup Period like 3,4,5" required name="period"></p>
       
        <p><input class="w3-input w3-border" type="text" placeholder="Set Time Zone like Asia/Kolkata etc.." required name="zone"></p>
      
        <p><textarea id="subject" class="textarea" name="message" placeholder="Write something.." style="height:200px"></textarea></p>
      
     </p>
     
      
      <p>
        <button class="btn" type="submit">
          <i class="fa fa-paper-plane"></i> SEND 
        </button>
        <button class="btn" type="attach">
          Attach To Email 
        </button>
        
        
        
        
        
      </p>
    </form>
    
  
    
    
    



<script>
	document.multiselect('#testSelect1');
</script>
 <?php include 'footer.php';?>