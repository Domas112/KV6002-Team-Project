export class OrdersComponent extends HTMLElement{
    constructor(){
        super();

        this.orders = [
            {
                dishName: "test dish 1",
                dishOption: "Regular",
                dishPrice : 5.99,
            },
            {
                dishName: "test dish 2",
                dishOption: "Regular",
                dishPrice : 5.99,
            }
        ];

    }

    attributeChangedCallback(){

    }

    connectedCallback(){
        this.render();
    }

    render(){
        let placeholder = `
            <div class="row border-top border-dark pt-2">
                <div class="col-2">
                    <h2>
                        Table #20
                    </h2>
                </div>
                <div class="col-2">
                    <div class='dropdown'>
                        <button class='border btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='.table-orders' aria-expanded='false' aria-controls='extra-content-${this.dishId}'>
                            Description
                        </button>
                    </div>
                </div>
                <div class="col-2">
                    <label for="complete-order">Completed order </label>
                    <input name="complete-order" type="checkbox"/>
                </div>    
                <div class="col-6">
                    <button class="float-end btn btn-danger">
                        Remove
                    </button>
                </div>
                <div class='container collapse col-12 table-orders'>
                            
                <div class='row card-body'>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" >
                                    Dish title
                                </th>
                                <th scope="col">
                                    Option
                                </th>
                                <th scope="col">
                                    Completed
                                </th>
                            </tr>
                        </thead>
                        <tbody>`;

        this.orders.forEach(order=>{
            placeholder+=`
                <tr>
                    <td scope='row'>
                        ${order.dishName}
                    </td>
                    <td>
                        ${order.dishOption}
                    </td>
                    <td>
                        <input type='checkbox' />
                    </td>
                </tr>
            `;
        })
        

        placeholder+=`
                        </tbody>
                    </table>
                </div>
                
                </div>
        </div>
        `;

        this.innerHTML = placeholder;
    }
}