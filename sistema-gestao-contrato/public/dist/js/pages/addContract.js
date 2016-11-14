var maxContract = 100;
var countContract = 1;

$(".btn-add-contract").click(function(){

    if(countContract >= maxContract){
        alert("Você só pode adicionar no máximo "+ maxContract +" contratos.");
        return false;
    }

    var contract = $(document.createElement('div'))
        .attr("id", 'contracts' + countContract);

    contract.after().append('<label>Selecione o arquivo '+ (countArquivo + 1) +':</label><input class="form-control" type="file" name="arquivo[]" />');
    contract.appendTo(".contracts");
    countArquivo++;

});



function removeContract() {
    if(countArquivo==1){
        alert("Não a nenhum contrato para remover");
        return false;
    }

    //console.log(countContract);

    countContract--;

    $("#contracts" + countContract).remove();
}
 