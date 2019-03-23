$(document).ready(function(){
	$("#search").keyup(function(){
		if($("#search").val().length > 2){
			var search = $("#search").val().replace(" ", "%20");
			var path = "buscarAjax/"+search;
			$("#searchResult").load(path);
		}
	});
});