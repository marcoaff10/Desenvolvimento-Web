<?php

    
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    $autoload = function($class){
        if($class == 'Email'){
            require_once('classes/phpmailer/PHPMailerAutoLoad.php');
        }
        include('classes/'.$class.'.php');
    };


    spl_autoload_register($autoload);

    define('INCLUDE_PATH','http://localhost/Curso%20Desenvolvimento%20Web/modulo_09/Projeto_01/');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

    //conectar ao banco de dados.
    define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
    define('DATABASE','projeto_01');

    //Constantes Painel de controle;
    define('NOME_EMPRESA','Maf-Code');
    define('BASE_DIR_PAINEL',__DIR__.'/painel');
    //Variaveis Globais.

    //Funções.
    function pegaCargo($indice){
        return Painel::$cargos[$indice];
    }

    function selecionadoMenu($par){
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par){
            echo 'class="menu-active"';
        }
    }

    function verificaPermissao($permissao){
        if($_SESSION['cargo'] == $permissao){
            return;
        }else{
            echo 'style="display: none;"';
        }
    }

    function verificaPermissaoPagina($permissao){
        if($_SESSION['cargo'] == $permissao){
            return;
        }else{
            include('painel/pages/permissao-negada.php');
            die();
        }
    }
?>