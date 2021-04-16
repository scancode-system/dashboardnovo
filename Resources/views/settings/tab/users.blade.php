<div class="row">
    <div class="col">
        {{ Form::open(['route' => 'users.store']) }}
        <div class="form-group">
            {{ Form::label('name', 'Nome') }}
            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Senha') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
        <div class="form-group  mb-0">
            {{ Form::button('Salvar', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
        </div>
        {{ Form::close() }}
    </div>
    <div class="col">
        <table class="table table-responsive-sm bg-white table-hover border mb-0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="text-right align-middle">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#users_destroy_{{ $user->id }}"><i class="cil-trash"></i></button>
                        </div>
                    </td>
                    @modal_destroy(['route_destroy' => 'users.destroy', 'model' => $user->id, 'modal_id' => 'users_destroy_'.$user->id])
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>