$(function(){
    var $setElem = $('.switch'),
    pcName       = '_pc',
    spName       = '_sp',
    replaceWidth = 619;

    pcImg    = "img/topimg_pc.png";
    spImg    = new Array();
    spImg[0] = "img/topimg_sp_01.png";
    spImg[1] = "img/topimg_sp_02.png";
    spImg[2] = "img/topimg_sp_03.png";

    spImgN = Math.floor(Math.random()*spImg.length);

    $setElem.each(function(){
        var $this = $(this);
        function imgSize(){
            var windowWidth = parseInt($(window).width());
            if(windowWidth >= replaceWidth) {
                $('.col2Box .box').tile();
                $this.attr('src',pcImg).css({visibility:'visible'});
            } else if(windowWidth < replaceWidth) {
                $this.attr('src',spImg[spImgN]).css({visibility:'visible'});
            }
        }
        $(window).resize(function(){imgSize();});
        imgSize();
    });

    $('#globalMenuOff').on('click',function(){
        if($(this).hasClass('open')) {
            $('#globalMenuOn').hide();
            $(this).removeClass('open');
        } else {
            $('#globalMenuOn').show();
            $(this).addClass('open');
        }
    });

    // $('.col2Box .box').tile();
});
