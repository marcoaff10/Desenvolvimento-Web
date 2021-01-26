<?php
    class Usuario{
        public function atualizarUsuario($nome,$senha,$imagem){
			$sql = MySql::conectar()->prepare("UPDATE `admin_usuarios` SET nome = ?,password = ?,img = ? WHERE user = ?");
			if($sql->execute(array($nome,$senha,$imagem,$_SESSION['user']))){
				return true;
			}else{
				return false;
            }
        }
        
        public function cadastrarUsuario($user,$senha,$imagem,$nome,$cargo){
            $sql = MySql::conectar()->prepare("INSERT INTO `admin_usuarios` VALUES (null,?,?,?,?,?)");
			$sql->execute(array($user,$senha,$imagem,$nome,$cargo));
        }

        public function userExists($user){
            $sql = MySql::conectar()->prepare("SELECT `id` FROM `admin_usuarios` WHERE user = ? ");
            $sql->execute(array($user));
            if($sql->rowCount() == 1){
                return true;
            }else{
                return false;
            }
        }
    }
?>