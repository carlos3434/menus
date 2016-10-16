@extends('layouts.app')

@section('htmlheader_title')
    Atención
@endsection

@section('contentheader_title')
    <h1">Atención</h1>
@endsection

@section('main-content')
    <!-- <link href="{{ asset('/css/main_pedidos.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('/css/atencion.css') }}" rel="stylesheet">
    <link href="pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />

    <div class="row">
    	<div class="col-md-12">
    		<div class="col-md-12">
    			<h2>Malla de Mesas</h2>
    			<div class="row listado-mesas">
    				@foreach ($mesas as $key => $value)
    					<div class="col-lg-2">
    						<a href="javascript:void(0);" class="btn-mesa" data-mesa = "{{json_encode($value)}}" style='background-color: {{$value["estado"]["color"]}}'>
    							<i class="fa fa-table" aria-hidden="true"></i>
    							<span>{{$value["nombre"]}}</span>
    						</a>
    					</div>
                    @endforeach
    			</div>
    		</div>
    	</div>
    </div>

    <div class="modal fade" id="modal-pedido">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-5 listado-productos">
	        		<h3>Productos</h3>
	        		<ul  class="nav nav-pills">
						<li class="active"><a  href="#1a" data-toggle="tab">Menú</a></li>
						<li><a href="#2a" data-toggle="tab">Carta</a></li>
					</ul>
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="1a">
							<ul>
								@foreach ($productos["menu"] as $key => $value)
									<li id="{{$value['id']}}"><input type="checkbox" value="{{json_encode($value)}}" class="btn-producto" name="producto[]"/><span class="descripcion">{{$value['descripcion_corta']}}</span><span class="stock">{{$value['stock']}}</span></li>
								@endforeach
							</ul>
						</div>
						<div class="tab-pane" id="2a">
						    <ul>
								@foreach ($productos["carta"] as $key => $value)
									<li id="{{$value['id']}}"><input type="checkbox" value="{{json_encode($value)}}" class="btn-producto" name="producto[]"/><span class="descripcion">{{$value['descripcion_corta']}}</span><span class="stock">{{$value['stock']}}</span></li>
								@endforeach
							</ul>
						</div>
					</div>
	        	</div>
	        	<div class="col-md-1 opciones">
	        		<div class="contenedor-opciones">
	        			<i class="fa fa-arrow-circle-o-right btn-agregar-producto" aria-hidden="true"></i>
	        			<i class="fa fa-arrow-circle-o-left btn-remover-producto" aria-hidden="true"></i>
	        		</div>
	        	</div>
	        	<div class="col-md-6 listado-pedido">
	        		<h3>Listado de Pedido</h3>
	        		<ul class="nav nav-pills">
						<li class="active"><a  href="#1a" data-toggle="tab">Resumen</a></li>
					</ul>
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="1a">
							<ul class="resultado">
							</ul>
						</div>
					</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary">Enviar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

@endsection

@push('scripts_custom')
    <script type="text/javascript" src="pnotify.custom.min.js"></script>
    <script src="/js/atencionv1.js"></script>

    <style>
    .success-transition {
        transition: all .5s ease-in-out;
    }
    .success-enter, .success-leave {
        opacity: 0;
    }
    </style>
@endpush