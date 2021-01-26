<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::deletar('site_depoimentos',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-depoimentos');
    }else if(isset($_GET['order']) && $_GET['id']){
        Painel::orderItem('site_depoimentos',$_GET['order'],$_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    $depoimentos  = Painel::selectAll('site_depoimentos');
    
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Depoimentos cadastrados:</h2>
    <table>
        <tr>
            <td><i class="fa fa-user"></i> Nome</td>
            <!--<td><i class="fa fa-id-card-o"></i> Depoimento</td>-->
            <td><i class="fa fa-table"></i> Data</td>
            <td>Editar</td>
            <td>Excluir</td>
            <td>Subir</td>
            <td>Descer</td>
        </tr>
        <?php
            foreach($depoimentos as $key => $value){  
        ?>
        <tr>
            <td><?php echo $value['nome']; ?></td>
            <td><?php echo $value['data']; ?></td>
            <td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL;?>editar-depoimentos?id=<?php echo $value['id'];?>"><i class="fa fa-edit"></i> </a></td>
            <td><a actionBtn="btn delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-depoimentos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> </a></td>
            <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-depoimentos?order=up&id=<?php echo $value['id'];?>"><i class="fa fa-angle-up"></i></a></td>
            <td><a class=" btn order" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-depoimentos?order=down&id=<?php echo $value['id'];?>"><i class="fa fa-angle-down"></i></a></td>
        </tr>

        <?php } ?>
    </table>
</div><!--box-content-->