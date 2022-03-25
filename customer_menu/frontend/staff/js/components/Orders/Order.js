export class Order extends HTMLElement{
    constructor(){
        super();
    }

    get dishName(){return this.getAttribute('dish-name');}
    set dishName(val){this.setAttribute('dish-name',val);}
    get optionName(){return this.getAttribute('option-name');}
    set optionName(val){this.setAttribute('option-name',val);}
    get amount(){return this.getAttribute('amount');}
    set amount(val){this.setAttribute('amount',val);}
    get completed(){return this.getAttribute('completed');}
    set completed(val){this.setAttribute('completed',val);}

    static get observedValues(){
        return ['completed']
    }

    attributeChangedCallback(){

    }

    connectedCallback(){
        this.render();
    }

    render(){
        this.innerHTML = `
            <tr>
                <td scope='row'>
                    ${this.dishName}
                </td>
                <td>
                    ${this.optionName}
                </td>
                <td>
                    ${this.amount}
                </td>
                <td>
                    <input type='checkbox' ${this.completed==1?"checked":""} />
                </td>
            </tr>
        `;
    }
}