<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
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
        $data=\Request::all();

        // se define la validacion de los campos
        $rules = array(
            'name' => 'required|max:60',
            'email'  => 'required|email|unique:users,email,' . $id,
            'profile' => 'in:colaborador,usuario,super_admin',
            'enable'=>'in:si,no');

        // Se validan los datos ingresados segun las reglas definidas
        $v = \Validator::make($data, $rules);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }

        $user = User::find($id);
        $user->fill(\Request::all());
        $user->save();
        return Redirect::to('admin/user')->with('success_message', 'Registro actualizado.');
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
        $data=\Request::all();

        // se define la validacion de los campos
        $rules = array(
            'name' => 'required|max:60',
            'email' => 'email|unique:users',
            'profile' => 'in:colaborador,usuario,super_admin',
            'enable'=>'in:si,no');

        // Se validan los datos ingresados segun las reglas definidas
        $v = \Validator::make($data, $rules);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        $user = User::create($data);
        return Redirect::to('admin/user')->with('success_message', 'Registro guardado!');
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
            //->whereNull('deleted_at')
            ->orderBy('name', 'ASC')
            ->paginate(10);
            return View::make('admin.user.view_user', compact('items', 'search'));
        }
    }

}