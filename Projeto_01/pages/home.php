

<section class="banner-principal">
        <div style="background-image: url('images/bg1.jpg');" class="banner-single"></div><!--banner-single-->
        <div style="background-image: url('images/bg2.jpg');" class="banner-single"></div><!--banner-single-->
        <div style="background-image: url('images/computer.jpg');" class="banner-single"></div><!--banner-single-->
        <div class="overlay"></div><!--overlay-->
        <div class="container">
            <form method="post">
                <h2>Qual o seu melhor E-mail?</h2>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="hidden" name="identificador" value="form_home">
                <input type="submit" name="acao" value="Cadastrar">
            </form>
        </div><!--container-->
        <div class="bullets">
            <span class="active-slider"></span>
            <span></span>
            <span></span>
        </div><!--bullets-->
    </section><!--banner-principal-->

    <section id="sobre" class="descricao-autor">
        <div class="container">
            <div class="descricao-flex">
                <div class="w50">
                    <h2><?php echo $infoSite['nome_autor'];  ?></h2>
                    <p><?php echo $infoSite['descricao'];  ?></p>
                </div><!--w50-->
                <div class="w50 slide">
                    <img src="images/foto.jpg" alt="">
                </div><!--w50-->
            </div><!--descricao-flex-->
        </div><!--container-->
    </section><!--descricao-autor-->

    <section class="especialidades">
        <div class="container">
            <h2>Especialidades</h2>
            <div class="box-especialidade-flex"> 
                <div class="box-especialidade">
                    <i class="<?php echo $infoSite['icone1'];  ?>"></i>
                    <h3>CSS3</h3> 
                    <p><?php echo $infoSite['descricao1'];  ?></p>
                </div><!--box-especialidade-->
                <div class="box-especialidade">
                    <i class="<?php echo $infoSite['icone2'];  ?>"></i>
                    <h3>HTML5</h3> 
                    <p><?php echo $infoSite['descricao2'];  ?></p>
                </div><!--box-especialidade-->
                <div class="box-especialidade">
                    <i class="<?php echo $infoSite['icone3'];  ?>"></i>
                    <h3>JavaScript</h3> 
                    <p><?php echo $infoSite['descricao3'];  ?></p>
                </div><!--box-especialidade-->
            </div><!--box-especialidade-flex-->
        </div><!--container-->
    </section><!--especialidades-->

    <section class="extras">
        <div class="container">
            <div class="depoimento">
                <h3>Depoimentos dos nossos clienes</h3>
                <?php 
                    $sql = MySql::conectar()->prepare("SELECT  * FROM `site_depoimentos` ORDER BY order_id ASC LIMIT 3 ");
                    $sql->execute();
                    $depoimentos = $sql->fetchAll();
                    foreach ($depoimentos as $key => $value) {
                ?>
                <div class="depoimento-single">
                <p><?php echo $value['depoimento'];?></p>
                <span><?php echo $value['nome']?> - <?php echo $value['data']?></span>
                </div><!--depoimento-single-->
                <?php } ?>
            </div><!--w50-->
            <div class="clear"></div>
            <div id="servico" class="servico">
                <h2>Serviços</h2>
                <div class="servicos">
                    <ul>
                    <?php 
                        $sql = MySql::conectar()->prepare("SELECT  * FROM `site_servicos` ORDER BY order_id ASC LIMIT 6 ");
                        $sql->execute();
                        $servicos = $sql->fetchAll();
                        foreach ($servicos as $key => $value) {
                    ?>
                        <li><?php echo $value['servico']?> </li>
                        <?php } ?>
                    </ul>
                </div><!--servicos-->
            </div><!--w50-->
            <div class="clear"></div>
        </div><!--container-->
    </section><!--extras-->