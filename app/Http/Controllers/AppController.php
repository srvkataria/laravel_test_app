<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AjaxService;


class AppController extends Controller
{
    public function ajaxCall(Request $request)
    {
        $ajaxService = new AjaxService();
        if ($request->input('action') == "save_record") {
        	$result = $ajaxService->saveRecord($request->input('input_data'));
        	return $result;
        }  
        else if ($request->input('action') == "get_all_records") {
        	$result = $ajaxService->getAllRecords();
        	return $result;
        } else if ($request->input('action') == "delete_record") {
        	$result = $ajaxService->deleteRecord($request->input('row_id'));
        	return $result;
        }  
        else if ($request->input('action') == "edit_record") {
        	$result = $ajaxService->editRecord($request->input('row_id'), $request->input('product_name'),$request->input('qty'),$request->input('price'));
        	return $result;
        }        
        
        return '';
    }
}
