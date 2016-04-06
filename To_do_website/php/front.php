<?php

session_start();

require 'php/database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>Jimmi_Andersen_Fødselsdag</title>

	<!-- javasqruipt for menu-->
	<script>
	
	var sse2 = function () {
    var rebound = 20; //set it to 0 if rebound effect is not prefered
    var slip, k;
    return {
        buildMenu: function () {
            var m = document.getElementById('sses2');
            if (!m) return;
            var ul = m.getElementsByTagName("ul")[0];
            m.style.width = ul.offsetWidth + 1 + "px";
            var items = m.getElementsByTagName("li");
            var a = m.getElementsByTagName("a");

            slip = document.createElement("li");
            slip.className = "highlight";
            ul.appendChild(slip);

            var url = document.location.href.toLowerCase();
            k = -1;
            var nLength = -1;
            for (var i = 0; i < a.length; i++) {
                if (url.indexOf(a[i].href.toLowerCase()) != -1 && a[i].href.length > nLength) {
                    k = i;
                    nLength = a[i].href.length;
                }
            }

            if (k == -1 && /:\/\/(?:www\.)?[^.\/]+?\.[^.\/]+\/?$/.test) {
                for (var i = 0; i < a.length; i++) {
                    if (a[i].getAttribute("maptopuredomain") == "true") {
                        k = i;
                        break;
                    }
                }
                if (k == -1 && a[0].getAttribute("maptopuredomain") != "false")
                    k = 0;
            }
            if (k > -1) {
                slip.style.width = items[k].offsetWidth + "px";
                //slip.style.left = items[k].offsetLeft + "px";
                sse2.move(items[k]); //comment out this line and uncomment the line above to disable initial animation
            }
            else {
                slip.style.visibility = "hidden";
            }

            for (var i = 0; i < items.length - 1; i++) {
                items[i].onmouseover = function () {
                    if (k == -1) slip.style.visibility = "visible";
                    if (this.offsetLeft != slip.offsetLeft) {
                        sse2.move(this);
                    }
                }
            }

            m.onmouseover = function () {
                if (slip.t2)
                    slip.t2 = clearTimeout(slip.t2);
            };

            m.onmouseout = function () {
                if (k > -1 && items[k].offsetLeft != slip.offsetLeft) {
                    slip.t2 = setTimeout(function () { sse2.move(items[k]); }, 50);
                }
                if (k == -1) slip.t2 = setTimeout(function () { slip.style.visibility = "hidden"; }, 50);
            };
        },
        move: function (target) {
            clearInterval(slip.timer);
            var direction = (slip.offsetLeft < target.offsetLeft) ? 1 : -1;
            slip.timer = setInterval(function () { sse2.mv(target, direction); }, 15);
        },
        mv: function (target, direction) {
            if (direction == 1) {
                if (slip.offsetLeft - rebound < target.offsetLeft)
                    this.changePosition(target, 1);
                else {
                    clearInterval(slip.timer);
                    slip.timer = setInterval(function () {
                        sse2.recoil(target, 1);
                    }, 15);
                }
            }
            else {
                if (slip.offsetLeft + rebound > target.offsetLeft)
                    this.changePosition(target, -1);
                else {
                    clearInterval(slip.timer);
                    slip.timer = setInterval(function () {
                        sse2.recoil(target, -1);
                    }, 15);
                }
            }
            this.changeWidth(target);
        },
        recoil: function (target, direction) {
            if (direction == -1) {
                if (slip.offsetLeft > target.offsetLeft) {
                    slip.style.left = target.offsetLeft + "px";
                    clearInterval(slip.timer);
                }
                else slip.style.left = slip.offsetLeft + 2 + "px";
            }
            else {
                if (slip.offsetLeft < target.offsetLeft) {
                    slip.style.left = target.offsetLeft + "px";
                    clearInterval(slip.timer);
                }
                else slip.style.left = slip.offsetLeft - 2 + "px";
            }
        },
        changePosition: function (target, direction) {
            if (direction == 1) {
                //following +1 will fix the IE8 bug of x+1=x, we force it to x+2
                slip.style.left = slip.offsetLeft + Math.ceil(Math.abs(target.offsetLeft - slip.offsetLeft + rebound) / 10) + 1 + "px";
            }
            else {
                //following -1 will fix the Opera bug of x-1=x, we force it to x-2
                slip.style.left = slip.offsetLeft - Math.ceil(Math.abs(slip.offsetLeft - target.offsetLeft + rebound) / 10) - 1 + "px";
            }
        },
        changeWidth: function (target) {
            if (slip.offsetWidth != target.offsetWidth) {
                var diff = slip.offsetWidth - target.offsetWidth;
                if (Math.abs(diff) < 4) slip.style.width = target.offsetWidth + "px";
                else slip.style.width = slip.offsetWidth - Math.round(diff / 3) + "px";
            }
        }
    };
} ();

