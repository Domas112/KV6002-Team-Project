export class Checkout extends HTMLElement{
    constructor(){
        super();
        this.orders = {};
        this.finalSum = 0;
    }

    get modalId(){return this.getAttribute('modal-id');}
    set modalId(val){this.setAttribute('modal-id',val);}

    static get observedAttributes(){
        return [];
    }

    attributeChangedCallback(){
        console.log('updated');
        this.render();
        document.querySelector('#open-checkout').addEventListener('click', ()=>{
            console.log('this is after changed callback');
            this.updateOrderedList();
        });
    }

    connectedCallback(){
        this.render();
        const btn = document.querySelector('#open-checkout');
        btn.addEventListener('click', (e)=>{
            console.log('this is after connected');
            this.updateOrderedList();
        });
    }

    updateOrderedList(){
        const dishes = document.querySelectorAll('dish-component');
        dishes.forEach(element=>{
            
            if(element.getAttribute('ordered') == 'true'){
                let id = element.getAttribute('id');
                let title = element.getAttribute('title');
                let price = element.getAttribute('price');
                let amount = element.getAttribute('amount');
                this.orders[id] = {
                    id: id, 
                    title : title,
                    price : price,
                    amount : amount
                };
            }else{
                let id = element.getAttribute('id');
                delete this.orders[id];
            }
            
        })
        this.render();
    }

    render(){
if(Object.keys(this.orders).length === 0){
            this.innerHTML = `
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                    <h2>You haven't ordered anything yet</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
            `;
        }else{
            let placeholder = `
                <div class="modal-content">
                    <div class='modal-header'>
                        <h2>Your order</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">  
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th scole='col'>
                                        Title
                                    </th>
                                    <th scole='col'>
                                        Price(£)
                                    </th>
                                    <th scole='col'>
                                        Amount ordered
                                    </th>
                                    <th scole='col'>
                                        Total cost
                                    </th>
                                </tr>
                            </thead
                            <tbody>
                        `
                        
                        for (const orderId in this.orders) {
                            this.finalSum += this.orders[orderId].price * this.orders[orderId].amount;
                            placeholder += `
                            <tr>
                                <th scope='row'>
                                    ${this.orders[orderId].title}
                                </th>
                                <td>
                                    ${this.orders[orderId].price}
                                </td>
                                <td>
                                    ${this.orders[orderId].amount}
                                </td>
                                <td>
                                    ${this.orders[orderId].amount*this.orders[orderId].price}
                                </td>
                            </tr>
                    `; 
                }

            placeholder += `</tbody> 
                            
                          </table>
                        </div>
                        <div class='px-5'>
                            <p class='text-right'>The final cost is ${this.finalSum}</p>
                        </div>
                        <button type="button" class="btn btn-warning" id='order-button'>Order</button>
                        
                </div>
          `
          this.innerHTML = placeholder;
        }
    }
}

