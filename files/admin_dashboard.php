<?php

//Protection de la page
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
	header("Location: connexion.php");
	exit();
}

//Connexion a la base de donneees
$conn = new mysqli("localhost", "root", "", "philip_lemon");

//Verification de la connexion
if ($conn->connect_error) {
	die("Echec de la conneion : " . $conn->connect_error);
}

// Recuperation de nombre total d'etudiants enscrits
$sql_etudiants = "SELECT COUNT(*) AS total FROM etudiants WHERE status = 'inscrit'";
$result_etudiants = $conn->query($sql_etudiants);
$row_etudiants = $result_etudiants->fetch_assoc();
$total_etudiants = $row_etudiants['total'];

//Recuperation de liste des etudiants
$sql_liste_etudiants = "SELECT utilisateurs.matricule, utilisateurs.nom, etudiants.faculte, 
etudiants.niveau, etudiants.status FROM etudiants JOIN utilisateurs ON etudiants.utilisateur_id = utilisateurs.id";
$result_liste_etudiants = $conn->query($sql_liste_etudiants);

//Recuperation des paiements effectuers
$sql_paiements = "SELECT utilisateurs.nom, paiements.montant, paiements.statu, paiements.date_paiement FROM paiements
JOIN utilisateurs ON paiements.utilisateur_id = utilisateurs.id";
$resul_paiements = $conn->query($sql_paiements);

?>



