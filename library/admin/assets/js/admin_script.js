(function( $ ) {
    'use strict';

    var hytte_admin_params = window.hytte_admin_params;
    $(document).ready(function() {
        
        // Kataloger asign to cabin
        $( ".asign_kataloger" ).on( "change", function() {
           var kataloger_id = $(this).val(); 
           var cabin_id = $(this).closest('.kataloger_box').find('.cabin_post_val').val();
           $.ajax({
            type: "POST",
            dataType: "json",
            url: hytte_admin_params.admin_ajax_url,
            data: {
                'action': 'hytteguiden_assign_kataloger',
                'cabin_id': cabin_id,
                'kataloger_id': kataloger_id,
            },
            success: function(data) {    
              return false;
            }
        });
        
        return false;

        });

        /* On Google Font Change */
        $( 'select.hytteguiden_google_font_select' ).on('change', function () {

        var hytte_admin_params     = window.hytte_admin_params;
        var this_li        = $(this).parent().parent().attr("id");
        var variant_li     = $("li#" + this_li).next("li").attr("id");
        var subset_li      = $("li#" + variant_li).next("li").attr("id");
        var font           = $(this).val();
        var subsets        = $('#hytteguiden_font_subsets').val();
        var admin_ajax_url = hytte_admin_params.admin_ajax_url;
        $.ajax({
            type     : "POST",
            dataType : "json",
            url      : admin_ajax_url,
            data     : {
                'action'  : 'hytteguiden_font_variant',
                'font'    : font,
                'font_id' : this_li,
                'subset'  : subsets,
            },
            beforeSend : function( data ) {
                $( "li#" + variant_li + " select" ).html( 'hytte_admin_params.loading_font_variants' );
            },
            success  : function( data ) {
                $( 'li#' + this_li + '_subsets' ).find( 'input[type="hidden"]' ).val( '' );
                $( "li#" + variant_li + " select" ).html( data.variant );
                $( "li#" + subset_li + " ul" ).html( data.subsets );
            },
            error    : function( e ) {
            }
        });
        });


    });
    
})( jQuery );