export class OrderComponent extends HTMLElement{
    constructor(){
        super();
    }

    attributeChangedCallback(){

    }

    connectedCallback(){
        this.render();
    }

    render(){
        this.innerHTML = `
            <tr>
                <td scope="row">
                    Some dish
                </td>
                <td>
                    Some option
                </td>
                <td>
                    <label for="ordered-dish-1"></label>
                    <input name="ordered-dish-1" type="checkbox" />
                </td>
            </tr>
        `;
    }
}