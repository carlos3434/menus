@extends('layouts.app')

@section('htmlheader_title')
    Usuarios
@endsection

@section('contentheader_title')
    <h1>Lista de Usuarios</h1>
@endsection

@section('main-content')
    <div id="app">
        <spinner id="spinner-box" :size="size" :fixed="fixed" v-show="loaded" text="Espere un momento por favor">
        </spinner>
        <div class="alert alert-success" transition="success" v-if="success">@{{ msj }} </div>
        <div class="alert alert-danger" transition="danger" v-if="danger">@{{ msj }} </div>
        <div class="row">
            <div class="row form-group form-inline">
                <div class="col-md-6">
                    <div class="control-group">
                        <label class="control-label"> </label>
                        <button type="button" class="btn btn-primary btn-sm"  @click="EditNewUser">Nuevo</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="control-group pull-right">
                        <label class="control-label">Buscar:</label>
                        <input v-model="searchFor" class="form-control input-sm" @keyup.enter="setFilter">
                        <button class="btn btn-primary btn-sm" @click="setFilter">Go</button>
                        <button class="btn btn-default btn-sm" @click="resetFilter">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <vuetable v-ref:vuetable
                api-url="/api/users"
                data-path="data"
                pagination-path=""
                :fields="fields"
                :sort-order="sortOrder"
                :multi-sort="multiSort"
                table-class="table table-bordered table-striped table-hover"
                ascending-icon="glyphicon glyphicon-chevron-up"
                descending-icon="glyphicon glyphicon-chevron-down"
                pagination-class=""
                pagination-info-class=""
                pagination-component-class=""
                :pagination-component="paginationComponent"
                :item-actions="itemActions"
                :append-params="moreParams"
                :per-page="perPage"
                wrapper-class="vuetable-wrapper"
                table-wrapper=".vuetable-wrapper"
                loading-class="loading"
                detail-row-component="my-detail-row"
                detail-row-id="id"
                detail-row-transition="expand"
                row-class-callback="rowClassCB"
            ></vuetable>
            <div class="control-group pull-right">
                <select class="form-control input-sm" v-model="perPage">
                    <option value=5>5</option>
                    <option value=10>10</option>
                    <option value=15>15</option>
                    <option value=20>20</option>
                    <option value=25>25</option>
                </select>
            </div>
        </div>
        @include('users.modal.user')
    </div>
@endsection

@push('scripts_custom')

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