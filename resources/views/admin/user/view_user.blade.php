  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
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
       
                                    </tr>
                                </table>
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->enable }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>