@extends('layouts.app')

@section('htmlheader_title')
    Usuarios
@endsection

@section('main-content')
    <link href="{{ asset('/css/main_pedidos.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/icons.css') }}" rel="stylesheet">
    <div id="AtencionController" style="padding-top: 2em">
        <spinner id="spinner-box" :size="size" :fixed="fixed" v-show="loaded" text="Espere un momento por favor">
        </spinner>

        <div class="alert alert-success" transition="success" v-if="success">@{{ msj }} </div>
        <div class="alert alert-danger" transition="danger" v-if="danger">@{{ msj }} </div>
        
       <div class="col-md-8">
            <!-- col-md-8 start here -->
            <div class="row">
                <!-- .row start -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <!-- .col-md-3 -->
                    <a href="#" title="" class="stats-btn tipB mb20" data-original-title="I`m with gradient">
                        <i class="icon icomoon-icon-table"></i>
                        <span class="notification">5</span>
                    </a>
                </div>
                <!-- / .col-md-3 -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <!-- .col-md-3 -->
                    <a href="#" class="stats-btn mb20">
                        <i class="icon icomoon-icon-table"></i>
                        <span class="notification blue">12</span>
                    </a>
                </div>
                <!-- / .col-md-3 -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <!-- .col-md-3 -->
                    <a href="#" title="" class="stats-btn pattern tipB mb20" data-original-title="I`m with pattern">
                        <i class="icon icomoon-icon-table"></i>
                        <!-- .<span class="txt">New Comments</span>-->
                        <span class="notification green">23</span>
                    </a>
                </div>
                <!-- / .col-md-3 -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <!-- .col-md-3 -->
                    <a href="#" class="stats-btn mb20">
                        <i class="icon icomoon-icon-table"></i>
                        <span class="notification">+5</span>
                    </a>
                </div>
                <!-- / .col-md-3 -->
            </div>
            <!-- / .row -->
        </div>

        

    </div>
@endsection

@push('scripts_custom')
    
    <script src="/js/atencion.js"></script>

    <style>
    .success-transition {
        transition: all .5s ease-in-out;
    }
    .success-enter, .success-leave {
        opacity: 0;
    }
    </style>
@endpush