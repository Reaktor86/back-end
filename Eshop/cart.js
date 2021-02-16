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

let confirmOrder = document.querySelector('.confirm-order');
confirmOrder.addEventListener('click', function () {
    window.location.href = '/Eshop/order.php';
});


