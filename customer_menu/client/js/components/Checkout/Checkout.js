export class Checkout extends HTMLElement{
    constructor(){
        super();
        this.totalCost = 0;
        this.totalItemsNumber = 0;
    }

    get totalCost(){return this.getAttribute('total-cost');}
    set totalCost(val){this.setAttribute('total-cost',val);}

    get totalItemsNumber(){return this.getAttribute('total-items-number');}
    set totalItemsNumber(val){this.setAttribute('total-items-number',val);}

    static get observedAttributes(){
        return ["total-items-number", "total-cost"];
    }

    attributeChangedCallback(props, newVal, oldVal){
        this.render();
    }

    connectedCallback(){
        this.render();
    }

    render(){
        this.innerHTML = `
            <div id='checkout' class='container>
                <div class='row'>
                    <p class='col'> 
                        total items: ${this.totalItemsNumber}
                    </p>
                    <p class='col'>
                        total cost: ${this.totalCost}
                    </p>
                    <button class='col btn btn-warning'>
                        Submit order
                    </button>
                </div>
            </div>
        `;
    }
}