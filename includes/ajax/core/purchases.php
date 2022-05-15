<?php

/**
 * ajax -> core -> signup
 * 
 * @package Sngine
 * @author Zamblek
 */

// fetch bootstrap
require('../../../bootstrap.php');

// check AJAX Request
is_ajax();

// check user logged in
if (!$user->_logged_in) {
	return_json(array('callback' => 'window.location.reload();'));
}


try {

	// signup
	switch ($_GET['do']) {
		case 'add':
			if(!isset($_GET['purchase']))
				return_json(array('error' => true, 'message' => 'Data inválida'));
			$user->upgrade_product($_POST);
			$new = $user->add_purchase($_POST, $_GET['purchase'], false);
			$get_balance = $db->query("SELECT SUM(detail_sub_total) AS balance FROM `purchase_detail` WHERE purchase_id = ".$_GET['purchase']);
		    $balance = $get_balance->fetch_assoc();

			return_json(array('callback' => "
								let tr_text = `<td>".$new['product_name']."</td>
					            <td>$".$new['detail_price_unit']."</td>
					            <td>".$new['detail_quantity']."</td>
					            <td>$".$new['detail_sub_total']."</td>
					            <td><button class='btn btn-flat js_button' data-url='core/purchases.php?do=desc&purchase=".$_GET['purchase']."' data-id='".$new['purchase_detail_id']."'><i class='material-icons'>close<i></button></td>`;
					            let tb = document.getElementById('tbody_purchase');
								let tr = document.createElement('tr');
								tr.id = 'tr".$new['purchase_detail_id']."';
								tr.innerHTML = tr_text;
								tb.appendChild(tr);form.reset();
								$(form).removeData('photo');
								$(form).data('url', 'core/products.php?do=new&purchase=".$_GET['purchase']."');
    							$('#name').prop('disabled', false);
								$('#cont-category').css('display', 'initial');
							    $('#cont-photo').css('display', 'initial');
							    $('#cont-description').css('display', 'initial');
							    $('#cont-marca').css('display', 'initial');
								$('#total_balance').html(".$balance['balance'].");
								M.toast({html: 'Elemento añadido', classes: 'rounded green'});"));
			break;

		case 'desc':
			if(!isset($_POST['id']))
				return_json(array('error' => true, 'message' => 'Data inválida'));

			$user->desc_purchase($_POST['id']);
			$get_balance = $db->query("SELECT SUM(detail_sub_total) AS balance FROM `purchase_detail` WHERE purchase_id = ".$_GET['purchase']);
		    $balance = $get_balance->fetch_assoc();
		    $balance['balance'] = ($balance['balance'] == null)?0:$balance['balance'];

			return_json(array('callback' => "
								let tb = document.getElementById('tbody_purchase');
								tb.removeChild(document.getElementById('tr".$_POST['id']."'));
								$('#total_balance').html(".$balance['balance'].")"));
			break;
		
		case 'check':
			if(!isset($_GET['id']))
				return_json(array('error' => true, 'message' => 'Data inválida, por favor recargue la página'));

			$user->check_purchase($_POST, $_GET['id']);
			return_json(array('callback' => 'location.href = "'.SYS_URL.'/purchases/list'.'"'));
		default:
			// code...
			break;
	}
	//return_json(array('callback' => "window.location = ".$rut));
} catch (Exception $e) {
	return_json(array('error' => true, 'message' => $e->getMessage()));
}
