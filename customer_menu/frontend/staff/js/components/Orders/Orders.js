export class Orders extends HTMLElement{
    constructor(){
        super();

        this.orders = [];
        console.log('constructed');
        this.shown = false;
    }

    get shown(){return this.getAttribute('shown');}
    set shown(val){this.setAttribute('shown',val);}
    get tableId(){return this.getAttribute('table-id');}
    set tableId(val){this.setAttribute('table-id',val);}

    static get observedAttributes(){
        return ['shown'];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        console.log(oldVal);
        console.log(newVal);
    }

    async connectedCallback(){
        await this.populateOrders();
        
        setInterval(async () => {
            await this.populateOrders();
            console.log('timeout');
        }, 10000);
    }

    async populateOrders(){
        await fetch(`../../backend/api/Orders.php?get_orders_by_table_id&&id=${this.tableId}`)
            .then(res=>res.json())
            .then(res=>{
                this.orders = res;
                this.render();
                this.addClickListeners();
            })
            .catch(err=>console.error(err));
            
    }

    addClickListeners(){
        this.querySelector(`#show-${this.tableId}`).addEventListener('click', ()=>{
            this.shown = true;
            console.log(this.shown);
        })
    }

    render(){
    let placeholder = `
        <div class="row border-top border-dark pt-2">
            <div class="col-2">
                <h2>
                    Table ${this.tableId}
                </h2>
            </div>
            <div class="col-2">
                <div class='dropdown'>
                    <button id="show-${this.tableId}" class='border btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='#table-${this.tableId}-orders' aria-expanded='false' aria-controls='extra-content-${this.dishId}'>
                        Description
                    </button>
                </div>
            </div>
            <div class="col-2">
                <label for="complete-order">Completed order </label>
                <input name="complete-order" type="checkbox"/>
            </div>    
            <div class="col-6">
                <button class="float-end btn btn-danger">
                    Remove
                </button>
            </div>
            <div id="table-${this.tableId}-orders" class='container collapse ${this.shown?"show":""} col-12'>
                        
                <div class='row card-body'>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" >
                                    Dish title
                                </th>
                                <th scope="col">
                                    Option
                                </th>
                                <th scope="col">
                                    Amount
                                </th>
                                <th scope="col">
                                    Completed
                                </th>
                            </tr>
                        </thead>
                        <tbody>`;

        this.orders.forEach(order=>{
            placeholder += `
                            <tr>
                                <td scope='row'>
                                    ${order.dishName}
                                </td>
                                <td>
                                    ${order.optionName}
                                </td>
                                <td>
                                    ${order.amount}
                                </td>
                                <td>
                                    <input id="checkbox-${order.orderID}" type='checkbox' ${order.completed==1?"checked":""} />
                                </td>
                            </tr>
            `;
        });
        placeholder+=`
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        `;    
        this.innerHTML = placeholder;
    }
}