let allContainerCart2 = document.querySelector('.tab-pane');
let containerBuyCart2 = document.querySelector('.wish-widget')
let amountProduct2 = document.querySelector('.wish-qty');

//Funciones 
let  buyThings2 = [];
let countProduct2 = 0;

loadEventListeners2();

function loadEventListeners2(){

    allContainerCart2.addEventListener('click', addProduct);
    containerBuyCart2.addEventListener('click', deleteProduct2);
}


function addProduct(e){
    e.preventDefault();
    if(e.target.classList.contains('add-to-wishlist')){
        

        //console.log(e.target.closest('.product'));
        const selectProduct2 = e.target.closest('.product');
        readTheContent2(selectProduct2)
    }
}

function deleteProduct2(e){
    if(e.target.classList.contains('wish-delete')){
        const deleteId = e.target.getAttribute('data-id');
        buyThings2 = buyThings2.filter(product => product.id != deleteId);

        
        

       countProduct2--;
    }
    loadHtml2();
}

function readTheContent2(product){

    const infoProduct2 = {
        image: product.querySelector('div img').src,
        title: product.querySelector('div h3 a').textContent,
        descrip: product.querySelector('div div h5').textContent,
        price: product.querySelector('div h4').textContent.replace('$',''),
        id: product.querySelector('.add-to-cart-btn').getAttribute('data-id'),
        amount:1
    }
    const exist =  buyThings2.some(product => product.id === infoProduct2.id);
    if(exist){
        const product = buyThings2.map(product =>  {
            if(product.id  === infoProduct2.id){
                product.amount ++;
                return product;
            } else{
                return product
            }
        });
        buyThings2 = [...product];
    }else{
        buyThings2 = [...buyThings2, infoProduct2];
        countProduct2++;
    }
    
    loadHtml2();
    //console.log(infoProduct2);
}

function loadHtml2(){
    clearHtml2();
    buyThings2.forEach(product =>  {
        const{image, title, descrip,price,  id, amount} = product;

        const row2 = document.createElement('div');
        row2.classList.add('item');
        row2.innerHTML = `
        <div class="cart-item" style="display: flex; align-items: center; padding: 10px;">
            <img src="${image}" alt="" style="width: 50%; margin-right: 10px;">
            <div class="item-content" style="display: flex; flex-direction: column;">
                <h5 style="margin: 0;">${title}</h5>
                <p style="margin: 0;">${descrip}</p>
                <h5 class="cart-price" style="margin: 5px 0;">Precio: ${price}</h5>
                <h6 style="margin: 0;">Cantidad: ${amount}</h6>
            </div>
            <button> <span class="wish-delete delete-product" data-id=${id}>X</span> </button> <!-- Botón de eliminar -->
        </div>
        `;
        containerBuyCart2.appendChild(row2);

        amountProduct2.innerHTML = countProduct2;
    });
}
function clearHtml2(){
    containerBuyCart2.innerHTML  = '';
}