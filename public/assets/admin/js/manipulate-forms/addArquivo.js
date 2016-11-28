var maxArquivo = 15;   
var countArquivo = 1;

$(".btn-add-arquivo").click(function(){
   
      if(countArquivo >= maxArquivo){
              alert("Você só pode adicionar no máximo "+ maxArquivo +" arquivos.");
              return false;
      }   
   
    var arquivo = $(document.createElement('div'))
         .attr("id", 'arquivos' + countArquivo);

    arquivo.after().append('<hr><input type="text" name="modelo[]" class="form-control" placeholder="Modelo" />');
    arquivo.after().append('<label>Selecione o arquivo '+ (countArquivo + 1) +':</label><input class="form-control" type="file" name="arquivo[]" required/>');
   
    arquivo.appendTo(".arquivos");   
    countArquivo++;

});


 
function removeArquivo() {
    if(countArquivo==1){
          alert("Não a nenhum arquivo para remover");
          return false;
    }  

    console.log(countArquivo); 
 
    countArquivo--;
 
    $("#arquivos" + countArquivo).remove();
 }
 