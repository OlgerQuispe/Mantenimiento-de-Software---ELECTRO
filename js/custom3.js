let allContainerCart = document.querySelector('.tab-pane');
let containerBuyCart = document.querySelector('.cart-widget'); 
let priceTotal = document.querySelector('.price-total');
let amountProduct = document.querySelector('.qty-cart');


let buyThings = [];
let totalCard = 0;
let countProduct = 0;

//Funciones 

loadEventListeners();

function loadEventListeners(){

    allContainerCart.addEventListener('click', addProduct);
    containerBuyCart.addEventListener('click',deleteProduct);
}

function addProduct(e){
    e.preventDefault();
    if(e.target.classList.contains('add-to-cart-btn')){
        
        //console.log(e.target.closest('.product'));
        const product = e.target.closest('.product');
        readTheContent(product);
    }

}


function deleteProduct(e){

    if(e.target.classList.contains('delete-product')){
        const deleteId = e.target.getAttribute('data-id');

        buyThings.forEach(value => {
            if (value.id == deleteId) {
                let priceReduce = parseFloat(value.price) * parseFloat(value.amount);
                totalCard =  totalCard - priceReduce;
                totalCard = totalCard.toFixed(2);//Dos decimales
            }
        });
        buyThings = buyThings.filter(product => product.id != deleteId);

        countProduct--;
    }
    loadHtml();
}


function readTheContent(product){
    const infoProduct = {
        image: product.querySelector('div img').src,
        title: product.querySelector('div h3 a').textContent,
        descrip: product.querySelector('div div h5').textContent,
        price: product.querySelector('div h4').textContent.replace('$',''),
        id: product.querySelector('.add-to-cart-btn').getAttribute('data-id'),
        amount:1
    }

    totalCard = parseFloat(totalCard) + parseFloat(infoProduct.price);
    totalCard = totalCard.toFixed(2); //dos decimales

    const exist = buyThings.some(product => product.id === infoProduct.id)

    if (exist) {
        const pro = buyThings.map(product => {
            if (product.id === infoProduct.id) {
                product.amount++;
                return product;
            } else {
                return product
            }
        });
        buyThings = [...pro];
    } else {
        buyThings = [...buyThings, infoProduct]
        
        countProduct++;
    }
    loadHtml();
    //.log(infoProduct);
}

function loadHtml(){
    clearHtml();
    buyThings.forEach(product => {
        const {image,title,descrip,price,id,amount} = product;
        const row = document.createElement('div');
        row.classList.add('item');
        row.innerHTML = `
        <div class="cart-item" style="display: flex; align-items: center; padding: 10px;">
            <img src="${image}" alt="" style="width: 50%; margin-right: 10px;">
            <div class="item-content" style="display: flex; flex-direction: column;">
                <h5 style="margin: 0;">${title}</h5>
                <p style="margin: 0;">${descrip}</p>
                <h5 class="cart-price" style="margin: 5px 0;">Precio: ${price}</h5>
                <h6 style="margin: 0;">Cantidad: ${amount}</h6>
            </div>
            <button> <span class="delete-product" data-id=${id}>X</span> </button> <!-- Botón de eliminar -->
        </div>
        `;
        containerBuyCart.appendChild(row);


        priceTotal.innerHTML= totalCard;


        amountProduct.innerHTML = countProduct;
    });
}


function clearHtml(){
    containerBuyCart.innerHTML='';

}