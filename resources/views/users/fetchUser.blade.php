@extends('layouts.app')

@section('htmlheader_title')
    Usuarios
@endsection

@section('main-content')

    <div id="UserController" style="padding-top: 2em">
        <spinner id="spinner-box" :size="size" :fixed="fixed" v-show="loaded" text="Espere un momento por favor">
        </spinner>

        <div class="col-sm-12">
            <button type="button" class="btn btn-primary btn-sm"  @click="EditNewUser">New User</button>
        </div>

        <div class="alert alert-success" transition="success" v-if="success">@{{ msj }} </div>
        <div class="alert alert-danger" transition="danger" v-if="danger">@{{ msj }} </div>
        <hr>

        <table class="table">
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>ADDRESS</th>
                <th>CREATED_AT</th>
                <th>UPDATED_AT</th>
                <th>CONTROLLER</th>
            </thead>

            <tbody>
                <tr v-for="user in users">
                    <td>@{{ user.id }}</td>
                    <td>@{{ user.name }}</td>
                    <td>@{{ user.email }}</td>
                    <td>@{{ user.address }}</td>
                    <td>@{{ user.created_at }}</td>
                    <td>@{{ user.updated_at }}</td>
                    <td>
                        <button type="button" class="btn btn-default btn-sm"  @click="ShowUser(user.id)" >Edit User</button>
                        <button class="btn btn-danger btn-sm" @click="RemoveUser(user.id)">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>

        @include('users.modal.user')
        
    </div>
@endsection

@push('scripts')
    
    <script src="/js/users.js"></script>

    <style>
    .success-transition {
        transition: all .5s ease-in-out;
    }
    .success-enter, .success-leave {
        opacity: 0;
    }
    </style>
@endpush