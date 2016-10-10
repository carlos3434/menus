@extends('layouts.app')

@section('htmlheader_title')
    Usuarios
@endsection

@section('contentheader_title')
    <h1>Lista de Usuarios</h1>
@endsection

@section('main-content')
    <style>
        /* Move down content because we have a fixed navbar that is 50px tall */
        .vuetable th.sortable:hover {
            color: #2185d0;
            cursor: pointer;
        }
        .vuetable-actions {
            width: 11%;
            padding: 12px 0px;
            text-align: center;
        }
        .vuetable-actions > button {
          padding: 3px 6px;
          margin-right: 4px;
        }
        .vuetable-pagination {
            margin: 0;
        }
        .vuetable-pagination .btn {
            margin: 2px;
        }
        .vuetable-pagination-info {
            float: left;
            margin-top: auto;
            margin-bottom: auto;
        }
        ul.pagination {
          margin: 0px;
        }
        .vuetable-pagination-component {
          float: right;
        }
        .vuetable-pagination-component li a {
            cursor: pointer;
        }
        [v-cloak] {
            display: none;
        }
        .highlight {
            background-color: yellow;
        }
        .vuetable-detail-row {
            height: 200px;
        }
        .detail-row {
            margin-left: 40px;
        }
        .expand-transition {
            transition: all .5s ease;
        }
        .expand-enter, .expand-leave {
            height: 0;
            opacity: 0;
        }

        /* Loading Animation: */
        .vuetable-wrapper {
            opacity: 1;
            position: relative;
            filter: alpha(opacity=100); /* IE8 and earlier */
        }
        .vuetable-wrapper.loading {
          opacity:0.4;
           transition: opacity .3s ease-in-out;
           -moz-transition: opacity .3s ease-in-out;
           -webkit-transition: opacity .3s ease-in-out;
        }
        .vuetable-wrapper.loading:after {
          position: absolute;
          content: '';
          top: 40%;
          left: 50%;
          margin: -30px 0 0 -30px;
          border-radius: 100%;
          -webkit-animation-fill-mode: both;
                  animation-fill-mode: both;
          border: 4px solid #000;
          height: 60px;
          width: 60px;
          background: transparent !important;
          display: inline-block;
          -webkit-animation: pulse 1s 0s ease-in-out infinite;
                  animation: pulse 1s 0s ease-in-out infinite;
        }
        @keyframes pulse {
          0% {
            -webkit-transform: scale(0.6);
                    transform: scale(0.6); }
          50% {
            -webkit-transform: scale(1);
                    transform: scale(1);
                 border-width: 12px; }
          100% {
            -webkit-transform: scale(0.6);
                    transform: scale(0.6); }
        }
    </style>
    <div id="UserController">
        <spinner id="spinner-box" :size="size" :fixed="fixed" v-show="loaded" text="Espere un momento por favor">
        </spinner>
        <div class="alert alert-success" transition="success" v-if="success">@{{ msj }} </div>
        <div class="alert alert-danger" transition="danger" v-if="danger">@{{ msj }} </div>

        <button type="button" class="btn btn-primary btn-sm"  @click="EditNewUser">New User</button>

        @include('users.modal.user')
    </div>
    <div id="app">
        <div class="row">
            <div class="col-md-5 form-inline pull-right">
                <div class="form-inline form-group">
                    <label>Search:</label>
                    <input v-model="searchFor" class="form-control" @keyup.enter="setFilter">
                    <button class="btn btn-primary" @click="setFilter">Go</button>
                    <button class="btn btn-default" @click="resetFilter">Reset</button>
                </div>
            </div>
            <!-- 
            <div class="col-md-5">
                <div class="form-inline form-group pull-right">
                    <button class="btn btn-default" data-toggle="modal" data-target="#settingsModal">
                        <span class="glyphicon glyphicon-cog"></span> Settings
                    </button>
                </div>
            </div>-->
        </div>
        <!-- <div class="modal fade" id="settingsModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <h4 class="modal-title">Settings</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" v-model="multiSort"> Multisort (use Alt+Click)
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pagination:</label>
                            <select class="form-control" v-model="paginationComponent">
                                <option value="vuetable-pagination">vuetable-pagination</option>
                                <option value="vuetable-pagination-dropdown">vuetable-pagination-dropdown</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Per Page:</label>
                            <select class="form-control" v-model="perPage">
                                <option value=10>10</option>
                                <option value=15>15</option>
                                <option value=20>20</option>
                                <option value=25>25</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Visible fields</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="checkbox" v-for="field in fields">
                                        <label>
                                            <input type="checkbox" v-model="field.visible">
                                            @{{ field.title == '' ? field.name.replace('__', '') : field.title | capitalize }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>-->

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
        </div>
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