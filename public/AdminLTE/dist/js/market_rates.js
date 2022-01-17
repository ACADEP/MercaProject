/**
  * @desc Buscar productos en la Base de datos para la vista de creacion
  * @return Url de busquedas de productos de cotizaciones
*/
$("#btn-search").click(function () {
    window.location = "/admin/market_rates/search?" + $('#form-search').serialize() + '&' + $("#form-create").serialize();

});


/**
  * @desc Buscar productos en la Base de datos para la vista de editar
  * @return Url de busquedas de productos de cotizaciones
*/
$("#btn-search-edit").click(function () {
    window.location = "/admin/market_rates/searchEdit?" + $('#form-search').serialize() + '&' + $("#form-edit").serialize();

});

/**
  * @desc Agregar productos a la cotizacion 
  * @return Producto agregado o mensaje error
*/
$(".btn-add-market").click(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var productosCart = new Array();
    var market_id = $(".marketRate").val();
    var product_id = $(this).val();
    var product_qty = $("#qty_product" + product_id).val();
    var product_photo = $("#product_photo" + product_id).val();
    var product_name = $("#product_name" + product_id).val();
    var product_price = $("#product_price" + product_id).val();
    var product_sku = $("#product_sku" + product_id).val();
    var formData = {
        product_id: product_id,
        product_name: product_name,
        product_price: product_price,
        product_sku: product_sku,
        product_photo: product_photo,
        product_qty: product_qty,
        market_id: market_id
    };


    $.ajax({
        url: "/admin/market_rates/addProduct",
        method: 'POST',
        data: formData,
        success: function (response) {

            Cookies.set("market_id", response.market_id, 1);
            $(".marketRate").val(Cookies.get("market_id"));
            console.log(response);

            if (response.detail != null) {

                if (Cookies.get("products") != null) {
                    var productosJSON = jQuery.parseJSON(Cookies.get("products"));
                    productosCart = productosJSON;
                }
                productosCart.push(response.detail);
                var cont = productosCart.length - 1;
                Cookies.set("products", productosCart, 1);
                if (cont == 0) {
                    $("#productmarket_content").empty();
                }
                $("#productmarket_content").append("<div class='col-md-12' id='product" + response.detail.id + "' style='margin-bottom:25px;'><div class='col-md-3'><img src='" + response.detail.thumbnail + "' style='width:100%;'></div>" +
                    "<div class='col-md-3' style='font-size: 0.8em;'>" + String(response.detail.description).substring(0, 30) + "</div>" +
                    "<div class='col-md-3'> $" + parseFloat(response.detail.subtotal).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</div>" +
                    "<div class='col-md-3'>" +
                    "<button class='btn btn-danger btn-xs btn-delete-market-product' style='margin-bottom:10px;' value='" + response.detail.id + "'><i class='fa fa-minus' aria-hidden='true'></i></button>" +
                    "<button class='btn btn-info btn-xs btn-edit-product' value='" + response.detail.id + "'><i class='fa fa-pencil' aria-hidden='true'></i></button>" +
                    "</div></div>");
            }
            else {
                $.notify({
                    // options
                    message: '<strong>Este Producto ya se encuentra en la cotización</strong>'
                }, {
                    // settings
                    type: 'danger',
                    delay: 3000
                });
            }


        },

        error: function (response) {
            console.log(response);
            alert("Intente de nuevo");
        }

    });
});

/**
  * @desc Enviar por correo la cotizacion por el correo dado
  * @return Enviar la peticion 
*/
$("#btn-send-market").click(function () {
    if (confirm('Desea enviar esta cotizacion')) {
        if ($("#company").val() == "") {
            $.notify({
                // options
                message: '<strong>Ingresar el nombre de la empresa</strong>'
            }, {
                // settings
                type: 'danger',
                delay: 3000
            });
        } else if ($("#email").val() == "") {
            $.notify({
                // options
                message: '<strong>Ingresar un correo valido</strong>'
            }, {
                // settings
                type: 'danger',
                delay: 3000
            });

        } else if ($(".marketRate").val() == "") {
            $.notify({
                // options
                message: '<strong>Ingresar productos</strong>'
            }, {
                // settings
                type: 'danger',
                delay: 3000
            });

        } else {
            $("#companySend").val($("#company").val());
            $("#emailSend").val($("#email").val());
            $("#form-send").submit();
        }


    } else { }
});


/**
 * @desc Eliminar productos de la cotizacion
 * @return notify - Notificar si el producto fue eliminado con exito
*/
$('#productmarket_content').on('click', '.btn-delete-market-product', function (e) {
    e.preventDefault();
    if (confirm('Desea eliminar este producto de la cotizacion')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var detail_id = $(this).val();
        var col_id = this.id;
        $.ajax({
            url: '/admin/market_rates/deleteProduct',
            method: 'POST',
            data: { detail_id: detail_id },
            success: function (response) {

                $("#product" + detail_id).remove();
                var productosJson = jQuery.parseJSON(Cookies.get("products"));

                productosJson.splice(col_id, 1);
                Cookies.set("products", productosJson, 1);

                if (Cookies.get("products") == null) {
                    $("#productmarket_content").html("<span class='help-block'>Agregar productos</span>");
                }

                $.notify({
                    // options
                    message: '<strong>' + response + '</strong>'
                }, {
                    // settings
                    type: 'success',
                    delay: 3000
                });

            },

            error: function (response) {

                alert("Intente de nuevo");
            }

        });

    } else { }

});

