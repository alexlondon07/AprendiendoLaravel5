<?php namespace App\Http\Controllers;
use App\User;
use View;
use Form;

class UserController extends Controller {


    public function index()
    {
        $items = User::orderBy('name', 'ASC')->paginate(10);
        return View::make('admin.user.view_user', compact('items'));
    }

}