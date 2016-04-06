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
    <title>Ønsker</title>
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
	<link href="../css/cssonsker.css" rel="stylesheet">
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
				<h1><b><strong>Ønskeliste</strong></b></h1>
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
                <h2><b><strong>Teksten er linket til online shop</strong></b></h2>  
            </div> 		
		
		<div id = "list">
			<ul>
				<li> <a href="http://www.elma.dk/_dk/Produkter/Lists;130070/El/Multimetre/p/5706445410101?shop.product.id=5706445410101"> <strong>Elma 805 Multimeter pris 595Kr</strong></a></li>
			
               <li> <a href="http://elektronik-lavpris.dk/p31379/w20325-laboratoriestroemforsyning-0-30vdc-0-3a/"> <strong>Laboratoriestrømforsyning 0-30VDC 0-3A pris 1.199Kr</strong></a></li>
			
               <li> <a href="http://www.biltema.dk/da/Vaerktoj/Arbejdsbank-og-opbevaring/Varktojskasser/Varktojskasse-85-dele-2000034918/"> <strong>Værktøjskasse 85 dele pris 949Kr</strong></a></li>
			
               <li> <a href="http://www.biltema.dk/da/Vaerktoj/Malevarktoj/Skydelare-og-Mikrometerskrue/Digital-skydelare-2000017022/"> <strong>Digital skydelære 189Kr</strong></a></li>
			
               <li> <a href="http://www.fribikeshop.dk/cykeludstyr/til-dig/fri-gavekort-2015"> <strong>Gavekort til fri cykler pris max 600Kr</strong></a></li>
				
               <li> <a href="http://www.bauhaus.dk/varemaerker/dremel/dremel-multivaerktojssaet-3000-15-stk-tilbehor-3000-15.html"> <strong>DREMEL MULTIVÆRKTØJSSÆT 3000-15 15 STK. TILBEHØR pris 650Kr</strong></a></li>
			
               <li> <a href="http://www.biltema.dk/da/Vaerktoj/Trykluft/Kompressorer/Kompressor-15-24-2000033784/"> <strong>Kompressor 15-24 pris 649Kr</strong></a></li>
			
               <li> <a href="http://elektronik-lavpris.dk/p135057/bn207077-printpladeholder/"> <strong>Printpladeholder pris 149Kr</strong></a></li>
			
               <li> <a href="http://dk.rs-online.com/web/p/grafisk-display-udviklingssaet/8997466/"> <strong>Nyhed Raspberry Pi 7" Touch Screen LCD pris 439Kr</strong></a></li>
			
               <li> <a href="https://www.proshop.dk/Skaerm/27-S27D390HS-PLS-Black/2439737?fv~skaerme_diagonalstorrelse=2700-2999&b=samsung"> <strong>Samsung 27" S27D390HS - PLS - Black pris 1.736Kr</strong></a></li>
			
               <li> <a href="http://www.biltema.dk/da/Vaerktoj/Handvarktoj/Tanger-og-Sakse/Minitanger-6-stk-2000031363/"> <strong>Minitænger, 6 stk. pris 159Kr</strong></a></li>
				
               <li> <a href="http://www.amazon.co.uk/gp/product/B014L10V02/ref=s9_simh_gw_p328_d1_i13?pf_rd_m=A3P5ROKL5A1OLE&pf_rd_s=desktop-2&pf_rd_r=09THDJ7VDHCCSCES3P2C&pf_rd_t=36701&pf_rd_p=577047927&pf_rd_i=desktop"> <strong>starter Kit for Raspberry Pi pris 23 pound</strong></a></li>
				
               <li> <a href="http://elektronik-lavpris.dk/p121490/bn206424-breadboard-4660-kontakter/"> <strong>Breadboard 4660 kontakter pris 399Kr</strong></a></li>
			
               <li> <a href="http://pdtrade.dk/shop/35-cree-xm-l-t6-1600-lumen-pandelygte.html"> <strong>CREE XM-L T6 1600 lumen pandelygte pris 339Kr</strong></a></li>
				
               <li> <a href="https://www.one.com"> <strong>domain navn: andersen-software pris 400Kr</strong></a></li>			  
			   
				<li> <a href="http://cdon.dk/film/arrow_-_s%C3%A6son_4_%28blu-ray%29-34313906"> <strong>Arrow season 4 blu-ray pris kommende Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/game_of_thrones_-_s%C3%A6son_5_%28blu-ray%29_%284_disc%29-27020393"> <strong>Game of thrones season 5 Blu-ray pris 399Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/star_wars%3a_episode_vii_-_the_force_awakens_%28blu-ray%29_%282_disc%29-21666680"> <strong>Star wars episode 7 Blu-ray pris 199Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/the_flash_-_s%C3%A6son_2_%28blu-ray%29-34313911"> <strong>Flash season 2 Blu-ray pris kommende Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/bones_-_s%C3%A6son_10_%286_disc%29-27586582"> <strong>Bones season 10 Dvd pris 249Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/bones_-_s%C3%A6son_11-34026525"> <strong>Bones season 11 Dvd pris kommende Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/merlin_-_season_4_%284_disc%29-35731627"> <strong>Merlin season 4 Dvd pris 99Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/how_i_met_your_mother_-_s%C3%A6son_6_%283_disc%29-33295556"> <strong>How i meet your mother season 6 Dvd pris 149Kr</strong></a></li>
			   
				<li> <a href="http://cdon.dk/film/how_i_met_your_mother_-_s%C3%A6son_7-33295557"> <strong>How i meet your mother season 7 Dvd pris 149Kr</strong></a></li>
				
				<li> <a href="http://cdon.dk/film/how_i_met_your_mother_-_s%C3%A6son_8_%283_disc%29-20641703"> <strong>How i meet your mother season 8 Dvd pris 199Kr</strong></a></li>
			   
				<li> <a href="http://iqleg.dk/4x4x4-84/moyu-aosu-p725"> <strong>Rubiks cube 4X4X4 pris 249Kr</strong></a></li>
				
				<li> <a href="http://iqleg.dk/6x6x6-90/moyu-aoshi-6x6-p769"> <strong>Rubiks cube 6X6X6 pris 429Kr</strong></a></li>
				
				<li> <a href="http://iqleg.dk/7x7x7-91/shengshou-7x7x7-p674"> <strong>Rubiks cube 7X7X7 pris 299Kr</strong></a></li>				
			   
				<li> <a href=> <strong>Penge</strong></a></li>
			</ul>
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