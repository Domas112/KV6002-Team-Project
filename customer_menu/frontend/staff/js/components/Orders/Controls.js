export class Controls extends HTMLElement{
    constructor(){
        super();
        this.orders = [];
        this.ordersComponent = document.querySelector(`#table-${this.tableId}-orders`);
    }
    get newOrder(){return this.getAttribute('new-order');}
    set newOrder(val){this.setAttribute('new-order',val);}

    get tableId() {
        return this.getAttribute("table-id");
    }
    set tableId(val) {
        this.setAttribute("table-id", val);
    }

    get tableOrdersCompleted(){return this.getAttribute('table-orders-completed');}
    set tableOrdersCompleted(val){this.setAttribute('table-orders-completed',val);}

    static get observedAttributes(){
        return ['new-order', 'table-orders-completed'];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        
        if(prop=='new-order'){
            this.render();
            this.addClickListeners();
        }

        if(prop=='table-orders-completed'){
            this.render();
            this.addClickListeners();
        }
    }
    
    connectedCallback(){
        this.render();
        this.addClickListeners();
    }

    addClickListeners(){
        this.querySelector(`#delete-${this.tableId}-btn`).addEventListener('click', async ()=>{
            // this.ordersComponent.setAttribute('clear-intervals', 1);
            fetch(`../../backend/api/Orders.php?delete_table&&id=${this.tableId}`)
                .then((res)=>{
                    //traveling to the tables list element;
                    this.parentElement.parentElement.parentElement.setAttribute('deleted', 'true');
                })
                .catch(err=>console.error(err));
        });
        
        this.querySelector(`#show-${this.tableId}`).addEventListener("click", () => {
            setTimeout(() => {
                this.newOrder = 'false';
            }, 5000);
            this.ordersComponent.setAttribute('show', !this.show);
            this.parentElement.parentElement.setAttribute('show', this.show);
            this.show = !this.show;
        });
    }

    render(){
        this.innerHTML = `
            <div class='row'>
                <div class="col-2">
                    <h2 class="
                        ${this.newOrder=='true'?'new-order':''}
                        ${this.tableOrdersCompleted == '1'?'table-orders-completed':''}    
                    ">
                        Table ${this.tableId} ${this.tableOrdersCompleted == '1'?'(Completed)':''}
                    </h2>
                </div>
                <div class="col-2">
                    <div class='dropdown'>
                        <button id="show-${this.tableId}" 
                            class='border btn btn-primary' type='button'
                            data-bs-toggle='collapse' data-bs-target='#table-${this.tableId}-orders-collapse'
                            aria-expanded='false' aria-controls='extra-content-${this.dishId}'>

                            Show Orders
                        </button>
                    </div>
                </div>
                
                <div class="col-6">
                    <button id="delete-${this.tableId}-btn" class="float-end btn btn-danger">
                        Remove
                    </button>
                </div>
            
            </div>
        `;
        
    }
}