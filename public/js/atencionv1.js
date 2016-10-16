localStorage.setItem("productosS", "{}");

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

pintarResultado = function(data) {
	if (data.length > 0) {
			html = "";
		for(var i in data) {
			valor = JSON.parse(data[i]);
			id = valor.id;
			stock = parseInt(valor.stock);
			console.log(valor);
			html+='<li><input type="checkbox" value="'+JSON.stringify(valor)+'" class="btn-producto" name="producto[]"><span class="descripcion">'+valor.descripcion_corta+'</span><span class="stock">1</span></li>';
			nuevostock = stock-1;
			$("#"+id+" span.stock").html(nuevostock);
		}
		$(".resultado").html(html);
	}

};