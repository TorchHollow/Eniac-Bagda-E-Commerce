// Lógica do CEP - Agora só executa se o elemento ".cep" existir na página
const linkCep = document.querySelector(".cep");
const boxCep = document.querySelector(".box-cep");
if (linkCep && boxCep) {
  const btnAdicionar = document.getElementById("btnAdicionar");
  const inputCep = document.getElementById("inputCep");

  linkCep.addEventListener("click", function (e) {
    e.preventDefault();
    boxCep.classList.add("active");
  });

  btnAdicionar.addEventListener("click", function (e) {
    e.preventDefault();
    let cep = inputCep.value.trim();
    const regexCep = /^\d{5}-?\d{3}$/;
    if (regexCep.test(cep)) {
      cep = cep.replace(/\D/g, "");
      cep = cep.substring(0, 5) + "-" + cep.substring(5, 8);
      linkCep.textContent = "Seu CEP: " + cep;
      boxCep.classList.remove("active");
    } else {
      alert("Digite um CEP válido no formato 00000-000");
    }
  });

  inputCep.addEventListener("input", function () {
    let cep = inputCep.value.replace(/\D/g, "");
    if (cep.length > 5) {
      cep = cep.substring(0, 5) + "-" + cep.substring(5, 8);
    }
    inputCep.value = cep;
  });
}

// Lógica do menu de Categorias (já era segura, mas mantida)
const categoriaBtn = document.querySelector(".categoria");
const dropdown = document.querySelector(".dropdown-categorias");
if (categoriaBtn && dropdown) {
  categoriaBtn.addEventListener("click", function (e) {
    e.preventDefault();
    categoriaBtn.classList.toggle("active");
    dropdown.classList.toggle("active");
  });
}

// Lógica do menu de Perfil do Usuário (já era segura, mas mantida)
document.addEventListener("DOMContentLoaded", function () {
  const profileButton = document.getElementById("profile-btn");
  const dropdownMenu = document.getElementById("dropdown-menu");

  if (!profileButton || !dropdownMenu) {
    return;
  }

  profileButton.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdownMenu.classList.toggle("show");
  });

  document.addEventListener("click", function () {
    dropdownMenu.classList.remove("show");
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") dropdownMenu.classList.remove("show");
  });
});

// Função para exibir mensagens
function mostrarMensagem(texto) {
  const container = document.getElementById("mensagens");
  if (!container) return; // Adicionado verificação de segurança

  const msg = document.createElement("div");
  msg.classList.add("mensagem");
  msg.innerText = texto;

  container.appendChild(msg);

  setTimeout(() => {
    msg.remove();
  }, 2000);
}

// Lógica do carrossel de ícones - Agora só executa se o elemento ".slide" existir
const slide = document.querySelector(".slide");
if (slide) {
  let currentIndex = 0;
  const cards = document.querySelectorAll(".card");
  let visibleCards = getVisibleCards();

  function getVisibleCards() {
    if (window.innerWidth >= 1024 && window.innerWidth <= 1440) {
      return 4;
    }
    return 5;
  }

  function showSlide(index) {
    if (cards.length > 0) {
      const cardWidth = cards[0].offsetWidth + 20;
      slide.style.transform = `translateX(${-index * cardWidth}px)`;
    }
  }

  // Anexa a função plusSlides ao objeto window para ser acessível pelo HTML
  window.plusSlides = function (n) {
    if (cards.length > 0) {
      const maxIndex = cards.length - visibleCards;
      currentIndex = Math.min(Math.max(currentIndex + n, 0), maxIndex);
      showSlide(currentIndex);
    }
  };

  window.addEventListener("resize", () => {
    visibleCards = getVisibleCards();
    currentIndex = 0;
    showSlide(currentIndex);
  });

  showSlide(currentIndex);
}

// Lógica do carrossel de produtos (com botões de navegação)
(() => {
  const slider = document.querySelector(".slider-produto");
  const track = document.querySelector(".slide-produto");
  const cards = Array.from(document.querySelectorAll(".card-produto"));
  if (!slider || !track || cards.length === 0) return;

  let stepPx = 0;
  let maxTranslate = 0;
  let current = 0;

  function measure() {
    const first = cards[0];
    const styles = getComputedStyle(first);
    const mr = parseFloat(styles.marginRight) || 0;
    const outer = first.offsetWidth + mr;

    stepPx = outer;
    const total = outer * cards.length;
    const viewport = slider.clientWidth;

    maxTranslate = Math.max(total - viewport, 0);
    current = Math.min(current, maxTranslate);
    apply();
  }

  function apply() {
    track.style.transform = `translateX(${-current}px)`;
  }

  window.plusSlidesProduto = function (n) {
    current += n * stepPx;
    if (current < 0) current = 0;
    if (current > maxTranslate) current = maxTranslate;
    apply();
  };

  window.addEventListener("resize", measure);
  window.addEventListener("load", measure);
  measure();
})();

// Lógica para mensagens ao adicionar ao carrinho/favoritos
document.querySelectorAll(".img-carrinho").forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    mostrarMensagem("Produto adicionado ao carrinho");
  });
});

document.querySelectorAll(".img-favorito").forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    mostrarMensagem("Produto adicionado aos favoritos");
  });
});