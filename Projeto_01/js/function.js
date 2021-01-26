/*script menu responsivo*/
$(function(){
    $('.bnt-mobile i').click(function(){
        var listaMenu = $('nav.mobile ul');
        
        if(listaMenu.is(':hidden') == true){
            var icone = $('.bnt-mobile').find('i');
            icone.removeClass('fa fa-bars');
            icone.addClass('fa fa-times');
            listaMenu.slideToggle();
        }else{
            var icone = $('.bnt-mobile').find('i');
            icone.removeClass('fa fa-times');
            icone.addClass('fa fa-bars');
            listaMenu.slideToggle();
        }
    });
});
/**/

/*script slide banner */
$(function(){

    var curSlider = 0;
    var maxSlide = $('.banner-single').length;
    var delay = 3;

    changeSlide();
    initSlider();

    function initSlider(){
        $('.banner-single').hide();
        $('.banner-single').eq(0).show();

        for(var i = 0; i < maxSlide-3; i++){
            var content = $('.bullets').html();

            if(i == 0)
                content+='<span class="active-slider"></span>';
            else
                content+='<span></span>';
                $('.bullets').html(content);
        }
    }

    function changeSlide(){
        setInterval(function(){
            $('.banner-single').eq(curSlider).stop().fadeOut(2000);
            curSlider++;
            if(curSlider > maxSlide)
            curSlider = 0;
            $('.banner-single').eq(curSlider).stop().fadeIn(2000);
            //Trocando bullets da navegação do slider!
            $('.bullets span').removeClass('active-slider');
            $('.bullets span').eq(curSlider).addClass('active-slider');
        },delay * 1000);
    }

    $('body').on('click','.bullets span', function(){
        var currentBullets = $(this);
        $('.banner-single').eq(curSlider).stop().fadeIn(2000);
        curSlider = currentBullets.index();
        $('.banner-single').eq(curSlider).stop().fadeIn(2000);
        $('.bullets span').removeClass('active-slider');
        currentBullets.addClass('active-slider');
    });
});
/**/

/*script scrollTop*/
if($('target').length > 0){
    //O elemento existe, portanto precisamos dar o scroll em algum elemento.
    var elemento = '#'+$('target').attr('target');

    var divScroll = $(elemento).offset().top;

    $('html,body').animate({scrollTop:divScroll},1500);
}
/**/

/*carregar dinamico*/
$(function(){
    carregarDinamico();
    function carregarDinamico(){
        $('[realtime]').click(function(){
			var pagina = $(this).attr('realtime');
			$('.container-principal').hide();
            $('.container-principal').load(include_path+'pages/'+pagina+'.php');

            setTimeout(function(){
                initialize();
                addMarker(-27.609959,-48.576585,'',"Minha casa",undefined,false);
            },1000);

            $('.container-principal').fadeIn(1000);
            window.history.pushState('','',pagina);
           
            return false;
        });
    }
});
/**/

/**/
$(function(){
    var atual = -1;
    var maximo = $('.box-especialidade').length -1;
    var timer;
    var animacaoDaley = 2;

    executarAnimacao();
    function executarAnimacao(){
        $('.box-especialidade').hide();
        timer = setInterval(logicaAnimacao,animacaoDaley*1000);

        function logicaAnimacao(){
            atual++;
            if(atual > maximo){
                clearInterval(timer);
                return false;
            }

            $('.box-especialidade').eq(atual).fadeIn();
        }
    }
});
/**/

/*formulario*/
$(function(){
	

	$('body').on('submit','form',function(){
		var form = $(this);
		$.ajax({
			beforeSend:function(){
				$('.overlay-loading').fadeIn();
			},
			url:include_path+'ajax/formulario.php',
			method:'post',
			dataType: 'json',
			data:form.serialize()
		}).done(function(data){
			if(data.sucesso){
				//Tudo certo vamos melhorar a interface!
				$('.overlay-loading').fadeOut();
				$('.sucesso').fadeIn();
				setTimeout(function(){
					$('.sucesso').fadeOut();
				},3000)
			}else{
				//Algo deu errado.
				$('.overlay-loading').fadeOut();
			}
		});
		return false;
	})

})

/**/


