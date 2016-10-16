$(".btn-mesa").click(function(){
	console.log($(this).data("mesa"));
	data = $(this).data("mesa")
	data.productos = 4;
	$(this).attr("data", data);
	$("#modal-pedido").modal("show");
});