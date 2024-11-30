var api = [];

function sendForm(element){
    console.log(element.data('url'))
	var url = element.data('url');
    let photo = (element.data('photo')) ? element.data('photo') : '';
    var form = element.get(0);
	var formData = new FormData(element.get(0));
	formData.append('photo', JSON.stringify(photo));

	$.ajax({
            url: site_path+'/includes/ajax/'+url,
            data: formData,
            type: 'POST',
            enctype: 'x-www-form-urlencoded',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response){
                console.log(response)
                if(response.error){
	       			M.toast({html: "Error: "+response.message, classes: 'rounded red'});
                } else if(response.callback)
                    eval(response.callback);

                try{
                    document.querySelector('.progress_photo').value = 0;
                } catch {

                }
            },
            error: function(error){
         	    M.toast({html: "Error: Ha ocurrido un error", classes: 'rounded red'});
                console.log(error)
            }
        });
}


$('body').on('submit', '.js_form', function(e){
	e.preventDefault();
	sendForm($(this));
});


$('body').on('click', '.js_button', function(){
    let url = $(this).data('url');
    $.ajax({
        url: site_path+'/includes/ajax/'+url,
        data: {id:$(this).data('id')},
        type: 'POST',
        enctype: 'x-www-form-urlencoded',
        success: function(response){
            if(response.error){
                M.toast({html: "Error: "+response.message, classes: 'rounded red'});
            } else if(response.callback){
                eval(response.callback)
            }
        },
        error: function(error){
            console.log(error)
        }
    });
})

$('body').on('click', '.js_button_check', function(){
    $("#product_id_new").val($(this).data('id'));
    $("#name").val($(this).data('name'));
    $("#name").prop('disabled', true);
    $("#price").val($(this).data('price'));
    $("#price_sale").val($(this).data('price_sale'));
    $("#form_product").data('url', 'core/purchases.php?do=add&purchase='+$(this).data('purchase_id'));
    $('#cont-category').css('display', 'none');
    $('#cont-photo').css('display', 'none');
    $('#cont-description').css('display', 'none');
    $('#cont-marca').css('display', 'none');
})

$('body').on('click', '.js_button_check_sale', function(){
    $("#product_id").val($(this).data('id'));
    $("#name").val($(this).data('name'));
    $("#price_unit").val($(this).data('price'));
    $("#price_unit_bs").val($(this).data('price_bs'));
    $("#price_sale").val($(this).data('price_sale'));
    $("#price_sale_bs").val($(this).data('price_sale_bs'));
})


$('body').on('click', '.js_button_client', function(){
    $("#hd_client_name").val($(this).data('name'));
    $("#hd_client_contact").val($(this).data('contact'));
    $("#hd_client_id").val($(this).data('id'));
    $("#hd_client_type").val('exist');
    $("#client_span").html($(this).data('name'));
})


$('body').on('click', '.js_button_new_client', function(){
    $("#hd_client_name").val($("#client_name").val())
    $("#hd_client_contact").val($("#client_contact").val())
    $("#hd_client_id").val(0)
    $("#hd_client_type").val('new')
    $("#client_span").html($("#client_name").val());
})

// el select #purchase_type_payment al cambiar el valor a credito coloca el #days_payment_credit_div display block, de lo contrario display none
$('#purchase_type_payment').on('change', function(){
    if($(this).val() == 'credito'){
        $('#days_payment_credit_div').css('display', 'block');
    } else {
        $('#days_payment_credit_div').css('display', 'none');
    }
})

$('#sale_type_payment').on('change', function(){
    if($(this).val() == 'credito'){
        $('#days_payment_credit_div').css('display', 'block');
    } else {
        $('#days_payment_credit_div').css('display', 'none');
    }
})

$('body').on('click', '.js_button_confirm', function(){
    let message = $(this).data('message');
    let url = $(this).data('url');
    let id = $(this).data('id');

    if(confirm(message)){
        $.ajax({
            url: site_path+'/includes/ajax/'+url,
            data: {id:id},
            type: 'POST',
            enctype: 'x-www-form-urlencoded',
            success: function(response){
                if(response.error){
                    M.toast({html: "Error: "+response.message, classes: 'rounded red'});
                } else if(response.callback){
                    eval(response.callback)
                }
            },
            error: function(error){
                console.log(error)
            }
        });
    }
})