<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: /spages/login.php');
}
?>
<?php include('header.php'); ?>
<body>


    <div class="row-fluid">
        <div class="span12">


         

            <div class="container">


<?php include('modal_add.php'); ?>

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><i class="icon-user icon-large"></i>&nbsp;Data Table</strong>
                            </div>
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Name</th>
                                    <th style="text-align:center;">Phone</th>
                                    <th style="text-align:center;">Adress</th>
                                    <th style="text-align:center;">Business Phone</th>
                                    <th style="text-align:center;">Email</th>
									<th style="text-align:center;">Web Site</th>
									<th style="text-align:center;">Business Name</th>
                                    <th style="text-align:center;">Lead Status</th>
                                    <th style="text-align:center;">Business Industry</th>
                                    <th style="text-align:center;">Lead Score</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							<?php
						        $client = $_SESSION['id'];
								require_once('db.php');
								$result = $conn->prepare("SELECT * FROM leads WHERE client='$client' ORDER BY id DESC");
								$result->execute();
								for($i=0; $row = $result->fetch(); $i++){
								$id=$row['id'];
							?>
								<tr>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['name']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['phone']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['location']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['business_phone']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['email']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['website']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['business_name']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['lead_status']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['business_industry']; ?></td>
								<td style="text-align:center; word-break:break-all; width:800px;"> <?php echo $row ['lead_score']; ?></td>
								
								<td style="text-align:center; width:350px;">
									<a href="edit.php<?php echo '?id='.$id; ?>" class="btn btn-info">Edit</a>
									 <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" >Delete </a>
								</td>
									
										<!-- Modal -->
								<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
								<h3 id="myModalLabel">Delete</h3>
								</div>
								<div class="modal-body">
								<p><div style="font-size:larger;" class="alert alert-danger">Are you Sure you want Delete <b style="color:red;"><?php echo $row ['name']." ".$row ['phone']." ".$row ['lead_status'] ; ?></b> Data?</p>
								</div>
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="delete.php<?php echo '?id='.$id; ?>" class="btn btn-danger">Yes</a>
								</div>
								</div>
								</div>
								</tr>
								<?php } ?>
                            </tbody>
                        </table>


          
        </div>
        </div>
        </div>
    </div>


</body>
</html>


