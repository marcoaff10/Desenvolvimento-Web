<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        $selectImagem = MySql::conectar()->prepare("SELECT slide FROM `site_slides` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));

        $imagem = $selectImagem->fetch()['slide'];
        Painel::deleteFile($imagem);
        Painel::deletar('site_slides',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
    }else if(isset($_GET['order']) && $_GET['id']){
        Painel::orderItem('site_slides',$_GET['order'],$_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    $slides  = Painel::selectAll('site_slides');
    
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Slides cadastrados:</h2>
    <table>
        <tr>
            <td><i class="fa fa-user"></i> Nome</td>
            <!--<td><i class="fa fa-id-card-o"></i> Depoimento</td>-->
            <td><i class="fa fa-table"></i> imagem</td>
            <td>Editar</td>
            <td>Excluir</td>
            <td>Subir</td>
            <td>Descer</td>
        </tr>
        <?php
            foreach($slides as $key => $value){  
        ?>
        <tr>
            <td><?php echo $value['nome']; ?></td>
            <td><img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $value['slide']; ?>" alt=""></td>
            <td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL;?>editar-slides?id=<?php echo $value['id'];?>"><i class="fa fa-edit"></i> </a></td>
            <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-slides?excluir=<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> </a></td>
            <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-slides?order=up&id=<?php echo $value['id'];?>"><i class="fa fa-angle-up"></i></a></td>
            <td><a class=" btn order" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-slides?order=down&id=<?php echo $value['id'];?>"><i class="fa fa-angle-down"></i></a></td>
        </tr>

        <?php } ?>
    </table>
</div><!--box-content-->