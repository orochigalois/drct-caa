$(function(){

    //nav
    $(document).ready(function(){
        dropdownOpen();//调用
        $(document).off('click.bs.dropdown.data-api');
    });
    /**
     * 鼠标划过就展开子菜单，免得需要点击才能展开
     */
    function dropdownOpen() {

        var $dropdownLi = $('li.dropdown');

        $dropdownLi.mouseover(function() {
            $(this).addClass('open');
        }).mouseout(function() {
            $(this).removeClass('open');
        });
    }

    var $tab_a = $('.tab-tit a');
    $tab_a.click(function(){
        var index = $tab_a.index(this);
        $(this).addClass('current').siblings().removeClass('current');
        $('div.tab-cont > div').eq(index).css('visibility','visible').siblings().css('visibility','hidden')
    });

    var $tab_b = $('.tab-form a');
    $tab_b.click(function(){
        var index = $tab_b.index(this);
        $(this).addClass('current').siblings().removeClass('current');
        $('div.tab-main > div').eq(index).show().siblings().hide();
    });

    var winW = $(window).width();

    $(window).resize(function(){

        if(winW > 768) {
            var boxH = $('.service .img-box').height()-20;
            $('.service .form-wrap').height(boxH);
        }


    })
    $(window).resize();




    $('.hear_r1').hover(function(){
        $(this).find('.he_sub').stop(true,true).slideDown();
    },function(){
        $(this).find('.he_sub').stop(true,true).slideUp();
    })


    $(window).resize(function(){

        if(winW > 768) {
            // 三大分类
            $('.in_d1').hover(function(){
                $(this).find('>a').stop().animate({'top':-10},300);
            },function(){
                $(this).find('>a').stop().animate({'top':0},300);
            })
            // 通知公告
            $('.in_d2').hover(function(){
                $(this).find('p').stop().animate({'left':10},300);
            },function(){
                $(this).find('p').stop().animate({'left':0},300);
            })
            // 大图部分
            $('.in_d3_k').hover(function(){
                $(this).find('.in_d3>a').stop().animate({'left':10},300);
            },function(){
                $(this).find('.in_d3>a').stop().animate({'left':0},300);
            })

            // 收藏
            // $('.in_d5_r1 a').click(function() {
            //     $(this).addClass('on_1').siblings('a').removeClass('on_1');
            // });



            $('.in_d4_l').hover(function(){
                $(this).find('>a').stop().animate({'top':-10},300);
            },function(){
                $(this).find('>a').stop().animate({'top':0},300);
            })


            

            $('.in_d2_t').hover(function(){
                $(this).find('a').stop().animate({'top':-10},300);
            },function(){
                $(this).find('a').stop().animate({'top':0},300);
            })

            // 视频中心
            $('.ny_h').hover(function(){
                $(this).find('h3 a').stop().animate({'top':-10},300);
            },function(){
                $(this).find('h3 a').stop().animate({'top':0},300);
            })
        }

    })
    $(window).resize();


    // 机器人世界杯
    $('.in_d5 a').hover(function(){
        $(this).find('em').stop(true,true).fadeOut(500);
        $(this).find('.in_d5_m').addClass('in_d5_m_h');
    },function(){
        $(this).find('em').stop(true,true).fadeIn(500);
        $(this).find('.in_d5_m').removeClass('in_d5_m_h');

    })
	
	
	var inHeight;
    function bb() {
        inHeight = $('.in_ph_d1').height();
        $('.in_phone_d1 .in_ph_d1').height(inHeight);
    }
    bb();
    
    $(window).resize(function(){
        bb();
    })
    
    
    // var funOnLoad=function  bb() {
    //     inHeight = $('.in_ph_d1').height();
    //     $('.in_phone_d1 .in_ph_d1').height(inHeight);
    // }
    // bb();
    
    // $(window).onload(function(){
    //     var inHeight;
    //     bb();
    // })

    // $(window).resize(function(){
    //     var inHeight;
    //     bb();
    // })

})
