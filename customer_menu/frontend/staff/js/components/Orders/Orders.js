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
        return this.getAttribute("show");
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
                for(let i = 0; i < res.length; i++){    
                    if(res[i].viewed == 0){
                        this.controlsComponent.setAttribute('new-order', 'true');
                    }
                    if(res[i].completed == 0){
                        this.tableOrdersCompleted = false;
                        this.controlsComponent.setAttribute('table-orders-completed', 0);
                    }
                }

                if(this.tableOrdersCompleted){
                    this.controlsComponent.setAttribute('table-orders-completed', 1);
                }

                this.parentElement.parentElement.setAttribute('orders-count', this.orders.length);
                this.render();
                this.addClickListeners();
            })
            .catch((err) => console.error(err));
    }

    addClickListeners(){
        this.orders.forEach((order) => {
            this.querySelector(`#checkbox-${order.orderID}`).addEventListener('change', async ()=>{
                fetch(`../../backend/api/Orders.php?complete_order&&id=${order.orderID}`)
                    .catch(err=>console.error(err));
            })
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
            <div id="table-${this.tableId}-orders-collapse" class='container collapse ${this.show == "true" ? "show" : ""} col-12'>       
                <div class='row card-body'>
                    <table class="table">
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
                            <tr class='${order.viewed==0?"new-order":""}'>
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
                                        ${order.completed == 1 ? "disabled" : ""}
                                    />
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