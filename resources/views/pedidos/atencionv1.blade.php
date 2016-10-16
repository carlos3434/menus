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
					</ul>
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="1a">
							<ul>
								@foreach ($productos["menu"] as $key => $value)
									<li><input type="checkbox" value="{{json_encode($value)}}" class="btn-producto" name="producto[]"/><span class="descripcion">{{$value['descripcion_corta']}}</span><span class="stock">{{$value['stock']}}</span></li>
								@endforeach
							</ul>
						</div>
						<div class="tab-pane" id="2a">
						    <ul>
								@foreach ($productos["carta"] as $key => $value)
									<li><input type="checkbox" value="{{json_encode($value)}}" class="btn-producto" name="producto[]"/><span class="descripcion">{{$value['descripcion_corta']}}</span><span class="stock">{{$value['stock']}}</span></li>
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
						<li><a href="#2a" data-toggle="tab">Carta</a></li>
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

   <!-- <div class="row">

        <div id="AtencionController">
            <spinner id="spinner-box" :size="size" :fixed="fixed" v-show="loaded" text="Espere un momento por favor">
            </spinner>

            <div class="alert alert-success" transition="success" v-if="success">@{{ msj }} </div>
            <div class="alert alert-danger" transition="danger" v-if="danger">@{{ msj }} </div>
            
           <div id='mesas' class="col-md-8">
                <h3>Mesas</h3>
                    <div class="row listado-mesas">
                        @for ($i = 0; $i < 20; $i++)
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="javascript:void(0);" title="" class="stats-btn tipB mb20" data-original-title="I`m with gradient">
                                    <i class="fa fa-table" aria-hidden="true"></i>
                                    <span class="notification">5</span>
                                </a>
                            </div>
                        @endfor
                        
                    </div>
                
            </div>

            <div id='platos' class="col-md-12">
                <h3>Mesa # 2</h3>
                <ul class="nav nav-pills  nav-justified">
                  <li class="active"><a data-toggle="pill" href="#menu">Menu</a></li>
                  <li><a data-toggle="pill" href="#carta">Carta</a></li>
                </ul>
                <div class="tab-content">
                    <div id="menu" class="tab-pane fade in active">
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="t_usuarios" class="table table-sm table-condensed table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">#</th>
                                                <th class="col-md-10" colspan="3">Plato</th>
                                                <th class="col-md-1 col-md-1 col-sm-1 col-xs-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_usuarios">
                                            <tr>
                                                <th scope="row">1</td>
                                                <td>
                                                    Seco a la huachana
                                                </td>
                                                <td>
                                                    <select style="display: none" class="selectpicker" name="slct_tipo_persona" id="slct_tipo_persona_">
                                                        <option value='1'>Adulto</option>
                                                        <option value='2' selected>Niño</option>
                                                        <option value='3' selected>Embarazada</option>
                                                        <option value='4' selected>Mujer c7n bebe</option>
                                                        <option value='5' selected>Adulto mayor</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="display: none"  class="form-control input-sm" placeholder="Observacion" name="txt_observacion" id="txt_observacion">
                                                    <span class="badge pull-right">32</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs" Onclick="AgregarSubmodulo();">
                                                        &nbsp;<i class="fa fa-plus fa-sm"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</td>
                                                <td>
                                                    Aji de gallina
                                                </td>
                                                <td>
                                                    <select style="display: none" class="selectpicker" name="slct_tipo_persona" id="slct_tipo_persona_">
                                                        <option value='1'>Adulto</option>
                                                        <option value='2' selected>Niño</option>
                                                        <option value='3' selected>Embarazada</option>
                                                        <option value='4' selected>Mujer c7n bebe</option>
                                                        <option value='5' selected>Adulto mayor</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="display: none"  class="form-control input-sm" placeholder="Observacion" name="txt_observacion" id="txt_observacion">
                                                    <span class="badge pull-right">30</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs" Onclick="AgregarSubmodulo();">
                                                        &nbsp;<i class="fa fa-plus fa-sm"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</td>
                                                <td>
                                                    Escaveche
                                                </td>
                                                <td>
                                                    <select style="display: none" class="selectpicker" name="slct_tipo_persona" id="slct_tipo_persona_">
                                                        <option value='1'>Adulto</option>
                                                        <option value='2' selected>Niño</option>
                                                        <option value='3' selected>Embarazada</option>
                                                        <option value='4' selected>Mujer c7n bebe</option>
                                                        <option value='5' selected>Adulto mayor</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="display: none"  class="form-control input-sm" placeholder="Observacion" name="txt_observacion" id="txt_observacion">
                                                    <span class="badge pull-right">14</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs" Onclick="AgregarSubmodulo();">
                                                        &nbsp;<i class="fa fa-plus fa-sm"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</td>
                                                <td>
                                                    Tallarines
                                                </td>
                                                <td>
                                                    <select style="display: none" class="selectpicker" name="slct_tipo_persona" id="slct_tipo_persona_">
                                                        <option value='1'>Adulto</option>
                                                        <option value='2' selected>Niño</option>
                                                        <option value='3' selected>Embarazada</option>
                                                        <option value='4' selected>Mujer c7n bebe</option>
                                                        <option value='5' selected>Adulto mayor</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input  style="display: none" class="form-control input-sm" placeholder="Observacion" name="txt_observacion" id="txt_observacion">
                                                    <span class="badge pull-right">20</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs" Onclick="AgregarSubmodulo();">
                                                        &nbsp;<i class="fa fa-plus fa-sm"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a class='btn btn-default btn-sm pull-left' id="volverVerPlatos"
                                        ><i class="fa fa-plus fa-lg"></i>&nbsp;Volver</a>
                                    <a class='btn btn-primary btn-sm pull-right' id="verPlatos"
                                        ><i class="fa fa-plus fa-lg"></i>&nbsp;Previsualizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="carta" class="tab-pane fade">
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="t_usuarios" class="table table-sm table-condensed table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">#</th>
                                                <th class="col-md-10" colspan="3">Plato</th>
                                                <th class="col-md-1 col-md-1 col-sm-1 col-xs-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_usuarios">
                                            <tr data-toggle="collapse" data-target="#detalle1" class="accordion-toggle">
                                                <th scope="row">1</td>
                                                <td>
                                                    Arroz c/n pollo
                                                </td>
                                                <td>
                                                    <select style="display: none" class="selectpicker" name="slct_tipo_persona" id="slct_tipo_persona_">
                                                        <option value='1'>Adulto</option>
                                                        <option value='2' selected>Niño</option>
                                                        <option value='3' selected>Embarazada</option>
                                                        <option value='4' selected>Mujer c7n bebe</option>
                                                        <option value='5' selected>Adulto mayor</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="display: none"  class="form-control input-sm" placeholder="Observacion" name="txt_observacion" id="txt_observacion">
                                                    <span class="badge pull-right">27</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs" Onclick="AgregarSubmodulo();">
                                                        &nbsp;<i class="fa fa-plus fa-sm"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="hiddenRow">
                                                    <div class="accordian-body collapse" id="detalle1">
                                                        Arroz con pollo previamente frito y verduras frescas, y su respectivo culantro
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr data-toggle="collapse" data-target="#detalle2" class="accordion-toggle">
                                                <th scope="row">2</td>
                                                <td>
                                                    Arroz chaufa
                                                </td>
                                                <td>
                                                    <select style="display: none" class="selectpicker" name="slct_tipo_persona" id="slct_tipo_persona_">
                                                        <option value='1'>Adulto</option>
                                                        <option value='2' selected>Niño</option>
                                                        <option value='3' selected>Embarazada</option>
                                                        <option value='4' selected>Mujer c7n bebe</option>
                                                        <option value='5' selected>Adulto mayor</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input  style="display: none" class="form-control input-sm" placeholder="Observacion" name="txt_observacion" id="txt_observacion">
                                                    <span class="badge pull-right">23</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs" Onclick="AgregarSubmodulo();">
                                                        &nbsp;<i class="fa fa-plus fa-sm"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="hiddenRow">
                                                    <div class="accordian-body collapse" id="detalle2">
                                                        Arroz con pollo previamente frito y verduras frescas, y su respectivo culantro
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <a class='btn btn-default btn-sm pull-left' id="volverCobrar"
                                        ><i class="fa fa-plus fa-lg"></i>&nbsp;Volver</a>
                                    <a class='btn btn-primary btn-sm pull-right' id="cobrar"
                                        data-toggle="modal" data-target="#usuarioModal" data-titulo="Nuevo"><i class="fa fa-plus fa-lg"></i>&nbsp;Previsualizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id='pedidos' class="col-md-12">
                <h3>Pedido</h3>
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="t_usuarios" class="table table-sm table-condensed table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">#</th>
                                        <th class="col-md-10">Plato</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_usuarios">
                                    <tr>
                                        <th scope="row">1</td>
                                        <td>
                                            Sopa de Casa
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</td>
                                        <td>
                                            Arroz chaufa
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a class='btn btn-default btn-sm pull-left' id="volverPedido"
                                        ><i class="fa fa-plus fa-lg"></i>&nbsp;Volver</a>
                            <a class='btn btn-primary btn-sm pull-right' id="pedido"
                                        ><i class="fa fa-plus fa-lg"></i>&nbsp;Previsualizar</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> -->

@endsection

@push('scripts_custom')
    
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