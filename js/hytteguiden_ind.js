$(document).ready(function() {
    var hytteguiden_params = window.hytteguiden_params;

    // reset your form after your modal window has been closed
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
    });

    //Wishlist 
    if ($(".fancybox").length > 0) {
        $(".fancybox").fancybox();
    }

    //Range Slider

    if ($("#sliderDouble1").length > 0) {
        var price_range = document.getElementById('sliderDouble1');
        noUiSlider.create(price_range, {
            start: [hytteguiden_params.min_price, hytteguiden_params.max_price],
            connect: true,
            range: {
                min: parseInt(hytteguiden_params.slider_min_price),
                max: parseInt(hytteguiden_params.slider_max_price)
            }
        });

        var marginMin = document.getElementById('min_price'),
            marginMax = document.getElementById('max_price');

        price_range.noUiSlider.on('update', function(values, handle) {
            values[handle] = hytte_format_number(values[handle]);
            if (handle) {
                marginMax.innerHTML = values[handle];
            } else {
                marginMin.innerHTML = values[handle];
            }
        });

    }

    if ($("#sliderDouble2").length > 0) {
        var size_range = document.getElementById('sliderDouble2');
        noUiSlider.create(size_range, {
            start: [hytteguiden_params.min_size, hytteguiden_params.max_size],
            connect: true,
            range: {
                min: parseInt(hytteguiden_params.slider_min_size),
                max: parseInt(hytteguiden_params.slider_max_size)
            }
        });

        var marginMin1 = document.getElementById('min_size'),
            marginMax1 = document.getElementById('max_size');

        size_range.noUiSlider.on('update', function(values, handle) {
            values[handle] = hytte_format_number(values[handle]);
            if (handle) {
                marginMax1.innerHTML = values[handle];
            } else {
                marginMin1.innerHTML = values[handle];
            }
        });

    }

    /*  Home Page >> Banner Search >>  size */
    if ($("#home_banner_slider").length > 0) {
        var home_banner_slider = document.getElementById('home_banner_slider');
        noUiSlider.create(home_banner_slider, {
            start: [hytteguiden_params.min_size, hytteguiden_params.max_size],
            connect: true,
            range: {
                min: parseInt(hytteguiden_params.slider_min_size),
                max: parseInt(hytteguiden_params.slider_max_size)
            }
        });

        var marginMin1 = document.getElementById('banner_min_size'),
            marginMax1 = document.getElementById('banner_max_size');

        home_banner_slider.noUiSlider.on('update', function(values, handle) {
            values[handle] = parseInt(values[handle]);
            if (handle) {
                $('.banner_max_size').html(values[handle] + 'm <sup>2</sup>');
                $('.banner_in_max_size').val(values[handle]);
            } else {
                $('.banner_min_size').html(values[handle] + 'm <sup>2</sup>');
                $('.banner_in_min_size').val(values[handle]);
            }
        });

    }

    /*  Home Page >> Banner Search >>  price */
    if ($("#home_banner_price").length > 0) {
        var home_banner_price = document.getElementById('home_banner_price');
        noUiSlider.create(home_banner_price, {
            start: [hytteguiden_params.min_price, hytteguiden_params.max_price],
            connect: true,
            range: {
                min: parseInt(hytteguiden_params.slider_min_price),
                max: parseInt(hytteguiden_params.slider_max_price)
            }
        });

        var marginMin1 = document.getElementById('banner_min_price'),
            marginMax1 = document.getElementById('banner_max_price');

        home_banner_price.noUiSlider.on('update', function(values, handle) {
            values[handle] = hytte_format_number(values[handle]);
            if (handle) {
                $('.banner_max_price').html(values[handle]);
                $('.banner_in_max_price').val(values[handle]);
            } else {
                $('.banner_min_price').html(values[handle]);
                $('.banner_in_min_price').val(values[handle]);
            }
        });

    }

    /* Footer No of beds */

    if ($("#home_beds_slider").length > 0) {
        var home_beds_slider = document.getElementById('home_beds_slider');
        noUiSlider.create(home_beds_slider, {
            start: [hytteguiden_params.min_beds, hytteguiden_params.max_beds],
            connect: true,
            step: 1,
            range: {
                min: parseInt(hytteguiden_params.slider_min_beds),
                max: parseInt(hytteguiden_params.slider_max_beds)
            }
        });


        home_beds_slider.noUiSlider.on('update', function(values, handle) {
            values[handle] = hytte_format_number(values[handle]);
            if (handle) {
                $('#max_beds').html(values[handle]);
            } else {
                $('#min_beds').html(values[handle]);
            }
        });

    }

    /* Filter page price slider */

    if ($("#slide_filter_price").length > 0) {
        var slide_filter_price = document.getElementById('slide_filter_price');
        noUiSlider.create(slide_filter_price, {
            start: [hytteguiden_params.min_price, hytteguiden_params.max_price],
            connect: true,
            step: 1,
            range: {
                min: parseInt(hytteguiden_params.slider_min_price),
                max: parseInt(hytteguiden_params.slider_max_price)
            }

        });

        /* Trigger filter slide price */
        slide_filter_price.noUiSlider.on('change.one', function() {
            filter_results();
        });

        slide_filter_price.noUiSlider.on('update', function(values, handle) {
            values[handle] = hytte_format_number(values[handle]);
            if (handle) {
                $('#filter_max_price').val(values[handle]);
            } else {
                $('#filter_min_price').val(values[handle]);
            }
        });

    }

    /* Filter page size slider */
    if ($("#slide_filter_size").length > 0) {
        var slide_filter_size = document.getElementById('slide_filter_size');
        noUiSlider.create(slide_filter_size, {
            start: [hytteguiden_params.min_size, hytteguiden_params.max_size],
            connect: true,
            range: {
                min: parseInt(hytteguiden_params.slider_min_size),
                max: parseInt(hytteguiden_params.slider_max_size)
            }
        });

        /* Trigger filter slide price */
        slide_filter_size.noUiSlider.on('change.one', function() {
            filter_results();
        });

        slide_filter_size.noUiSlider.on('update', function(values, handle) {
            values[handle] = hytte_format_number(values[handle]);
            if (handle) {
                $('#filter_max_size').val(values[handle]);
            } else {
                $('#filter_min_size').val(values[handle]);
            }
        });
    }

    /* Filter page terrace slider */
    if ($("#slide_filter_beds").length > 0) {
        var slide_filter_beds = document.getElementById('slide_filter_beds');
        noUiSlider.create(slide_filter_beds, {
            start: [hytteguiden_params.min_beds, hytteguiden_params.max_beds],
            connect: true,
            range: {
                min: parseInt(hytteguiden_params.slider_min_beds),
                max: parseInt(hytteguiden_params.slider_max_beds)
            }
        });

        slide_filter_beds.noUiSlider.on('change.one', function() {
            filter_results();
        });

        slide_filter_beds.noUiSlider.on('update', function(values, handle) {
            values[handle] = hytte_format_number(values[handle]);
            if (handle) {
                $('#filter_max_beds').val(values[handle]);
            } else {
                $('#filter_min_beds').val(values[handle]);
            }
        });
    }
    /*Home page FIlter*/

    $(".btn_advanced_filter").on("click", function() {

        var cabin_style = '';
        var cabin_type = '';
        var cabin_amenity = '';
        var search_param = '';

        var min_price = ($('#min_price').length) ? $('#min_price').html() : '';
        var max_price = ($('#max_price').length) ? $('#max_price').html() : '';
        var min_size = ($('#min_size').length) ? $('#min_size').html() : '';
        var max_size = ($('#max_size').length) ? $('#max_size').html() : '';
        var min_beds = ($('#min_beds').length) ? $('#min_beds').html() : '';
        var max_beds = ($('#max_beds').length) ? $('#max_beds').html() : '';
        var bathrooms = ($('#bathrooms').length) ? $('#bathrooms').val() : '';
        var bedrooms = ($('#bedrooms').length) ? $('#bedrooms').val() : '';


        var cabin_style = ($('#home_cabin_style_data').length) ? $('#home_cabin_style_data').val() : '';
        var cabin_type = ($('#home_cabin_type_data').length) ? $('#home_cabin_type_data').val() : '';
        var cabin_amenity = ($('#home_cabin_amenity_data').length) ? $('#home_cabin_amenity_data').val() : '';
        var cabin_method = ($('#home_cabin_method_data').length) ? $('#home_cabin_method_data').val() : '';

        if (min_price != '') {
            search_param = search_param + '&min_price=' + min_price;
        }
        if (max_price != '') {
            search_param = search_param + '&max_price=' + max_price;
        }
        if (min_size != '') {
            search_param = search_param + '&min_size=' + min_size;
        }
        if (max_size != '') {
            search_param = search_param + '&max_size=' + max_size;
        }
        if (min_beds != '') {
            search_param = search_param + '&min_beds=' + min_beds;
        }
        if (max_beds != '') {
            search_param = search_param + '&max_beds=' + max_beds;
        }
        if (bathrooms != '') {
            var bathrooms = bathrooms.replace("+", "*");
            search_param = search_param + '&bathrooms=' + bathrooms;
        }
        if (bedrooms != '') {
            var bedrooms = bedrooms.replace("+", "*");
            search_param = search_param + '&bedrooms=' + bedrooms;
        }
        if (cabin_style != '') {
            search_param = search_param + '&cabin_style=' + cabin_style;
        }
        if (cabin_type != '') {
            search_param = search_param + '&cabin_type=' + cabin_type;
        }
        if (cabin_amenity != '') {
            search_param = search_param + '&cabin_amenity=' + cabin_amenity;
        }
        if (cabin_method != '') {
            search_param = search_param + '&cabin_method=' + cabin_method;
        }

        var search_url = hytteguiden_params.search_url + '?' + search_param;

        window.location = search_url;
        return false;

    });

    /*** Filter option for bedrooms  */
    $("#home_bedrooms_option .customcheck").on("click", "span.checkme", function() {
        var this_value = $(this).html();
        home_update_checkbox('#bedrooms', this_value);
    });

    /*** Filter option for bedrooms  */
    $("#home_bathrooms_option .customcheck").on("click", "span.checkme", function() {
        var this_value = $(this).html();
        home_update_checkbox('#bathrooms', this_value);
    });

    /*** Filter option for cabin style  */
    $(".home_checkbox_block .custom-checkbox").on("click", ".custom-control-label", function() {

        var this_value = $(this).closest(".custom-checkbox").find('.custom-control-input').val();
        var holder_selector = $(this).closest(".home_checkbox_block").find('.group_checkbox').attr("id");
        home_update_checkbox('#' + holder_selector, this_value);

    });

    function home_update_checkbox(holder_selector, current_value) {
        var chk_data = [];
        var current_data = $(holder_selector).val();

        if (current_data != '') {
            chk_data = current_data.split(",");
        }
        if ($.inArray(current_value, chk_data) > -1) {
            chk_data.splice($.inArray(current_value, chk_data), 1);
        } else {
            chk_data.push(current_value);
        }

        // Update for more than 6 
        if(current_value != '6+' && $.inArray('6+', chk_data) > -1 ){
            chk_data.splice($.inArray('6+', chk_data), 1);
            $(holder_selector).closest('.form-group').find('.checkbox_more').prop('checked', false);
        }

        chk_data.join(", ");
        $(holder_selector).val(chk_data);

    }

    /* Load More Ajax
    .......................................... */
    $("#btn_load_more").click(function() {
        filter_results('load_more');
    });

    /* Filter page ajax
    .......................................... */
    function update_checkbox(this_checkbox, current_value) {

        var chk_data = [];

        if (current_value.includes("-") || current_value.includes("+")) {
            this_checkbox.closest('.card-body').find('.group_checkbox').val(current_value);
            return '';
        }

        var current_data = this_checkbox.closest('.card-body').find('.group_checkbox').val();

        if (current_data != '') {
            chk_data = current_data.split(",");
        }

        if ($.inArray(current_value, chk_data) > -1) {
            chk_data.splice($.inArray(current_value, chk_data), 1);
        } else {
            chk_data.push(current_value);
        }

        // Update for more than 6 
        if(current_value != '6*' && $.inArray('6*', chk_data) > -1 ){
            chk_data.splice($.inArray('6*', chk_data), 1);
            this_checkbox.closest('.card-body').find('.checkbox_more').prop('checked', false);
        }

        chk_data.join(", ");
        this_checkbox.closest('.card-body').find('.group_checkbox').val(chk_data);
    }


    // Update filter option
    $("#filter_option_form").on("click", "label.custom-control-label", function() {

        var this_checkbox = $(this).siblings(".custom-control-input");
        var current_value = this_checkbox.val();
        update_checkbox(this_checkbox, current_value);
        filter_results();
    });

    // Bedroom filter
    $("#filter_option_form").on("click", ".checkme", function() {
        var current_value = $(this).siblings(".filter_count").val();
        var this_checkbox = $(this).siblings(".filter_count");
        update_checkbox(this_checkbox, current_value);
        filter_results();
    });

    /*Filter Sort Cabins  */
    $('#filter_sort_cabins').on("change", function() {
        filter_results();

    });


    function filter_results(opt_mode = 'filter') {

        var cabin_style = '';
        var cabin_type = '';
        var cabin_amenity = '';
        var cabin_method = '';

        $('#btn_load_more').html(hytteguiden_params.loading_text);
        $('#btn_load_more').prop("disabled", true);

        if (opt_mode == 'filter') {
            $('#paged').val(2);
        }


        var posts_per_page = ($('#posts_per_page').length) ? $('#posts_per_page').val() : 6;
        var paged = ($('#paged').length) ? $('#paged').val() : 1;
        var filter_sort_cabins = ($('#filter_sort_cabins').length) ? $('#filter_sort_cabins').val() : 1;
        var global_search = ($('#global_search').length) ? $('#global_search').val() : '';

        var filter_min_price = ($('#filter_min_price').length) ? $('#filter_min_price').val() : '';
        var filter_max_price = ($('#filter_max_price').length) ? $('#filter_max_price').val() : '';

        var filter_min_size = ($('#filter_min_size').length) ? $('#filter_min_size').val() : '';
        var filter_max_size = ($('#filter_max_size').length) ? $('#filter_max_size').val() : '';

        var filter_min_beds = ($('#filter_min_beds').length) ? $('#filter_min_beds').val() : '';
        var filter_max_beds = ($('#filter_max_beds').length) ? $('#filter_max_beds').val() : '';

        var filter_bedrooms = ($('#filter_bedrooms').length) ? $('#filter_bedrooms').val() : '';
        var filter_bathrooms = ($('#filter_bathrooms').length) ? $('#filter_bathrooms').val() : '';

        var filter_beds = ($('#filter_beds').length) ? $('#filter_beds').val() : '';

        var cabin_style = ($('#cabin_style_data').length) ? $('#cabin_style_data').val() : '';
        var cabin_type = ($('#cabin_type_data').length) ? $('#cabin_type_data').val() : '';
        var cabin_amenity = ($('#cabin_amenity_data').length) ? $('#cabin_amenity_data').val() : '';
        var cabin_method = ($('#cabin_method_data').length) ? $('#cabin_method_data').val() : '';

        var search_param = '';

        if (filter_min_price != hytteguiden_params.min_price || filter_max_price != hytteguiden_params.max_price) {
            $("#price_span").html('Pris : ' + filter_min_price + ' - ' + filter_max_price + ' <i class="fa fa-times delete price"></i>');
            $("#price_span").addClass("tag-item btn  btn-theme1");
        }

        if (filter_min_size != hytteguiden_params.min_size || filter_max_size != hytteguiden_params.max_size) {
            $("#size_span").html('Størrelse : ' + filter_min_size + ' - ' + filter_max_size + ' <i class="fa fa-times delete size"></i>');
            $("#size_span").addClass("tag-item btn  btn-theme1");
        }

        if (filter_min_beds != hytteguiden_params.min_beds || filter_max_beds != hytteguiden_params.max_beds) {
            $("#beds_span").html('Sengeplasser : ' + filter_min_beds + ' - ' + filter_max_beds + ' <i class="fa fa-times delete beds"></i>');
            $("#beds_span").addClass("tag-item btn  btn-theme1");
        }

        if (global_search != '') {
            search_param = search_param + '&s=' + global_search;
            $("#query_span").html('Søkeord : ' + global_search + ' <i class="fa fa-times delete query_text"></i>');
            $("#query_span").addClass("tag-item btn  btn-theme1");
        } else {
            $("#query_span").html('');
            $("#query_span").removeClass("tag-item");
            $("#query_span").removeClass("btn");
            $("#query_span").removeClass("btn-theme1");
        }

        if (filter_min_price != '') {
            search_param = search_param + '&min_price=' + filter_min_price;
        }

        if (filter_max_price != '') {
            search_param = search_param + '&max_price=' + filter_max_price;
        }

        if (filter_min_size != '') {
            search_param = search_param + '&min_size=' + filter_min_size;
        }
        if (filter_max_size != '') {
            search_param = search_param + '&max_size=' + filter_max_size;
        }

        if (filter_min_beds != '') {
            search_param = search_param + '&min_beds=' + filter_min_beds;
        }
        if (filter_max_beds != '') {
            search_param = search_param + '&max_beds=' + filter_max_beds;
        }

        if (filter_bedrooms != '') {
            search_param = search_param + '&bedrooms=' + filter_bedrooms;
            $("#bedrooms_span").html('Soverom : ' + filter_bedrooms + ' <i class="fa fa-times delete bedrooms"></i>');
            $("#bedrooms_span").addClass("tag-item btn  btn-theme1");
        } else {
            $("#bedrooms_span").html('');
            $("#bedrooms_span").removeClass("tag-item");
            $("#bedrooms_span").removeClass("btn");
            $("#bedrooms_span").removeClass("btn-theme1");
        }

        if (filter_bathrooms != '') {
            search_param = search_param + '&bathrooms=' + filter_bathrooms;
            $("#bathrooms_span").html('Antall Bad : ' + filter_bathrooms + ' <i class="fa fa-times delete bathrooms"></i>');
            $("#bathrooms_span").addClass("tag-item btn  btn-theme1");
        } else {
            $("#bathrooms_span").html('');
            $("#bathrooms_span").removeClass("tag-item");
            $("#bathrooms_span").removeClass("btn");
            $("#bathrooms_span").removeClass("btn-theme1");
        }


        if (cabin_style != '') {
            search_param = search_param + '&cabin_style=' + cabin_style;
            var cabin_style_text = cabin_style.replace(/,/gi, ', ');
            $("#style_span").html('Stil : ' + cabin_style_text + ' <i class="fa fa-times delete style"></i>');
            $("#style_span").addClass("tag-item btn  btn-theme1");
        } else {
            $("#style_span").html('');
            $("#style_span").removeClass("tag-item");
            $("#style_span").removeClass("btn");
            $("#style_span").removeClass("btn-theme1");
        }

        if (cabin_type != '') {
            search_param = search_param + '&cabin_type=' + cabin_type;
            var cabin_type_text = cabin_type.replace(/,/gi, ', ');
            $("#type_span").html('Tak : ' + cabin_type_text + ' <i class="fa fa-times delete type"></i>');
            $("#type_span").addClass("tag-item btn  btn-theme1");
        } else {
            $("#type_span").html('');
            $("#type_span").removeClass("tag-item");
            $("#type_span").removeClass("btn");
            $("#type_span").removeClass("btn-theme1");
        }

        if (cabin_amenity != '') {
            search_param = search_param + '&cabin_amenity=' + cabin_amenity;
            var cabin_amenity_text = cabin_amenity.replace(/,/gi, ', ');

            $("#amenity_span").html('Tillegg : ' + cabin_amenity_text + ' <i class="fa fa-times delete amenity"></i>');
            $("#amenity_span").addClass("tag-item btn  btn-theme1");
        } else {
            $("#amenity_span").html('');
            $("#amenity_span").removeClass("tag-item");
            $("#amenity_span").removeClass("btn");
            $("#amenity_span").removeClass("btn-theme1");
        }

        if (cabin_method != '') {
            search_param = search_param + '&cabin_method=' + cabin_method;
            var cabin_method_text = cabin_method.replace(/,/gi, ', ');

            $("#method_span").html('Byggemåte : ' + cabin_method_text + ' <i class="fa fa-times delete method"></i>');
            $("#method_span").addClass("tag-item btn  btn-theme1");
        } else {
            $("#method_span").html('');
            $("#method_span").removeClass("tag-item");
            $("#method_span").removeClass("btn");
            $("#method_span").removeClass("btn-theme1");
        }

        if (filter_sort_cabins != '') {
            var sort_data = filter_sort_cabins.replace("cabin_price_kit", "price");
            var sort_data = sort_data.replace("cabin_utility_area", "size");
            var sort_data = sort_data.replace("membership_value", "member");
            search_param = search_param + '&sorting=' + sort_data;
        }

        // Add Push state to update url in browser 
        window.history.pushState("object or string", hytteguiden_params.site_name, hytteguiden_params.search_url + '?' + search_param);


        // ajax
        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytteguiden_filter_cabin',
                'filter_min_price': filter_min_price,
                'filter_max_price': filter_max_price,
                'filter_min_size': filter_min_size,
                'filter_max_size': filter_max_size,
                'filter_min_beds': filter_min_beds,
                'filter_max_beds': filter_max_beds,
                'filter_bedrooms': filter_bedrooms,
                'filter_bathrooms': filter_bathrooms,
                'filter_beds': filter_beds,
                'cabin_style': cabin_style,
                'cabin_type': cabin_type,
                'cabin_amenity': cabin_amenity,
                'cabin_method': cabin_method,
                'posts_per_page': posts_per_page,
                'filter_sort_cabins': filter_sort_cabins,
                'paged': paged,
                's': global_search,
                'opt_mode': opt_mode,

            },
            success: function(data) {
                if (opt_mode == 'load_more') {

                    if (data.content == '') {
                        $('#btn_load_more').html(hytteguiden_params.no_more_content_text);
                    } else {
                        $('#cabin_data_wrapper').append(data.content);
                        $('#paged').val(parseInt(paged) + 1);
                        $('#btn_load_more').html(data.load_more_text);
                    }

                } else {

                    if (data.content == '') {
                        $('#cabin_data_wrapper').empty();
                    } else {
                        $('#cabin_data_wrapper').html(data.content);
                    }

                    $('#paged').val('2');
                    $('#btn_load_more').html(data.load_more_text);
                    $('#total_record').html(data.total_record);

                }

                $('#btn_load_more').prop("disabled", false);
                return false;
            }
        });
        return false;

    }


    /* Format slider value */
    function hytte_format_number(text) {
        text = parseInt(text);
        return text;
    }


    /*Taxonomies load more cabin */
    $('#btn_taxonomy_loadmore').on("click", function() {

        $(this).html('<i class="fa fa-spinner fa-spin"></i>' + hytteguiden_params.loading_text);
        $(this).prop("disabled", true);

        var taxonomy = ($('#taxonomy').length) ? $('#taxonomy').val() : '';
        var posts_per_page = ($('#posts_per_page').length) ? $('#posts_per_page').val() : '';
        var paged = ($('#paged').length) ? $('#paged').val() : '';
        var tax_id = ($('#tax_id').length) ? $('#tax_id').val() : '';


        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytteguiden_taxonomy_loadmore',
                'taxonomy': taxonomy,
                'paged': paged,
                'posts_per_page': posts_per_page,
                'tax_id': tax_id
            },

            success: function(data) {

                if (data.status == 'success') {
                    $('#btn_taxonomy_loadmore').html('<i class="fa fa-plus"></i> ' + hytteguiden_params.load_more_text);
                    $("#paged").val(parseInt(paged) + 1);
                    $("#cabin_data_wrapper").append(data.content);
                } else {
                    $('#btn_taxonomy_loadmore').html('<i class="fa fa-plus"></i>' + hytteguiden_params.no_more_content_text);
                }
                $('#btn_taxonomy_loadmore').prop("disabled", false);
                return false;
            }
        });

        return false;

    });

    /* Home Banner Button */
    $('#btn_home_banner').on("click", function() {
        window.location = hytteguiden_params.search_url;

    });

    /* Reset Filter  */
    $('.tagmodules').on("click", '.delete', function() {
        var filter_component = $(this).attr("class").replace('fa fa-times delete ', '');

        if (filter_component == 'bedrooms' || filter_component == 'bathrooms') {
            hytte_reset_meta_filter_options('#' + filter_component + '_filter_options');
        } else if (filter_component == 'style' || filter_component == 'type' || filter_component == 'amenity' || filter_component == 'method') {
            hytte_reset_tax_filter_options('#' + filter_component + '_filter_options');
        } else if (filter_component == 'price' || filter_component == 'size' || filter_component == 'beds') {
            hytte_reset_range_filter_options(filter_component);
        } else if (filter_component == 'query_text') {
            hytte_reset_search_filter_options(filter_component);
        }

        $(this).parent().removeClass("tag-item");
        $(this).parent().removeClass("btn");
        $(this).parent().removeClass("btn-theme1");
        $(this).parent().html("");
        filter_results();
    });

    function hytte_reset_meta_filter_options(wrapper_id) {
        $(wrapper_id + ' .filter_count').each(function() {
            $(this).prop("checked", false);
        });
        $(wrapper_id).find('.group_checkbox').val('');

    }

    // Reset checkbox for Taxonomies in filter option 
    function hytte_reset_tax_filter_options(wrapper_id) {
        $(wrapper_id + ' .custom-control-input').each(function() {
            $(this).prop("checked", false);
        });
        $(wrapper_id).find('.group_checkbox').val('');

    }
    // Reset range in filter option 
    function hytte_reset_range_filter_options(wrapper) {

        if (wrapper == 'price') {
            $('#slide_filter_price')[0].noUiSlider.set([hytteguiden_params.slider_min_price, hytteguiden_params.slider_max_price]);
        } else if (wrapper == 'size') {
            $('#slide_filter_size')[0].noUiSlider.set([hytteguiden_params.slider_min_size, hytteguiden_params.slider_max_size]);
        } else {
            $('#slide_filter_beds')[0].noUiSlider.set([hytteguiden_params.slider_min_beds, hytteguiden_params.slider_max_beds]);
        }

    }

    // Reset search in filter option 
    function hytte_reset_search_filter_options(wrapper) {
        $('#global_search').val('');
    }

    // Produsenter validations start here 
    $('.btn_contact_producer').on("click", function() {
        var error = '';
        var $this_form = $(this).closest(".produsenter_contact_form");

        $this_form.find('.alert_msg').addClass('alert-warning');
        $this_form.find('.alert_msg').html(hytteguiden_params.loading_text);
        $(this).prop("disabled", true);


        var cabin_id = ($this_form.find('.cabin_id').length) ? $this_form.find('.cabin_id').val() : '';
        var con_name = ($this_form.find('.con_name').length) ? $this_form.find('.con_name').val() : '';
        var con_email = ($this_form.find('.con_email').length) ? $this_form.find('.con_email').val() : '';
        var con_phone = ($this_form.find('.con_phone').length) ? $this_form.find('.con_phone').val() : '';
        var con_message = ($this_form.find('.con_message').length) ? $this_form.find('.con_message').val() : '';

        $.each(['con_name', 'con_email', 'con_phone', 'con_message'], function(index, value) {
            if ($this_form.find('.' + value).val() == '') {
                $this_form.find('.' + value).addClass('custom_error');
                error = error + 'empty';
            } else {
                $this_form.find('.' + value).removeClass('custom_error');
            }
        });

        if (error) {
            $this_form.find('.alert_msg').html(hytteguiden_params.mandatory_msg);
            $this_form.find('.alert_msg').removeClass('alert-warning');
            $this_form.find('.alert_msg').addClass('alert-success');
            $(this).prop("disabled", false);
            return false;
        }

        if (!validateEmail(con_email)) {
            $this_form.find('.alert_msg').html(hytteguiden_params.email_valid_msg);
            $this_form.find('.con_email').addClass('custom_error');
            $this_form.find('.alert_msg').removeClass('alert-warning');
            $this_form.find('.alert_msg').addClass('alert-success');
            $(this).prop("disabled", false);
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytteguiden_contact_producer',
                'con_name': con_name,
                'con_email': con_email,
                'con_phone': con_phone,
                'cabin_id': cabin_id,
                'con_message': con_message
            },

            success: function(data) {

                $this_form.find('.alert_msg').html(data.message);
                $this_form.find('.alert_msg').removeClass('alert-warning');
                $this_form.find('.alert_msg').addClass('alert-success');

                $(this).html('Send');
                $this_form[0].reset();
                $(this).prop("disabled", false);
                return false;
            }
        });

        return false;


    });

    // Reset Filter Options
    $("#reset_search_filter").on("click", function() {

        $('#slide_filter_price')[0].noUiSlider.set([hytteguiden_params.slider_min_price, hytteguiden_params.slider_max_price]);
        $('#slide_filter_size')[0].noUiSlider.set([hytteguiden_params.slider_min_size, hytteguiden_params.slider_max_size]);
        $('#slide_filter_beds')[0].noUiSlider.set([hytteguiden_params.slider_min_beds, hytteguiden_params.slider_max_beds]);

        $('#sliderDouble1')[0].noUiSlider.set([hytteguiden_params.slider_min_price, hytteguiden_params.slider_max_price]);
        $('#sliderDouble2')[0].noUiSlider.set([hytteguiden_params.slider_min_size, hytteguiden_params.slider_max_size]);
        $('#home_beds_slider')[0].noUiSlider.set([hytteguiden_params.slider_min_beds, hytteguiden_params.slider_max_beds]);

        hytte_reset_meta_filter_options('#home_bedrooms_option');
        hytte_reset_meta_filter_options('#home_bathrooms_option');

        hytte_reset_tax_filter_options('.home_checkbox_block');

        return false;

    });


    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    // user login validation
    $("#user_login_form").validate({
        rules: {
            login_username: {
                required: true,
                email: true
            },
            login_password: {
                required: true
            },
        },
        messages: {
            login_username: {
                required: "E-post må fylles ut.",
                email: "Din epost må være gyldig."
            },
            login_password: {
                required: "Passordet må fylles ut."
            },
        },
        submitHandler: function() {
            var login_username = $('#login_username').val();
            var login_password = $('#login_password').val();
            var login_option = ($('#producer_login').length) ? $('#producer_login').val() : '';


            $.ajax({
                type: "POST",
                dataType: "json",
                url: hytteguiden_params.admin_ajax_url,
                data: {
                    'action': 'hytteguiden_login',
                    'login_username': login_username,
                    'login_password': login_password,
                    'login_option': login_option
                },

                success: function(data) {

                    $('.login_message').html(data[0].msg);
                    $('.login_message').removeClass('alert-warning');
                    $('.login_message').addClass('alert-success');

                    if (data[0].response == 'success') {
                        setTimeout(function() {
                            location.href = data[0].dashboard_url;
                        }, 2000);
                    } else {
                        return false;
                    }
                    return false;
                }
            });

            return false;
        }

    });


    // user info edit validations start here
    $("#edit_user_info").validate({
        rules: {
            first_name: {
                required: true
            },
            user_email: {
                required: true,
                email: true
            },
            user_phone: {
                required: true
            },
            user_address: {
                required: true
            },
            user_postal_number: {
                required: true
            },
            user_city: {
                required: true
            },
            zip_code: {
                required: true
            },
            country_code: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Vennligst nevne navnet ditt."
            },
            user_email: {
                required: "E-post må fylles ut.",
                email: "Din epost må være gyldig."
            },
            user_phone: {
                required: "Telefonnummer er nødvendig."
            },
            user_address: {
                required: "Adresse er nødvendig."
            },
            user_postal_number: {
                required: "Postnummer er påkrevd."
            },
            user_city: {
                required: "By er nødvendig."
            },
            zip_code: {
                required: "Postnummer er nødvendig."
            },
            country_code: {
                required: "Landskode er påkrevd."
            },
        },

        submitHandler: function() {

            $('#error_msg').addClass('alert alert-warning');
            $('#error_msg').html(hytteguiden_params.loading_text);

            /* Form Data */
            var first_name = ($('#first_name').length) ? $('#first_name').val() : '';
            var user_email = ($('#user_email').length) ? $('#user_email').val() : '';
            var user_phone = ($('#user_phone').length) ? $('#user_phone').val() : '';
            var user_address = ($('#user_address').length) ? $('#user_address').val() : '';
            var user_postal_number = ($('#user_postal_number').length) ? $('#user_postal_number').val() : '';
            var user_city = ($('#user_city').length) ? $('#user_city').val() : '';
            var zip_code = ($('#zip_code').length) ? $('#zip_code').val() : '';
            var country_code = ($('#country_code').length) ? $('#country_code').val() : '';

            $.ajax({
                type: "POST",
                dataType: "json",
                url: hytteguiden_params.admin_ajax_url,
                data: {
                    'action': 'hytteguiden_edit_user_profile',
                    'first_name': first_name,
                    'user_email': user_email,
                    'user_phone': user_phone,
                    'user_address': user_address,
                    'user_postal_number': user_postal_number,
                    'user_city': user_city,
                    'zip_code': zip_code,
                    'country_code': country_code

                },
                success: function(data) {

                    $('#error_msg').removeClass('alert-warning');
                    $('#error_msg').addClass('alert-success');
                    $('#error_msg').html(data.message);
                    return false;
                }
            });

            return false;


        }

    });

    // Add to wishlist
    $(".add_to_wishlist").on("click", function() {
        $(".add_to_wishlist").html(hytteguiden_params.processing);
        var cabin_id = ($('#cabin_id').length) ? $('#cabin_id').val() : '';
        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytteguiden_save_wishlist',
                'cabin_id': cabin_id,
            },
            success: function(data) {
                $(".add_to_wishlist").html(data.message);
                $(".cabin_count").html(data.cabin_count);
                if (data.status == 'removed') {
                    $(".add_to_wishlist").removeClass('selected');
                } else {
                    $(".add_to_wishlist").addClass('selected');
                }
                return false;
            }
        });

        return false;
    });

    // Add to wishlist
    $(".btn_order_kataloger").on("click", function() {
        var kataloger_order = [];
        $(".alert_msg").html(hytteguiden_params.processing);
        $('.alert_msg').addClass('alert alert-warning');
        var cabin_producer_id = ($('#cabin_producer_id').length) ? $('#cabin_producer_id').val() : '';

        $(".kataloger_order:checked").each(function() {
            kataloger_order.push($(this).val());
        });

        var selected_kataloger = kataloger_order.join(',');
        if (selected_kataloger == '') {
            $(".alert_msg").html(hytteguiden_params.select_catalog);
            $('.alert_msg').addClass('alert alert-warning');
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytteguiden_save_kataloger',
                'selected_kataloger': selected_kataloger,
                'cabin_producer_id': cabin_producer_id,
            },
            success: function(data) {
                $(".alert_msg").html(data.message);
                $('.alert_msg').removeClass('alert-warning');
                $('.alert_msg').addClass('alert-success');

                if (data.status == 'success') {
                    setTimeout(function() {
                        $("#catalog_order_form .close").click();
                    }, 2000);
                }

                return false;
            }
        });

        return false;
    });

    // Remove Katalog individual
    $(".remove_kataloger").on("click", function() {
        var kataloger = $(this).closest('.kataloger_remove_block').find('.kataloger_val').val();
        var r = confirm("Er du sikker på å slette?");
        if (r == true) {
            $(".alert_msg").html(hytteguiden_params.processing);
            $('.alert_msg').addClass('alert alert-warning');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: hytteguiden_params.admin_ajax_url,
                data: {
                    'action': 'hytteguiden_remove_kataloger',
                    'kataloger': kataloger,
                },
                success: function(data) {
                    $('.katalog_row_' + kataloger).remove();
                    $(".alert_msg").html(data.message);
                    $('.alert_msg').removeClass('alert-warning');
                    $('.alert_msg').addClass('alert-success');
                    return false;
                }
            });

        }
        return false;
    });

    // Clear All Katalog for front end
    $(".clear_all_katalog").on("click", function() {
        var kataloger_order = [];

        $('.table_katalog').find(".kataloger_val").each(function() {
            kataloger_order.push($(this).val());
        });

        var selected_kataloger = kataloger_order.join(',');
        var r = confirm("Er du sikker på å slette?");
        if (r == true) {
            $(".alert_msg").html(hytteguiden_params.processing);
            $('.alert_msg').addClass('alert alert-warning');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: hytteguiden_params.admin_ajax_url,
                data: {
                    'action': 'hytteguiden_remove_kataloger',
                    'kataloger': selected_kataloger,
                },
                success: function(data) {
                    $('.table_katalog').remove();
                    $(".alert_msg").html(data.message);
                    $('.alert_msg').removeClass('alert-warning');
                    $('.alert_msg').addClass('alert-success');
                    return false;
                }
            });

        }
        return false;

    });

    // Clear All Katalog for cabin
    $(".btn_cabin_kataloger").on("click", function() {

        var kataloger_id = ($('#kataloger_id').length) ? $('#kataloger_id').val() : '';
        var cabin_producer_id = ($('#cabin_producer_id').length) ? $('#cabin_producer_id').val() : '';
        $(".btn_cabin_kataloger").html(hytteguiden_params.processing);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytteguiden_save_kataloger',
                'selected_kataloger': kataloger_id,
                'cabin_producer_id': cabin_producer_id,
            },
            success: function(data) {
                $(".btn_cabin_kataloger").html(data.message);
                $(".kataloger_count").html(data.kataloger_count);
                $("#btn_cabin_kataloger").removeClass('btn_cabin_kataloger');

                if (data.status == 'success') {
                    setTimeout(function() {
                        $("#catalog_order_form .close").click();
                    }, 2000);
                }

                return false;
            }
        });
        return false;

    });

    /** producer submit */
    $("#producer_submit").on("click", function() {

        var producer_name = ($('#producer_name').length) ? $('#producer_name').val() : '';
        var producer_id = ($('#producer_id').length) ? $('#producer_id').val() : '';
        var user_email = ($('#user_email').length) ? $('#user_email').val() : '';
        var producer_address = ($('#producer_address').length) ? $('#producer_address').val() : '';
        var producer_web = ($('#producer_web').length) ? $('#producer_web').val() : '';
        var user_phone = ($('#user_phone').length) ? $('#user_phone').val() : '';
        var user_phone2 = ($('#user_phone2').length) ? $('#user_phone2').val() : '';
        $("#producer_submit").val('Updating...');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytte_update_profile',
                'producer_name': producer_name,
                'producer_id': producer_id,
                'user_email': user_email,
                'producer_address': producer_address,
                'producer_web': producer_web,
                'user_phone': user_phone,
                'user_phone2': user_phone2,
            },
            success: function(data) {
                if (data.status == 'success') {
                    $("#error_msg").html(data.message);
                    $("#producer_submit").val('Oppdater');
                }
            }



        });
    });

    /** image upload */
    $('#images').change(function(e) {
        e.preventDefault();
        var nonce = $('#image_upload_nonce').val();
        var producer_id = ($('#producer_id').length) ? $('#producer_id').val() : '';
        var formdata = new FormData();
        formdata.append("img", $('#images')[0].files[0]);
        formdata.append("action", "hytte_upload_profile_image");
        formdata.append("post_id", producer_id);
        formdata.append("nonce", nonce);
        $.ajax({
            type: "POST",
            url: hytteguiden_params.admin_ajax_url,
            data: formdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {

                    $('#producer_display_image').attr("src", data.image_url);
                }
            }
        });

    });


    /* Dashboard Kataloger Add Update */
    $("#btn_save_kataloger").on("click", function() {
        var kataloger_title = ($('#kataloger_title').length) ? $('#kataloger_title').val() : '';
        var helthjem_id = ($('#helthjem_id').length) ? $('#helthjem_id').val() : '';
        var post_id = ($('#post_id').length) ? $('#post_id').val() : '';
        var status_id = ($('#status_id').length) ? $('#status_id').val() : '';
        var img_attach_id = ($('#img_attach_id').length) ? $('#img_attach_id').val() : '';
        var post_content = tmce_getContent('post_content', 'post_content');

        $(".alert_msg").html(hytteguiden_params.processing);
        $(".alert_msg").addClass('alert alert-success');

        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytte_update_kataloger',
                'kataloger_title': kataloger_title,
                'helthjem_id': helthjem_id,
                'status_id': status_id,
                'img_attach_id': img_attach_id,
                'post_id': post_id,
                'post_content': post_content,
            },
            success: function(data) {
                $('.alert_msg').removeClass('alert-warning');
                $('.alert_msg').addClass('alert-success');
                $(".alert_msg").html(data.message);

                if (data.status == 'success') {
                    setTimeout(function() {
                        location.href = data.redir;
                    }, 2000);

                } else {
                    $(this).prop("disabled", false);
                }
            }
        });


    });

    /* Dashboard Hytter Add Update */
    $("#btn_save_hytter").on("click", function() {

        var cabin_images_galleries = $("input[name='cabin_images_galleries[]']")
            .map(function() {
                return obj = {
                    'id': $(this).attr('data-id'),
                    'image_url': $(this).val()
                }
            }).get();

        var cabin_images_json = JSON.stringify(cabin_images_galleries);

        var cabin_floor_plan_galleries = $("input[name='cabin_floor_plan_galleries[]']")
            .map(function() {
                return obj = {
                    'id': $(this).attr('data-id'),
                    'image_url': $(this).val()
                }
            }).get();

        var cabin_floor_plan_json = JSON.stringify(cabin_floor_plan_galleries);

        var cabin_style = '';
        var cabin_amenity_data = [];

        var post_title = ($('#post_title').length) ? $('#post_title').val() : '';
        var post_id = ($('#post_id').length) ? $('#post_id').val() : '';
        var status_id = ($('#status_id').length) ? $('#status_id').val() : '';
        var img_attach_id = ($('#img_attach_id').length) ? $('#img_attach_id').val() : '';
        var post_content = tmce_getContent('post_content', 'post_content');
        var base_area = ($('#base_area').length) ? $('#base_area').val() : '';
        var utility_area = ($('#utility_area').length) ? $('#utility_area').val() : '';
        var built_area = ($('#built_area').length) ? $('#built_area').val() : '';
        var gross_area = ($('#gross_area').length) ? $('#gross_area').val() : '';
        var length = ($('#length').length) ? $('#length').val() : '';
        var main_width = ($('#main_width').length) ? $('#main_width').val() : '';
        var moon_light = ($('#moon_light').length) ? $('#moon_light').val() : '';
        var bedroom = ($('#bedroom').length) ? $('#bedroom').val() : '';
        var bathroom = ($('#bathroom').length) ? $('#bathroom').val() : '';
        var beds = ($('#beds').length) ? $('#beds').val() : '';
        var price_kit = ($('#price_kit').length) ? $('#price_kit').val() : '';
        var price_turnkey = ($('#price_turnkey').length) ? $('#price_turnkey').val() : '';
        var hems = ($('#hems').length) ? $('#hems').val() : '';
        var rise = ($('#rise').length) ? $('#rise').val() : '';
        var bod = ($('#bod').length) ? $('#bod').val() : '';
        var youtube_link = ($('#youtube_link').length) ? $('#youtube_link').val() : '';
        var youtube_link = ($('#youtube_link').length) ? $('#youtube_link').val() : '';

        $(".update_cabin_style").each(function(index) {
            if ($(this).is(':checked')) {
                cabin_style = $(this).val();
            }
        });

        $(".update_cabin_amenity").each(function(index) {
            if ($(this).is(':checked')) {
                var current_data = $(this).val();
                cabin_amenity_data.push(current_data);
            }
        });

        cabin_amenity_data.join(", ");

        $(".alert_msg").html(hytteguiden_params.processing);
        $(".alert_msg").addClass('alert alert-success');

        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytte_update_hytter',
                'post_title': post_title,
                'status_id': status_id,
                'img_attach_id': img_attach_id,
                'post_id': post_id,
                'post_content': post_content,
                'base_area': base_area,
                'utility_area': utility_area,
                'built_area': built_area,
                'gross_area': gross_area,
                'length': length,
                'main_width': main_width,
                'moon_light': moon_light,
                'bedroom': bedroom,
                'bathroom': bathroom,
                'beds': beds,
                'price_kit': price_kit,
                'price_turnkey': price_turnkey,
                'hems': hems,
                'rise': rise,
                'bod': bod,
                'youtube_link': youtube_link,
                'cabin_style': cabin_style,
                'cabin_images': cabin_images_json,
                'cabin_floor_plan_json': cabin_floor_plan_json,
                'cabin_amenity_data': cabin_amenity_data,
            },
            success: function(data) {
                $('.alert_msg').removeClass('alert-warning');
                $('.alert_msg').addClass('alert-success');
                $(".alert_msg").html(data.message);

                if (data.status == 'success') {
                    setTimeout(function() {
                        location.href = data.redir;
                    }, 2000);

                } else {
                    $(this).prop("disabled", false);
                }
            }
        });


    });

    function tmce_getContent(editor_id, textarea_id) {
        if (typeof editor_id == 'undefined') editor_id = wpActiveEditor;
        if (typeof textarea_id == 'undefined') textarea_id = editor_id;

        if (jQuery('#wp-' + editor_id + '-wrap').hasClass('tmce-active') && tinyMCE.get(editor_id)) {
            return tinyMCE.get(editor_id).getContent();
        } else {
            return jQuery('#' + textarea_id).val();
        }
    }

    /** image upload */
    $('#hytte_upload_image').change(function(e) {
        e.preventDefault();
        var nonce = $('#hytte_upload_image_nonce').val();
        var formdata = new FormData();
        formdata.append("img", $('#hytte_upload_image')[0].files[0]);
        formdata.append("action", "hytte_upload_image_action");
        formdata.append("nonce", nonce);
        $.ajax({
            type: "POST",
            url: hytteguiden_params.admin_ajax_url,
            data: formdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    $('.hytte_upload_image_holder').html(data.message);
                }
            }
        });

    });

    /** Dashboard Hytte Gelleries upload */
    $('#hytte_upload_galleries').change(function(e) {
        e.preventDefault();
        var nonce = $('#hytte_upload_galleries_nonce').val();
        var formdata = new FormData();

        var files_data = $('#hytte_upload_galleries');
        $.each($(files_data), function(i, obj) {
            $.each(obj.files, function(j, file) {
                formdata.append('files[' + j + ']', file);
            })
        });

        formdata.append("action", "hytte_upload_galleries_action");
        formdata.append("nonce", nonce);
        $('#loading-screen').show();
        $.ajax({
            type: "POST",
            url: hytteguiden_params.admin_ajax_url,
            data: formdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    $('.cabin_images_galleries_wrapper').append(data.message);
                    $('#loading-screen').hide();
                }
            }
        });

    });

    /** Dashboard Hytte Floor Plan Images*/

    $('#hytte_upload_floor_plan').change(function(e) {
        e.preventDefault();
        var nonce = $('#hytte_upload_floor_plan_nonce').val();
        var formdata = new FormData();

        var files_data = $('#hytte_upload_floor_plan');
        $.each($(files_data), function(i, obj) {
            $.each(obj.files, function(j, file) {
                formdata.append('files[' + j + ']', file);
            })
        });

        formdata.append("action", "hytte_upload_floor_plan_action");
        formdata.append("nonce", nonce);
        $('#floor-plan').show();
        $.ajax({
            type: "POST",
            url: hytteguiden_params.admin_ajax_url,
            data: formdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    $('.cabin_floor_plan_galleries_wrapper').append(data.message);
                    $('#floor-plan').hide();
                }
            }
        });

    });


    /* Dashboard Healthjem Order Kataloger */
    $(".healthjem_order").on("click", function() {

        $(".loader_message").html(hytteguiden_params.processing);
        $(".loader_message").addClass('alert alert-success');

        var contact_request = $('#contact_request:checked').val()?'Yes':'No';


        var kataloger_ids = [];

        $('.table_katalog').find(".checkItem").each(function () {
            
            kataloger_ids.push($(this).val());
        });
        
        kataloger_ids.join(",");

        if(kataloger_ids == ''){
            $(".loader_message").html('Vennligst velg kataloger først.');
            $(".loader_message").addClass('alert alert-success');
            return false;
        }


        $.ajax({
            type: "POST",
            dataType: "json",
            url: hytteguiden_params.admin_ajax_url,
            data: {
                'action': 'hytte_order_kataloger',
                'kataloger_ids': kataloger_ids,
                'contact_request': contact_request
            },
            success: function(data) {
                $('.loader_message').removeClass('alert-warning');
                $('.loader_message').addClass('alert-success');
                $(".loader_message").html(data.message);
                if (data.redir != '') {
                    setTimeout(function() {
                        location.href = data.redir;
                    }, 2000);
                }

            }
            
        });

    });


    $('ul li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(100);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(100);
    });

    /** Remove Gallery Image  */
    $(".cab_img").on("click", function() {
        $(this).closest(".image_wrapper").remove();

    });

    /** Remove Floor Plan Image */

    $(".floor_plan").on("click", function() {
        $(this).closest(".image_wrapper").remove();

    });

    /** Bedrooms/bathrooms more than 6 */
    $(".btn_more_value").on("click", function() {

        $(this).closest('.card-body').find('.checkbox_normal').prop('checked', false);

        if ($(this).closest('.card-body').find('.checkbox_more').is(':checked')) {
            $(this).closest('.card-body').find('.group_checkbox').val('6*');
        } else{
            $(this).closest('.card-body').find('.group_checkbox').val('');
        }
    });

    /** Bedrooms/bathrooms more than 6 for mobile version */
    $(".btn_more_value_mob").on("click", function() {

        $(this).closest('.form-group').find('.checkbox_normal').prop('checked', false);

        if ($(this).closest('.form-group').find('.checkbox_more').is(':checked')) {
            $(this).closest('.form-group').find('.group_checkbox').val('6+');
        } else{
            $(this).closest('.form-group').find('.group_checkbox').val('');
        }
    });

    $("#checkAll").click(function () {
        $('.table_katalog').find('input:checkbox').not(this).prop('checked', this.checked);
    });


    FB.init({
        appId: hytteguiden_params.facebook_appId,
        status: true,
        cookie: true,
        xfbml: true
    });


});

function postToFeed(url, picture, fb_title, fb_description) {
    'use strict';

    var obj = {
        method: 'feed',
        link: url,
        picture: picture,
        name: fb_title,
        caption: fb_title,
        description: fb_description
    };

    function callback(response) {
        //document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
    }
    FB.ui(obj, callback);
}

// Load the SDK Asynchronously
function fb_callout(fb_url, picture, name, description) {
    'use strict';

    postToFeed(fb_url, picture, name, description);
}

function share_on_twitter(share_url, share_text) {
    'use strict';

    var sharethis_url = "https://twitter.com/intent/tweet?url=" + share_url + "&text=" + share_text;
    window.open(sharethis_url, 'Twitter_share', 'width=650,height=530');
    return false;
}
function pin_it_now(p_url, image, share_text) {
    'use strict';

    var pin_url = 'http://pinterest.com/pin/create/button/?url=' + p_url + '&media=' + image + '&description=' + share_text;
    window.open(pin_url, 'Pin_Login', 'width=650,height=530');
    return false;
}