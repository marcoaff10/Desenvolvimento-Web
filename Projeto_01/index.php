<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php
    $infoSite = MySql::conectar()->prepare("SELECT * FROM `site_config`");
    $infoSite->execute();
    $infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do meu site">
    <meta name="keywords" content="site,programador,front-end,criar,jacutinga">
    <link rel="icon" href="<?php echo INCLUDE_PATH;?>favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/font-awesome.min.css">
    <link href="<?php echo INCLUDE_PATH;?>css/style.css" rel="stylesheet" />
    <title><?php echo $infoSite['titulo'];?></title>
</head>
<body>
    <base base="<?php echo INCLUDE_PATH;?>">
    <?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'Sobre':
				echo '<target target="sobre" />';
				break;

			case 'Servicos':
				echo '<target target="servico" />';
				break;
		}
    ?>
    <div class="sucesso">Formulário enviado com sucesso!</div>
    <div class="overlay-loading">
        <img src="<?php echo INCLUDE_PATH;?>images/ajax-loader.gif" alt="">
    </div><!--overlay-loading-->
    <header> 
        <div class="container">
            <div class="logo"><a href="<?php echo INCLUDE_PATH;?>"><img src="<?php echo INCLUDE_PATH;?>images/logo.png.png" alt=""></a></div><!--logo-->
            <nav class="desktop">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH;?>Home">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>Sobre">Sobre</a></li>    
                    <li><a href="<?php echo INCLUDE_PATH;?>Servicos">Serviços</a></li>
                    <li><a realtime href="<?php echo INCLUDE_PATH;?>Contato">Contato</a></li>
                </ul>
            </nav><!--desktop-->

            <nav class="mobile">
                <div class="bnt-mobile">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div><!--bnt-mobile-->
                <ul>
                    <li style="border-top: 1px solid #ebe7d9;"><a href="<?php echo INCLUDE_PATH;?>Home">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>Sobre">Sobre</a></li>    
                    <li><a href="<?php echo INCLUDE_PATH;?>Servicos">Serviços</a></li>
                    <li><a realtime href="<?php echo INCLUDE_PATH;?>Contato">Contato</a></li>
                </ul>
            </nav><!--mobile-->
            <div class="clear"></div>
        </div><!--container-->
    </header>
        <div class="container-principal">
    <?php
        if(file_exists('pages/'.$url.'.php')){
            include('pages/'.$url.'.php');
        }else{
            if($url != 'Sobre' && $url != 'Servicos'){
            $pagina404 = true;
            include('pages/404.php');
            }else{
                include('pages/home.php');
            }
        }
    ?>    
        </div><!--container-principal-->
    <footer>
        <div class="container">
            <h2>Todos os nossos direitos reservados</h2>
        </div><!--container-->
    </footer>
<script src="<?php echo INCLUDE_PATH;?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH;?>js/function.js"></script>  
<?php 
    if($url == 'Contato'){
    ?>
<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script> 
<script src="<?php echo INCLUDE_PATH;?>js/map.js"></script>
<?php } ?>
</body>
</html>