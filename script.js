const middle = document.querySelector(".middle-screen");
const btnCadastro = document.getElementById("btn-link-cadastro");
const btnEntrar = document.getElementById("btn-link-login");
const textoMiddle = document.getElementById("texto-middle");

const container = document.querySelector(".container");
const modal = document.querySelector(".recuperar-senha");
const btnAbrir = document.querySelector("#abrir-modal");
const btnFechar = document.querySelector(".btn-close a");

const cadastro = document.querySelector(".cadastro");
const login = document.querySelector(".login");

const formCadastro = document.querySelector(".form-cadastro");
const mensagemDiv = document.getElementById("mensagem");

function mostrarMensagem(tipo, texto) {
  const mensagemDiv = document.getElementById("mensagem");
  mensagemDiv.innerHTML = texto;
  mensagemDiv.className = "mensagem " + tipo;
  mensagemDiv.style.display = "block";

  setTimeout(() => {
    mensagemDiv.style.display = "none";
  }, 4000);

  const novaURL =
    window.location.protocol +
    "//" +
    window.location.host +
    window.location.pathname;
  window.history.replaceState({}, document.title, novaURL);
}


window.onload = function () {
  const params = new URLSearchParams(window.location.search);
  const msg = params.get("msg");

  if (msg === "sucesso") {
    mostrarMensagem("sucesso", "Cadastro realizado com sucesso!");
  } else if (msg === "erro") {
    mostrarMensagem("erro", "Erro no cadastro. Tente novamente.");
  } else if (msg === "existe") {
    mostrarMensagem("aviso", "Cadastro já existente!");
  }
};

btnCadastro.addEventListener("click", (e) => {
  e.preventDefault();
  middle.classList.remove("ir-esquerda");
  middle.classList.add("ir-direita");
  textoMiddle.textContent =
    "Crie sua conta e tenha acesso ao nosso catálogo exclusivo de produtos.";

  login.classList.add("fade-out");
  login.classList.remove("fade-in");

  setTimeout(() => {
    cadastro.classList.add("fade-in");
    cadastro.classList.remove("fade-out");
  }, 200);
});

btnEntrar.addEventListener("click", (e) => {
  e.preventDefault();
  middle.classList.remove("ir-direita");
  middle.classList.add("ir-esquerda");
  textoMiddle.textContent =
    "Entre na sua conta e descubra ofertas exclusivas para você.";

  cadastro.classList.add("fade-out");
  cadastro.classList.remove("fade-in");

  setTimeout(() => {
    login.classList.add("fade-in");
    login.classList.remove("fade-out");
  }, 200);
});

btnAbrir.addEventListener("click", (e) => {
  e.preventDefault();
  modal.classList.add("show");
  container.classList.add("dim");
});

btnFechar.addEventListener("click", (e) => {
  e.preventDefault();
  modal.classList.remove("show");
  container.classList.remove("dim");
});
