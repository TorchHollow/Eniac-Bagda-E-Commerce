const minPrice = document.getElementById("minPrice");
const maxPrice = document.getElementById("maxPrice");
const minValue = document.getElementById("minValue");
const maxValue = document.getElementById("maxValue");
// Os inputs de precisão 'minInput' e 'maxInput' não existem no HTML do catalogo.php. 
// Vamos removê-los da lógica para evitar erros.
// const minInput = document.getElementById("minInput");
// const maxInput = document.getElementById("maxInput"); 

const checkboxes = document.querySelectorAll(".filtro input[type='checkbox']");

// CORREÇÃO: Mudar de ".produto" para ".produto-card"
const produtos = document.querySelectorAll(".produto-card");

// Função auxiliar para formatar números com separador de milhar (ex: 1000 -> 1.000)
function number_format(number) {
    return new Intl.NumberFormat('pt-BR').format(number);
}

function updatePrice() {
  const minSliderValue = parseInt(minPrice.value);
  const maxSliderValue = parseInt(maxPrice.value);

  // 1. GARANTE VALORES CONSISTENTES ENTRE SLIDERS
  if (minSliderValue > maxSliderValue) {
    minPrice.value = maxSliderValue;
  }
  if (maxSliderValue < minSliderValue) {
    maxPrice.value = minSliderValue;
  }
  
  // 2. ATUALIZA TEXTO DE EXIBIÇÃO (abaixo dos sliders)
  minValue.textContent = number_format(minPrice.value);
  maxValue.textContent = number_format(maxPrice.value);

  filterProducts();
}

function filterProducts() {
  const min = parseInt(minPrice.value); 
  const max = parseInt(maxPrice.value);

  // Seleciona todos os checkboxes marcados na caixa de Condição
  // CORREÇÃO: Usar :nth-of-type(3) que é a caixa de "Condição"
  const selectedCondicoes = Array.from(
    document.querySelectorAll('.filtro-box:nth-of-type(3) input[type="checkbox"]:checked')
  ).map(c => c.value);

  // Seleciona todos os checkboxes marcados na caixa de Categoria
  // CORREÇÃO: Usar :nth-of-type(4) que é a caixa de "Categoria"
  const selectedCategorias = Array.from(
    document.querySelectorAll('.filtro-box:nth-of-type(4) input[type="checkbox"]:checked')
  ).map(c => c.value);

  produtos.forEach(produto => {
    // Busca os dados do atributo, que estão no div.produto-card
    const preco = parseFloat(produto.dataset.price);
    const condicao = produto.dataset.condicao;
    const categoria = produto.dataset.categoria;

    let show = true;

    // 1. Filtro de Preço
    if (preco < min || preco > max) {
      show = false;
    }

    // 2. Filtro de Condição
    if (selectedCondicoes.length > 0 && !selectedCondicoes.includes(condicao)) {
      show = false;
    }

    // 3. Filtro de Categoria
    if (selectedCategorias.length > 0 && !selectedCategorias.includes(categoria)) {
      show = false;
    }

    // O elemento que precisamos esconder é o link pai do produto-card
    const linkElement = produto.closest('.produto-link');
    if (linkElement) {
        linkElement.style.display = show ? "block" : "none"; 
    }
  });
}

// --- EVENTOS DE ESCUTA ---

// 1. Escuta dos Sliders
minPrice.addEventListener("input", updatePrice);
maxPrice.addEventListener("input", updatePrice);

// 2. Eventos dos Checkboxes - Agora eles também chamam o filterProducts
checkboxes.forEach(cb => cb.addEventListener("change", filterProducts));

// Inicializa o filtro e a exibição de preços
updatePrice();