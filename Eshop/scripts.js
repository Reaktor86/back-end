let button = document.querySelectorAll('button.delete');
button.forEach(function (item){
    item.addEventListener('click',function (e){
        let productId = this.dataset.id ;
        let params = {
            'id':productId,
            'method': "delete"
        };
        let response =fetch('/Eshop/handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(params)
        });
    });
});
let updatesButtons = document.querySelectorAll('button.update');
updatesButtons.forEach(function (item) {
    item.addEventListener('click',function () {
        let popupButton = document.querySelector('.popup');
        popupButton.style.display = 'block';
        let productId = this.dataset.id ;
        let params = {
            'id':productId,
            'method': "getProduct"
        };

        let response =fetch('/Eshop/handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(params)
        }).then((response) => {
            return response.json();
        })
        .then((data) => {
            let form = document.querySelector(".popup__form");
            form.querySelector("input[name=id]").value = data[0].id;
            form.querySelector("input[name=Name]").value = data[0].name;
            form.querySelector("input[name=Price]").value = data[0].price;
            form.querySelector("input[name=Active]").value = data[0].active;
            form.querySelector("input[name=Description]").value = data[0].description;
        });

    });
});

let formButton = document.querySelector(".popup__form");
formButton.addEventListener("submit", function (e){
    e.preventDefault();
    let popupButton = document.querySelector('.popup');
    popupButton.style.display = 'none';
    let temp = {
        method: 'update',
        id: this.querySelector("input[name=id]").value,
        name: this.querySelector("input[name=Name]").value,
        price: this.querySelector("input[name=Price]").value,
        active: this.querySelector("input[name=Active]").value,
        description: this.querySelector("input[name=Description]").value,
    };
    let response =fetch('/Eshop/handle.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(temp)
    }).then((response) => {
        return response.json();
    })
        .then((data) => {
            if ('error' in data) {
                console.log('ERROR')
                document.querySelector('.error').innerHTML = data.error;
            }
        });
});

let addButton = document.querySelector(".form-add");
addButton.addEventListener("submit", function (e){
    e.preventDefault();

    let addInfo = {
        method: 'add',
        name: this.querySelector("input[name=Name]").value,
        price: this.querySelector("input[name=Price]").value,
        active: this.querySelector("input[name=Active]").value,
        description: this.querySelector("input[name=Description]").value,
    }

    let file = this.querySelector("input[name=img_path]").files[0];
    let data = new FormData();
    data.append('file_img', file);

    //console.log(data)

    for (let item in addInfo) {
        data.append(item, addInfo[item]);
        //console.log(item);
    }

    //console.log(data)
    let response = fetch('/Eshop/handle.php', {
        method: 'POST',
        headers: {
            //'Content-Type': 'application/json;charset=utf-8'
        },
        body: data
    })
});