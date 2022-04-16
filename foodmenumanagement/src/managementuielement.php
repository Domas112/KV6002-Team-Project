<?php

/**
 * managementuielement.php
 * This PHP script has been used to handle all the webpage component such as creating navigation bar, search bar
 * and more. The purpose of this class is to minimise redundant code by reusing the code to generate elements necessary
 * to the website and to keep the code consistency over the pages. The class is extended to UIElement class
 * (refer to uielement.php) to reuse the shared elements that will also be used in other sites.
 *
 * @author Teck Xun Tan W20003691
 */

class ManagementUIElement extends UIElement
{

    /**
     * generateNav
     * To generate the navigation section of the webpage.
     */
    protected function generateNavigation(){
        return <<<EOT
        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href={$this->adminPath}>Back to Admin Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={$this->viewPath}>View All Dishes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={$this->logPath}>System Log</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <button class="btn btn-sm logout">Logout</button>
                    </div>
                </div>
            </nav>
        </div>
EOT;

    }

    /**
     * generateSearchBar
     * To generate the search bar section of the webpage by combining <span> and <input>.
     */
    protected function generateSearchBar(){
        return <<<EOT
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">🔍 Search</span>
                </div>
                <input type="text" class="form-control" id='search' name='search' placeholder="Search anything here!">
            </div>
EOT;

    }

    /**
     * generateDataPageNavigator
     * To generate the data page navigator section for the datatable (E.g. Next, Previous). The function only generate
     * the <div> required to generate the buttons later using Javascript (Check retrieveDish.js and retrieveLog.js).
     */
    protected function generatePageNavigator(){
        return <<<EOT
            <div class="container-fluid" id="page-navigator">
                <div id="pageNumber"></div>
                <div class="d-flex justify-content-center" id="pagination"></div>
            </div>
EOT;
    }

    /**
     * generateDishManageForm
     * To generate the form to manage the selected dish by combining with different elements such as <input>, <textarea>
     * and <select>. Note that the category of the form is generated using a built function (Check
     * generateCategoryDropdown function)
     */
    protected function generateDishManageForm($mode){
        //Start generating the form
        $dishForm = <<<EOT
            <form class='container-fluid' name='dishForm' method='post' enctype='multipart/form-data'">
                {$this->generateDishID($mode)}
                <!--Name-->
                <div class='mb-3'>
                    <label>Name:</label>
                    <input class='form-control' type='text' name='$mode-name' id='$mode-name' required>
                </div>
                <!--Description-->
                <div class='mb-3'>
                    <label>Description:</label>
                    <textarea class='form-control' name='$mode-description' id='$mode-description' required></textarea>
                </div>
                <!--Category-->
                <div class='mb-3'>
                    <label>Category:</label>
EOT;

        //Generate the category dropdown
        $dishForm .= $this->generateCategoryDropdown($mode);

        //Continue generating the rest of the form
        $dishForm .= <<<EOT
                </div>
                <!--Image-->
                <div class='mb-3'>
                    <label>Image Path:</label>
                    <input class='form-control-file' type='file' accept='image/*' name='$mode-imgPath' id='$mode-imgPath'>
                </div>
                <hr>
                <!--Dish Option-->
                <div class='$mode-option'>
                    <input class="btn btn-lg" type='button' id='$mode-addOption' value='+ Add New Option'>
                    <hr>
                </div>
                {$this->generateHiddenInput($mode)}
                <!--Submit-->
                <div>
                    <input class="btn btn-lg" type='submit' name='$mode-submit' id='$mode-submit' value='{$this->submitTextChange($mode)}' onclick="">
                </div>
            </form>
EOT;

        //Return the generated form
        return $dishForm;
    }

    /**
     * generateConfirmation
     * To generate a confirmation message using the combination of <form> and <input> tags.
     */
    protected function generateConfirmation($confirmationFormName, $id){
        return <<<EOT
            <div id="$id-confirmation-message"></div>
            <form name="$confirmationFormName" method="post">
                <input type="hidden" name="$id-hiddenID" id="$id-hiddenID">
                <input type="hidden" name="$id-hiddenName" id="$id-hiddenName">
                <div class='d-flex justify-content-end'>
                    <input class='btn btn-sm' type="submit" name="$id-yes" id='$id-yes' value="Yes">
                    <input class='btn btn-sm' type="button" name="no" id='no' value="No" data-bs-dismiss="modal">
                </div>
            </form>
EOT;
    }

