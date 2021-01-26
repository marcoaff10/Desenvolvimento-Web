<?php
    if(isset($_POST['acao'])){
        echo 'Funcionando!';
    }
?>
<div style="border-bottom: 2px solid #1c1c1c;" id="map"></div>
<div class="contato-container">
    <div class="container">
        <form method="post">
            <input style="margin-top: 180px;" type="text" name="nome" placeholder="Nome..." required>
            <input type="text" name="email" placeholder="E-mail..." required>
            <input type="tel" name="telefone" placeholder="Telefone..." required>
            <textarea name="menssagem" placeholder="Menssagem"></textarea>
            <input type="hidden" name="identificador" value="form_contato">
            <input type="submit" value="Enviar" name="acao">
        </form>
    </div><!--container-->
</div><!--contato-container-->