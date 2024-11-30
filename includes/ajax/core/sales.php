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
			if(!isset($_GET['sale']))
				return_json(array('error' => true, 'message' => 'Data inválida'));

			if(!isset($_POST['product_id']) || $_POST['product_id'] == 0)
				return_json(array('error' => true, 'message' => 'Debes seleccionar un producto'));

			$new = $user->add_sale($_POST, $_GET['sale'], false);
			$get_balance = $db->query("SELECT SUM(detail_sub_total) AS balance FROM `sale_detail` WHERE sale_id = ".$_GET['sale']);
		    $balance = $get_balance->fetch_assoc();

			return_json(array('callback' => "
								let tr_text = `<td>".$new['product_name']."</td>
					            <td>$".$new['detail_price_unit']."</td>
					            <td>".$new['detail_price_unit_bs']." Bs</td>
					            <td>".$new['detail_quantity']."</td>
					            <td>$".$new['detail_sub_total']."</td>
					            <td><button class='btn btn-flat js_button' data-url='core/sales.php?do=desc&sale=".$_GET['sale']."' data-id='".$new['sale_detail_id']."'><i class='material-icons'>close<i></button></td>`;
					            let tb = document.getElementById('tbody_sale');
								let tr = document.createElement('tr');
								tr.id = 'tr".$new['sale_detail_id']."';
								tr.innerHTML = tr_text;
								tb.appendChild(tr);form.reset();$('#product_id').val(0);
								$('#total_balance').html(".$balance['balance'].");
								M.toast({html: 'Elemento añadido', classes: 'rounded green'});"));
			break;

		case 'desc':
			if(!isset($_POST['id']))
				return_json(array('error' => true, 'message' => 'Data inválida'));

			$user->desc_sale($_POST['id']);
			$get_balance = $db->query("SELECT SUM(detail_sub_total) AS balance FROM `sale_detail` WHERE sale_id = ".$_GET['sale']);
		    $balance = $get_balance->fetch_assoc();
		    $balance['balance'] = ($balance['balance'] == null)?0:$balance['balance'];

			return_json(array('callback' => "
								let tb = document.getElementById('tbody_sale');
								tb.removeChild(document.getElementById('tr".$_POST['id']."'));
								$('#total_balance').html(".$balance['balance'].")"));
			break;
		
		case 'check':
			if(!isset($_GET['id']))
				return_json(array('error' => true, 'message' => 'Data inválida, por favor recargue la página'));

			$user->check_sale($_POST, $_GET['id']);
			return_json(array('callback' => 'location.href = "'.SYS_URL.'/sales/list'.'"'));
			break;

		case 'check_credit_payment':
			if(!isset($_POST['id']))
				return_json(array('error' => true, 'message' => 'Data inválida, por favor recargue la página'));

			$user->check_credit_payment_sale($_POST['id']);
			return_json(array('callback' => 'window.location.reload();'));
			break;

		case 'delete':
			if(!isset($_POST['id']))
				return_json(array('error' => true, 'message' => 'Data inválida, por favor recargue la página'));

			$user->delete_sale($_POST['id']);
			return_json(array('callback' => 'location.href = ""'));
			break;
		default:
			// code...
			break;
	}
	//return_json(array('callback' => "window.location = ".$rut));
} catch (Exception $e) {
	return_json(array('error' => true, 'message' => $e->getMessage()));
}
