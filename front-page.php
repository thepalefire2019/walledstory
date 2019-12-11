<?php
get_header();
	
	?>
	<style type="text/css">
		.bl-nav{display: none;}
		.parent{ width: 100%; height:80vh;background-image: url(" <?php echo get_stylesheet_directory_uri()?>/img/temp.jpg"); background-repeat: no-repeat;   position: relative;
		 margin-bottom: 20px;overflow: hidden; }
		.child{ position: absolute; width:100%; height:100%;top:0; left:0; background:rgba(0,0,0,0.6); }
		.writting{position: absolute; color:#fff; transform: translateX(-50%); margin-left: 50%; top:15vh;}
		.writting p{  text-align: center; text-transform: capitalize; font-size:37px; padding-bottom: 4vh; line-height: 43px;}
		.writting p span{ text-transform: uppercase; font-weight: bold; }
		.writting h5{  text-align: center; font-size:24px; padding-bottom: 1vh;}
		.writting h6{  text-align: center; margin-top: 20px; font-size:19px; font-weight:500; text-transform: uppercase;}
		.writting a{ color: #828282; text-decoration: none; }
		.countdown-div{ position: absolute; color:#fff; transform: translateX(-50%); margin-left: 50%; bottom:8vh; }
		.number{ font-size:45px; padding:18px; background-color: transparent;  width: 90px; text-align: center; }
		.of{text-align: center; font-size: 22px; font-weight: 700; color: #ddd;  text-transform: uppercase;margin-left: -5px}
		.no-margin{margin:0 !important;}
		.bl-header-search a{ color:#000; }
		.register{position: absolute; transform: translateX(-50%); margin-left: 50%; bottom:2vh;}
		.register a{ color:#fff; text-decoration: none;}
		footer{display:none;}
		@media only screen and (max-width : 767px) {
			.parent{height: 100vh}
			.bl-header-logo h2{ font-size: 2em; }
			.bl-header-search{display: none;}
			.writting{top:7vh;}
			.writting p{font-size: 28px; line-height: 35px; margin-bottom: 10px;}
			.writting h5{font-size: 18px;}
			.writting h6{font-weight: 700; font-size: 14px; margin-top:22px;}
			.countdown-div{bottom: 15vh; margin-left: 48%;}
			.number{font-size: 25px; }
			.number:nth-child(even){margin-right:5px;}
			.box{margin-bottom: 12px;}
			.of{font-size: 16px;margin-left: 10px}
			.bl-header-search a{ color:#000; }
		}	

	</style>
	<div class="row no-margin">
		<div class="col-md-12">
			<div class="parent">
				<div class="child">
					<div class="writting">
						<p>We Are Getting ready to launch <span>Walledstory.</span></p>
						<h5>An interactive blogging space for all. </h5>
						<h6><a href="https://thepalefire.com/">A Palefire Production.</a></h6>
					</div>
					<div class="countdown-div">
						<div class="row">
							<div class="col-md-3 col-6 box">
								<p id="days" class="number">19</p>
								<h4 class="of">Days</h4>
							</div>
							<div class="col-md-3 col-6 box">
								<p id="hours" class="number">19</p>
								<h4 class="of">Hours</h4>
							</div>
							<div class="col-md-3 col-6 box">
								<p id="minutes" class="number">19</p>
								<h4 class="of">Minutes</h4>
							</div>
							<div class="col-md-3 col-6 box">
								<p id="seconds" class="number">19</p>
								<h4 class="of">Seconds</h4>
							</div>
						</div>
					</div>
					<div class="register">
						<a href="<?php echo wp_registration_url() ; ?>">Register</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		
		function countdown(){
			var now = new Date();
			var eventDate = new Date(2019, 12, 25);

			var currentTime = now.getTime();
			var eventTime = eventDate.getTime();

			var remTime = eventTime - currentTime;
			var s = Math.floor( remTime/1000 );
			var m = Math.floor( s/60 );
			var h = Math.floor( m/60 );
			var d = Math.floor( h/60 );

			h %= 24;
			m %= 60;
			s %= 60;

			h = ( h < 10 )? "0" + h : h;
			m = ( m < 10 )? "0" + m : m;
			s = ( s < 10 )? "0" + s : s;
			
			document.getElementById("days").textContent = d;
			document.getElementById("days").innerText = d;

			document.getElementById("hours").textContent = h;
			document.getElementById("minutes").textContent = m;
			document.getElementById("seconds").textContent = s;

			setTimeout( countdown, 1000 );


		}
		jQuery(document).ready( function($){
			countdown();
			
		} );
	</script>


	<?php



get_footer();
?>

<!-- 
<td id="days">120</td>
<td id="hours">12</td>
<td id="minutes">4</td>
<td id="seconds">22</td>
-->