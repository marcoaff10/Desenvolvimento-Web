<div class="box-content">
    <h2><i class="fa fa-edit"></i> Cadastrar Slide:</h2>
    <form method="post" enctype="multipart/form-data">
        

        <?php
           if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];  
                if($nome == ''){
                    Painel::alert('erro','O campo Nome é obrigatório!');
                }else{
                    if(Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O formato da imagem não é aceito!');
                    }else{
                        include('../classes/lib/WideImage.php');
                        $imagem = Painel::uploadImagem($imagem);
                        WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                        $arr = ['nome'=>$nome,'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'site_slides'];
                        Painel::insert($arr);
                        Painel::alert('sucesso','Slide cadastrado com sucesso!');
                    }
                }  
            }
        ?>
        <div class="form-group">
            <label>Nome do slide:</label>
            <input type="text" name="nome">
        </div><!--form-group-->

        <div class="form-group">
            <label>imagem:</label>
            <input type="file" name="imagem" >
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div><!--form-group-->
    </form>
</div><!--box-content-->