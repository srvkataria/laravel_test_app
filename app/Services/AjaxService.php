<?php

namespace App\Services;

class AjaxService
{
	public function getAllRecords() {
		$file = base_path() . '/data.json';
		$all_data = file_get_contents($file);
    	return $all_data;
	}

	public function deleteRecord($row_id) {
		$file = base_path() . '/data.json';
		$old_data = file_get_contents($file);
		$old_data_array = json_decode($old_data, true);
		array_splice($old_data_array, (int)$row_id, 1);
		$final_data = json_encode($old_data_array, JSON_PRETTY_PRINT);
		file_put_contents($file, $final_data);
    	return $final_data;
	}

	public function editRecord($row_id, $product_name, $qty, $price) {
		$file = base_path() . '/data.json';
		$old_data = file_get_contents($file);
		$old_data_array = json_decode($old_data, true);

		$old_data_array[(int)$row_id]['product_name'] = $product_name;
		$old_data_array[(int)$row_id]['qty'] = $qty;
		$old_data_array[(int)$row_id]['price'] = $price;
		$total_value = (float)$qty * (float)$price;
		$old_data_array[(int)$row_id]['total_value'] = $total_value;
		//array_splice($old_data_array, (int)$row_id, 1);
		$final_data = json_encode($old_data_array, JSON_PRETTY_PRINT);
		file_put_contents($file, $final_data);
    	return $final_data;
	}

	public function saveRecord($input_data) {
    	$input_data = json_decode($input_data);
    	$new_data = array('product_name' => $input_data->product_name, 'qty' => $input_data->qty, 'price' => $input_data->price);
    	$file = base_path() . '/data.json';
		
		$old_data = file_get_contents($file);

		$old_data_array = json_decode($old_data, true);

		$current_date_time = date('Y/m/d H:i:s');
		$total_value = (float)$input_data->qty * (float)$input_data->price;
		$new_data['created_at'] = $current_date_time;
		$new_data['total_value'] = $total_value;
		
		if(!$old_data_array) {
			$old_data_array[] = $new_data;
		} else {
			array_push($old_data_array,$new_data);
		}

		$final_data = json_encode($old_data_array, JSON_PRETTY_PRINT);
		file_put_contents($file, $final_data);
    	return $final_data;
    }
}
