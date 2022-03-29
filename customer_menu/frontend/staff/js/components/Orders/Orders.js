export class Orders extends HTMLElement {
    constructor() {
        super();

        this.orders = [];
    }

    get show() {
        return this.getAttribute("show");
    }
    set show(val) {
        this.setAttribute("show", val);
    }
    get tableId() {
        return this.getAttribute("table-id");
    }
    set tableId(val) {
        this.setAttribute("table-id", val);
    }

    get index() {
        return this.getAttribute("index");
    }

    static get observedAttributes() {
        return [];
    }

    attributeChangedCallback(prop, oldVal, newVal) { }

    async connectedCallback() {
        await this.populateOrders();

        setInterval(async () => {
            await this.populateOrders();
        }, 10000);
    }

    async populateOrders() {
        await fetch(
            `../../backend/api/Orders.php?get_orders_by_table_id&&id=${this.tableId}`
            )
            .then((res) => res.json())
            .then((res) => {
                console.log('populate called');

                this.orders = res;
                this.render();
                this.addClickListeners();
            })
            .catch((err) => console.error(err));
    }

    addClickListeners() {
        this.querySelector(`#show-${this.tableId}`).addEventListener("click", () => {
                this.parentElement.setAttribute("show-table", this.index);
            }
        );

        this.querySelector(`#delete-${this.tableId}-btn`).addEventListener('click', async ()=>{
            fetch(`../../backend/api/Orders.php?delete_table&&id=${this.tableId}`)
                .then(async _=>{
                    console.log('delete called');
                    await this.populateOrders();
                })
                .catch(err=>console.error(err));

        });

        this.orders.forEach((order) => {
            this.querySelector(`#checkbox-${order.orderID}`).addEventListener('change', async ()=>{
                await fetch(`../../backend/api/Orders.php?complete_order&&id=${order.orderID}`)
                    .catch(err=>console.error(err));
            })
        })
    }

    render() {
        let placeholder = `
        <div class="row border-top border-dark pt-2">
            <div class="col-2">
                <h2>
                    Table ${this.tableId}
                </h2>
            </div>
            <div class="col-2">
                <div class='dropdown'>
                    <button id="show-${this.tableId}" 
                        class='border btn btn-primary' type='button'
                        data-bs-toggle='collapse' data-bs-target='#table-${this.tableId}-orders'
                        aria-expanded='false' aria-controls='extra-content-${this.dishId}'>

                        Show Orders
                    </button>
                </div>
            </div>
           <!--- <div class="col-2">
                <label for="complete-order">Completed order </label>
                <input disabled name="complete-order" type="checkbox"/>
            </div> --->    
            <div class="col-6">
                <button id="delete-${this.tableId}-btn" class="float-end btn btn-danger">
                    Remove
                </button>
            </div>
            <div id="table-${this.tableId}-orders" class='container collapse ${this.show == "undefined" ? "" : "show"
            } col-12'>
                        
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

        this.orders.forEach((order) => {
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
                                    <input id="checkbox-${order.orderID}"
                                        type='checkbox' 
                                        ${order.completed == 1 ? "checked" : ""}
                                    />
                                </td>
                            </tr>
            `;
        });
        placeholder += `
                            <tr>
                                <td scope='row'>
                                    
                                </td>
                                <td>
                                    <input type='checkbox' id="checkbox-${this.tableId}-all" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        `;
        this.innerHTML = placeholder;
    }
}
