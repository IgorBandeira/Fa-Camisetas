function textoPnumero(t) {
  var tt = t.replace("R$", "").replace(",", ".");
  return parseFloat(tt);
}

function numeroPtexto(n) {
  var t = (n < 1 ? "0" : "") + Math.floor(n * 100);
  t = "R$ " + t;
  return text.substr(0, text.length - 2) + "," + text.substr(-2);
}

function lerTotal() {
  var t = document.getElementById("total");
  return textoPnumero(total.innerHTML);
}

function escreveTotal(t) {
  var total = document.getElementById("total");
  total.innerHTML = numeroPtexto(t);
}

function calcular() {
  var cpqtde = $("#cpqtde").text();
  var cpvalor = $("#cpvalor").val();

  $("#cpliqu").text(cpqtde * cpvalor);
}

function calculaTotalPQ() {
  var items = document.getElementById("produto");
  alert(items.length);
  var subTotalProdutos = 0;

  for (var pos = 0; pos < items.length; pos++) {
    var precoProd = items[pos].document.getElementById("preco");
    var precoTexto = precoProd[0].innerHTML;
    var preco = textoPnumero(precoTexto);

    var qtdProd = items[pos].getElementById("quantidade");
    var qtdTexto = qtdProd[0].value;
    var quantidade = moneyTextToFloat(qtyText);

    var totalPtodutos = quantidade * preco;

    items[pos].getElementById("total").value = totalPtodutos;

    alert(totalPtodutos);

    subTotalProdutos += totalPtodutos;
  }

  return subTotalProdutos;
}

$("#quantity").bind("click keyup", function () {
  $("<p/>").appendTo("#val").html($(this).val());
});
