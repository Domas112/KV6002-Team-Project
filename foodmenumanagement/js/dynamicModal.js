let deleteConfirmationMsg = "#delete-confirmation-message";
let deleteHiddenID = "#delete-hiddenID";
let availabilityConfirmationMsg = "#availability-confirmation-message";
let availabilityHiddenID = "#availability-hiddenID";

$('#addModal').on('hidden.bs.modal', function(){
    $('#addModal form')[0].reset();
    $('.add-newOption').remove();
})

$('#editModal').on('hidden.bs.modal', function(){
    $('#editModal form')[0].reset();
    $('#edit-description').text(null);
    $("input[id='deletedOption']").val("");
    deletedOption = [];
    $('.edit-newOption').remove();
})

function deleteModal(deleteBtn){
    const id = deleteBtn.id;
    const name = deleteBtn.name;
    $(deleteHiddenID).val(id);
    $(deleteConfirmationMsg).html("<p>Are you sure you want to delete dish: "+name+"?</p>");
}

function availableModal(availabilityBtn){
    const id = availabilityBtn.id;
    const name = availabilityBtn.name;
    $(availabilityHiddenID).val(id);
    $(availabilityConfirmationMsg).html("<p>Are you sure you want to change the availability for dish: "+name+"?</p>");
}