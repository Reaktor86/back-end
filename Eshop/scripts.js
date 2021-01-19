let button = document.querySelectorAll('button.delete');
button.forEach(function (item){
    item.addEventListener('click',function (e){
        let productId = this.dataset.id ;
        let params = {
            'id':productId,
            'method': "delete"
        };
        let response =fetch('/handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(params)
        });
    });
});