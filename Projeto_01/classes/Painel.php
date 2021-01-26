<?php
    class Painel{

        public static  $cargos = [
            '0' => 'Gerente Geral',
            '1' => 'Gerente',
            '2' => 'Sub Gerente',
            '3' => 'Administrador',
            '4' => 'RH',
            '5' => 'Encarregado',
            '6' => 'Operador'
        ];
        
        public static function logado(){
                return isset($_SESSION['login']) ? true : false;
        }
        
        public static function loggout(){
            setcookie('lembrar','true',time()-1,'/');
            session_destroy();
			header('Location: '.INCLUDE_PATH_PAINEL);
        }

        public static function carregarPagina(){
            if(isset($_GET['url'])){
                $url = explode('/',$_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                    header('Location: '.INCLUDE_PATH_PAINEL);
                }
            }else{
                include('pages/home.php');
            }
        }

        public static function listarUsuariosOnlne(){
            self::limparUsuariosOnline();
            $sql = MySql::conectar()->prepare("SELECT * FROM `admin_online`");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function limparUsuariosOnline(){
            $date =  date('Y-m-d H:i:s');
            $sql = MySql::conectar()->exec("DELETE FROM `admin_online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE");
        }

        public static function alert($tipo,$menssagem){
            if($tipo == 'sucesso'){
                echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$menssagem.'</div>';
            }else if($tipo == 'erro'){
                echo '<div class="box-alert erro"><i class="fa fa-times"></i> '.$menssagem.'</div>';
            }
        }

        public static function imagemValida($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'imagem/jpg' ||
				$imagem['type'] == 'imagem/png'){

				$tamanho = intval($imagem['size']/1024);
				if($tamanho < 300)
					return true;
				else
					return false;
			}else{
				return false;
			} 
		}

        public static function uploadImagem($file){
            $formatoArquivo = explode('.',$file['name']);
			$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
				return $imagemNome;
			else
				return false;
        }

        public static function deleteFile($file){
            @unlink(BASE_DIR_PAINEL.'/uploads/'.$file);
        }

        public static function insert($arr){
            $certo = true;
			$nome_tabela = $arr['nome_tabela'];
			$query = "INSERT INTO `$nome_tabela` VALUES (null";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$parametros[] = $value;
			}

			$query.=")";
			if($certo == true){
				$sql = MySql::conectar()->prepare($query);
				$sql->execute($parametros);
				$lastId = MySql::conectar()->lastInsertId();
				$sql = MySql::conectar()->prepare("UPDATE `$nome_tabela` SET order_id = ? WHERE id = $lastId");
				$sql->execute(array($lastId));
			}
			return $certo;
        }

        public static function update($arr,$single = false){
            $certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];

			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
				if($single == false){
					$parametros[] = $arr['id'];
					$sql = MySql::conectar()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
				}else{
					$sql = MySql::conectar()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo; 
        }

        public static function selectAll($tabela){
            $sql = MySql::conectar()->prepare("SELECT * FROM $tabela ORDER BY order_id ASC");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function deletar($tabela,$id = false){
            if($id == false){
                $sql = MySql::conectar()->prepare("DELETE FROM $tabela");
            }else{
                $sql = MySql::conectar()->prepare("DELETE FROM $tabela WHERE id = $id");
            }
            $sql->execute();
        }

        public static function redirect($url){
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }

        public static function select($table,$query = '',$arr = ''){
            if($query != false){
                $sql = MySql::conectar()->prepare("SELECT * FROM $table WHERE $query");
                $sql->execute($arr);
            }else{
                $sql = MySql::conectar()->prepare("SELECT * FROM $table");
                $sql->execute();
            }
            return $sql->fetch();
        }

        public static function orderItem($tabela,$orderType,$idItem){
            if($orderType == 'up'){
                $infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
                $itemBefore->execute();
                if($itemBefore->rowCount() == 0)
                    return;
                $itemBefore = $itemBefore->fetch();
                Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
                Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
            }else if($orderType == 'down'){
                $infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
                $itemBefore->execute();
                if($itemBefore->rowCount() == 0)
                    return;
                $itemBefore = $itemBefore->fetch();
                Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
                Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
            }
        }
    }
?>