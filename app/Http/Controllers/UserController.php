<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use  Illuminate\Support\Facades\Request;
use View;
use App\User;

class UserController extends Controller {


    public function index()
    {
        $items = User::paginate();
        //dd($items);
        $items->setPath('user');
        return View::make('admin.user.view_user', compact('items'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user = new User;
        $show = false;
        return View::make('admin.user.new_edit_user', compact('user', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::findOrFail($id);
        $show = false;
        return View::make('admin.user.new_edit_user', compact('user', 'show'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user = User::find($id);
        $data= Request::all();
        if ($user->isValid($data)){
            $user->fill($data);
            $user->save();
            return Redirect::to('admin/user')->with('success_message', 'Registro actualizado.');
        }else{
            return Redirect::back()->withInput()->withErrors($user->errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $user = User::find($id);
        $show = true;
        return View::make('admin.user.new_edit_user', compact('user', 'show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return Redirect::to('admin/user')->with('success_message', 'El registro ha sido borrado.')->withInput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $user = new User;
        $data = Request::all();
        if ($user->isValidStore($data)){
            $user->fill($data);
            $user->save();
            return Redirect::to('admin/user')->with('success_message', 'Registro guardado!');
        }else{
            return Redirect::back()->withInput()->withErrors($user->errors);
        }
    }


    /**
     * Metodo para hacer la busqueda
     */
    public static function search(Request $request) {
        $items = array();
        $search = '';
        if ($request->input('search')) {
            $search = $request->input('search');
            $arrparam = explode(' ', $search);
            $items = User::whereNested(function($q) use ($arrparam) {
                $p = $arrparam[0];
                $q->whereNested(function($q) use ($p) {
                    $q->where('id', 'LIKE', '%' . $p . '%');
                    $q->orwhere('name', 'LIKE', '%' . $p . '%');
                    $q->orwhere('email', 'LIKE', '%' . $p . '%');
                    $q->orwhere('enable', 'LIKE', '%' . $p . '%');
                });
                $c = count($arrparam);
                if ($c > 1) {
                    foreach ($arrparam as $p) {
                        $p = $arrparam[$i];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('id', 'LIKE', '%' . $p . '%');
                            $q->orwhere('name', 'LIKE', '%' . $p . '%');
                            $q->orwhere('email', 'LIKE', '%' . $p . '%');
                            $q->orwhere('enable', 'LIKE', '%' . $p . '%');
                        }, 'OR');
                    }
                }
            })
            ->whereNull('deleted_at')
            ->orderBy('name', 'ASC')
            ->paginate(10);
            return View::make('admin.user.view_user', compact('items', 'search'));
        }
    }

}