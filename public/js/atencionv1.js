localStorage.setItem("productosS", "{}");
localStorage.setItem("productosR", "{}");

$(".btn-mesa").click(function(){
	console.log($(this).data("mesa"));
	data = $(this).data("mesa")
	data.productos = 4;
	$(this).attr("data-mesa", JSON.stringify(data));
	$("#modal-pedido .modal-title").html("<b>PEDIDO : <b>"+data.nombre);
	$("#modal-pedido").modal("show");
});

$(".btn-agregar-producto").click(function(){
	seleccionados = [];
	$(".btn-producto").each(function(){
		console.log($(this));
		if($(this).is(":checked")) {
			seleccionados.push($(this).val());
		}
	});
	pintarResultado(seleccionados);
	localStorage.setItem("productosS", JSON.stringify(seleccionados));
});

$(".btn-remover-producto").click(function(){
	seleccionados = [];
	$(".btn-producto").each(function(){
		console.log($(this));
		if($(this).is(":checked")) {
			seleccionados.push($(this).val());
		}
	});
	pintarResultado(seleccionados);
	localStorage.setItem("productosR", JSON.stringify(seleccionados));
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
			html+='<li id="add-producto-'+id+'"><input type="checkbox" value="'+JSON.stringify(valor)+'" class="btn-producto" name="producto[]"><span class="descripcion">'+valor.descripcion_corta+'</span><span class="stock">1</span></li>';
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