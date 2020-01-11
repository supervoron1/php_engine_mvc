document.addEventListener('click', async (e) => {
  async function responseAPI(action, data) {
    let response = await fetch(`/api/${action}/`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
    return response.json();
  }

  if (e.target.classList[0] === "buy") {
    e.preventDefault();
    let id = e.target.id;
    let data = {id};
    let result = await responseAPI("buy", data);
    console.log(result);
    document.getElementById('counter').innerHTML = result['count'];
  }

  if (e.target.classList[0] === "delete") {
    e.preventDefault();
    let id = e.target.id;
    let data = {id};
    let result = await responseAPI("deleteFromBasket", data);
    document.getElementById('counter').innerHTML = result['count'];
    document.getElementById('summ').innerHTML = result['summ'];
    document.getElementById(`item_${result['id']}`).remove();
  }

  if (e.target.classList[0] === "imgItem" || e.target.classList[0] === "nameItem") {
    e.preventDefault();
    let idImg = e.target.id;
    let data = {idImg};
    let result = await responseAPI("catalogItem", data);
    const modalWindow = document.querySelector('.modalWindow');
    modalWindow.classList.add('visibility');
    modalWindow.insertAdjacentHTML('beforeend',
      `<div id="${idImg}mod"><img src="/img/${result['imgAddr']}" alt="" height="200" width="200">
                <div class="info"><p>${result['desc']}</p><p>Цена - ${result['price']}</p></div>
                <button class="buy" id="${idImg}">Купить</button><hr>
             </div>`);

    window.addEventListener('keydown', () => {
      if (event.code === "Escape")
        modalWindow.classList.remove('visibility');
      document.getElementById(`${idImg}mod`).remove();
    });
  }

  if (e.target.value === "Зарегистрироваться") {
    e.preventDefault();
    console.log(e.target.value);
    let login = document.getElementById('login').value;
    let password = document.getElementById('pass').value;
    let email = document.getElementById('email').value;
    let tel = document.getElementById('tel').value;

    let data = {
      login,
      password,
      email,
      tel
    };

    console.log(data);
    let result = await responseAPI("add_user", data);
    document.querySelector('.informMessage').innerHTML = `${result}`;
    document.querySelector('.formRegistr').remove();
  }

  if (e.target.value === "Оформить") {
    e.preventDefault();
    console.log(e.target.value);
    let login = document.getElementById('orderLogin').value;
    let tel = document.getElementById('orderTel').value;
    let addres = document.getElementById('orderAdr').value;

    let data = {
      login,
      tel,
      addres
    }

    let result = await responseAPI("order", data);

    document.querySelector('.infoMes').innerHTML = `${result}`;
    document.querySelector('.formOrder').remove();
  }

});
