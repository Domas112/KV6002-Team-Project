export class Checkout extends HTMLElement{
    constructor(){
        super();
        this.orders = {};
        this.finalSum = 0;

        this.newDishId;
        this.newOptionId;
        this.newOrderName;
        this.newOrderOptionName;
        this.newOrderPrice;
        this.newOrderAmount;

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        this.tableId = urlParams.get('tableId');

        //Check if the current table exists in the database. Else - redirect the user.
        fetch('../../backend/api/Tables.php?get_table_ids')
        .then(res=>res.json())
        .then(res=>{
            let tableExists = false;
            res.forEach(table=>{
                if(table.tableID==this.tableId){
                    tableExists=true;
                }
            })

            if(!tableExists){
                window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=404";
            }
        }).catch(err=>console.error(err))
    }

    get newOptionId(){return this.getAttribute('new-option-id');}
    set newOptionId(val){this.setAttribute('new-option-id',val);}
    get newOrderName(){return this.getAttribute('new-order-name');}
    set newOrderName(val){this.setAttribute('new-order-name',val);}
    get newOrderOptionName(){return this.getAttribute('new-order-option-name');}
    set newOrderOptionName(val){this.setAttribute('new-order-option-name',val);}
    get newDishId(){return this.getAttribute('new-dish-id');}
    set newDishId(val){this.setAttribute('new-dish-id',val);}
    get newOrderPrice(){return this.getAttribute('new-order-price');}
    set newOrderPrice(val){this.setAttribute('new-order-price',val);}
    get newOrderAmount(){return this.getAttribute('new-order-amount');}
    set newOrderAmount(val){this.setAttribute('new-order-amount',val);}

    get modalId(){return this.getAttribute('modal-id');}
    set modalId(val){this.setAttribute('modal-id',val);}

    static get observedAttributes(){
        return ["new-option-id"];
    }

    
    attributeChangedCallback(prop, oldVal, newVal){
        //once a new order has been added, append it to the new orders list.
        if(prop == 'new-option-id'){
            if(this.newOrderAmount != 0){
                this.orders[this.newOptionId] = {
                    dishId : this.newDishId,
                    dishOptionId : this.newOptionId,
                    dishName : this.newOrderName,
                    dishPrice : this.newOrderPrice,
                    dishOptionName : this.newOrderOptionName,
                    dishAmount : this.newOrderAmount
                }
            }else{
                delete this.orders[this.newOptionId];
            }
        }
        
        this.render();
        
        let checkoutButton = this.querySelector('#checkout-button');
        if(checkoutButton != null){
            
            //once the checkout button has been clicked,
            //send the order to the server.
            checkoutButton.addEventListener('click', ()=>{
                let parsedOrders = [];

                for (const key in this.orders) {
                    let order = {
                        tableId: this.tableId,
                        dishId : this.orders[key].dishId,
                        optionId : this.orders[key].dishOptionId,
                        amount : this.orders[key].dishAmount,
                    }
                    parsedOrders.push(order);
                }
                let body = JSON.stringify(parsedOrders);
                fetch('../../backend/api/Orders.php?post_order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: body
                })
                .then(res=>{
                    //If the orders post was successful, redirect the user to the payment page
                    if(res.status == 200){
                        window.location.href = '../../../payment/PaymentUI.php'
                    }
                })
                .catch(err=>console.error(err));
            });

        }
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
                <div class="modal-header">
                    <h2>You haven't ordered anything yet</h2>
                    <button id="modal-close-btn" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
            `;
        }else{
            let placeholder = `
                <div class="modal-content">
                    <div class='modal-header'>
                        <h2>Your order</h2>
                        <button id="modal-close-btn" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body px-2">  
                        <table class='table px-2'>
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
                                        Total cost(£)
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
                                    ${this.orders[key].dishName} (${this.orders[key].dishOptionName})
                                </th>
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
                            <p class='text-right'>The final cost is £${this.finalSum.toFixed(2)}</p>
                        </div>
                        <button type="button" class="btn btn-warning" id='checkout-button'>Order</button>
                        
                </div>
          `
          this.innerHTML = placeholder;
        }
    }
}

