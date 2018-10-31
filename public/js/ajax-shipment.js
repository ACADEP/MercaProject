function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

$(document).ready(function(){

    $.date = function(dateObject) {
        var d = new Date(dateObject);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = day + "/" + month + "/" + year;
    
        return date;
    };
 
if($("#cp_user").val()!=undefined)
{
    chargeShipments($("#cp_user").val());
}
else
{
    $('#loader').remove();
    $("#shipments").html("Agrege una dirección para mostrar paqueterías disponibles");
}

function chargeShipments(cp_user)
{ 
    shipments=new Array();
    var formData = {    api_key : 'c3704460afdf5f0a6e53b71c48a2f736',
                        origin_direction:{country_code:"MX" ,postal_code:"23000"},
                        destination_direction:{country_code:"MX" ,postal_code: cp_user},
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
        $.ajax({
            url: 'https://enviaya.com.mx/api/v1/rates',
            method: 'POST',
            data: formData,
            success: function(response){

                if(response.dhl.length > 0)
                {
                    response.dhl.sort(function (a, b) {
                        return a.total_amount - b.total_amount;
                    });
                
                    shipments.push(response.dhl[0]);
                   
                
                }
                if(response.fedex.length > 0)
                {
                    response.fedex.sort(function (a, b) {
                        return a.total_amount - b.total_amount;
                    });
                    shipments.push(response.fedex[0]);
                   
                }

                if(response.ups.length > 0)
                {
                    response.ups.sort(function (a, b) {
                        return a.total_amount - b.total_amount;
                    });
                    shipments.push(response.ups[0]);
                   
                }

                if(response.redpack.length > 0)
                {
                    response.redpack.sort(function (a, b) {
                        return a.total_amount - b.total_amount;
                    });
                    shipments.push(response.redpack[0]);
                }

                var countPaq=1;
                $("#shipments").html("");
                shipments.forEach(element => {
                    $("#shipments").append("<a id='paq-"+countPaq+"'><div class='card border-primary mb-3 text-center col-md-4' style='max-width: 10rem; margin:10px; height:310px;'>"+
                    "<div class='card-body'>"+
                        "<p class='card-text' style='width:100%;' >"+
                            "<img src='"+element.carrier_logo_url+"' class='img-fluid'>"+
                        "</p>"+
                        "<h4>Costo:</h4><div class='badge badge-pill badge-primary' style='font-size:15px;'>$"+element.total_amount+"</div><br>"+
                        "Llegada aprox:<div class='badge badge-pill badge-primary'>"+$.date(element.estimated_delivery)+"</div>"+
                        "<div class='custom-control custom-radio'>"+
                                "<input type='radio' class='custom-control-input' value="+element.carrier_service_code+" id='paqueteria"+countPaq+"' name='defaultExampleRadios'>"+
                                "<label class='custom-control-label' for='paqueteria"+countPaq+"'></label>"+
                       " </div>"+
                    "</div>"+
                    "</div></a>");
                    countPaq++;    
                });

                var total=parseInt($("#total-cart").val());
                var cont=1;
                shipments.forEach(element =>{
                    $('#step-2').on('click', '#paq-'+cont, { i : cont }, function(e){
                        reset_paq_css();
                        $(this).css("background-color", "green");
                        e.preventDefault();
                        var cont = e.data;
                        $('#paqueteria'+cont.i).prop("checked",true);
                        var num = '$' + (element.total_amount).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                        $(".ship-rate").html(num);
                        $("#total-pursh").val(element.total_amount+total);
                        $("#shipment").html(element.carrier);
                        num = '$' + (element.total_amount+total).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                        $("#total").html(num);
                        $('#carrie_id').val($('#paqueteria'+cont.i).val());
                        $("#date_aprox").html($.date(element.estimated_delivery));
                    });
                   cont++;
                });
                $('#loader').remove();
            },
           
            error: function(response){
                alert("No se pudieron cargar las paqueterías");
                $("#shipments").html("No hay paqueterías disponibles vuelva a intentarlo mas tarde")
                $('#loader').remove();
            }
          

    
        });

        function reset_paq_css()
        {
            for(var i=1;i<=shipments.length;i++)
            {
                $("#paq-"+i).css("background-color", "white");
            }
        }

        
      
}  


   
});
