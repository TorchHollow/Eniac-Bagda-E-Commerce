const minPrice = document.getElementById("minPrice");
const maxPrice = document.getElementById("maxPrice");
const minValue = document.getElementById("minValue");
const maxValue = document.getElementById("maxValue");
// Inputs de precisão
const minInput = document.getElementById("minInput");
const maxInput = document.getElementById("maxInput"); 

const checkboxes = document.querySelectorAll(".filtro input[type='checkbox']");
const produtos = document.querySelectorAll(".produto");

// Função auxiliar para formatar números com separador de milhar (ex: 1000 -> 1.000)
function number_format(number) {
    return new Intl.NumberFormat('pt-BR').format(number);
}

function updatePrice() {
  // Lê os valores dos sliders (a fonte primária do filtro)
  const minSliderValue = parseInt(minPrice.value);
  const maxSliderValue = parseInt(maxPrice.value);

  // 1. GARANTE VALORES CONSISTENTES ENTRE SLIDERS
  if (minSliderValue > maxSliderValue) {
    minPrice.value = maxSliderValue;
  }
  if (maxSliderValue < minSliderValue) {
    maxPrice.value = minSliderValue;
  }
  
  // 2. SINCRONIZA SLIDERS COM INPUTS DE TEXTO
  // Atualiza os inputs de texto com os valores corrigidos dos sliders
  minInput.value = minPrice.value;
  maxInput.value = maxPrice.value;
  
  // 3. ATUALIZA TEXTO DE EXIBIÇÃO (abaixo dos sliders)
  minValue.textContent = number_format(minPrice.value);
  maxValue.textContent = number_format(maxPrice.value);

  filterProducts();
}

function filterProducts() {
  // O filtro usa o valor atual do slider (que é sincronizado pelo updatePrice)
  const min = parseInt(minPrice.value); 
  const max = parseInt(maxPrice.value);

  // CORREÇÃO: Seleciona todos os checkboxes marcados na caixa de Condição (segundo filtro-box)
  const selectedCondicoes = Array.from(
    document.querySelectorAll('.filtro-box:nth-of-type(2) input[type="checkbox"]:checked')
  ).map(c => c.value);

  // CORREÇÃO: Seleciona todos os checkboxes marcados na caixa de Categoria (terceiro filtro-box)
  const selectedCategorias = Array.from(
    document.querySelectorAll('.filtro-box:nth-of-type(3) input[type="checkbox"]:checked')
  ).map(c => c.value);

  produtos.forEach(produto => {
    const preco = parseInt(produto.dataset.price);
    const condicao = produto.dataset.condicao;
    const categoria = produto.dataset.categoria;

    let show = true;

    // 1. Filtro de Preço
    if (preco < min || preco > max) {
      show = false;
    }

    // 2. Filtro de Condição
    // Se alguma condição foi marcada E a condição do produto não está na lista selecionada, esconde.
    if (selectedCondicoes.length > 0 && !selectedCondicoes.includes(condicao)) {
      show = false;
    }

    // 3. Filtro de Categoria
    // Se alguma categoria foi marcada E a categoria do produto não está na lista selecionada, esconde.
    if (selectedCategorias.length > 0 && !selectedCategorias.includes(categoria)) {
      show = false;
    }

    // O display é block para manter o layout flexbox
    produto.style.display = show ? "block" : "none"; 
  });
}

// --- EVENTOS DE ESCUTA ---

// 1. Escuta dos Sliders (evento "input" para feedback em tempo real)
minPrice.addEventListener("input", updatePrice);
maxPrice.addEventListener("input", updatePrice);

// 2. Escuta dos Inputs de Precisão (evento "change" quando o valor é confirmado)
minInput.addEventListener("change", function() {
    // Quando o input muda, atualiza o slider e dispara updatePrice
    minPrice.value = minInput.value;
    updatePrice();
});

maxInput.addEventListener("change", function() {
    // Quando o input muda, atualiza o slider e dispara updatePrice
    maxPrice.value = maxInput.value;
    updatePrice();
});

// 3. Eventos dos Checkboxes - Agora eles também chamam o filterProducts
checkboxes.forEach(cb => cb.addEventListener("change", filterProducts));

// Inicializa o filtro e a exibição de preços
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
    li.textContent = `${item.nome} - R$ ${number_format(item.preco)},00`; // Formata preço do carrinho
    carrinhoItens.appendChild(li);
  });

  carrinhoTotal.textContent = number_format(total) + ",00"; // Formata total do carrinho
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