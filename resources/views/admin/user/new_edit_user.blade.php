@extends('template.generic_admin')

@section('head_content')
@stop
@section('body_content')
<hr>
@if(!$show)
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">@if($user->id) Editar @else Crear @endif</h3>
                </div>
                <div class="panel-body">

                    {{-- Mensajes de validaciones del formulario --}}
                    @include ('admin.alert.messages-validations')
                    {{-- Fin Mensajes de validaciones del formulario --}}

                    @if($user->id)
                      {!! Form::model($user, ['id' => 'form_user', 'route' => ['admin.user.update', $user->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) !!}
                      {!! Form::hidden('email_old', $user->email, array('id'=>'email_old'))!!}
                    @else
                      {!!Form::model($user, ['id' => 'form_user', 'route' => 'admin.user.store', 'role'=>'form', 'class'=>'form-horizontal']) !!}
                    @endif

                    {{--Se valida que si lleguen datos correctos--}}
                    @if (!empty($user))

                        {{-- Campos del formulario --}}
                        @include ('admin.user.partials.fields')
                        {{-- Fin Campos del formulario --}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{URL::to('/')}}/admin/user" class="btn btn-info">Volver</a>
                            </div>
                        </div>
                    @else
                    <p class="">No existe información para este item</p>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- Contenido de la visualizacion del item -->
<div class="container">
    <div class="row">
        <!-- Contenido de la visualizacion del item -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detalles</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(array('role'=>'form', 'class'=>'form-horizontal'))!!}
                @if (!empty($user))
                <div class="form-group">
                    {!!Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))!!}
                    <div class="col-sm-4">
                        {!! Form::label('name',$user->name, array('class' => 'form-control'))!!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Usuario', array('class' => 'control-label col-sm-2'))!!}
                    <div class="col-sm-4">
                        {!! Form::label('email',$user->email, array('class' => 'form-control'))!!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('profile', 'Perfil', array('class' => 'control-label col-sm-2'))!!}
                    <div class="col-sm-4">
                        {!!  Form::select('profile',array('colaborador'=>'Colaborador','usuario'=>'Usuario','super_admin'=>'Administrador'), $user->profile, array('class'=>'form-control','disabled' => 'true')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))!!}
                    <div class="col-sm-4">
                        {!!  Form::select('enable',array('si'=>'si','no'=>'no'), $user->enable, array('class'=>'form-control','disabled' => 'true')) !!}
                    </div>
                </div>
                @else
                <p class="">No existe información para éste usuario</p>
                @endif
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <a href="{{URL::to('/')}}/admin/user" class="btn btn-info">Volver</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endif
@stop
@section('javascript_content')
@stop
