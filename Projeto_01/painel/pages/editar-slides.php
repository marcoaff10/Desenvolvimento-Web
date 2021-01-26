<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $slide = Painel::select('site_slides','id = ?',array($id));
    }else{
        Painel::alert('erro','Você precisa passar o parametro ID!');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-edit"></i> Editar slide:</h2>
    <form method="post" enctype="multipart/form-data">
        <?php 
           if(isset($_POST['acao'])){
            //Enviei o meu formulário.
            
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];
                if($imagem['name'] != ''){
                    //Existe o upload de imagem.
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadImagem($imagem);
                        $arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'site_slides'];
                        Painel::update($arr);
                        $slide = Painel::select('site_slides','id = ?',array($id));
                        Painel::alert('sucesso','Slide editado com sucesso!');
                    }else{
                        Painel::alert('erro','Erro ao editar');
                    }
                }else{

                }
            }
        ?>
        <div class="form-group">
            <label>Nome do slide:</label>
            <input type="text" name="nome" value="<?php echo $slide['nome'];?>" required>
        </div><!--form-group-->

        <div class="form-group">
            <label>imagem:</label>
            <input type="file" name="imagem" >
            <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide'];?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div><!--form-group-->
    </form>
</div><!--box-content-->