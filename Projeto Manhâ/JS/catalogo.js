const minPrice = document.getElementById("minPrice");
const maxPrice = document.getElementById("maxPrice");
const minValue = document.getElementById("minValue");
const maxValue = document.getElementById("maxValue");

const checkboxes = document.querySelectorAll(".filtro input[type='checkbox']");
const produtos = document.querySelectorAll(".produto");

function updatePrice() {
  if (parseInt(minPrice.value) > parseInt(maxPrice.value)) {
    minPrice.value = maxPrice.value;
  }
  if (parseInt(maxPrice.value) < parseInt(minPrice.value)) {
    maxPrice.value = minPrice.value;
  }
  minValue.textContent = minPrice.value;
  maxValue.textContent = maxPrice.value;

  filterProducts();
}

function filterProducts() {
  const min = parseInt(minPrice.value);
  const max = parseInt(maxPrice.value);

  const selectedCondicoes = Array.from(
    document.querySelectorAll("input[value='novo']:checked, input[value='usado']:checked")
  ).map(c => c.value);

  const selectedCategorias = Array.from(
    document.querySelectorAll("input[value='pc']:checked, input[value='notebook']:checked, input[value='perifericos']:checked")
  ).map(c => c.value);

  produtos.forEach(produto => {
    const preco = parseInt(produto.dataset.price);
    const condicao = produto.dataset.condicao;
    const categoria = produto.dataset.categoria;

    let show = true;

    if (preco < min || preco > max) {
      show = false;
    }

    if (selectedCondicoes.length > 0 && !selectedCondicoes.includes(condicao)) {
      show = false;
    }

    if (selectedCategorias.length > 0 && !selectedCategorias.includes(categoria)) {
      show = false;
    }

    produto.style.display = show ? "block" : "none";
  });
}

minPrice.addEventListener("input", updatePrice);
maxPrice.addEventListener("input", updatePrice);
checkboxes.forEach(cb => cb.addEventListener("change", filterProducts));

updatePrice();

const carrinhoBtn = document.getElementById("carrinhoBtn");
const carrinhoBox = document.getElementById("carrinhoBox");
const fecharCarrinho = document.getElementById("fecharCarrinho");
const carrinhoItens = document.getElementById("carrinhoItens");
const carrinhoTotal = document.getElementById("carrinhoTotal");

let carrinho = [];

document.querySelectorAll(".addCarrinho").forEach((btn, index) => {
  btn.addEventListener("click", () => {
    const produto = produtos[index];
    const nome = produto.querySelector("p").innerText;
    const preco = parseInt(produto.dataset.price);

    carrinho.push({ nome, preco });
    atualizarCarrinho();
  });
});

function atualizarCarrinho() {
  carrinhoItens.innerHTML = "";
  let total = 0;

  carrinho.forEach((item, i) => {
    total += item.preco;
    let li = document.createElement("li");
    li.textContent = `${item.nome} - R$ ${item.preco}`;
    carrinhoItens.appendChild(li);
  });

  carrinhoTotal.textContent = total;
}

carrinhoBtn.addEventListener("click", () => {
  carrinhoBox.classList.add("open");
});

fecharCarrinho.addEventListener("click", () => {
  carrinhoBox.classList.remove("open");
});

function finalizarCompra() {
  window.location.href = "checkout.html";
}