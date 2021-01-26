<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo INCLUDE_PATH;?>favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL;?>estilo/style.css">
    <title>Painel de Controle</title>
</head>
<body>
<div class="menu">
	<div class="box-usuario">
		<?php
			if($_SESSION['img'] == ''){
		?>
			<div class="avatar-usuario">
				<i class="fa fa-user"></i>
			</div><!--avatar-usuario-->
		<?php }else{ ?>
			<div class="imagem-usuario">
				<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" />
			</div><!--avatar-usuario-->
		<?php } ?>
		<div class="nome-usuario">
			<p><?php echo $_SESSION['nome']; ?></p>
			<p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
		</div><!--nome-usuario-->
    </div><!--box-usuario-->
    <div class="itens-menu">
            <h2>Cadastrar</h2>
            <a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-depoimento"><i class="fa fa-angle-double-right"></i> Cadastrar Depoimento</a>
            <a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-servico"><i class="fa fa-angle-double-right"></i> Cadastrar Serviços</a>
            <a <?php selecionadoMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-slides"><i class="fa fa-angle-double-right"></i> Cadastrar Slides</a>
            <h2>Gestão</h2>
            <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-depoimentos"><i class="fa fa-angle-double-right"></i> Listar Depoimentos</a>
            <a <?php selecionadoMenu('listar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-servicos"><i class="fa fa-angle-double-right"></i> Listar Serviços</a>
            <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-slides"><i class="fa fa-angle-double-right"></i> Listar Slides</a>
            <h2>Admin. do Painel</h2>
            <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-usuario"><i class="fa fa-angle-double-right"></i> Editar Usuário</a>
            <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissao(0); ?>href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario"><i class="fa fa-angle-double-right"></i> Adicionar Usuários</a>
            <h2>Configuração Geral</h2>
            <a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-site"><i class="fa fa-angle-double-right"></i> Editar Site</a>
    </div><!--itens-menu-->
</div><!--menu-->
<header>
	<div class="center">
		<div class="menu-btn">
			<i class="fa fa-bars"></i>
        </div><!--menu-btn-->
            <div class="logo-main"><img src="<?php echo INCLUDE_PATH_PAINEL ?>images/logo.png.png" alt=""></div>
		<div class="loggout">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>"><i style="font-size: 30px;" class="fa fa-home"></i><span></span></a>
			<a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"> <i class="fa fa-window-close"></i><span></span></a>
		</div><!--loggout-->

		<div class="clear"></div>
	</div>
</header>

    <section class="content">
            <?php Painel::carregarPagina(); ?>
    </section><!--content-->
    <div class="clear"></div>
<script src="<?php echo INCLUDE_PATH_PAINEL;?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL;?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL;?>js/main.js"></script>
</body>
</html>