<html>
<head>
<title>Minions</title>

<style type="text/css">
	label{
		font-size: 25px;
		color: white;
	}
	img{
		max-height:700px;
		width: 100%;

	}
	#con{
  margin-top:10px;
  color:darkgreen;
}
	#p{
		margin-top:75px;
		margin-bottom:50px;
		background-color:#FFEBCD;
		padding-top:50px;
		padding-bottom:50px;
	}
	.btn{
		background-color: white; 
		width: 100%

	}
	h1,h2,h4,h3{
		text-align: center;
	}
	.mini{
		padding-top: 50px;
		padding-bottom: 50px;
		/* The image used */
    background-image: url("back.jpg");

    /* Full height */
        

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
	}
</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="animate.css">
<script>
  $(document).ready(function() {
    $("#p").addClass("animated fadeInUpBig");
	 //$(".navbar").addClass("animated flash");
  });
</script>
</head>
<body>
<div class="navigation">
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #AF7817;>
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html" style="color:white">MINIONS</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="lounge.html"style="color:white">Lounge</a></li>
      <li><a href="#con"style="color:white">Contact us</a></li>
     
    </ul>
  </div>
</nav> 
</div>



<div id="p">
<?php
$sum=0;
$checked=$_GET['udaipur'];
$place=array("City Palace","Taj Lake Palace","Pichola Lake","jag Mandir","car museum");
$dk=array(9,9,9,9,9,9);
for($i=0;$i<count($checked);$i++)
{
	/*echo $checked[$i]."<br/>";*/
	$dk[$checked[$i]]=$checked[$i];

}
/*for($i=0;$i<count($dk);$i++)
{
	echo $dk[$i]."<br/>";

}
*/
$graph= array(
	array(0,290,280,1300,1100),
	array(290,0,10,1000,1900),
	array(280,10,0,500,1400),
	array(1300,1000,500,0,1800),
	array(1100,1900,1400,1800,0)
);

function farray($graph,$dk)
{    global $checked;
	for($i=0;$i<5;$i++)
	   for($j=0;$j<5;$j++)
		{   if($i!=$dk[$i])
			{
                for($k=0;$k<5;$k++)
                	{$graph[$i][$k]=9999;
                     $graph[$k][$i]=9999;
                   }
		   }
			}


/*for($i=0;$i<5;$i++)
	{   for($j=0;$j<5;$j++)
		{   echo $graph[$i][$j]. " ";
			}
echo "<br/>";*/


FloydWarshall($graph, 5);

}



$INF = 99999;
$known=array(0,0,0,0,0);
function mini($distance,$verticesCount)
{ global $known;
 $me=9999;

 for($v=0;$v<$verticesCount ;$v++)
  {
      

  	if($known[$v]==0)
   if($me>$distance[$v])
   	  $me=$distance[$v];
   

}
echo "<br/>";
	return $me;
}


function index($distance,$m,$verticesCount)
{  
	for($i=0;$i<$verticesCount;$i++)
		if($distance[$i]==$m)
			return $i;
}
function PrintResult($distance, $verticesCount)
{	global $sum;
	global $INF;
	global $known;
	global $dk;
	global $checked , $place;
	echo  "<h1><u>TRAVEL PLAN TO VISIT UDAIPUR :</h1></u>" . "<br/>";
    $count =0;
    $i=0;
	while($i<5)
	{
		if($dk[$i]!=9)
			break;
		$i++;
	}
    
	   echo "<h2>Shortest Path Between The Selected Places</h2>";
	while( $count < count($checked)-1)
	{   $m=mini($distance[$i],$verticesCount);
	
        $mem=index($distance[$i],$m,$verticesCount);
        
     
		/*echo $i;
		echo " to ";
		echo $mem;
		echo "<br/>";*/
		$sum=$sum+$distance[$i][$mem];
		echo "<h3 >$place[$i]</h3>";
		echo " <h4 >to</h4> ";
		echo "<h3 >$place[$mem]</h3>";
		echo "<br/>";
        $known[$i]=1;
        
		$i=$mem;
		$count++;
		
	}
	echo  "</pre>";
	$sum=$sum/1000;
	echo "<center><h3>Total Distance is</h3><h3>". $sum. "</h3><h3>km</h3></center>" ;
}

function FloydWarshall($graph, $verticesCount)
{  global $INF;
	$distance = array();
 
	for ($i = 0; $i < $verticesCount; ++$i)
		for ($j = 0; $j < $verticesCount; ++$j)
			$distance[$i][$j] = $graph[$i][$j];

	for ($k = 0; $k < $verticesCount; ++$k)
	{
		for ($i = 0; $i < $verticesCount; ++$i)
		{
			for ($j = 0; $j < $verticesCount; ++$j)
			{
				if ($distance[$i][$k] + $distance[$k][$j] < $distance[$i][$j])
					$distance[$i][$j] = $distance[$i][$k] + $distance[$k][$j];
			}
		}
	}
     
for ($i = 0; $i < $verticesCount; ++$i)
		for ($j = 0; $j < $verticesCount; ++$j)
			  if( $i==$j )
			   $distance[$i][$j] = 999999;


	PrintResult($distance, $verticesCount);
}

								







farray($graph,$dk);


?>
</div>

<div class="container-fluid bg-grey" id="con">
  <h2 class="text-center">CONTACT US</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact Us and we will get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Rajasthan, India</p>
      <p><span class="glyphicon glyphicon-phone"></span> +91 7401130265</p>
      <p><span class="glyphicon glyphicon-envelope"></span> minions007@gmail.com</p>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
</html>