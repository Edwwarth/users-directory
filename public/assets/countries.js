$(document).ready(function(){
    $.get("https://restcountries.eu/rest/v2/all", function(data, status){
    var $select = $("#paises");
    for(i=0; i<data.length; i++){
        console.log(data[i].name);
        $select.append($("<option />").val(data[i].name).text(data[i].name));
    }
    });
});