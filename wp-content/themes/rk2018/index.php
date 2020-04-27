<?php get_header(); ?>
<!-- Header -->
<header id="header">
    <div class="intro text-center">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="intro-text">
                        <h1>Rafael Keller</h1>
                        <p>Desenvolvedor Full Stack</p>
                        <a href="#about" class="btn btn-default btn-lg page-scroll">Saiba mais</a> </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Navigation -->
<div id="nav">
    <nav class="navbar navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse"> <i class="fa fa-bars"></i> </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-main-collapse">
                <ul class="nav navbar-nav">

                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden"> <a href="#page-top"></a> </li>
                    <li> <a class="page-scroll" href="#page-top">Home</a> </li>
                    <li> <a class="page-scroll" href="#about">Sobre</a> </li>
                    <li> <a class="page-scroll" href="#skills">Habilidades</a> </li>
                    <li> <a class="page-scroll" href="#portfolio">Projetos</a> </li>
                    <li> <a class="page-scroll" href="#testimonials">Depoimentos</a> </li>
                    <li> <a class="page-scroll" href="#contact">Contato</a> </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- About Section -->
<div id="about">
    <div class="container">
        <div class="section-title text-center center">
            <h2>Sobre mim</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6"> <img src="<?php echo get_template_directory_uri() ?>/images/photo.jpg" class="img-responsive" alt=""> </div>
            <div class="col-xs-12 col-md-6">
                <div class="about-text">
                    <p>
                        Trabalho com desenvolvimento web a <?php echo (date("Y") - 2007) ?> anos. Com destaques para alguns projetos de clientes como Petrobrás, Dpvat Seguradora, FTD Editora além de duas consultorias para empresas de São Paulo.
                    </p>
                    <p>Hoje trabalho como freelancer e na pesquisa de automação e produtividade do desenvolvimento web (back e front), tentando aplicar as boas práticas de desenvolvimento para se obter um resultado de qualidade com um tempo mais otimizado.</p>
                    <a href="#portfolio" class="btn btn-primary btn-lg page-scroll">Projetos</a> </div>
            </div>
        </div>
    </div>
</div>
<!-- Skills Section -->
<div id="skills" class="text-center">
    <div class="container">
        <div class="section-title center">
            <h2>Habilidades</h2>
            <hr>
        </div>
        <div class="row">
             <div class="col-md-3 col-sm-6 skill"> <span class="chart" data-percent="95"> <span class="percent">95</span> </span>
                <h4>PHP</h4>
            </div>
            <div class="col-md-3 col-sm-6 skill"> <span class="chart" data-percent="95"> <span class="percent">95</span> </span>
                <h4>jQuery</h4>
            </div>
            <div class="col-md-3 col-sm-6 skill"> <span class="chart" data-percent="85"> <span class="percent">85</span> </span>
                <h4>HTML5</h4>
            </div>
            <div class="col-md-3 col-sm-6 skill"> <span class="chart" data-percent="80"> <span class="percent">80</span> </span>
                <h4>CSS3</h4>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Section -->
<div id="portfolio">
    <div class="container">
        <div class="section-title text-center center">
            <h2>Alguns Projetos</h2>
            <hr>
        </div>
        <!--
        <div class="categories">
            <ul class="cat">
                <li>
                    <ol class="type">
                        <li><a href="#" data-filter="*" class="active">All</a></li>
                        <li><a href="#" data-filter=".web">Web Design</a></li>
                        <li><a href="#" data-filter=".app">App Development</a></li>
                        <li><a href="#" data-filter=".branding">Branding</a></li>
                    </ol>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        -->
        <div class="row">
            <div class="portfolio-items">
                <div class="col-sm-6 col-md-3 col-lg-3 web">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="<?php echo get_template_directory_uri() ?>/images/portfolio/unikhb.jpg" title="UnikHB Altos Negócios" rel="prettyPhoto[pp_gal]">
                                <div class="hover-text">
                                    <h4>UnikHB</h4>
                                    <small>Full Stack</small>
                                </div>
                                <img src="<?php echo get_template_directory_uri() ?>/images/portfolio/unikhb-small.jpg" class="img-responsive" alt="UnikHB">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 web">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="<?php echo get_template_directory_uri() ?>/images/portfolio/opote.jpg" title="O Pote" rel="prettyPhoto[pp_gal]">
                                <div class="hover-text">
                                    <h4>O Pote</h4>
                                    <small>Back End</small>
                                </div>
                                <img src="<?php echo get_template_directory_uri() ?>/images/portfolio/opote-small.jpg" class="img-responsive" alt="O Pote">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 web">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="<?php echo get_template_directory_uri() ?>/images/portfolio/dpvat.jpg" title="Dpvat" rel="prettyPhoto[pp_gal]">
                                <div class="hover-text">
                                    <h4>Dpvat</h4>
                                    <small>Front End</small>
                                </div>
                                <img src="<?php echo get_template_directory_uri() ?>/images/portfolio/dpvat-small.jpg" class="img-responsive" alt="Dpvat">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 web">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="<?php echo get_template_directory_uri() ?>/images/portfolio/medquimica.jpg" title="MedQumica" rel="prettyPhoto[pp_gal]">
                                <div class="hover-text">
                                    <h4>MedQuimica</h4>
                                    <small>Back End</small>
                                </div>
                                <img src="<?php echo get_template_directory_uri() ?>/images/portfolio/medquimica-small.jpg" class="img-responsive" alt="MedQumica">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Achievements Section -->
