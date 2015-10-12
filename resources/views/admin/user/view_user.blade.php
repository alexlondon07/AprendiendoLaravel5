
<div class="container-fluid">
    <div class="row">
        <div class="main">
            <h1 class="page-header">Usuarios</h1>
            <div class="controls form-inline">

                <a href="{!!URL::to('/') !!}/admin/user/create" class="btn btn-primary pull-right">Ingresar usuarios</a>

                <div class="input-group">
                  {!! Form::open(array('url' => 'admin/users/search', 'id' => 'search_form', 'method'=>'GET', 'class'=>'control-group')) !!}

                  {!! Form::close() !!}
              </div>
          </div>
            <div class="table-responsive">
                @if (count($items) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td style="width: 150px !important">
                                <table>
                                    <tr>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>{!! $item->name !!}</td>
                            <td>{!! $item->email !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav class="text-center">
                </nav>
                @else
                No hay datos!
                @endif
            </div>
        </div>
    </div>
</div>
