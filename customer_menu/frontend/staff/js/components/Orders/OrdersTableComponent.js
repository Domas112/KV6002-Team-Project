export class OrdersTableComponent extends HTMLElement{
    constructor(){
        super();
    }

    attributeChangedCallback(prop, oldVal, newVal){

    }

    connectedCallback(){
        this.render();
    }

    render(){
        this.innerHTML=`
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        Dish title
                    </th>
                    <th scope="col">
                        Option
                    </th>
                    <th scope="col">
                        Completed
                    </th>
                    <th scope="col">
                        Remove
                    </th>
                </tr>
            </thead>
            <tbody>
                <order-component></order-component>
            </tbody>
        </table>
        
        `
    }

}