<!doctype html>
<!-- Martex - Software, App, SaaS & Startup Landing Pages Pack design by DSAThemes (http://www.dsathemes.com) -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="fr">




	
<!-- Mirrored from dsathemes.com/html/martex_1.1/files/features.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 Mar 2024 12:48:28 GMT -->
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="DSAThemes">	
		<meta name="description" content="Martex - Software, App, SaaS & Startup Landing Pages Pack">
		<meta name="keywords" content="Responsive, HTML5, DSAThemes, Landing, Software, Mobile App, SaaS, Startup, Creative, Digital Product">	
		<meta name="viewport" content="width=device-width, initial-scale=1">

		
		<style>
			.container {
				width: 80%;
				margin: 20px;
			}
			.tite1 {
				text-align: center;
			}
			table {
				width: 100%;
				border-collapse: collapse;
				margin-top: 20px;
			}
			th, td {
				border: 1px solid #ddd; padding: 10px; text-align: center;
			}
			th {
				background-color: #f4f4f4;
			}
		</style>

										   
				
  		<!-- SITE TITLE -->
		<title>Martex - Software, App, SaaS & Startup Landing Pages Pack</title>
							
		<!-- FAVICON AND TOUCH ICONS -->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
		<link rel="icon" href="images/apple-touch-icon.png" type="image/x-icon">

		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
		
		<!-- BOOTSTRAP CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
				
		<!-- FONT ICONS -->
		<link href="css/flaticon.css" rel="stylesheet">

		<!-- PLUGINS STYLESHEET -->
		<link href="css/menu.css" rel="stylesheet">	
		<link id="effect" href="css/dropdown-effects/fade-down.css" media="all" rel="stylesheet">
		<link href="css/magnific-popup.css" rel="stylesheet">	
		<link href="css/owl.carousel.min.css" rel="stylesheet">
		<link href="css/owl.theme.default.min.css" rel="stylesheet">
		<link href="css/lunar.css" rel="stylesheet">

		<!-- ON SCROLL ANIMATION -->
		<link href="css/animate.css" rel="stylesheet">

		<!-- TEMPLATE CSS -->
		<link href="css/blue-theme.css" rel="stylesheet">

		<!-- Style Switcher CSS -->	
		<link href="css/crocus-theme.css" rel="alternate stylesheet" title="crocus-theme">	
		<link href="css/green-theme.css" rel="alternate stylesheet" title="green-theme">
		<link href="css/magenta-theme.css" rel="alternate stylesheet" title="magenta-theme">
		<link href="css/pink-theme.css" rel="alternate stylesheet" title="pink-theme">	
		<link href="css/purple-theme.css" rel="alternate stylesheet" title="purple-theme">
		<link href="css/skyblue-theme.css" rel="alternate stylesheet" title="skyblue-theme">	
		<link href="css/red-theme.css" rel="alternate stylesheet" title="red-theme">	
		<link href="css/violet-theme.css" rel="alternate stylesheet" title="violet-theme">	
		
		<!-- RESPONSIVE CSS -->
		<link href="css/responsive.css" rel="stylesheet">

	</head>




	<body> 




		<!-- PRELOADER SPINNER
		============================================= -->	
		<div id="loading" class="loading--theme">
			<div id="loading-center"><span class="loader"></span></div>
		</div>




		<!-- STYLE SWITCHER
		============================================= -->
		<div id="stlChanger">
			<div class="blockChanger bgChanger">
            	<a href="#" class="chBut icon-xs"><span class="flaticon-control-panel"></span></a>
                <div class="chBody white-color">	

                	<div class="stBlock text-center" style="margin: 30px 20px 20px 26px;">				
						<div class="stBgs">	
							<p class="switch"></p>
						
						</div>
					</div>

					<div class="stBlock text-center" style="margin: 0px 27px 25px 31px;">
						<a class="btn r-04 btn--theme hover--theme" href="javascript:chooseStyle('none', 60)">Reset Color</a>
					</div>

				</div>
			</div>
		</div>	  <!-- END SWITCHER -->




		<!-- PAGE CONTENT
		============================================= -->	
		<div id="page" class="page font--jakarta">




			<!-- HEADER
			============================================= -->
			<header id="header" class="tra-menu navbar-dark inner-page-header white-scroll">
				<div class="header-wrapper">


					<!-- MOBILE HEADER -->
				    <div class="wsmobileheader clearfix">	  	
				    	<span class="smllogo"><img src="images/logo-blue.png" alt="mobile-logo"></span>
				    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>	
				 	</div>


				 	<!-- NAVIGATION MENU -->
				  	<div class="wsmainfull menu clearfix">
	    				<div class="wsmainwp clearfix">


	    					<!-- HEADER BLACK LOGO -->
	    					<div class="desktoplogo">
	    						<a href="demo-1.html" class="logo-black">
	    							<img class="light-theme-img" src="images/logo-blue.png" alt="logo">
	    							<img class="dark-theme-img" src="images/logo-blue-white.png" alt="logo">
	    						</a>
	    					</div>
	    					

	    					<!-- HEADER WHITE LOGO -->
	    					<div class="desktoplogo">
	    						<a href="demo-1.html" class="logo-white"><img src="images/logo-blue-white.png" alt="logo"></a>
	    					</div>


	    					<!-- MAIN MENU -->
	      					<nav class="wsmenu clearfix">
	        					<ul class="wsmenu-list nav-theme">


	        						<!-- DROPDOWN SUB MENU -->
						          	<li aria-haspopup="true"><a href="#" class="h-link">Company <span class="wsarrow"></span></a>
	            						<ul class="sub-menu">
	            							<li aria-haspopup="true"><a href="about.html">About Us</a></li>
	            							<li aria-haspopup="true"><a href="careers.html">Careers <span class="sm-info">4</span></a></li>
	            							<li aria-haspopup="true"><a href="reviews.html">Customers</a></li>
	            							<li aria-haspopup="true"><a href="blog-listing.html">Our Blog</a></li>
	            							<li aria-haspopup="true"><a href="contacts.html">Contact Us</a></li>	
						           		</ul>
								    </li>

								    <!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="projects.html" class="h-link">Case Studies</a></li>


								    <!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="pricing-1.html" class="h-link">Pricing</a></li>


								    <!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="faqs.html" class="h-link">FAQs</a></li>


							    	<!-- SIGN IN LINK -->
							    	<li class="nl-simple reg-fst-link mobile-last-link" aria-haspopup="true">
							    		<a href="login-2.html" class="h-link">Sign In</a>
							    	</li>


								    <!-- SIGN UP BUTTON -->
								    <li class="nl-simple" aria-haspopup="true">
								    	<a href="signup-2.html" class="btn r-04 btn--theme hover--theme last-link">Get Started</a>
								    </li> 


	        					</ul>
	        				</nav>	<!-- END MAIN MENU -->


	    				</div>
	    			</div>	<!-- END NAVIGATION MENU -->


				</div>     <!-- End header-wrapper -->
			</header>	<!-- END HEADER -->



			<!-- FEATURES-12
			============================================= -->
			<section id="features-12" class="shape--bg shape--white-400 pt-100 features-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						

						<!-- FEATURES-12 WRAPPER -->
						<div class="col-md-7">
							<div class="fbox-12-wrapper wow fadeInLeft">	
										<div id="page" class="page font--jakarta">


											<div class="container">
												<h1 class="tite1">Tableau de Bord - Admin</h1>

												<h3>Nombre total d'etudiants enscrits : <?php echo $total_etudiants; ?></h3>

												<h2>Liste des etudiants</h2>
												<table>
													<tr>
														<th>Matricule</th>
														<th>Nom</th>
														<th>Faculte</th>
														<th>Niveau</th>
														<th>Statut</th>
													</tr>
													<?php while ($row = $result_liste_etudiants->fetch_assoc()) {?>
															<tr>
																<td><?php echo $row['matricule']; ?></td>
																<td><?php echo $row['nom']; ?></td>
																<td><?php echo $row['faculte']; ?></td>
																<td><?php echo $row['niveau']; ?></td>
																<td><?php echo $row['status']; ?></td>
															</tr> 
															<?php
														} ?>
												</table>

												<h2>Liste des Paiements</h2>
												<table>

														<tr>
															<th>Nom</th>
															<th>Montant</th>
															<th>Statut</th>
															<th>Date de Paiement</th>
														</tr>
													<?php 
														while ($row = $result_liste_etudiants->fetch_assoc()) {?>
															<tr>
																<td><?php echo $row['nom']; ?></td>
																<td><?php echo $row['momtant']; ?></td>
																<td><?php echo $row['status']; ?></td>
																<td><?php echo $row['date_paiement']; ?></td>
															</tr>
															<?php
														}?>
												</table>
											</div>



                                        </div>	<!-- END PAGE CONTENT -->	

							</div>	<!-- End row -->
						</div>	<!-- END FEATURES-12 WRAPPER -->


					</div>    <!-- End row -->
				</div>     <!-- End container -->
			</section>	<!-- END FEATURES-12 -->




			


		



			<!-- DIVIDER LINE -->
			<hr class="divider">




			
		
			<footer id="footer-3" class="pt-100 footer">
				<div class="container">


					<!-- FOOTER CONTENT -->
					<div class="row">


						<!-- FOOTER LOGO -->
						<div class="col-xl-3">
							<div class="footer-info">
								<img class="footer-logo" src="images/logo-blue.png" alt="footer-logo">
								<img class="footer-logo-dark" src="images/logo-blue-white.png" alt="footer-logo">
							</div>	
						</div>	


						<!-- FOOTER LINKS -->
						<div class="col-sm-4 col-md-3 col-xl-2">
							<div class="footer-links fl-1">
							
								<!-- Title -->
								<h6 class="s-17 w-700">Company</h6>

								<!-- Links -->
								<ul class="foo-links clearfix">
									<li><p><a href="about.html">About Us</a></p></li>
									<li><p><a href="careers.html">Careers</a></p></li>	
									<li><p><a href="blog-listing.html">Our Blog</a></p></li>							
									<li><p><a href="contacts.html">Contact Us</a></p></li>			
								</ul>

							</div>
						</div>	<!-- END FOOTER LINKS -->	


						<!-- FOOTER LINKS -->
						<div class="col-sm-4 col-md-3 col-xl-2">
							<div class="footer-links fl-2">
												
								<!-- Title -->
								<h6 class="s-17 w-700">Product</h6>

								<!-- Links -->
								<ul class="foo-links clearfix">
									<li><p><a href="features.html">Integration</a></p></li>
									<li><p><a href="reviews.html">Customers</a></p></li>	
									<li><p><a href="pricing-1.html">Pricing</a></p></li>	
									<li><p><a href="help-center.html">Help Center</a></p></li>			
								</ul>

							</div>	
						</div>	<!-- END FOOTER LINKS -->	


						<!-- FOOTER LINKS -->
						<div class="col-sm-4 col-md-3 col-xl-2">
							<div class="footer-links fl-3">
												
								<!-- Title -->
								<h6 class="s-17 w-700">Legal</h6>

								<!-- Links -->
								<ul class="foo-links clearfix">
									<li><p><a href="terms.html">Terms of Use</a></p></li>										
									<li><p><a href="privacy.html">Privacy Policy</a></p></li>
									<li><p><a href="cookies.html">Cookie Policy</a></p></li>
									<li><p><a href="#">Site Map</a></p></li>
								</ul>

							</div>	
						</div>	<!-- END FOOTER LINKS -->	


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3">
							<div class="footer-links fl-4">
												
								<!-- Title -->
								<h6 class="s-17 w-700">Connect With Us</h6>

								<!-- Mail Link -->
								<p class="footer-mail-link ico-25">
									<a href="mailto:yourdomain@mail.com">hello@yourdomain.com</a>
								</p>

								<!-- Social Links -->	
								<ul class="footer-socials ico-25 text-center clearfix">		
									<li><a href="#"><span class="flaticon-facebook"></span></a></li>
									<li><a href="#"><span class="flaticon-twitter"></span></a></li>
									<li><a href="#"><span class="flaticon-github"></span></a></li>
									<li><a href="#"><span class="flaticon-dribbble"></span></a></li>
								</ul>

							</div>	
						</div>	<!-- END FOOTER LINKS -->	


					</div>	<!-- END FOOTER CONTENT -->


					<hr>	<!-- FOOTER DIVIDER LINE -->


					<!-- BOTTOM FOOTER -->
					<div class="bottom-footer">
						<div class="row row-cols-1 row-cols-md-2 d-flex align-items-center">


							<!-- FOOTER COPYRIGHT -->
							<div class="col">
								<div class="footer-copyright"><p class="p-sm">&copy; 2023 Martex. <span>All Rights Reserved</span></p></div>
							</div>


							<!-- FOOTER SECONDARY LINK -->
							<div class="col">
								<div class="bottom-secondary-link ico-15 text-end">
									<p class="p-sm"><a href="https://themeforest.net/user/dsathemes/portfolio">Made with 
										<span class="flaticon-heart color--pink-400"></span> by @DSAThemes</a>
									</p>
								</div>
							</div>


						</div>  <!-- End row -->
					</div>	<!-- END BOTTOM FOOTER -->


				</div>     <!-- End container -->	
			</footer>   <!-- END FOOTER-3 -->	




		</div>	<!-- END PAGE CONTENT -->	




		<!-- EXTERNAL SCRIPTS
		============================================= -->	
		<script src="js/jquery-3.7.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
		<script src="js/modernizr.custom.js"></script>
		<script src="js/jquery.easing.js"></script>
		<script src="js/jquery.appear.js"></script>
		<script src="js/menu.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/pricing-toggle.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>
		<script src="js/request-form.js"></script>	
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/jquery.ajaxchimp.min.js"></script>	
		<script src="js/popper.min.js"></script>
		<script src="js/lunar.js"></script>
		<script src="js/wow.js"></script>
				
		<!-- Custom Script -->		
		<script src="js/custom.js"></script>

		<script>
			$(document).on({
			    "contextmenu": function (e) {
			        console.log("ctx menu button:", e.which); 

			        // Stop the context menu
			        e.preventDefault();
			    },
			    "mousedown": function(e) { 
			        console.log("normal mouse down:", e.which); 
			    },
			    "mouseup": function(e) { 
			        console.log("normal mouse up:", e.which); 
			    }
			});
		</script>

		<script>
			$(function() {
			  $(".switch").click(function() {
			    $("body").toggleClass("theme--dark");
				    if( $( "body" ).hasClass( "theme--dark" )) {
	                	$( ".switch" ).text( "Light Mode" );
	            	} else {
	                	$( ".switch" ).text( "Dark Mode" );
	            	}
			    });
			});
		</script>

		<script>
			$(document).ready(function() {
	            if( $( "body" ).hasClass( "theme--dark" )) {
	                $( ".switch" ).text( "Light Mode" );
	            } else {
	                $( ".switch" ).text( "Dark Mode" );
	            }
	        });
		</script>

		

		<script src="js/changer.js"></script>
		<script defer src="js/styleswitch.js"></script>	

	</body>


</html>