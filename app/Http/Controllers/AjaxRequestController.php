<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AjaxRequestController extends Controller
{

    public function productDetail($id)
    {
        $status = true;
        try {
            $resultSet = Product::find($id);
            $content = view('ajax.products.detail', compact('id', 'resultSet'));
            $responseBody = $content->render();
            return json_encode(['status' => $status, 'body' => $responseBody]);
        } catch (Exception $ex) {
            
        }
    }

}
