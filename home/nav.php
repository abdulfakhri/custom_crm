<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CRM</title>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	
	
	
	
<style>

    
    
</style>
</head>
<body>
    
   
      
        <!-- Top container -->
        <div class="w3-bar w3-top w3-blue w3-large" style="z-index:4">
            <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
       
            <span class="w3-bar-item w3-right">CRM</span>
        </div>
        
        <!-- Sidebar/menu -->
        <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:248px;border:1px solid grey; border-radius:0px;border-shadow: 3px;background:blue" id="mySidebar"><br>
        <div class="w3-center">
                
                <h2><b><?PHP  echo $_SESSION['name'];?></b></h2>
                <hr>
            </div>   
        <div class="w3-container w3-row">
             
            <div class="w3-bar-block">
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>Close Menu</a>
                <div class="w3-center">
                
               <button class="btn zzbtn-primary" onclick="window.location.href='home.php'">+ Add Business</button>
                <hr>
                </div>
                <div class="w3-container w3-row">
                <a href="/home/home.php" class="w3-bar-item w3-button">Dashboard</a>
                <hr>
                <a href="#" class="w3-bar-item w3-button w3-padding">Leads</a>
                <hr>
                
                <a href="#" class="w3-bar-item w3-button w3-padding">Customers</a>
                <hr>
                
                <a href="#" class="w3-bar-item w3-button w3-padding">Automation</a>
               
                <hr>
                
                <a href="#" class="w3-bar-item w3-button w3-padding">Reports</a>
               
                <hr>
                
                <a href="#" class="w3-bar-item w3-button w3-padding">Activities</a>
               
                <hr>
                <a href="#" class="w3-bar-item w3-button w3-padding">Compensation</a>
                
                <hr>
                <a href="#" class="w3-bar-item w3-button w3-padding">Conversation</a>
               
              
                <hr>
                    <a href="#" class="w3-bar-item w3-button">My Profile</a> 
                 <hr>
                 <!--  <a href="/home/leads.php" class="w3-bar-item w3-button w3-padding">Leads</a>
                <hr>
                
                <a href="/home/leads.php" class="w3-bar-item w3-button w3-padding">Customers</a>
                <hr>
                
                <a href="/home/camp.php" class="w3-bar-item w3-button w3-padding">Automation</a>
               
                <hr>
                
                <a href="/home/camp.php" class="w3-bar-item w3-button w3-padding">Reports</a>
               
                <hr>
                
                <a href="/home/camp.php" class="w3-bar-item w3-button w3-padding">Activities</a>
               
                <hr>
                <a href="/home/communication.php" class="w3-bar-item w3-button w3-padding">Compensation</a>
                
                <hr>
                <a href="/home/communication.php" class="w3-bar-item w3-button w3-padding">Conversation</a>
               
              
                <hr>
                    <a href="/home/profile.php" class="w3-bar-item w3-button">My Profile</a> 
                 <hr> -->
                <a href="/logout.php" class="w3-bar-item w3-button">Log Out</a>
                </div>
            </div>
        </nav>


        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


        
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:320px;margin-top:43px;">
      
          
            
            
            