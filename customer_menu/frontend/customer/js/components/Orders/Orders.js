export class Orders extends HTMLElement{
    constructor(){
        super();
        this.orders = [];
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        this.tableId = urlParams.get('tableId');
    }

    get orderChanged (){return this.getAttribute('order-changed')};
    set orderChanged (val){this.setAttribute('order-changed',val)};

    static get observedAttributes(){
        return ['order-changed']
    }

    async attributeChangedCallback(prop, oldVal, newVal){
        this.render();
    }

    async connectedCallback(){
        await this.populateOrders()
        this.render();
    }

    async populateOrders(){
        //get all orders, which were ordered by the table
        await fetch(`../../backend/api/Orders.php?get_orders_by_table_id&id=${this.tableId}`)
        .then(res=>res.json())
        .then(res=>{
            this.orders = res;
            if(Object.keys(this.orders).length != 0){
                document.querySelector('#open-orders').style.display="block";
            }
        })
        .catch(err=>console.error(err));

    }

    render(){
        let placeholder = `
        <div class="modal-content">
            <div class='modal-header'>
                <h2>Table ${this.tableId} orders</h2>
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
                    `;

                this.orders.forEach(order=> {
                    this.finalSum +=  order.optionPrice * order.amount;
                    placeholder += `
                    <tr>
                        <th scope='row'>
                            ${order.dishName} (${order.optionName})
                        </th>
                        <td>
                            ${order.optionPrice}
                        </td>
                        <td>
                            ${order.amount}
                        </td>
                        <td>
                            ${(order.optionPrice * order.amount).toFixed(2)}
                        </td>
                    </tr>
                `; 
            });

        placeholder += `
                    </tbody>
                </table>
            </div>
        </div>
        `;

        this.innerHTML = placeholder;
    }
}