var listaFerias = [];
window.onload = popularTabela();
//window.onload 

function escreverArquivo(ferias) {

  let fso = new ActiveXObject("Scripting.FileSystemObject");
  let fh = null;
  let varDate data;
  let caminho = "C:/Users/PAULO/Documents/Projeto JS/Mamba/Mamba/teste.txt"
  //var ExcelApp = new ActiveXObject("Excel.Application");
  //var excelSheet = new ActiveXObject("Excel.Sheet");

  //excelSheet.Application.Visible = true;
  if(fso.FileExists (caminho))
       fh = fso.OpenTextFile(caminho, 8, true);
  else
      fh = fso.CreateTextFile(caminho, true);

  fh.WriteLine(JSON.stringify(ferias));

  fh.Close();

  alert("Suas Férias foi agendada " + ferias.nome +"! Aguarde a confirmação...");
  //$('.modal').modal('hide');

}


function escreverArquivoAll(listaFerias) {

  let fso = new ActiveXObject("Scripting.FileSystemObject");
  let fh = null;
  let caminho = "C:/Users/PAULO/Documents/Projeto JS/Mamba/Mamba/teste.txt"
  //var ExcelApp = new ActiveXObject("Excel.Application");
  //var excelSheet = new ActiveXObject("Excel.Sheet");
  //excelSheet.Application.Visible = true;
  if(fso.FileExists (caminho))
       fh = fso.OpenTextFile(caminho, 8, true);
  else
      fh = fso.CreateTextFile(caminho, true);

  for(i  = 0; i< listaFerias.length; i++)
  {
    fh.WriteLine(JSON.stringify(listaFerias[i]));
  }  
 
  fh.Close();

  //alert("Suas Férias foi agendada " + ferias.nome +"! Aguarde a confirmação...");
  //$('.modal').modal('hide');

}


function lerArquivo()
{
  let fso = new ActiveXObject("Scripting.FileSystemObject");
  let fh = null; let linha; let stream;
  let caminho = "C:/Users/PAULO/Documents/Projeto JS/Mamba/Mamba/teste.txt";
  
  if(fso.FileExists (caminho))
       fh = fso.GetFile(caminho) 
  else
       fh = fso.CreateTextFile(caminho, true);

    stream = fh.OpenAsTextStream(1,false) 

    while(!stream.AtEndOfStream)
    {
      linha = stream.Readline();
     
      listaFerias.push(JSON.parse(linha));
    }
    stream.Close();
}


function popularTabela()
{
  var tabela = document.getElementById("tabela");
  let linha  = document.createElement("tr");
  var corpoTabela = document.getElementById("corpo");
 
  lerArquivo();
  for(i = 0; i < listaFerias.length; i++)
  {

    let linha  = document.createElement("tr");
    let cell = document.createElement("td");
    let cell1 = document.createElement("td");
    let cell2 = document.createElement("td");
    let cell3 = document.createElement("td");
    let cell4 = document.createElement("td");
    let cellOp = document.createElement("td");
    cellOp.classList.add("excluir");
    let botaoExcluir = document.createElement('button');
    let botaoAlterar = document.createElement("button");
    botaoExcluir.innerHTML = "Excluir";
    botaoExcluir.classList.add("btn-danger");
    botaoExcluir.classList.add("excluir");
    botaoAlterar.innerHTML = "Alterar";
    botaoAlterar.classList.add("btn-primary");
    let  textoIndice = document.createTextNode(i);
    let  textoNome = document.createTextNode(listaFerias[i].nome);
    let textoData = document.createTextNode(listaFerias[i].data);
    let textoDias = document.createTextNode(i);
    let textoStatus = document.createTextNode("pedente");
    cell.appendChild(textoIndice);
    linha.appendChild(cell);
    cell1.appendChild(textoNome);
    linha.appendChild(cell1);
    cell2.appendChild(textoData);
    linha.appendChild(cell2);
    cell3.appendChild(textoDias);
    linha.appendChild(cell3);
    cell4.appendChild(textoStatus);
    linha.appendChild(cell4);
    cellOp.appendChild(botaoAlterar);
    cellOp.appendChild(botaoExcluir);
    linha.appendChild(cellOp);
    corpoTabela.appendChild(linha);
  }
  
}


function salvarDados()
{
  var ferias = new Object();
  ferias.nome = document.getElementById("nome").value;
  ferias.matricula = document.getElementById("matricula").value;
  ferias.data = document.getElementById("data").value;
  ferias.dias = document.getElementById("qdtDias");

  escreverArquivo(ferias);
}

function removerArquivo(index)
{

    let fso = new ActiveXObject("Scripting.FileSystemObject");
    let caminho = "C:/Users/PAULO/Documents/Projeto JS/Mamba/Mamba/teste.txt"
    
    listaFerias.splice(index, 1);
    fso.DeleteFile(caminho, true);
    escreverArquivoAll(listaFerias);

}


function habilitarModal() {
  var isIE = window.ActiveXObject || "ActiveXObject" in window;
  if (isIE) {
      $('.modal').removeClass('fade');
  }
}


$(document).ready(function() {
  $('.modal').on('hidden.bs.modal', function() {
    console.log('fechar modal')
    $(this).find('input:text').val('');
  });
});


$( "button.excluir" ).click(function() {

  if(confirm("Deseja cancelar agendamento de férias"))
  {
    removerArquivo($(this).parent().parent().index());
    $(this).parent().parent().remove();
  }

});

