<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::deletar('site_servicos',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
    }else if(isset($_GET['order']) && $_GET['id']){
        Painel::orderItem('site_servicos',$_GET['order'],$_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    $servicos  = Painel::selectAll('site_servicos');
    
?>
<div class="box-content">
    <h2><i class="fa fa-briefcase"></i> Listar Serviços:</h2>
    <table>
        <tr>
            <td><i class="fa fa-briefcase"></i> Serviço</td>
            <!--<td><i class="fa fa-id-card-o"></i> Depoimento</td>-->
            <td>Editar</td>
            <td>Excluir</td>
            <td>Subir</td>
            <td>Descer</td>
        </tr>
        <?php
            foreach($servicos as $key => $value){  
        ?>
        <tr>
            <td><?php echo $value['servico']; ?></td>
            <td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL;?>editar-servicos?id=<?php echo $value['id'];?>"><i class="fa fa-edit"></i> </a></td>
            <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-servicos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> </a></td>
            <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-servicos?order=up&id=<?php echo $value['id'];?>"><i class="fa fa-angle-up"></i></a></td>
            <td><a class=" btn order" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-servicos?order=down&id=<?php echo $value['id'];?>"><i class="fa fa-angle-down"></i></a></td>
        </tr>
        <?php } ?>
    </table>
</div><!--box-content-->