    /**
     * generateAddButton
     * To generate the add button that will be used to display the add new dish modal on click.
     */
    protected function generateAddButton(){
        return <<<EOT
            <button type='button' class='btn btn-lg' id='add-newDish' data-bs-toggle='modal' data-bs-target='#addModal'>+ Add New Dish</button>
EOT;
    }

    /**
     * generateCategoryDropdown
     * To generate the category dropdown menu that will be used in the management form for identifying and categorising
     * the food item. The function will retrieve the categories (such as Drinks, Starters, Soup and A la carte) from the
     * database and generate the category dropdown menu using the category name and ID.
     */
    protected function generateCategoryDropdown($mode){
        //Initialise the CategoryDB class
        $category = new CategoryDBHandler();

        //Retrieve the category available from database
        $result = $category->retrieveAllCategory();

        //Generate the category dropdown list for each available category
        $categoryDropdown = "<select class='form-select form-select mb-3' name='$mode-category' id='$mode-category'>";
        foreach($result as $rows){
            $categoryDropdown .= "<option value='{$rows['categoryID']}'>{$rows['categoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        //Return the generated category dropdown
        return $categoryDropdown;
    }

    /**
     * generateModalAdd
     * To generate modal and handle form on submit event for the adding new dish modal. The function also checks for
     * form on submit even where it will execute the addDish database function (refer to dishdbhandler.php) to upload
     * the dish into the database.
     */
    protected function generateModalAdd(){
        //Handle management form on submit event
        if (isset($_POST['add-submit'])) {
            //Initialise the DishDB class
            $dishDB = new DishDBHandler();

            //Create new object and set the data input
            $dish = new Dish(null, $_POST['add-name'], $_POST['add-description'], $_POST['add-category'], $this->imageToBlob("add"), null, $this->checkEmptyOption("add-optionName"), $this->checkEmptyOption("add-optionPrice"));

            //Execute upload dish function
            if($dishDB->addDish($dish)){
                //If addDish returns true, redirect back to View Dishes page
                header('Location: '.$this->viewPath);
            }else{
                //If addDish caught an error and returned false, redirect to error page
                header('Location: ' . $this->errPath);
            }
        }

        //Generate modal (Function from UIElement Class)
        return $this->generateModal("addModal","Add Dish",array(
            //Generate the management form in "add" mode
            $this->generateDishManageForm("add")
        ));
    }

    /**
     * generateModalEdit
     * To generate modal and handle form on submit event for the editing dish modal. The function also checks for form
     * on submit event where it will execute the editDish database function (refer to dishdbhandler.php) to editing
     * the dish from database.
     */
    protected function generateModalEdit(){
        //Handle management form on submit event
        if(isset($_POST['edit-submit'])){
            //Initialise the DishDB class
            $dishDB = new DishDBHandler();

            //Create new object and set the data input
            $dish = new Dish($_POST['edit-id'],$_POST['edit-name'],$_POST['edit-description'],$_POST['edit-category'],$this->imageToBlob("edit"),null,$this->checkEmptyOption("edit-optionName"), $this->checkEmptyOption("edit-optionPrice"));
            $dish->setRetrievedOption($this->checkEmptyOption("retrievedName"));
            $dish->setRetrievedPrice($this->checkEmptyOption("retrievedPrice"));
            $dish->setRetrievedID($this->checkEmptyOption("retrievedID"));

            //Execute edit dish function
            if($dishDB->editDish($dish,$this->checkEmptyOption("removedOption"))){
                //If editDish returns true, redirect back to View Dishes page
                header('Location: '.$this->viewPath);
            }else{
                //If editDish caught an error and returned false, redirect to error page
                header('Location: ' . $this->errPath);
            }
        }

        //Generate modal (Function from UIElement Class)
        return $this->generateModal("editModal","Edit Dish",array(
            //Generate the management form in "edit" mode
            $this->generateDishManageForm("edit")
        ));
    }

    /**
     * generateModalDelete
     * To generate modal and handle button on click event for the delete dish modal. The function also checks for
     * button on click event where it will execute the deleteDish using the preset hidden ID and Name to delete the
     * dish from database.
     */
    protected function generateModalDelete(){
        //Handle delete confirm button on click event
        if(isset($_POST['delete-yes'])) {
            //Initialise the DishDB class
            $dishDB = new DishDBHandler();

            //Execute delete dish function
            if ($dishDB->deleteDish($_POST['delete-hiddenID'],$_POST['delete-hiddenName'])) {
                //If deleteDish returns true, redirect back to View Dishes page
                header('Location: ' . $this->viewPath);
            }else{
                //If deleteDish caught an error and returned false, redirect to error page
                header('Location: ' . $this->errPath);
            }
        }

        //Generate modal (Function from UIElement Class)
        return $this->generateModal("deleteModal", "Delete Dish", array(
            //Generate the confirmation form
            $this->generateConfirmation("deletionForm","delete")
        ));
    }

    /**
     * generateModalAvailability
     * To generate modal and handle button on click event for the change dish availability modal. The function also
     * checks for button on click event where it will execute the updateDishAvailability using the preset hidden ID
     * and Name to update the dish availability from database.
     */
    protected function generateModalAvailability(){
        //Handle change availability confirm button on click event
        if(isset($_POST['availability-yes'])){
            //Initialise the DishDB class
            $dishDB = new DishDBHandler();

            //Execute update dish availability function
            if($dishDB->updateDishAvailability($_POST['availability-hiddenID'],$_POST['availability-hiddenName'])){
                //If updateDishAvailability returns true, redirect back to View Dishes page
                header('Location: '.$this->viewPath);
            }else{
                //If updateDishAvailability returns caught an error and returned false, redirect to error page
                header('Location: ' . $this->errPath);
            }
        }

        //Generate modal (Function from UIElement Class)
        return $this->generateModal("availabilityModal", "Change Dish Availability", array(
            //Generate the confirmation form
            $this->generateConfirmation("availabilityForm","availability")
        ));
    }

    /**
     * generateModalLogDetail
     * To generate modal for the log detail modal. The function uses generateDataTable function to generate a complete
     * table to display a list of log details. Note that generateDataTable will only create the <div> tags required
     * to generate the data later with retrieveLogDetail.js.
     */
    protected function generateModalLogDetail(){
        //Generate modal (Function from UIElement Class)
        return $this->generateModal("logModal","Log Detail", array(
            //Generate the data table
            $this->generateDataTable("logDetailTable")
        ));
    }

    /**
     * submitTextChange
     * To change the text of the submit button for the dish management form depending on the mode specified (E.g. "add" and
     * "edit")
     */
    private function submitTextChange($mode){
        if($mode == "add"){
            return "Add Dish";
        }else if($mode == "edit"){
            return "Edit Dish";
        }
    }

    /**
     * generateHiddenInput
     * To generate the hidden input required to holds the ID of the deleted option when an option is removed in the
     * edit dish modal
     */
    private function generateHiddenInput($mode){
        if($mode == "add"){
            return null;
        }else if($mode == "edit"){
            return <<<EOT
                <input type='hidden' id='deletedOption' name='deletedOption'>
EOT;
        }
    }

    /**
     * generateDishID
     * To generate an readonly text input that will be used to hold the dish ID on the edit dish modal
     */
    private function generateDishID($mode){
        if($mode == "add"){
            return null;
        }else if($mode == "edit"){
            return <<<EOT
                <div class='mb-3'>
                    <label>ID:</label>
                    <input class='form-control' type='text' name='edit-id' id='edit-id' readonly>
                </div>
EOT;
        }
    }

    /**
     * imageToBlob
     * To convert the uploaded image into a long blob before uploading to the database
     */
    private function imageToBlob($mode){
        if(!is_uploaded_file($_FILES[$mode.'-imgPath']['tmp_name'])){
            //If image is not uploaded, return 1 as default
            return 1;

        }else{
            //Check the extension of the uploaded file
            $path = $_FILES[$mode.'-imgPath']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                //If the extension is correct, convert the file into blob
                $image = $_FILES[$mode.'-imgPath']['tmp_name'];
                return base64_encode(file_get_contents(addslashes($image)));

            }else{
                //Return 1 as default if the extension is incorrect
                return 1;
            }
        }
    }

    /**
     * checkEmptyOption
     * To check if the POST variable are empty
     */
    private function checkEmptyOption($value){
        if($value == "edit-optionName" || $value == "edit-optionPrice" || $value == "add-optionName" ||
           $value == "add-optionPrice" || $value == "retrievedName" || $value == "retrievedPrice" ||
           $value == "retrievedID"){
            if(isset($_POST[$value])){
                //If the POST variable is set, return the variable
                return $_POST[$value];

            }else{
                //Return null if the variable is not set
                return null;
            }
        }else if($value == "removedOption"){
            if(isset($_POST['deletedOption'])){
                //If the POST deletedOption variable is set, return the variable
                return $_POST['deletedOption'];

            }else{
                //Return null if the variable is not set
                return null;
            }
        }
    }

}