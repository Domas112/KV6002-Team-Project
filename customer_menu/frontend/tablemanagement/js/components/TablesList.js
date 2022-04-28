export class TablesList extends HTMLElement{
    constructor(){
        super();
    }

    static get observedAttributes(){
        return ['order-added'];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        if(prop=='order-added'){
            this.populateTables();
        }
    }

    connectedCallback(){
        this.populateTables();
    }

    populateTables(){
        fetch(`../../backend/api/Tables.php?get_tables`)
                .then(res=>res.json())
                .then(res=>{
                    this.tables = res;
                    this.render();
                    this.addEventListeners();
                })
                .catch(err=>console.error(err));
    }

    addEventListeners(){
        this.tables.forEach(table=>{
            document.querySelector(`#delete-btn-${table.tableID}`).addEventListener('click', ()=>{
                fetch(`../../backend/api/Tables.php?delete_table&&id=${table.tableID}`)
                .then(res=>{
                    this.populateTables();
                })
                .catch(err=>console.error(err));
            })
            
            //handle the update logic
            document.querySelector(`#submit-btn-${table.tableID}`).addEventListener('click', ()=>{
                //get the values directly from inputs
                //this is done this way, as a form was not working properly inside a modal.
                let newSeatCount = document.querySelector(`#update-seatcount-${table.tableID}`).value;
                let newVipStatus = document.querySelector(`#update-vip-${table.tableID}`).checked;

                //send the new information to the server
                fetch(`../../backend/api/Tables.php?update_table`,{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8;'
                    },
                    body: JSON.stringify({
                        tableID: table.tableID,
                        seatCount: newSeatCount,
                        VIP: newVipStatus    
                    })
                })
                .then(res=>{
                    this.populateTables();
                })
                .catch(err=>console.error(err));

            })
        })
    }


    render(){
        let placeholder = `
       
            <table id='tables-table' class="table table-responsive mt-2">
                <thead class="custom-table-header">
                    <tr>
                        <th scope="col">Table ID</th>
                        <th scope="col">Seat count</th>
                        <th scope="col">VIP?</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody class="custom-table-body">
            `;
        this.tables.forEach(table=>{
            
            placeholder+=`
                        <div class="modal fade" id="update-modal-${table.tableID}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <label>Seat count</label>
                                    <input id="update-seatcount-${table.tableID}" required name="seats" type="number" min="0" step="1" value=${table.seatCount} />

                                    <label>VIP table?</label>
                                    <input id="update-vip-${table.tableID}" name="vip" type='checkbox' ${table.VIP==1?"checked":""}/>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button id="submit-btn-${table.tableID}" type="button" class="btn btn-primary"  data-bs-dismiss="modal">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <tr>
                            <td scope="row">${table.tableID}</td>
                            <td>${table.seatCount}</td>
                            <td>${table.VIP==1?"Yes":"No"}</td>
                            <td>
                                <button id='delete-btn-${table.tableID}' class='btn btn-danger'>
                                    Delete
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button id='update-btn-${table.tableID}' class='btn functionality-button' data-bs-toggle="modal" data-bs-target="#update-modal-${table.tableID}">Update</button>
                            </td>
                        </tr>
                `;
        })

        placeholder+=`        
                </tbody>
            </table>
        `;

        this.innerHTML = placeholder;
    }
}