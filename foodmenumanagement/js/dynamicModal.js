/**
 * dynamicModal.js
 * A script used to handle the modal dynamically
 *
 * @author Teck Xun Tan W20003691
 */
let deleteConfirmationMsg = "#delete-confirmation-message";
let deleteHiddenID = "#delete-hiddenID";
let deleteHiddenName = "#delete-hiddenName";
let availabilityConfirmationMsg = "#availability-confirmation-message";
let availabilityHiddenID = "#availability-hiddenID";
let availabilityHiddenName = "#availability-hiddenName";

$('#addModal').on('hidden.bs.modal', function(){
    //Reset and remove all the created new option when the Add modal is closed
    $('#addModal form')[0].reset();
    $('.add-newOption').remove();
})

$('#editModal').on('hidden.bs.modal', function(){
    //Reset and remove all the retrieve option when the Edit modal is closed
    $('#editModal form')[0].reset();
    $('#edit-description').text(null);
    $("input[id='deletedOption']").val("");
    deletedOption = [];
    $('.edit-newOption').remove();
})

/**
 * deleteModal
 * The function is used to setting the message of the delete modal when the delete button has been clicked on
 */
function deleteModal(deleteBtn){
    //Retrieving the id and name from the button element
    const id = deleteBtn.id;
    const name = deleteBtn.name;

    //Setting the hidden ID, name and confirmation message
    $(deleteHiddenID).val(id);
    $(deleteHiddenName).val(name);
    $(deleteConfirmationMsg).html("<p>Are you sure you want to delete dish: "+name+"?</p>");
}

/**
 * availableModal
 * The function is used to setting the message of the availability modal when the change availability button has been
 * clicked on
 */
function availableModal(availabilityBtn){
    //Retrieving the id and name from the button element
    const id = availabilityBtn.id;
    const name = availabilityBtn.name;

    //Setting the hidden ID, name and confirmation message
    $(availabilityHiddenID).val(id);
    $(availabilityHiddenName).val(name);
    $(availabilityConfirmationMsg).html("<p>Are you sure you want to change the availability for dish: "+name+"?</p>");
}