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

    // let formProduct = document.getElementById("form_product");
    // let div = formProduct.querySelector(".row");
    // div.removeChild(div.querySelector('#cont-category'));
    // div.removeChild(div.querySelector('#cont-photo'));
    // div.removeChild(div.querySelector('#cont-description'));
    // div.removeChild(div.querySelector('#cont-marca'));
})