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
        //when the element is loaded, the orders should be fetched from the server once
        this.populateOrders();

        //set an interval for automatic order retrieval and 
        let interval = setInterval(() => {
            this.populateOrders();
        }, 10000);
        this.runningIntervals.push(interval);
    }

    //the function loads all orders and rerenders the view
    populateOrders() {
        fetch(`../../backend/api/Orders.php?get_orders_by_table_id&&id=${this.tableId}`)
            .then((res) => res.json())
            .then((res) => {
                for(let i = 0; i < res.length; i++){
                    if(res[i].viewed == 0){
                        this.controlsComponent.setAttribute('new-order', 'true');
                        break;
                    }
                }
                this.orders = res;
                this.parentElement.parentElement.setAttribute('orders-count', this.orders.length);
                this.render();
                this.addEventListeners();
            })
            .catch((err) => console.error(err));
    }

    //the function adds all the required event listeners 
    addEventListeners(){
        this.orders.forEach((order) => {
            //add an event listener to manual payment checkboxes  
            this.querySelector(`#paid-${order.orderID}`).addEventListener('change', (e)=>{
                //if the checkbox is clicked on, the order should be marked paid for 
                fetch(`../../backend/api/Orders.php?order_paid&&id=${order.orderID}`)
                    .catch(err=>console.error(err));
                
                //if the checkbox is clicked on, the order should be marked paid for 
                let orderID = e.target.getAttribute('id').split("-")[1];

                //find the order which was paid for ad change it's 'paid' value to 1
                //so the changes would be reflected in real time, instead of waiting for the automatic refresh
                this.orders.forEach(order=>{
                    if(order.orderID == orderID){
                        order.paid = 1;
                    }
                })

                //rerender the view with the new values
                this.render();
                this.addEventListeners();
            });

            //an event handler for when the order has to be canceled
            this.querySelector(`#cancel-${order.orderID}`).addEventListener('click', ()=>{
                //if the button is clicked, the server is notified it has to delete the order
                fetch(`../../backend/api/Orders.php?delete_order&&id=${order.orderID}`)
                    .then(res=>{
                        //the orders should be repopulated and the view has to be rerendered
                        this.populateOrders();
                    })
                    .catch(err=>console.error(err));

            });
        })

        //an event handler for when the order is viewed by the staff
        document.querySelector(`#show-${this.tableId}`).addEventListener('click', ()=>{
            setTimeout(()=>{
                for(const i in this.orders){
                    this.orders[i].viewed = 1;
                }
                //mark the order as viewed
                fetch(`../../backend/api/Orders.php?view_order&&id=${this.tableId}`)
                    .then(res=>{
                        //re-render the view to reflect the changes
                        this.render();
                        this.addEventListeners();
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
                                    Time
                                </th>
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
                                    ${order.time.split(" ")[1]}
                                </td>
                                <td>
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