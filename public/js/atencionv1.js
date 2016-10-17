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

$(document).delegate("input[name=cantdeproducto]", "change", function(){
	data_producto = $(this).data("producto");
	console.log(data_producto);
	stockN = data_producto.stock - $(this).val();
	$("#"+id+" span.stock").html(stockN);
	data_producto.stock = stockN;

	//$("li#"+id+" input[type=checkbox]").val(JSON.stringify(data_producto));
});

notificacion = function(data) {
$(".notificaciones-pedido").css("display", "none");
    setTimeout(function(){
    	new PNotify({
	    	addclass: "notificaciones-pedido",
	        title: 'Preparacion',
	        text: 'Aqui ira preparacion del producto'
	   });
    }, 1000);
}

pintarResultado = function(data) {
	
	if (data.length > 0) {
			html = "";
		for(var i in data) {
			valor = JSON.parse(data[i]);
			valor.seleccionado = 1;
			valor.stockS = 1;
			id = valor.id;
			stock = parseInt(valor.stock);
			nuevostock = stock-1;
			valor.stock = nuevostock;
			html+="<li id='add-producto-"+id+"'><input type='checkbox' value='"+JSON.stringify(valor)+"' class='btn-producto-add' name='producto[]'>";
			html+="<span class='descripcion'>"+valor.descripcion_corta+"</span>";
			html+="<input type='number' min='1' name='cantdeproducto' class='stock' value='1' data-producto='"+JSON.stringify(valor)+"' /></li>";
			
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