if (window.addEventListener) {
    window.addEventListener("load", sse2.buildMenu, false);
}
else if (window.attachEvent) {
    window.attachEvent("onload", sse2.buildMenu);
}
else {
    window["onload"] = sse2.buildMenu;
}
</script>


	
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/css.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	

  
      <div id = "container" >
		<?php if( !empty($user) ): ?>
          <div id="header">
			
      
			<div id = "headline">
				<h1><b><strong>Jimmi Andersens <br> 30 Års fødselsdag</strong></b></h1>
			</div>
		                       
		  <div id = "box">
			 <div id = "sses2">
				<ul>
					<li><a href="../php/front.php">Forside</a></li>
					<li><a href="../php/onsker.php">Mine ønsker</a></li>
					<li><a href="../php/regler.php">Festens regler</a></li>
					<li><a href="../php/tilmelding.php">Tilmelding</a></li>
					<li><a href="../php/tilmeldt.php">Tilmeldt</a></li>
					<li><a href="../php/logout.php">Log ud</a></li>
				</ul>
              
			</div>
		  </div>

		  
         </div>
		
			<div id = "leftnav"></div>
			<div id = "rightnav">
			
			</div>

		    <div id = "headline2">
                <h2><b><strong>Du er inviteret til fest</strong></b></h2>  
            </div> 		
		
        <div id = "images">
            <figure>
                <a> <img src="../pictures/flag.jpg" alt="my picture" title=" jimmi" /></a>
            </figure>
		</div>
		<div id = "invite">
			<p><strong> Ja hvis det ikke lige var for min dåbsattest,<br> de grå hår og vægten,<br> 
						             der de sidste par år er røget op og ned,<br> 
						med en fart der siger spar to til alt.<br> 
						Ja så ville jeg jo nok have forsvoret<br> 
						at jeg i dette år rykker op i de voksnes rækker.<br> 
						Men jeg må jo nok erkende, at det er den barske realitet.<br>
						<br>	
						Derfor vil det glæde mig at se dig. 
						<br>
						Lørdag, den 18-06-2016<br>
						kl. 14 til kaffe og kage.<br> kl. 18 på nedenstående adresse til et <br>BRAG af en FEST.<br>
						<br>
						på gensyn til jer alle<br>
						<br>
						S.U. senest d. 07-05-2016<br> 
						tilmelding skal ske på dette website. det påpeges at læse festens regler da brud på samme vil medføre øjeblikkelig udsmiddelse fra festen.
			</strong></p>
		
		</div>
		
		
			<div id="head">
				<p><strong> fest addressen er </strong></p> <br> <br>
			</div>
			
		<div id = "address">	
			<p><strong>
				Højkildevej 50 Ørum <br>
				8721 Daugård.<br>
				Tlf. +4523368303<br>
				Email: joa@jimmiandersen.dk
			</strong></p>
		
		</div>
          
       
      </div>
      <?php else : ?>
            <p>
				<span class="error">You are not authorized to access this page. Please</span> <a href="../index.php">login</a>.        
				</p>
        <?php endif; ?>
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>