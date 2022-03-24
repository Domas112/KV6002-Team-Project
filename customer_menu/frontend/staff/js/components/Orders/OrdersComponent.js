export class OrdersComponent extends HTMLElement{
    constructor(){
        super();

        this.orders = [];

    }

    attributeChangedCallback(){

    }

    async connectedCallback(){
        await this.populateOrders();
        setInterval(async () => {
            await this.populateOrders();
            console.log('timeout');
        }, 10000);
        this.render();
    }

    async populateOrders(){
        this.orders = await fetch(`../../backend/api/Orders.php?get_orders`)
            .then(res=>res.json())
            .catch(err=>console.error(err));

        console.log(this.orders);
        this.render();
    }

    render(){
    let placeholder = ``;
    for(const tableId in this.orders){
        placeholder += `
            <div class="row border-top border-dark pt-2">
                <div class="col-2">
                    <h2>
                        Table ${tableId}
                    </h2>
                </div>
                <div class="col-2">
                    <div class='dropdown'>
                        <button class='border btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='#table-${tableId}-orders' aria-expanded='false' aria-controls='extra-content-${this.dishId}'>
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
                <div id="table-${tableId}-orders" class='container collapse col-12'>
                            
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
                                        Completed
                                    </th>
                                </tr>
                            </thead>
                            <tbody>`;

            this.orders[tableId].forEach(order=>{
                placeholder+=`
                                <tr>
                                    <td scope='row'>
                                        ${order.dishName}
                                    </td>
                                    <td>
                                        ${order.optionName}
                                    </td>
                                    <td>
                                        <input type='checkbox' ${order.completed==1?"checked":""} />
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
        }
        


        this.innerHTML = placeholder;
    }
}