<?php 
    verificaPermissaoPagina(0);
   
?>

<div class="box-content">
    <h2><i class="fa fa-edit"></i> Adicionar Usuário:</h2>
    <form method="post" enctype="multipart/form-data">
        

        <?php
           if(isset($_POST['acao'])){
                $user = $_POST['user'];
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $cargo = $_POST['cargo'];
                $usuario = new Usuario();
                
                if($nome == ''){
                    Painel::alert('erro','O campo Nome é obrigatório!');
                }else if( $user == ''){
                    Painel::alert('erro','O campo User é obrigatório!');
                }else if( $senha == ''){
                    Painel::alert('erro','O campo Senha é obrigatório!');
                }else if( $cargo == ''){
                    Painel::alert('erro','O campo Cargo é obrigatório!');
                }else{

                    if($cargo < $_SESSION['cargo']){
                        Painel::alert('erro','Selecione um cargo menor do que o seu!');
                    }else if(Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O formato da imagem não é aceito!');
                    }else if($usuario->userExists($user)){
                        Painel::alert('erro','Usuário já cadastrado!');
                    }else{
                        $imagem = Painel::uploadImagem($imagem);
						$usuario->cadastrarUsuario($user,$senha,$imagem,$nome,$cargo);
                        Painel::alert('sucesso','Usuário: '.$user.', cadastrado com sucesso!');
                    }
                }

                
            }
        ?>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome">
        </div><!--form-group-->

        <div class="form-group">
            <label>User:</label>
            <input type="text" name="user">
        </div><!--form-group-->

		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password">
        </div><!--form-group-->
        
        <div class="form-group">
			<label>Cargo:</label>
			<select name="cargo">
                <?php 
                    foreach(PAinel::$cargos as $key => $value){
                       if($key > $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
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