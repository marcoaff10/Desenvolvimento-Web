<div class="box-content">
    <h2><i class="fa fa-edit"></i> Adicionar Depoimento:</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
           if(isset($_POST['acao'])){
               if(Painel::insert($_POST)){
                Painel::alert('sucesso','Depoimento cadastrado com sucesso!' );
               }else{
                Painel::alert('erro','Preencha todos os campos!' );
               }
            }
        ?>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome">
        </div><!--form-group-->

        <div class="form-group">
            <label>Depoimento:</label>
            <textarea name="depoimento"></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label>Data:</label>
            <input type="text" name="data" formato="data">
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="site_depoimentos">
            <input type="submit" name="acao" value="Cadastrar">
        </div><!--form-group-->
    </form>
</div><!--box-content-->