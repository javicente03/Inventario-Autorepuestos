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
		case 'new':
			$_POST['photo'] = json_decode($_POST['photo']);
			$user->register_product($_POST);

			if(isset($_GET['purchase'])){
				$new = $user->add_purchase($_POST, $_GET['purchase'], true);
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
								$('#total_balance').html(".$balance['balance'].");
								M.toast({html: 'Elemento añadido', classes: 'rounded green'});"));
			}
			return_json(array('callback' => "M.toast({html: 'Producto registrado exitósamente', classes: 'rounded green'});
                    form.reset()"));
			break;

		case 'edit':

			if(!isset($_GET['id']))
				return_json(array('error' => true, 'message' => 'Data inválida'));

			$_POST['photo'] = json_decode($_POST['photo']);
			$user->edit_product($_POST);

			return_json(array('callback' => "M.toast({html: 'Producto  exitósamente', classes: 'rounded green'});
                    form.reset()"));

			break;
		
		default:
			// code...
			break;
	}
	//return_json(array('callback' => "window.location = ".$rut));
} catch (Exception $e) {
	return_json(array('error' => true, 'message' => $e->getMessage()));
}
