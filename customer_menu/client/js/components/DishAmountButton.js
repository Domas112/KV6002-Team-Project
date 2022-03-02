export class DishAmountButton extends HTMLElement{

    constructor(){
        super();
        this.amount = 0;
        this.attachShadow({mode:'open'})
    }

    get amount(){return this.getAttribute('amount');}
    set amount(val){this.setAttribute('amount',val);}
    get id(){return this.getAttribute('id');}
    set id(val){this.setAttribute('id',val);}
    get amountId(){return this.getAttribute('amountid');}
    set amountId(val){this.setAttribute('amountid',val);}

    static get observedAttributes(){
        return ["id", "amountid", "amount"];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        this.render();
        this.addEventListeners();
    }


    connectedCallback(){
        this.render();
        this.addEventListeners();
    }

    addEventListeners(){
        let increaseBtn = this.shadowRoot.querySelector(`#incBtn-${this.id}`);
        increaseBtn.addEventListener('click', ()=>{
            this.amount++;
        })

        let decreaseBtn = this.shadowRoot.querySelector(`#dcrBtn-${this.id}`);
        decreaseBtn.addEventListener('click', ()=>{
            if(this.amount > 0){
                this.amount--;
            }
        })
    }


    render(){
        this.shadowRoot.innerHTML = `
            <style>
                .row-format{
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-contents: center;

                }
                .row-format>button{
                    height:50%;
                }

                h2{
                    margin: 0 1% 0 1%;
                }
            </style>
            <div class='row-format'>
                <button id='dcrBtn-${this.id}' class='btn btn-danger'>
                -   
                </button>
                    <h2 id='${this.amountId}'>
                    ${this.amount}
                    </h2>
                <button id='incBtn-${this.id}' class='btn btn-success'>
                +
                </button>
            </div>
        `;
    }
}