<?php 
session_start(); 
if(!isset($_SESSION['valid'])) {
	header('Location: /spages/login.php');
}
?>


   
<?php 
$to_email = implode(",",$_POST['email']);
$subject = $_POST['subject'];
$message = $_POST['message'];
$headers = $_POST['sender'];
$sd=mail($to_email, $subject, $message, $headers);
if($sd){
    
    echo "Email Sent Sucessfully To All";
}

?>


<?PHP include("nav.php");?>
            
            <div class="title">
         <center>Send Unlimited Emails To Unlimited People at Once</center>
           </div>
 
    <form action=""  method="post">
      <h3>From:</h3>
      <p><input class="w3-input w3-border" type="text" placeholder="From" required name="sender" value="<?PHP  echo $_SESSION['valid'];?>"></p>
      
      <h3>To:</h3>
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
      
      <p><textarea id="subject" class="textarea" name="message" placeholder="Write something.." style="height:200px"></textarea></p>
      
     </p>
     
      
      <p>
       <button class="btn" type="submit"  >
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