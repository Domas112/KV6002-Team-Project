export class TablesForm extends HTMLElement{
    constructor(){
        super();
    }

    attributeChangedCallback(prop, oldVal, newVal){

    }

    connectedCallback(){
        this.render();
        this.querySelector('#add-table-form').addEventListener('submit', (e)=>{
            e.preventDefault();
            console.log(e.target.seats.value);
            console.log(e.target.vip.checked);
            fetch(`../../backend/api/Tables.php?post_table`,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify({
                    seatCount: e.target.seats.value,
                    VIP: e.target.vip.checked
                })
            })
            .then(res=>{
                document.querySelector('#tables-list').setAttribute('order-added', 'true');
            })
            .catch(err=>console.error(err));
        })
    }

    render(){
        this.innerHTML = `
            <form id="add-table-form">
                <label>Seat count</label>
                <input required name="seats" type="number" min="0" step="1" />

                <label>VIP table?</label>
                <input name="vip" type='checkbox'/>
                <button class="btn functionality-button" type="submit">Add table</button>
            </form>
        `;
    }
}