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

    attributeChangedCallback(){
        this.render();
    }

    connectedCallback(){
        this.render();
        this.populateValues();
    }
    // TODO: FIX THIS. RIGHT NOW IT STACKS THE EVENT LISTENERS, SINCE NOT ALL BUTTONS ARE RENDERED
    populateValues(){
        console.log('populate values called');
        const dishes = document.querySelectorAll('dish-component');
        console.log(dishes);
        for(let i = 1 ; i <= dishes.length; i++){
            let dcrButton = document.querySelector(`#dcrBtn-amount-btn-${i}`); 
            console.log(dcrButton);
            dcrButton.addEventListener('click', ()=>{
                console.log('test');
                this.totalItemsNumber--;
            });
            document.querySelector(`#incBtn-amount-btn-${i}`).addEventListener('click', ()=>{
                this.totalItemsNumber++;
            });
        }
    }

    render(){
        this.innerHTML = `
            <div>
                <h1>
                    This is the checkout element
                </h1>
                <p>
                    total items: ${this.totalItemsNumber}
                </p>
                <p>
                    total cost: ${this.totalCost}
                </p>
            </div>
        `;
    }
}