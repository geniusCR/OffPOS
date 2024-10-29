$(function(){
    "use strict";
    let base_url = $('#base_url_').val();
    /** add active class and stay opened when selected */
    let url = window.location;
    function setActiveCurrentURL(){
        // Get the current URL
        let currentUrl = window.location.href;
        // Find the active_sub_menu when the current location matches the link
        $('.treeview').has('a[href="' + currentUrl + '"]').addClass('active_sub_menu');
        $('.treeview2').has('a[href="' + currentUrl + '"]').addClass('active_sub_menu');
    }
    setActiveCurrentURL();
    
    $('.set_collapse').on('click', function() {
        let status = Number($('.set_collapse').attr("data-status"));
        let outlet_responsive = Number($('.outlet_responsive').attr("data-status"));
        let status_tmp = '';
        if(status==1 || outlet_responsive == 1){
            $('.set_collapse').attr('data-status',2);
            $('.outlet_responsive').attr('data-status',2);
            $('.outlet_large').addClass('d-none');
            $('.outlet_large').removeClass('d-block');
            $('.outlet_small').addClass('d-block');
            $('.outlet_small').removeClass('d-none');
            $('#menu-search').parent().show();
            status_tmp = "No";
        }else{
            $('.set_collapse').attr('data-status',1);
            $('.outlet_responsive').attr('data-status',1);
            $('.outlet_large').addClass('d-block');
            $('.outlet_large').removeClass('d-none');
            $('.outlet_small').addClass('d-none');
            $('.outlet_small').removeClass('d-block');
            $('#menu-search').parent().hide();
            status_tmp = "Yes";
        }
        $.ajax({
            url: base_url+'Ajax_View/set_collapse',
            method: "POST",
            data: {
                status: status_tmp,
            },
            success: function(response) {
            }
        });
    });
    $('.treeview2').hover(function(){
        $('.treeview').removeClass("active_sub_menu");
        $(".sidebar_sub_menu").css("display", "none");
    });
    $(".treeview").hover(function () {
        //Every time hover active_sub_menu class remove
        $(".treeview").removeClass("active_sub_menu");
        $(".treeview-menu-in").remove();
        $(".sidebar_sub_menu").css("display", "block");
        $(this).addClass("active_sub_menu");
        let html = '<ul class="treeview-menu-in">';
        html += $(this).find(".treeview-menu").html();
        html += "</ul>";
        $(".sidebar_sub_menu").html(html);
    },
    function () {
        $(".sidebar_sub_menu").css("display", "block");
    });
    let activeSubMenu = $(".active_sub_menu");
    if (activeSubMenu.length) {
        let scrollPosition = activeSubMenu.position().top - 100;
        $(".sidebar-menu").scrollTop(scrollPosition);
    }
    $(document).on('mouseleave', '.sidebar_sub_menu', function(){
        $(".sidebar_sub_menu").css("display", "none");
    });
    $(document).on('click', '.arabic-lang .mobile_sideber_hide_show', function(){
        if(!$('.sidebar-mini').hasClass('sidebar-open')){
            $('.main-sidebar2').removeClass('active')
        }else{
            $('.sidebar-mini').removeClass('sidebar-collapse')
        }
    });

    $(document).on('click', '.mobile_sideber_hide_show, .main-content-wrapper', function(){
         $(".sidebar_sub_menu").hide();
    });

});