<div id="achievements" class="text-center">
    <div class="container">
        <div class="section-title center">
            <h2>Números</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3 wow fadeInDown" data-wow-delay="200ms">
                <div class="achievement-box"> <span class="count">32</span>
                    <h4>Projetos trabalhados</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 wow fadeInDown" data-wow-delay="100ms">
                <div class="achievement-box"> <span class="count">3</span>
                    <h4>Projetos no GitHub</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 wow fadeInDown" data-wow-delay="600ms">
                <div class="achievement-box"> <span class="count">349</span>
                    <h4>Reputação StackOverflow</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 wow fadeInDown" data-wow-delay="1100ms">
                <div class="achievement-box"> <span class="count"><?php echo date("Y") - 2007 ?></span>
                    <h4>Anos de experiência</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonials Section -->
<div id="testimonials" class="text-center">
    <div class="container">
        <div class="section-title center">
            <h2>Depoimentos</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row testimonials">
                    <div class="col-sm-4">
                        <blockquote><i class="fa fa-quote-left"></i>
                            <p>Rafael é um profissional muito esforçado e trabalhador. Possui uma forte capacidade técnica e busca sempre manter-se atualizado. Mantém o astral elevado de todos ao seu redor e com alto grau de motivação. Por ser um profissional de meu conhecimento eu o recomendo.</p>
                            <div class="clients-name">
                                <p><strong>Carlos Alberto Velloso Júnior, MBA, ITIL</strong><br>
                                    <em>Analista de Sistemas na Thomson Reuters</em></p>
                            </div>
                        </blockquote>
                    </div>
                    <div class="col-sm-4">
                        <blockquote><i class="fa fa-quote-left"></i>
                            <p>Na verdade, esta é uma recomendação para quando ele trabalhava na Solucionar, na mesma equipe que eu. Rafael é uma pessoa que trabalha muito bem em equipe, além de possuir muitos conhecimentos técnicos.</p>
                            <div class="clients-name">
                                <p><strong>Lucas Romano</strong><br>
                                    <em>Sócio na Nativa Desenvolvimento</em></p>
                            </div>
                        </blockquote>
                    </div>
					<div class="col-sm-4">
                        <blockquote><i class="fa fa-quote-left"></i>
                            <p>Profissional qualificado, dinâmico e proativo. Sempre um passo a frente e por dentro das novidades e atualidades.</p>
                            <div class="clients-name">
                                <p><strong>Paulo Rezende</strong><br>
                                    <em>Mestre em Ciência da Computação</em></p>
                            </div>
                        </blockquote>
                    </div>
                    <!--
                    <div class="col-sm-4">
                        <blockquote><i class="fa fa-quote-left"></i>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elitduis sed dapibus leo nec ornare.</p>
                            <div class="clients-name">
                                <p><strong>Chris Smith</strong><br>
                                    <em>CEO, Company Inc.</em></p>
                            </div>
                        </blockquote>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section -->
<div id="contact" class="text-center">
    <div class="overlay">
        <div class="container">
            <div class="section-title center">
                <h2>Contato</h2>
                <hr>
            </div>
            <div class="col-md-8 col-md-offset-2">

                <?php echo do_shortcode( '[contact-form-7 id="123" title="Contact form 1"]' ); ?>


                <div class="social">
                    <ul>
                        <li><a target="_blank" href="https://www.facebook.com/faelkeller"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://twitter.com/faelkeller"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://stackoverflow.com/users/2912374/rafael-keller"><i class="fa fa-stack-overflow"></i></a></li>
                        <li><a target="_blank" href="https://github.com/faelkeller"><i class="fa fa-github"></i></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/faelkeller" ><i class="fa fa-instagram"></i></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/in/rafael-keller-25931025/"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
