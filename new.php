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
	h1,h2,h4{
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

$checked=$_GET['raj'];
$place=array("JODHPUR","JAIPUR","UDAIPUR","AJMER","BIKANER");
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
	array(0,335,260,206,252),
	array(335,0,394,135,336),
	array(260,394,0,265,501),
	array(206,135,265,0,270),
	array(252,336,501,270,0)
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
{
	global $INF;
	global $known;
	global $checked , $place;
	global $sum;
	global $dk;
	echo  "<h1><u>TRAVEL PLAN TO VISIT RAJASTHAN :</u></h1>" . "<br/>";
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

		echo "<h4>$place[$i]</h4>";
		echo " <h4>to</h4> ";
		echo "<h4>$place[$mem]</h4>";
		echo "<br/>";
        $known[$i]=1;
        
		$i=$mem;
		$count++;
		
	}
	echo  "</pre>";

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