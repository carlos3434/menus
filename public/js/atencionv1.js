$(".btn-mesa").click(function(){
	console.log($(this).data("mesa"));
	data = JSON.parse($(this).data("mesa"))
	data.productos = 4;
	$(this).attr("data", JSON.stringify(data));
	$("#modal-pedido").modal("show");
});