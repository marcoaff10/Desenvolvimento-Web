<?php
    $usuariosOnline = Painel::listarUsuariosOnlne();

    $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `admin_visitas`");
    $pegarVisitasTotais->execute();
    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

    $pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `admin_visitas` WHERE dia = ?");
    $pegarVisitasHoje->execute(array(date('Y-m-d')));
    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>

<div class="box-content">
    <h2><i class="fa fa-home"></i>Painel de Controle - <?php echo NOME_EMPRESA; ?></h2>
    <div style="background-color: #5bc99f;" class="box-metrica-single">
        <div class="box-metrica-wraper">
            <h2>Usuários Online</h2>
            <p><?php echo count($usuariosOnline); ?></p>
        </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div style="background-color: #bdb959;" class="box-metrica-single">
        <div class="box-metrica-wraper">
            <h2>Total de Visitas</h2>
            <p><?php echo $pegarVisitasTotais; ?></p>
        </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div style="background-color: #F55139;" class="box-metrica-single">
        <div class="box-metrica-wraper">
            <h2>Visitas Hoje</h2>
            <p><?php echo $pegarVisitasHoje; ?></p>
        </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div class="clear"></div>
</div><!--box-content-->

<div class="box-content">
    <h2 style="text-align: center;"><i class="fa fa-user"></i>Usuários Online no Site</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP:</span>
            </div><!--col-->
            <div class="col">
                <span>Ultima ação:</span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php 
            foreach($usuariosOnline as $key => $value){
        ?>
        <div class="row2">
            <div class="col">
                <span><?php echo $value['ip']; ?></span>
            </div><!--col-->
            <div class="col">
            <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])); ?></span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php } ?>
    </div><!--table-responsive-->
</div><!--box-content-->

<div class="box-content">
    <h2 style="text-align: center;"><i class="fa fa-user"></i>Usuários do Painel</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>Nome:</span>
            </div><!--col-->
            <div class="col">
                <span>Cargo:</span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php 
            $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `admin_usuarios`");
            $usuariosPainel->execute();
            $usuariosPainel = $usuariosPainel->fetchAll();
            foreach($usuariosPainel as $key => $value){
        ?>
        <div class="row2">
            <div class="col">
                <span><?php echo $value['nome']; ?></span>
            </div><!--col-->
            <div class="col">
            <span><?php echo pegaCargo($value['cargo']); ?></span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php } ?>
    </div><!--table-responsive-->
</div><!--box-content-->