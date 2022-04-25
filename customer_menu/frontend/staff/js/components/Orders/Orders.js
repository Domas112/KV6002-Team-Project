export class Orders extends HTMLElement {
    constructor() {
        super();
        this.orders = []
        this.runningIntervals = [];
        this.tableOrdersCompleted = true;
        this.controlsComponent = document.querySelector(`#table-${this.tableId}-controls`);
    }

    
    get tableId() {
        return this.getAttribute("table-id");
    }
    set tableId(val) {
        this.setAttribute("table-id", val);
    }
    get show() {
        return (this.getAttribute("show") === 'true');
    }
    set show(val) {
        this.setAttribute("show", val);
    }

    static get observedValues() {
        return []
    }

    attributeChangedCallback(prop, oldVal, newVal) {
        
    }

    connectedCallback(){
        this.populateOrders();
        let interval = setInterval(() => {
            this.populateOrders();
        }, 10000);
        this.runningIntervals.push(interval);
    }

    populateOrders() {
        fetch(`../../backend/api/Orders.php?get_orders_by_table_id&&id=${this.tableId}`)
            .then((res) => res.json())
            .then((res) => {
                this.orders = res;
                console.log(this.orders);
                this.parentElement.parentElement.setAttribute('orders-count', this.orders.length);
                this.render();
                this.addClickListeners();
            })
            .catch((err) => console.error(err));
    }

    addClickListeners(){
        this.orders.forEach((order) => {
            this.querySelector(`#paid-${order.orderID}`).addEventListener('change', (e)=>{
                fetch(`../../backend/api/Orders.php?order_paid&&id=${order.orderID}`)
                    .catch(err=>console.error(err));
                
                let orderID = e.target.getAttribute('id').split("-")[1];
                this.orders.forEach(order=>{
                    if(order.orderID == orderID){
                        order.paid = 1;
                    }
                })

                this.render();
                this.addClickListeners();
            });

            this.querySelector(`#cancel-${order.orderID}`).addEventListener('click', ()=>{
                fetch(`../../backend/api/Orders.php?delete_order&&id=${order.orderID}`)
                    .then(res=>{
                        this.populateOrders();
                    })
                    .catch(err=>console.error(err));

            });
        })

        document.querySelector(`#show-${this.tableId}`).addEventListener('click', ()=>{
            setTimeout(()=>{
                for(const i in this.orders){
                    this.orders[i].viewed = 1;
                }
    
                fetch(`../../backend/api/Orders.php?view_order&&id=${this.tableId}`)
                    .then(res=>{
                        this.render();
                        this.addClickListeners();
                    })
                    .catch(err=>console.error(err));
    
            }, 5000);
        });
    }

    disconnectedCallback(){
        this.clearIntervals();
    }

    clearIntervals(){
        for(let i = 0; i < this.runningIntervals.length; i++){
            clearInterval(this.runningIntervals[i]);
        }
    }

    render() {
        let placeholder = `
            <div id="table-${this.tableId}-orders-collapse" class='container collapse ${this.show ? "show" : ""} col-12'>       
                <div class='row card-body'>
                    <table class="table">
                        <thead class='custom-table-header'>
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
                                    Paid
                                </th>
                                <th scope="col">
                                    Controls
                                </th>
                            </tr>
                        </thead>
                        <tbody class='custom-table-body'>`;

        this.orders.forEach((order) => {
            placeholder += `
                            <tr class='${(order.viewed==0) && (order.completed==0) ?"new-order":""}'>
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
                                    <input id="paid-${order.orderID}"
                                        type='checkbox' 
                                        ${order.paid == '1' ? "checked" : ""}
                                        ${order.paid == '1' ? "disabled" : ""}
                                    />
                                </td>
                                <td>
                                    <button id="cancel-${order.orderID}" class='btn functionality-button'>
                                        Cancel order
                                    </button>
                                </td>
                            </tr>
                `;
        });
        placeholder += `
                        </tbody>
                    </table>
                </div>
            </div>`;

        this.innerHTML = placeholder;
    }
}