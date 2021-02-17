/*window.onload = function () {

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
}*/

let order = document.querySelector('.confirm-button');
if (order) {
    order.addEventListener('click', function (e) {
        //e.preventDefault();

        let params = {
            name: document.querySelector(".confirm-form input[name=name]").value,
            surname: document.querySelector(".confirm-form input[name=surname]").value,
            address: document.querySelector(".confirm-form input[name=address]").value,
            shipping_id: document.querySelector(".confirm-form select[name=shipping]").value,
            method: 'confirmOrder',
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
}

let cancelOrder = document.querySelector('.cancel-button');
cancelOrder.addEventListener('click', function () {
    window.location.href = '/Eshop/cart.php';
});

let shippingSelect = document.querySelector('.shipping');
shippingSelect.addEventListener('change', function (){

    let params = {
        shipping_id: document.querySelector(".confirm-form select[name=shipping]").value,
        method: 'getShippingCost',
    }

    let response = fetch('/Eshop/handle.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(params)
    })
        .then((data) => {
            return data.json();
        })
        .then((res) => {
            console.log(res)
            document.querySelector('.total-data').innerHTML = res.totalPrice + +res.cost;
        });
});