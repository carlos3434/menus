localStorage.setItem("productosS", "{}");
localStorage.setItem("productosR", "{}");

$(".btn-mesa").click(function(){
	data = $(this).data("mesa")
	data.productos = 4;
	$(this).attr("data-mesa", JSON.stringify(data));
	$("#modal-pedido .modal-title").html("<b>PEDIDO : <b>"+data.nombre);
	$("#modal-pedido").modal("show");
});

$(".btn-agregar-producto").click(function(){
	seleccionados = [];
	$(".btn-producto").each(function(){
		if($(this).is(":checked")) {
			seleccionados.push($(this).val());
		}
	});
	pintarResultado(seleccionados);
	localStorage.setItem("productosS", JSON.stringify(seleccionados));
});

$(".btn-remover-producto").click(function(){
	seleccionados = [];
	$(".btn-producto-add").each(function(){
		console.log($(this));
		if($(this).is(":checked")) {
			seleccionados.push($(this).val());
		}
	});
	pintarRemocion(seleccionados);
	localStorage.setItem("productosR", JSON.stringify(seleccionados));
});

$(".btn-registrar").click(function(){
	confirmacionRegistro();
});

$( "div.listado-productos ul li" )
  .mouseover(function() {
  	$(".notificaciones-pedido").css("display", "none");
    setTimeout(function(){
    	new PNotify({
	    	addclass: "notificaciones-pedido",
	        title: 'Preparacion',
	        text: 'Aqui ira preparacion del producto'
	   });
    }, 200);
})
  .mouseout(function() {
    console.log($(this).val());
    $(".notificaciones-pedido").css("display", "none");
    
});

pintarResultado = function(data) {
	
	if (data.length > 0) {
			html = "";
		for(var i in data) {
			valor = JSON.parse(data[i]);
			valor.seleccionado = 1;
			valor.stockS = 1;
			id = valor.id;
			stock = parseInt(valor.stock);
			html+="<li id='add-producto-"+id+"'><input type='checkbox' value='"+JSON.stringify(valor)+"' class='btn-producto-add' name='producto[]'><span class='descripcion'>"+valor.descripcion_corta+"</span><span class='stock'>1</span></li>";
			nuevostock = stock-1;
			$("#"+id+" span.stock").html(nuevostock);
		}
		$(".resultado").html(html);
	}
};

pintarRemocion = function(data) {
	if (data.length > 0) {
		for(var i in data) {
			valor = JSON.parse(data[i]);
			stockS = parseInt(valor.stockS);
			id = valor.id;
			stock = parseInt($("li#"+id+" span.stock").html());
			stock+=stockS;
			$("li#"+id+" span.stock").html(stock);
			$("#add-producto-"+id).remove();
		}
	}
};

confirmacionRegistro = function(){
	pedido = JSON.parse(localStorage.getItem("productosS"));
	html="<ul>";
	for (var i in pedido){
		html+="<li>"+pedido[i].seleccionado+"   |   "+pedido[i].descripcion_corta+"</li>";
	}
	html+="</ul>";
	swal({
	  title: "¿Quieres realizar el pedido?",
	  text: "",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Si, pedir!",
	  closeOnConfirm: false
	},
	function(){
	  swal("OK!", "Tu pedido ha sido solicitado.", "success");
	});
};

