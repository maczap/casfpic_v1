<!DOCTYPE html>
<!-- saved from url=(0032)# -->
<html lang="pt-br"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    	<!-- Meta Tags -->
        
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<meta name="description" content="CASFPIC">
    	<meta name="keywords" content="convênio odontológico uniodonto, convênio odontológico unimed,">
    	<meta name="author" content="Marcos Granziera">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    	<!-- Title -->
    	<title>CASFPIC</title>
    
    	<!-- Favicon and Touch Icons -->
    	<link href="#images/favicon.png" rel="shortcut icon" type="image/png">
    	<link href="#images/apple-touch-icon.png" rel="apple-touch-icon">
    	<link href="#images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    	<link href="#images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    	<link href="#images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
    
    	<!-- Stylesheet -->
        
    	<link href="css/hero/bootstrap.min.css" rel="stylesheet" type="text/css">
    	<link href="css/hero/ace-responsive-menu.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/hero/all.min.css">
        <link rel="stylesheet" type="text/css" href="css/hero/flaticon.css">
        <link rel="stylesheet" type="text/css" href="css/hero/owl.carousel.min.css">
    	<link href="css/hero/default.css" rel="stylesheet" type="text/css">
    	<link href="css/hero/style.css" rel="stylesheet" type="text/css">
        <link href="css/hero/responsive.css" rel="stylesheet" type="text/css">
        <link href="css/app.css" rel="stylesheet" type="text/css">
        
        
    </head>
    <body>
        
		<div class="main-content-area" id="app">
            <!-- Header start -->
            <header id="header-section">
                <!-- Header main nav -->
                <div id="sticky-header" class="header-main-menu sticky-menu">
                    <div class="container">
                        <div class="row">
                            <!-- Header logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="header-logo d-none d-md-block d-lg-block d-xl-block">
                                    <a href="#index.html"><img src="images/hero/logo.png" alt="logo"></a>
                                </div>
                            </div>
                            <!-- Header Responsive menu -->
                            <div class="col-xl-9 col-lg-8 col-md-8">
                                <div class="header-menu f-right">
                                    <nav>
                                        <!-- Menu Toggle btn-->
                                        <div class="menu-toggle" style="display: none;">
                                            <!-- Mobile logo -->
                                            <div class="mobile-logo">
                                                <a href="#index.html"><img src="images/hero/logo.png" alt="logo"></a>
                                            </div>
                                            <button type="button" id="menu-btn">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal" style="display: none;">
                                            <li class=""><a href="#index.html"><span class="title">Home</span></a></li>
                                            <li class=""><a href="javascript:;"><span class="title">Sobre nós</span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#about.html">About - 01</a></li>
                                                    <li><a href="#about-2.html">About - 02</a></li>
                                                    <li><a href="#"></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:;"><span class="title">Serviços</span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#service.html">Service - 01</a></li>
                                                    <li><a href="#service-2.html">Service - 02</a></li>
                                                    <li><a href="#service-details.html">Service Details</a></li>
                                                    <li><a href="#"></a></li>
                                                </ul>
                                            </li>
                                            <li class=""><a class="" href="javascript:;"><span class="title">Planos</span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#faqs.html">Faqs</a></li>
                                                    <li><a href="#career.html">Jobs &amp; Career</a></li>
                                                    <li><a href="#project.html">Projects</a></li>
                                                    <li><a href="#team.html">Team</a></li>
                                                    <li><a href="#partner.html">Our Partner</a></li>
                                                    <li><a href="#404.html">404 Error</a></li>
                                                </ul>
                                            </li>
                                            <li class=""><a class="" href="javascript:;"><span class="title">Blog</span></a>
                                                <ul class="sub-menu" style="">
                                                    <li><a href="#blog.html">Blog three column</a></li>
                                                    <li><a href="#blog-2.html">Blog two col right sidebar </a></li>
                                                    <li><a href="#blog-3.html">Blog one col left sidebar </a></li>
                                                    <li><a href="#single-blog.html">Single Blog Details</a></li>
                                                </ul>
                                            </li>
                                            <li class=""><a class="" href="#contact.html"><span class="title">Contato</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </header>
            <!-- Header end -->
            
                @yield('content')
            
            
            <!-- Blog end -->

			<!-- Footer start -->
            @section('footer')
            <footer id="footer-section" class="mt-120">
            
				<div class="container">
					<div class="row">
                        <div class="col-xl-4 col-sm-6 col-md-6 col-lg-4">
                            <div class="footer-about">
                                <a href="#"><img src="images/hero/logo.png" alt="footer logo"></a>
                                <p>Bdolorum eaque Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam.</p>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-md-6 col-lg-2">
                            <div class="footer-cmn footer-menu">
                                <h5>Institucional</h5>
                                <ul>
                                    <li><a href="#">Diretoria</a></li>
                                    <li><a href="#">Estatuto</a></li>
                                    <li><a href="#">Critérios</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-md-6 col-lg-2">
                            <div class="footer-cmn footer-quick-link">
                                <h5>Contato</h5>
                                <ul>
                                    <li><a href="#">contato@casfpic.org.br</a></li>
                                    <li><a href="#">((11)0000-0000</a></li>
                       
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-md-6 col-lg-4">
                            <div class="footer-cmn footer-social-link">
                                <h5>Redes sociais</h5>
                                <ul>
                                    <li><a class="social-bg-fb" href="#"><i class="flaticon-facebook"></i> Facebook</a></li>
                                    <li><a class="social-bg-link" href="#"><i class="flaticon-linkedin"></i> Linkedin</a></li>
                                    <li><a class="social-bg-twit" href="#"><i class="flaticon-twitter"></i> Twitter</a></li>
                                    <li><a class="social-bg-dribb" href="#"><i class="flaticon-dribbble-logo"></i> Dribbble</a></li>
                                    <li><a class="social-bg-inst" href="#"><i class="flaticon-instagram"></i> Instagram</a></li>
                                    <li><a class="social-bg-pint" href="#"><i class="flaticon-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="footer-shape-one">
                                 <img src="images/hero/hero-shape-3.png" alt="">
                             </div>
                             <div class="footer-shape-two">
                                 <img src="images/hero/shape-small-01.png" alt="">
                             </div>
                             <div class="footer-shape-three">
                                 <img src="images/hero/shape-small-02.png" alt="">
                             </div>
                             <div class="footer-shape-four">
                                 <img src="images/hero/shape-small-03.png" alt="">
                             </div>
                        </div>
					</div>
				</div>
            
            </footer>
            @show
			<!-- Footer end -->

            <!-- Copyright start -->
            <div id="copyright-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="">
                                <p>@Copyrights Reserved by <a href="#">CASFPIC</a></p>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- Copyright end -->
			
            <!-- scrollToTop start -->
            <div id="scrollToTop">
                <a href="#" class="scrollToTop" style="display: inline;"><i class="flaticon-up-arrow"></i></a>
            </div>
            <!-- scrollToTop end -->
		</div>    
        
        <script src="js/app.js"></script>
        <script src="js/all.js"></script>
    
    </body>
</html>