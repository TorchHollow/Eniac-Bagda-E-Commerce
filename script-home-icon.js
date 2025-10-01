const cartDropdown = document.getElementById("cart-dropdown");
const favDropdown = document.getElementById("fav-dropdown");
const btnCart = document.getElementById("btn-cart");
const btnFav = document.getElementById("btn-fav");

let cartItems = [];
let favItems = [];

function renderDropdown(list, container, emptyMsg, type) {
  const ul = container.querySelector("ul");
  ul.innerHTML = "";

  if (list.length === 0) {
    container.querySelector(".empty").style.display = "block";
    container.querySelector(".total").innerText = "Total: R$ 0,00";
  } else {
    container.querySelector(".empty").style.display = "none";

    let total = 0;

    list.forEach((item, index) => {
      const li = document.createElement("li");
      li.innerHTML = `
        <img src="${item.img}" alt="">
        <div class="info">
          <span class="name">${item.name}</span>
          <span class="price">${item.price}</span>
        </div>
        <div class="actions">
          ${
            type === "favorites"
              ? `<button class="add-cart">
            <img src="../assets/shopping-cart.png" alt="Adicionar ao carrinho">
            </button>`
              : ""
          }
          <button class="remove">❌</button>
        </div>
      `;

      if (type === "cart") {
        const priceNumber = parseFloat(
          item.price.replace("R$", "").replace(",", ".")
        );
        total += priceNumber;
      }

      li.querySelector(".remove").addEventListener("click", () => {
        list.splice(index, 1);
        renderDropdown(list, container, emptyMsg, type);
      });

      if (type === "favorites") {
        li.querySelector(".add-cart").addEventListener("click", () => {
          cartItems.push(item);
          renderDropdown(
            cartItems,
            cartDropdown,
            "Seu carrinho está vazio",
            "cart"
          );
        });
      }

      ul.appendChild(li);
    });

    if (type === "cart") {
      container.querySelector(".total").innerText =
        "Total: R$ " + total.toFixed(2).replace(".", ",");
    }
  }
}

document.getElementById("checkout-btn").addEventListener("click", () => {
  window.location.href = "pagamento.html";
});

btnCart.addEventListener("click", () => {
  cartDropdown.style.display =
    cartDropdown.style.display === "block" ? "none" : "block";
  favDropdown.style.display = "none";
});

btnFav.addEventListener("click", () => {
  favDropdown.style.display =
    favDropdown.style.display === "block" ? "none" : "block";
  cartDropdown.style.display = "none";
});

document.querySelectorAll(".card-produto .img-carrinho").forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    const card = btn.closest(".card-produto");
    const name = card.querySelector(".card-info-produto h3").innerText;
    const price = card.querySelector(".preco-produto").innerText;
    const img = card.querySelector(".card-img-produto img").src;

    cartItems.push({ name, price, img });
    renderDropdown(cartItems, cartDropdown, "Seu carrinho está vazio", "cart");
  });
});

document.querySelectorAll(".card-produto .img-favorito").forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    const card = btn.closest(".card-produto");
    const name = card.querySelector(".card-info-produto h3").innerText;
    const price = card.querySelector(".preco-produto").innerText;
    const img = card.querySelector(".card-img-produto img").src;

    favItems.push({ name, price, img });
    renderDropdown(favItems, favDropdown, "Nenhum favorito ainda", "favorites");
  });
});

document
  .querySelectorAll(".card-produto-oferta .img-carrinho")
  .forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();
      const card = btn.closest(".card-produto-oferta");
      const name = card.querySelector(".card-info-oferta h3").innerText;
      const price = card.querySelector(".preco-oferta").innerText;
      const img = card.querySelector(".card-img-oferta img").src;

      cartItems.push({ name, price, img });
      renderDropdown(
        cartItems,
        cartDropdown,
        "Seu carrinho está vazio",
        "cart"
      );
    });
  });

document
  .querySelectorAll(".card-produto-oferta .img-favorito")
  .forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();
      const card = btn.closest(".card-produto-oferta");
      const name = card.querySelector(".card-info-oferta h3").innerText;
      const price = card.querySelector(".preco-oferta").innerText;
      const img = card.querySelector(".card-img-oferta img").src;

      favItems.push({ name, price, img });
      renderDropdown(
        favItems,
        favDropdown,
        "Nenhum favorito ainda",
        "favorites"
      );
    });
  });
