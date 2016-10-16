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
			seleccionados.push($(this));
		}
	});
	pintarResultado(seleccionados);
	localStorage.setItem("productosS", JSON.stringify(seleccionados));
});

pintarResultado = function(data) {
	html = "";
	for(var i in data) {
		html+='<li><input type="checkbox" value="{&quot;descripcion_corta&quot;:&quot;Sopa + Pollo Saltado&quot;,&quot;preparacion&quot;:&quot;Esta es una descripcion de preparacion&quot;,&quot;stock&quot;:50,&quot;tipo&quot;:&quot;M&quot;}" class="btn-producto" name="producto[]"><span class="descripcion">Sopa + Pollo Saltado</span><span class="stock">50</span></li>';
	}
	$(".resultado").html(html);
};