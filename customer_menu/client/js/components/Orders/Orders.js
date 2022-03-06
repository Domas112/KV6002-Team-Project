export class Orders extends HTMLElement{
    constructor(){
        super();
        this.orders = [];
    }

    static get observedAttributes(){
        return [];
    }

    attributeChangedCallback(){
        console.log('updated');
        this.render();
        this.querySelector('#open-orders').addEventListener('click', ()=>{
            this.getOrders();
        });
    }

    connectedCallback(){
        this.render();
        this.querySelector('#open-orders').addEventListener('click', ()=>{
            this.getOrders();
        });
    }

    getOrders(){
        const dishes = document.querySelectorAll('dish-component');
        console.log(dishes);

        dishes.forEach(element=>{
            console.log(element);
            if(element.getAttribute('ordered') == 'true'){
                let id = element.getAttribute('id');
                let title = element.getAttribute('title');
                let price = element.getAttribute('price');
                let amount = element.getAttribute('amount');
                //TODO MAKE SURE THERE ARE NO DUPLICATES. 
                //EITHER BY MAKING THIS INTO OBJECTS OR SOMEHOW CHECKING FOR DUPES 
                this.orders.push({
                    id: id, 
                    title : title,
                    price : price,
                    amount : amount
                });
                console.log(this.orders);
            }
        })

        this.render();
    }

    render(){
        console.log(this.orders.length);
        if(this.orders.length == 0){
            this.innerHTML = `
                <button id='open-orders'>
                    Open orders
                </button>
            `;
        }else{
            let placeholder = `
                            <button id='open-orders'>
                                Open orders
                            </button>
                            <div class="container">
                        `;
            this.orders.forEach(order=>{
                console.log(order);
                placeholder += `                    
                        <div class='row'>
                            <div class='col'>
                                ${order.title}
                            </div>
                            <div class='col'>
                                ${order.price}
                            </div>
                            <div class='col'>
                                ${order.amount}
                            </div>
                        </div>`;
            })
            placeholder += `</div>`;

            this.innerHTML = placeholder;
        }

        this.querySelector('#open-orders').addEventListener('click', ()=>{
            this.getOrders();
        });
    }
}