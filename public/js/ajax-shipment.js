$(document).ready(function(){
    
    var ratedhl=0;
    var ratefedex=0;
    var rateups=0;
    var rateredpack=0;
    var formData = {    api_key : 'c3704460afdf5f0a6e53b71c48a2f736',
                        origin_direction:{country_code:"MX" ,postal_code:"23000"},
                        destination_direction:{country_code:"MX" ,postal_code:"23000"},
                        shipment:{
                        shipment_type:"Package",
                            parcels:[
                                {
                                quantity:"1",
                                weight:"1",
                                weight_unit:"kg",
                                length:"5",
                                height:"10",
                                width:"15",
                                dimension_unit:"cm"
                                }
                            ]}
                        ,};
        console.log(formData);  
        $.ajax({
            url: 'https://enviaya.com.mx/api/v1/rates',
            method: 'POST',
            data: formData,
            success: function(response){
                
                //Buscar tarifa mas barata de la paqueterias
                response.dhl.sort(function (a, b) {
                    return a.total_amount > b.total_amount ;
                });
                response.dhl.sort();
                ratedhl=response.dhl[0].total_amount;
                response.fedex.sort(function (a, b) {
                    return a.total_amount > b.total_amount ;
                });
                response.fedex.sort();
                ratefedex=response.fedex[0].total_amount;
                response.ups.sort(function (a, b) {
                    return a.total_amount > b.total_amount ;
                });
                response.ups.sort();
                rateups=response.ups[0].total_amount;
                response.redpack.sort(function (a, b) {
                    return a.total_amount > b.total_amount ;
                });
                response.redpack.sort();
                rateredpack=response.redpack[0].total_amount;
                var countPaq=1;
                $("#shipments").html("<div class='card border-primary mb-3 text-center col-md-4' style='max-width: 10rem; margin:10px;'>"+
                "<div class='card-header'>Paquetería <br><br></div>"+
                "<div class='card-body text-primary'>"+
                    "<p class='card-text' style='width:100%;'>"+
                        "<img src='"+response.dhl[0].carrier_logo_url+"' style='width:100%;'>"+
                        "Costo: "+response.dhl[0].total_amount+"<br>"+
                        "Fecha de llegada aprox:"+response.dhl[0].estimated_delivery+
                    "</p>"+
                    "<div class='custom-control custom-radio'>"+
                            "<input type='radio' class='custom-control-input' value="+response.dhl[0].carrier_service_code+" id='paqueteria"+countPaq+"' name='defaultExampleRadios'>"+
                            "<label class='custom-control-label' for='paqueteria"+countPaq+"'></label>"+
                   " </div>"+
                "</div>"+
                "</div>");
                countPaq++;
                $("#shipments").append("<div class='card border-primary mb-3 text-center col-md-4' style='max-width: 10rem; margin:10px;'>"+
                "<div class='card-header'>Paquetería <br><br></div>"+
                "<div class='card-body text-primary'>"+
                    "<p class='card-text'>"+
                        "<img src='"+response.fedex[0].carrier_logo_url+"' style='width:100%;'>"+
                        "Costo: "+response.fedex[0].total_amount+"<br>"+
                        "Fecha de llegada aprox:"+response.fedex[0].estimated_delivery+
                    "</p>"+
                    "<div class='custom-control custom-radio'>"+
                            "<input type='radio' class='custom-control-input' value="+response.fedex[0].carrier_service_code+" id='paqueteria"+countPaq+"' name='defaultExampleRadios'>"+
                            "<label class='custom-control-label' for='paqueteria"+countPaq+"'></label>"+
                   " </div>"+
                "</div>"+
                "</div>");
                countPaq++;
                $("#shipments").append("<div class='card border-primary mb-3 text-center col-md-4' style='max-width: 10rem; margin:10px;'>"+
                "<div class='card-header'>Paquetería <br><br></div>"+
                "<div class='card-body text-primary'>"+
                    "<p class='card-text'>"+
                        "<img src='"+response.ups[0].carrier_logo_url+"' style='width:100%;'>"+
                        "Costo: "+response.ups[0].total_amount+"<br>"+
                        "Fecha de llegada aprox:"+response.ups[0].estimated_delivery+
                    "</p>"+
                    "<div class='custom-control custom-radio'>"+
                            "<input type='radio' class='custom-control-input' value="+response.ups[0].carrier_service_code+" id='paqueteria"+countPaq+"' name='defaultExampleRadios'>"+
                            "<label class='custom-control-label' for='paqueteria"+countPaq+"'></label>"+
                   " </div>"+
                "</div>"+
                "</div>");
                countPaq++;
                $("#shipments").append("<div class='card border-primary mb-3 text-center col-md-4' style='max-width: 10rem; margin:10px;'>"+
                "<div class='card-header'>Paquetería <br><br></div>"+
                "<div class='card-body text-primary'>"+
                    "<p class='card-text'>"+
                        "<img src='"+response.redpack[0].carrier_logo_url+"' style='width:100%;'>"+
                        "Costo: "+response.redpack[0].total_amount+"<br>"+
                        "Fecha de llegada aprox:"+response.redpack[0].estimated_delivery+
                    "</p>"+
                    "<div class='custom-control custom-radio'>"+
                            "<input type='radio' class='custom-control-input' value="+response.redpack[0].carrier_service_code+" id='paqueteria"+countPaq+"' name='defaultExampleRadios'>"+
                            "<label class='custom-control-label' for='paqueteria"+countPaq+"'></label>"+
                   " </div>"+
                "</div>"+
                "</div>");
               
                $('#loader').remove();
            },
           
            error: function(response){
                alert("No se pudieron cargar las paqueterias");
                $('#loader').remove();
            }
    
        });
        var total=parseInt($("#total-cart").val());
        $('#step-2').on('change', '#paqueteria1', function(e){
            e.preventDefault();
           
            var num = '$' + (ratedhl).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#ship-rate").html(num);
            $("#shipment").html("DHL");
            num = '$' + (ratedhl+total).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#total").html(num);
        });

        $('#step-2').on('change', '#paqueteria2', function(e){
            e.preventDefault();
            var num = '$' + (ratefedex).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#ship-rate").html(num);
            $("#shipment").html("Fedex");
            num = '$' + (ratefedex+total).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#total").html(num);
        });

        $('#step-2').on('change', '#paqueteria3', function(e){
            e.preventDefault();
            var num = '$' + (rateups).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#ship-rate").html(num);
            $("#shipment").html("UPS");
            num = '$' + (rateups+total).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#total").html(num);
        });

        $('#step-2').on('change', '#paqueteria4', function(e){
            e.preventDefault();
            var num = '$' + (rateredpack).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#ship-rate").html(num);
            $("#shipment").html("Redpack");
            num = '$' + (rateredpack+total).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $("#total").html(num);
        });

    $("#btn-testship").click(function(){
        var carrie_id=""; //id de la tarifa de la paqueteria
        var band=true; //Seleccion de una paqueteria 
        if($("#paqueteria1").prop("checked"))
        {
            carrie_id=$("#paqueteria1").val();
            carrie="dhl";
            
        }
        else if($("#paqueteria2").prop("checked"))
        {
            carrie_id=$("#paqueteria2").val();
            carrie="fedex";
          
        }
        else if($("#paqueteria3").prop("checked"))
        {
            carrie_id=$("#paqueteria3").val();
            carrie="ups";
          
        }
        else if($("#paqueteria4").prop("checked"))
        {
            carrie_id=$("#paqueteria4").val();
            carrie="redpack";
          
        }
        else
        {
           alert("Elegir un metodo de envío");
           band=false;
        }
        if(band)
        {
            var address;
            var customer;
            address = jQuery.parseJSON($("#address-active").val());
            customer= jQuery.parseJSON($("#customer").val());
            $("#loader-contener").html("<div id='loader'></div>");
            var formData = {    
                        api_key : 'c3704460afdf5f0a6e53b71c48a2f736',
                        origin_direction:{  company: "Acadep",
                                            country_code: "MX",
                                            postal_code: "23000",
                                            direction_1: "Allende",
                                            city: "La Paz",
                                            phone: "6121225174",
                                        },
                        destination_direction:{ full_name: customer.nombre+" "+customer.apellidos,
                                                country_code: "MX",
                                                postal_code: address.cp,
                                                direction_1: address.calle,
                                                direction_2: address.calle2,
                                                direction_3: address.calle3,
                                                city: address.ciudad,
                                                phone: customer.telefono,
                                        },
                        carrier: carrie,
                        carrier_service_code: carrie_id, 
                        shipment:{
                        shipment_type:"Package",
                        content: "Productos",
                            parcels:[
                                {
                                    quantity:"1",
                                    weight:"1",
                                    weight_unit:"kg",
                                    length:"5",
                                    height:"10",
                                    width:"15",
                                    dimension_unit:"cm"
                                }
                            ]}
                        ,};
    
            $.ajax({
            url: 'https://enviaya.com.mx/api/v1/shipments',
            method: 'POST',
            data: formData,
            success: function(response){
                console.log(response);
                $('#loader').remove();
            },
            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
                $('#loader').remove();
            }
    
            });
    
        }
       
    });
});