/**
 * @desc Eliminar que productos que ya esten en la cotizacion 
 * @return notify - Notificar si el producto fue eliminado con exito
*/
$('.btn-delete-market-product-q').click(function(e){
    e.preventDefault();
    if (confirm('Desea eliminar este producto de la cotizacion')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var detail_id = $(this).val();
        var col_id = this.id;
        $.ajax({
            url: '/admin/market_rates/deleteProduct',
            method: 'POST',
            data: { detail_id: detail_id },
            success: function (response) {

                $("#rowProduct" + detail_id).remove();
                var productosJson = jQuery.parseJSON(Cookies.get("products"));

                productosJson.splice(col_id, 1);
                Cookies.set("products", productosJson, 1);

                if (Cookies.get("products") == null) {
                    $("#productmarket_content").html("<span class='help-block'>Agregar productos</span>");
                }

                $.notify({
                    // options
                    message: '<strong>' + response + '</strong>'
                }, {
                    // settings
                    type: 'success',
                    delay: 3000
                });

            },

            error: function (response) {

                alert("Intente de nuevo");
            }

        });

    } else { }

});

//Editar producto agregado a la cotizacion en cache
$('#productmarket_content').on('click', '.btn-edit-product', function (e) {
    e.preventDefault();

    var detail_id = $(this).val();

    var formData = { detail_id: detail_id };
    $.ajax({
        url: '/admin/market_rates/showinfoproduct',
        method: 'get',
        data: formData,
        success: function (response) {

            //Establecer la informacion 
            $("#detail_id").val(response["id"]);
            $("#product_image").attr("src", response["thumbnail"]);
            $("#prod_market_sku").val(response["product_sku"]);
            $("#prod_market_name").text(response["description"]);

            $("#prod_market_price, #prod_market_price_format").val(response["price"]);

            $("#prod_market_qty").val(parseInt(response["qty"]));
            $("#modal-edit-product").modal("show");


        },

        error: function (response) {

            alert("Intente de nuevo");
        }

    });

});

//Editar producto agregado a la cotizacion en cache
$('.edit-product-market').click(function (e) {
    e.preventDefault();

    var detail_id = $(this).val();

    var formData = { detail_id: detail_id };
    $.ajax({
        url: '/admin/market_rates/showinfoproduct',
        method: 'get',
        data: formData,
        success: function (response) {
            //Establecer la informacion 
            $("#detail_id").val(response["id"]);
            $("#product_image").attr("src", response["thumbnail"]);
            $("#prod_market_sku").val(response["product_sku"]);
            $("#prod_market_name").text(response["description"]);

            $("#prod_market_price, #prod_market_price_format").val(response["price"]);

            $("#prod_market_qty").val(parseInt(response["qty"]));

            $("#modal-edit-product").modal("show");


        },

        error: function (response) {

            alert("Intente de nuevo");
        }

    });

});

$("#accept-modal").click(function () {

    if (Cookies.get("products") != null) {
        var productosArray = jQuery.parseJSON(Cookies.get("products"));
        var maxElements = parseInt(productosArray.length);

        for (var i = 0; i < maxElements; i++) {
            if (productosArray[i].id == $("#detail_id").val()) {
                productosArray[i]["product_sku"] = $("#prod_market_sku").val();
                productosArray[i]["description"] = $("#prod_market_name").text();
                productosArray[i]["price"] = $("#prod_market_price").val();
                productosArray[i]["qty"] = $("#prod_market_qty").val();
                productosArray[i]["subtotal"] = $("#prod_market_price").val() * $("#prod_market_qty").val();
            }
        }

        Cookies.set("products", productosArray, 1);
    }


    $("#modal-form").submit();
});




//Mostrar elementos en creacion de cotizacion
function mostrarElementos() {


    // Cookies.remove("products");
    // Cookies.remove("market_id");
    $("#productmarket_content").empty();

    if (Cookies.get("products") != null) {
        var productosArray = jQuery.parseJSON(Cookies.get("products"));
        var cont = productosArray.length;


        if (cont > 0) {
            var maxElements = parseInt(productosArray.length);
            for (var i = 0; i < maxElements; i++) {


                $("#productmarket_content").append("<div class='col-md-12' id='product" + productosArray[i].id + "' style='margin-bottom:25px;'><div class='col-md-3'><img src='" + productosArray[i].thumbnail + "' style='width:100%;'></div>" +
                    "<div class='col-md-3' style='font-size: 0.8em;'>" + String(productosArray[i].description).substring(0, 30) + "</div>" +
                    "<div class='col-md-3'> $" + parseFloat(productosArray[i].subtotal).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</div>" +
                    "<div class='col-md-3'>" +
                    "<button class='btn btn-danger btn-xs btn-delete-market-product' style='margin-bottom:10px;' id='" + i + "' value='" + productosArray[i].id + "'><i class='fa fa-minus' aria-hidden='true'></i></button>" +
                    "<button class='btn btn-info btn-xs btn-edit-product' value='" + productosArray[i].id + "'><i class='fa fa-pencil' aria-hidden='true'></i></button>" +
                    "</div></div>");

            }
        }
        else {
            $("#productmarket_content").html("<span class='help-block'>Agregar productos</span>");
        }
    }
    else {

        $("#productmarket_content").html("<span class='help-block'>Agregar productos</span>");
    }
}