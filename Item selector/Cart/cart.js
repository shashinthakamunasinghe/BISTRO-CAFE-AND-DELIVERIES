document.addEventListener("DOMContentLoaded", () => {
  let orders = JSON.parse(localStorage.getItem('cartItems')) || [];

  function formatCurrency(number) {
    return number.toLocaleString("en-US", {
      style: "currency",
      currency: "LKR"
    });
  }

  function updateCart() {
    const cartItemsContainer = document.getElementById("cart-items");
    cartItemsContainer.innerHTML = "";

    orders.forEach((item, index) => {
      const itemHtml = `
        <div class="store-item ${index + 1 < orders.length ? "bottom-line" : ""}">
          <div class="row">
            <div class="col-lg-3">
              <img class="image-store" src="${item.image}" alt="${item.name}">
            </div>
            <div class="col-lg-9">
              <div class="mt-3 mt-lg-0 d-flex align-items-center justify-content-between">
                <h5>${item.name}</h5>
                <div class="btn-quantity-container d-flex align-items-center justify-content-center" style="gap: .5rem;">
                  <button class="btn-quantity" onclick="changeQuantity('${item.id}', -1)">−</button>
                  <span class="p-quantity">${item.quantity || 1}</span>
                  <button class="btn-quantity" onclick="changeQuantity('${item.id}', 1)">+</button>
                </div>
              </div>
              <div class="list-store d-flex align-items-center justify-content-between">
                <p>${item.id}</p>
              </div>
              <div class="list-store d-flex align-items-center justify-content-between">
                <div class="d-flex">
                  <h6>${formatCurrency(parseFloat(item.price.slice(1)))}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      cartItemsContainer.insertAdjacentHTML("beforeend", itemHtml);
    });

    document.getElementById("item-count").textContent = orders.length;
    updateAmountStore();
  }

  function updateAmountStore() {
    const amountStoreContainer = document.getElementById("amount-store");
    const totalOrder = orders.reduce((total, item) => total + (item.quantity || 1) * parseFloat(item.price.slice(1)), 0);
    const amountStoreHtml = `
      <div class="store-item mt-2">
        <div class="row">
          <div class="col">
            <div class="list-store d-flex align-items-center justify-content-between">
              <p>Temporary amount</p>
              <p>${formatCurrency(totalOrder)}</p>
            </div>
            <div class="list-store d-flex align-items-center justify-content-between">
              <p>Delivery</p>
              <p>Free</p>
            </div>
            <div class="bottom-line"></div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-6">
            <p class="p-total-label">The total amount of (Including VAT)</p>
          </div>
          <div class="col-6">
            <p class="p-total">${formatCurrency(totalOrder)}</p>
          </div>
        </div>
        <div class="row mt-1">
          <div class="col">
            <a href="payement/paymentplace.html"><button class="btn btn-primary w-100">Go To Checkout</button></a>
          </div>
        </div>
      </div>
    `;
    amountStoreContainer.innerHTML = amountStoreHtml;
  }

  window.changeQuantity = (id, delta) => {
    const orderIndex = orders.findIndex((order) => order.id === id);
    if (orderIndex >= 0) {
      orders[orderIndex].quantity = (orders[orderIndex].quantity || 1) + delta;
      if (orders[orderIndex].quantity <= 0) {
        orders.splice(orderIndex, 1);
      }
    } else if (delta > 0) {
      const item = dataStore.find((item) => item.id === id);
      orders.push({ ...item, quantity: delta });
    }
    localStorage.setItem('cartItems', JSON.stringify(orders));
    updateCart();
  };

  window.removeItem = (id) => {
    const orderIndex = orders.findIndex((order) => order.id === id);
    if (orderIndex >= 0) {
      orders.splice(orderIndex, 1);
    }
    localStorage.setItem('cartItems', JSON.stringify(orders));
    updateCart();
  };

  updateCart();
});