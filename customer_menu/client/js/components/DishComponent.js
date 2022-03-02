
const template = `
        <div class='row'>
            <p class=' col-8'>
                <slot name='title'/>
            </p>
            <p class='dish-price col-2'>
                <slot name='price'/>  
            </p>

            <div class='col-2'>
                <div class='dropdown'>
                    <button class='border btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='.extra-content' aria-expanded='false' aria-controls='extra-content'>
                        Reveal more
                    </button>
                </div>
            </div>

            <div class='container collapse col-12 extra-content'>

                <div class='row card-body dish-extra-content'>

                    <div class='col'>
                        <slot name='image'/>
                    </div>

                    <div class='col dish-extra-info'>
                        <slot name='description' />                        
                    </div>
                </div>
            </div>
        </div>
`;

export class DishComponent extends HTMLElement{

    constructor(){
        super();
        this.btnText = 'Open';
    }

    get id(){return this.getAttribute('id')};
    set id(val){this.setAttribute('id',val);}
    get title(){return this.getAttribute('title');}
    set title(val){this.setAttribute('title',val);}
    get price(){return this.getAttribute('price');}
    set price(val){this.setAttribute('price',val);}
    get description(){return this.getAttribute('description');}
    set description(val){this.setAttribute('description',val);}
    get imagePath(){return this.getAttribute('image-path');}
    set imagePath(val){this.setAttribute('image-path',val);}
    get btnText(){return this.getAttribute('btn-text');}
    set btnText(val){this.setAttribute('btn-text',val);}

    static get observedAttributes(){
        return ['btn-text'];
    }

    attributeChangedCallback(prop, oldVal, newVal){

        this.render();
        if(this.btnText === 'Close'){
            this.querySelector(`#btn-${this.id}`).click();
        }
        this.addEventListeners();
    }
    connectedCallback(){
        
        this.render();
        this.addEventListeners();
    }

    addEventListeners(){
        const btn = this.querySelector(`#btn-${this.id}`);
        btn.addEventListener('click', ()=>{
            this.btnText = this.btnText === 'Open' ? 'Close' : 'Open';
        })
    }

    render(){
        
        this.innerHTML=` 
        <div id='${this.id}' class='row border border-dark'>
            <div class='col-2'>
                <dish-amount-button></dish-amount-button>
            </div>
            <h1 class='col-6'>
                ${this.title}
            </h1>
            <p class='dish-price col-2'>
                £${this.price}  
            </p>

            <div class='col-2'>
                <div class='dropdown'>
                    <button id='btn-${this.id}' class='border btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='.extra-content-${this.id}' aria-expanded='false' aria-controls='extra-content-${this.id}'>
                        ${this.btnText}
                    </button>
                </div>
            </div>

            <div class='container collapse col-12 extra-content-${this.id}'>

                <div class='row card-body'>

                    <div class='col'>
                        <img class='dish-image' src='${this.imagePath}'>
                    </div>

                    <div class='col dish-extra-info'>
                        ${this.description}                        
                    </div>
                </div>
            </div>
        </div>
        `;
    }
}
