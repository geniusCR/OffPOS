$(function () {
    "use strict";

    $(".parent_class").each(function(){
        let this_parent_name=$(this).attr('data-name');
        if($(".child_"+this_parent_name).length == $(".child_"+this_parent_name+":checked").length) {
            $(".parent_class_"+this_parent_name).prop("checked", true);
        } else {
            $(".parent_class_"+this_parent_name).prop("checked", false);
        }
    });


    $(document).on('click', '.child_class', function() {
        let this_parent_name = $(this).attr('data-parent_name');
        if($(".child_"+this_parent_name).length == $(".child_"+this_parent_name+":checked").length) {
            $(".parent_class_"+this_parent_name).prop("checked", true);
            $(".hidden_menu_"+this_parent_name).val("NO");
        } else {
            $(".parent_class_"+this_parent_name).prop("checked", false);
            $(".hidden_menu_"+this_parent_name).val("YES");
        }
    });

    $(document).on('click', '.parent_class', function() {
        let this_name=$(this).attr('data-name');
        let checked = $(this).is(':checked');
        if(checked){
            $(".child_"+this_name).each(function(){
                $(this).prop("checked",true);
            });
            $(".hidden_menu_"+this_name).each(function(){
                $(this).val('NO');
            });
        }else{
            $(".child_"+this_name).each(function(){
                $(this).prop("checked",false);
            });
            $(".hidden_menu_"+this_name).each(function(){
                $(this).val('YES');
            });
        }
    });

    if($(".checkbox_user").length == $(".checkbox_user:checked").length) {
        $("#checkbox_userAll").prop("checked", true);
    } else {
        $("#checkbox_userAll").removeAttr("checked");
    }
    // Check or Uncheck All checkboxes
    $(document).on('change', '#checkbox_userAll', function() {
        let checked = $(this).is(':checked');
        if(checked){
            $(".checkbox_user").each(function(){
                $(this).prop("checked",true);
            });
            $(".hidden_all").each(function(){
                $(this).val("NO");
            });
            $(".checkbox_user_p").prop("checked", true);
        }else{
            $(".hidden_all").each(function(){
                $(this).val("YES");
            });
            $(".checkbox_user").each(function(){
                $(this).prop("checked",false);
            });
            $(".checkbox_user_p").prop("checked", false);
        }
    });
    $(document).on('click', '.checkbox_user', function() {
        if($(".checkbox_user").length == $(".checkbox_user:checked").length) {
            $("#checkbox_userAll").prop("checked", true);

        } else {
            $("#checkbox_userAll").prop("checked", false);
        }
    });
    
    

});