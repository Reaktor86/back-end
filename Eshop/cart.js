let deleteButtons = document.querySelectorAll('.delete-record');
deleteButtons.forEach(function (elemButton) {
    elemButton.addEventListener('click', function (e) {
        let parentTr = this.closest('tr');
        let recordId = parentTr.dataset.recordid;
        console.log(recordId);
        let params = {
            id: recordId,
            method: 'deleteCartProduct'
        };
        let response = fetch('/Eshop/handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(params)
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data)
                document.querySelector('.total-data').innerHTML = data.totalPrice;
                parentTr.remove();
            });

    });
});

let minusButtons = document.querySelectorAll('.minus-quantity');
minusButtons.forEach(function (elemButton) {
    elemButton.addEventListener('click', function (e) {
        let parentTr = this.closest('tr');
        let recordId = parentTr.dataset.recordid;
        console.log(recordId);
        let params = {
            id: recordId,
            method: 'minusQuantityCartProduct'
        };
        let response = fetch('/Eshop/handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(params)
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data)
                parentTr.querySelector('.quantity-num').innerHTML = data.quantity;
                document.querySelector('.total-data').innerHTML = data.totalPrice;
            });

    });
});

let plusButtons = document.querySelectorAll('.plus-quantity');
plusButtons.forEach(function (elemButton) {
    elemButton.addEventListener('click', function (e) {
        let parentTr = this.closest('tr');
        let recordId = parentTr.dataset.recordid;
        console.log(recordId);
        let params = {
            id: recordId,
            method: 'plusQuantityCartProduct'
        };
        let response = fetch('/Eshop/handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(params)
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data)
                parentTr.querySelector('.quantity-num').innerHTML = data.quantity;
                document.querySelector('.total-data').innerHTML = data.totalPrice;
            });

    });
});

let orderState = 0;
let confirmOrder = document.querySelector('.confirm-order');
confirmOrder.addEventListener('click', function () {
    if (orderState == 0) {
        document.querySelector('.confirm-block').style.display = 'block';
        this.innerHTML = 'Отменить оформление';
        orderState = 1;

        // заполняем параметры доставки, если они есть
        let params = {
            method: 'getOrderParams'
        };
        let response = fetch('/Eshop/handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(params)
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data)
                if (data.name) {
                    document.querySelector(".confirm-form input[name=name]").value = data.name;
                    document.querySelector(".confirm-form input[name=surname]").value = data.surname;
                    document.querySelector(".confirm-form input[name=address]").value = data.address;
                }
            });

    } else {
        document.querySelector('.confirm-block').style.display = 'none';
        this.innerHTML = 'Оформить заказ';
        orderState = 0;
    }
});

let order = document.querySelector('.confirm-button');
order.addEventListener('click', function (e) {
    //e.preventDefault();

    let method = 'confirmOrder';
    if (document.querySelector(".confirm-form input[name=save]").checked) {
        method = 'confirmOrderSaveParams';
    }

    let params = {
        name: document.querySelector(".confirm-form input[name=name]").value,
        surname: document.querySelector(".confirm-form input[name=surname]").value,
        address: document.querySelector(".confirm-form input[name=address]").value,
        method: method,
    }
    console.log(params);
    let response = fetch('/Eshop/handle.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(params)
    })
        .then((data) => {
            console.log(data)

        });
});
