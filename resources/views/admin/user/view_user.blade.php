@extends('template.generic_admin')

@section('head_content')
@stop

@section('body_content')
<div class="container-fluid">
    <div class="row">
        <div class="main">
            <h2 class="page-header">Usuarios</h2>
            <h4>{!!$items->total()!!} resultados </h4>
            <div class="controls form-inline">
                <a href="{!! URL::to('/') !!}/admin/user/create" class="btn btn-primary pull-right">Crear Usuario</a>
                <div class="input-group">
                  {!! Form::open(array('url' => 'admin/users/search', 'id' => 'search_form', 'method'=>'GET', 'class'=>'control-group')) !!}
                  <div class="form-group">
                        <input id="search"  name="search"  type="text" required="true" class="form-control" placeholder="Buscar..." value="@if(isset($search)){{ $search }}@endif" >
                  </div>
                  <button class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                  <a href="{!!URL::to('/')!!}/admin/user" title="Refrescar Usuarios"class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
                  {!! Form::close() !!}
              </div>
            </div>
          <div class="table-responsive">
            @if (count($items) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Item</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Habilitado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td style="width: 150px !important">
                            <table>
                              <tr>
                                <td><a title="Detalles" href="{!! URL::to('/') !!}/admin/user/{!! $item->id !!}"><span class="glyphicon glyphicon-eye-open btn btn-default btn-xs"></span></a></td>
                                <td><a title="Editar" href="{!! URL::to('/') !!}/admin/user/{{ $item->id !!}/edit"><span class="glyphicon glyphicon-edit btn btn-default btn-xs"></span></a></td>
                                <td>{!! Form::open(['action' => ['UserController@destroy', $item->id], 'method' => 'delete', 'style' => 'display: inline;']) !!}
                                    <button title="Eliminar" type="submit" onclick="return Util.confirmDelete(this);" class="glyphicon glyphicon-trash btn btn-default btn-xs"></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>{!! $item->id !!}</td>
                    <td>{!! $item->name !!}</td>
                    <td>{!! $item->email !!}</td>
                    <td>{!! $item->enable !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $items->render() !!}
        @else
        No hay datos!
        @endif
    </div>
</div>
</div>
</div>
@stop


