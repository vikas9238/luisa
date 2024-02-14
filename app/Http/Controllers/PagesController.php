<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Group;
use App\Mail\Contact;
use Mail;

class PagesController extends Controller
{

    public function home(Request $request)
    {
        $productObj = Product::select(['*']);
        $slectedGroup = $request->group ?? '';
        $slectedKeyword = $request->keyword ?? '';
        if (isset($request->group)) {
            $productObj->where('group_id', $request->group);
        }
        if (isset($request->keyword)) {
            $productObj->where('name', 'LIKE', '%' . $request->keyword . '%');
        }
        $products = $productObj->get();
        $groups = Group::pluck('name', 'id')->toArray();
        return view('pages.home', compact('products', 'groups', 'slectedGroup', 'slectedKeyword'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
        $mailData = [
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'subject' => $request->subject,
            'description' => $request->description,
        ];
        Mail::to("luisapharmaceuticals@gmail.com")->send(new Contact($mailData));
        return redirect()->back()->with("alert-success", "Information submitted successfully. Our representative contact you shortly");
    }

}
