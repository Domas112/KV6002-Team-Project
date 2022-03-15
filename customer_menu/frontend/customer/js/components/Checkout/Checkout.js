export class Checkout extends HTMLElement{
    constructor(){
        super();
        this.orders = {};
        this.finalSum = 0;

        this.newOrderId;
        this.newOrderName;
        this.newOrderOptionName;
        this.newOrderPrice;
        this.newOrderAmount;

    }

    get newOrderId(){return this.getAttribute('new-order-id');}
    set newOrderId(val){this.setAttribute('new-order-id',val);}
    get newOrderName(){return this.getAttribute('new-order-name');}
    set newOrderName(val){this.setAttribute('new-order-name',val);}
    get newOrderOptionName(){return this.getAttribute('new-order-option-name');}
    set newOrderOptionName(val){this.setAttribute('new-order-option-name',val);}
    get newOrderPrice(){return this.getAttribute('new-order-price');}
    set newOrderPrice(val){this.setAttribute('new-order-price',val);}
    get newOrderAmount(){return this.getAttribute('new-order-amount');}
    set newOrderAmount(val){this.setAttribute('new-order-amount',val);}

    get modalId(){return this.getAttribute('modal-id');}
    set modalId(val){this.setAttribute('modal-id',val);}

    static get observedAttributes(){
        return ["new-order-id"];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        console.log('updated');
        if(prop == 'new-order-id'){
            if(this.newOrderAmount != 0){
                this.orders[this.newOrderId] = {
                dishName:this.newOrderName,
                dishPrice:this.newOrderPrice,
                dishOptionName:this.newOrderOptionName,
                dishAmount:this.newOrderAmount,
                }
            }else{
                delete this.orders[this.newOrderId];
            }
        }
        this.render();
    }

    connectedCallback(){
        this.render();
    }

    updateOrderedList(){
        this.render();
    }

    render(){
        this.finalSum = 0;
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
                                        Option
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
                        
                        for (const key in this.orders) {
                            this.finalSum +=  this.orders[key].dishPrice * this.orders[key].dishAmount;
                            placeholder += `
                            <tr>
                                <th scope='row'>
                                    ${this.orders[key].dishName}
                                </th>
                                <td>
                                    ${this.orders[key].dishOptionName}
                                </td>
                                <td>
                                    ${this.orders[key].dishPrice}
                                </td>
                                <td>
                                    ${this.orders[key].dishAmount}
                                </td>
                                <td>
                                    ${(this.orders[key].dishPrice * this.orders[key].dishAmount).toFixed(2)}
                                </td>
                            </tr>
                    `; 
                }

            placeholder += `</tbody> 
                            
                          </table>
                        </div>
                        <div class='px-5'>
                            <p class='text-right'>The final cost is ${this.finalSum.toFixed(2)}</p>
                        </div>
                        <button type="button" class="btn btn-warning" id='order-button'>Order</button>
                        
                </div>
          `
          this.innerHTML = placeholder;
        }
    }
}

