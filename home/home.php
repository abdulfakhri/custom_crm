<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: /login.php');
}
?>
<style>
                      body {
    background-color: #7E57C2
}

.mt-100 {
    margin-top: 200px
}

.progress {
    width: 150px;
    height: 150px !important;
    float: left;
    line-height: 150px;
    background: none;
    margin: 20px;
    box-shadow: none;
    position: relative
}

.progress:after {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 12px solid #fff;
    position: absolute;
    top: 0;
    left: 0
}

.progress>span {
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1
}

.progress .progress-left {
    left: 0
}

.progress .progress-bar {
    width: 100%;
    height: 100%;
    background: none;
    border-width: 12px;
    border-style: solid;
    position: absolute;
    top: 0
}

.progress .progress-left .progress-bar {
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left
}

.progress .progress-right {
    right: 0
}

.progress .progress-right .progress-bar {
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 1.8s linear forwards
}

.progress .progress-value {
    width: 90%;
    height: 90%;
    border-radius: 50%;
    background: #000;
    font-size: 24px;
    color: #fff;
    line-height: 135px;
    text-align: center;
    position: absolute;
    top: 5%;
    left: 5%
}

.progress.blue .progress-bar {
    border-color: #049dff
}

.progress.blue .progress-left .progress-bar {
    animation: loading-2 1.5s linear forwards 1.8s
}

.progress.yellow .progress-bar {
    border-color: #fdba04
}

.progress.yellow .progress-right .progress-bar {
    animation: loading-3 1.8s linear forwards
}

.progress.yellow .progress-left .progress-bar {
    animation: none
}

@keyframes loading-1 {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg)
    }

    100% {
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg)
    }
}

@keyframes loading-2 {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg)
    }

    100% {
        -webkit-transform: rotate(144deg);
        transform: rotate(144deg)
    }
}

@keyframes loading-3 {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg)
    }

    100% {
        -webkit-transform: rotate(135deg);
        transform: rotate(135deg)
    }
}
</style>
<?php include 'nav.php';?>
      
     
  <!-- Header -->
  <div class="w3-container" style="padding-top:40px">
   


  <div class="w3-row-padding w3-margin-bottom">
  
    <div class="w3-quarter" style="padding-top:40px;background-color:aliceblue; border:1px solid grey; border-radius:10px;border-shadow: 3px;padding:20px;margin:20px;">
    <h3><b>Hi,Here is your goal for today:</b></h3>
      <div class="w3-container w3-white w3-padding-64 w3-margin-64">

      
        <div class="w3-left">
          <p>STARTED TODAY AT</p>
          <p>$0</p>
          <hr>
          <p>SHOULD BE AT</p>
          <p>$1,200</p>
          <hr>
          <p>$1,200</p>
          <p>GOAL FOR TODAY</p>
          <hr>
        </div>
        <div class="w3-clear"></div>
        
      </div>
    </div>
    <div class="w3-quarter" style="padding-top:40px;background-color:aliceblue; border:1px solid grey; border-radius:10px;border-shadow: 3px;padding:20px;margin:20px;">
      <div class="w3-container w3-white w3-padding-16 w3-margin-32">
      
        <div class="w3-left">
        <button class="btn btn-primary">Premium</button> <button class="btn btn-primary">Policies</button>
        </div>
        <div class="w3-left">
        <div class="row d-flex ">
         <div class="col-md-6">
        <div class="progress blue"> <span class="progress-left"> <span class="progress-bar"></span> </span> <span class="progress-right"> <span class="progress-bar"></span> </span>
            <div class="progress-value">90%</div>
            
         </div>
         
         
         </div>
         
        </div>
      </div>
      <br>
      <div class="w3-left">
       
        <div class="w3-left">
        <p>$200.00</p>
          <p>Still Needed</p>
          <br></br>
          <p>ACHIVED TODAY</p>
          <p>$1000.0</p>
        </div>
       
        </div>
        <br></br>
      <br>
        
      </div>
    </div>
    <div class="w3-quarter" style="padding-top:40px;background-color:aliceblue; border:1px solid grey; border-radius:10px;border-shadow: 3px;padding:20px;margin:20px;">
    <h3><b>Janurary Stats:</b></h3>
    <div class="w3-right">
    <button class="btn btn-primary">Premium</button> <button class="btn btn-primary">Policies</button>
        </div>
      <div class="w3-container w3-white w3-padding-64 w3-margin-64">
        <div class="w3-center">
          <hr>
          <h4>TRENDING FOR</h4>
          <h5>$0</h5>
           <h6>100% below goal of $1,500</h6>
        </div>
        <hr>
        <div class="w3-clear"></div>
        <div class="w3-left">
       <h4> VS LAST MONTH</h4>
         <h4>N/A</h4>
          </div>
        <div class="w3-right">
          
          <div class="w3-right">
          <h4>$0</h4>
          <h4>LAST MONTH<h4>
          </div>
          
        </div>
        
        <div class="w3-clear"></div>
        <div class="w3-left">
       <h4> CURRENTLY AT</h4>
         <h4>$0</h4>
          </div>
        <div class="w3-right">
          
          <div class="w3-right w3-text-aling-right">
          <h4>0%</h4>
          <h4>OF GOAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4>
          </div>
          
        </div>
      </div>
    </div>
   
  </div>

  <hr>
 
  <div class="w3-container" style="padding-top:40px;background-color:aliceblue; border:1px solid grey; border-radius:10px;border-shadow: 3px;">
    <div class="w3-right">
    <button class="btn btn-primary">Chart</button> <button class="btn btn-primary">Details</button>  <button class="btn btn-primary">Premium</button> <button class="btn btn-primary">Policies</button>
        </div>
 <div class="w3-left">
 <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">Written Business</a></li>
      <li><a href="#">Life & Health</a></li>
      <li><a href="#">Activities</a></li>
      <li><a href="#">Analytics</a></li>
    </ul>
  </div>
  <h3>Filters</h3>
  <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Time Frame
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">MTD</a></li>
      <li><a href="#">QTD</a></li>
      <li><a href="#">Today</a></li>
      <li><a href="#">Yesterday</a></li>
      <li><a href="#">YTD</a></li>
      <li><a href="#">This Week</a></li>
      <li><a href="#">Last Week</a></li>
      <li><a href="#">Last Month</a></li>

    </ul>
  </div>
  <br>
  <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Carries
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">All Carries</a></li>
      <li><a href="#">Progressive</a></li>
      <li><a href="#">Other</a></li>
      <li><a href="#">Nationwide</a></li>
      <li><a href="#">.Not Listed</a></li>
   

    </ul>
  </div>
  </div>
  &nbsp;&nbsp;&nbsp;
  <div class="w3-center">
  <canvas id="myChart" style="width:100%;max-width:70%;;padding:20px;margin:50px;"></canvas>
  </div>
  
  <script>
var xValues = ["Steve M", "Jonhhy", "Claire M", "Chad M", "Abdul F"];
var yValues = [55, 49, 44, 24, 15];
var barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: ""
    }
  }
});
</script>
<?php include 'footer.php';?>
         
    