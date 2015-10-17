                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            {!!Form::label('name', 'Nombre', array('class' => 'control-label col-md-4'))!!}
                            <div class="col-md-6">
                                {!!Form::text('name',null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label('profile', 'Perfil', array('class' => 'control-label col-md-4'))!!}
                            <div class="col-md-6">
                                {!!Form::select('profile',array('Usuario'=>'Usuario','super_admin'=>'Administrador'), null, array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label('enable', 'Habilitado', array('class' => 'control-label col-md-4'))!!}
                            <div class="col-md-6">
                                {!! Form::select('enable',array('si'=>'si','no'=>'no'), null, array('class'=>'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!!Form::label('email', 'Email', array('class' => 'control-label col-md-4'))!!}
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            {!!Form::label('password', 'Contraseña', array('class' => 'control-label col-md-4'))!!}
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>