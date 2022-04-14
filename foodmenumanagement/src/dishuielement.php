<?php

/**
 * dishuielement.php
 *
 * PHP class to handle and generating all the webpage elements.
 *
 * This PHP script has been used to handle all the webpage elements
 * such as creating title with <h1>, subtitle with <p>, and more. The
 * purpose of this class is to minimise redundant code by reusing the
 * code to generate elements necessary to the website and to keep the
 * code consistency over the pages.
 *
 * @author Teck Xun Tan W20003691
 */

class DishUIElement extends UIElement
{

    /**
     * generateNav
     *
     * To generate the navigation section of the webpage.
     *
     * @visibility protected
     * @return string The generated nav component
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
     *
     * To generate the search bar section of the webpage by combining
     * <span> and <input>.
     *
     * @visibility protected
     * @return string The generated search bar component
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
     *
     * To generate the data page navigator section for the datatable (E.g. Next, Previous).
     * The function only generate the <div> required to generate the buttons later
     * using Javascript (Check retrieveDish.js and retrieveLog.js).
     *
     * @visibility protected
     * @return string The generated page navigation component
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
     *
     * To generate the form to manage the selected dish by combining with different elements
     * such as <input>, <textarea> and <select>. Note that the category of the form is generated
     * using a built function (Check generateCategoryDropdown function)
     *
     * @visibility protected
     * @param string $mode The mode of the management form (E.g. "add" for generating adding form, "edit" for generating editing form)
     * @return string The generated management form
     */
    protected function generateDishManageForm($mode){
        $dishForm = <<<EOT
            <form class='container-fluid' name='dishForm' method='post' enctype='multipart/form-data'">
                {$this->generateDishID($mode)}
                <div class='mb-3'>
                    <label>Name:</label>
                    <input class='form-control' type='text' name='$mode-name' id='$mode-name' required>
                </div>
                <div class='mb-3'>
                    <label>Description:</label>
                    <textarea class='form-control' name='$mode-description' id='$mode-description' required></textarea>
                </div>
                <div class='mb-3'>
                    <label>Category:</label>
EOT;
        $dishForm .= $this->generateCategoryDropdown($mode);
        $dishForm .= <<<EOT
                </div>
                <div class='mb-3'>
                    <label>Image Path:</label>
                    <input class='form-control-file' type='file' accept='image/*' name='$mode-imgPath' id='$mode-imgPath'>
                </div>
                <hr>
                <div class='$mode-option'>
                    <input class="btn btn-lg" type='button' id='$mode-addOption' value='+ Add New Option'>
                    <hr>
                </div>
                {$this->generateHiddenInput($mode)}
                <div>
                    <input class="btn btn-lg" type='submit' name='$mode-submit' id='$mode-submit' value='{$this->submitTextChange($mode)}' onclick="">
                </div>
            </form>
EOT;
        return $dishForm;
    }

    /**
     * generateConfirmation
     *
     * To generate a confirmation message
     *
     * @visibility protected
     * @param $confirmationFormName
     * @param $id
     * @return string
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
     *
     *
     *
     * @visibility protected
     * @return string
     */
    protected function generateAddButton(){
        return <<<EOT
            <div class='container-fluid'>
                <button type='button' class='btn btn-lg' id='add-newDish' data-bs-toggle='modal' data-bs-target='#addModal'>+ Add New Dish</button>
            </div>
EOT;
    }

    /**
     * generateCategoryDropdown
     *
     * @visibility protected
     * @param $mode
     * @return string
     */
    protected function generateCategoryDropdown($mode){
        $category = new CategoryDBHandler();
        $result = $category->retrieveAllCategory();
        $categoryDropdown = "<select class='form-select form-select mb-3' name='$mode-category' id='$mode-category'>";
        foreach($result as $rows){
            $categoryDropdown .= "<option value='{$rows['categoryID']}'>{$rows['categoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        return $categoryDropdown;
    }

    /**
     * generateModalAdd
     *
     * @visibility private
     * @return string
     */
    protected function generateModalAdd(){
        if (isset($_POST['add-submit'])) {
            $dishDB = new DishDBHandler();
            $dish = new Dish(null, $_POST['add-name'], $_POST['add-description'], $_POST['add-category'], $this->imageToBlob("add"), null, $this->checkEmptyOption("add-optionName"), $this->checkEmptyOption("add-optionPrice"));
            if($dishDB->addDish($dish)){
                header('Location: '.$this->viewPath);
            }else{
                header('Location: ' . $this->errPath);
            }
        }

        return $this->generateModal("addModal","Add Dish",array(
            $this->generateDishManageForm("add")
        ));
    }

    /**
     * generateModalEdit
     *
     * @visibility protected
     * @return string
     */
    protected function generateModalEdit(){
        if(isset($_POST['edit-submit'])){
            $dishDB = new DishDBHandler();
            $dish = new Dish($_POST['edit-id'],$_POST['edit-name'],$_POST['edit-description'],$_POST['edit-category'],$this->imageToBlob("edit"),null,$this->checkEmptyOption("edit-optionName"), $this->checkEmptyOption("edit-optionPrice"));
            $dish->setRetrievedOption($this->checkEmptyOption("retrievedName"));
            $dish->setRetrievedPrice($this->checkEmptyOption("retrievedPrice"));
            $dish->setRetrievedID($this->checkEmptyOption("retrievedID"));

            if($dishDB->editDish($dish,$this->checkEmptyOption("removedOption"))){
                header('Location: '.$this->viewPath);
            }else{
                header('Location: ' . $this->errPath);
            }
        }

        return $this->generateModal("editModal","Edit Dish",array(
            $this->generateDishManageForm("edit")
        ));
    }

    /**
     * generateModalDelete
     *
     * @visibility protected
     * @return string
     */
    protected function generateModalDelete(){
        if(isset($_POST['delete-yes'])) {
            $dishDB = new DishDBHandler();
            if ($dishDB->deleteDish($_POST['delete-hiddenID'],$_POST['delete-hiddenName'])) {
                header('Location: ' . $this->viewPath);
            }else{
                header('Location: ' . $this->errPath);
            }
        }

        return $this->generateModal("deleteModal", "Delete Dish", array(
            $this->generateConfirmation("deletionForm","delete")
        ));
    }

    /**
     * generateModalAvailability
     *
     * @visibility protected
     * @return string
     */
    protected function generateModalAvailability(){
        if(isset($_POST['availability-yes'])){
            $dishDB = new DishDBHandler();
            if($dishDB->updateDishAvailability($_POST['availability-hiddenID'],$_POST['availability-hiddenName'])){
                header('Location: '.$this->viewPath);
            }else{
                header('Location: ' . $this->errPath);
            }
        }

        return $this->generateModal("availabilityModal", "Change Dish Availability", array(
            $this->generateConfirmation("availabilityForm","availability")
        ));
    }

    /**
     * generateModalLogDetail
     *
     * @visibility protected
     * @return string
     */
    protected function generateModalLogDetail(){
        return $this->generateModal("logModal","Log Detail", array(
            $this->generateDataTable("logDetailTable")
        ));
    }

    /**
     * submitTextChange
     *
     * @visibility protected
     * @param $mode
     * @return string|void
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
     *
     * @visibility private
     * @param $mode
     * @return string|void|null
     */
    private function generateHiddenInput($mode){
        if($mode == "add"){
            return null;
        }else if($mode == "edit"){
            return <<<EOT
                <input type='hidden' id='previousName' name='previousName'>
                <input type='hidden' id='previousDescription' name='previousDescription'>
                <input type='hidden' id='previousCategory' name='previousCategory'>
                <input type='hidden' id='deletedOption' name='deletedOption'>
EOT;
        }
    }

    /**
     * generateDishID
     *
     * @visibility private
     * @param $mode
     * @return string|void|null
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
     *
     * @visibility private
     * @param $mode
     * @return int|string
     */
    private function imageToBlob($mode){
        if(!is_uploaded_file($_FILES[$mode.'-imgPath']['tmp_name'])){
            return 1;
        }else{
            $image = $_FILES[$mode.'-imgPath']['tmp_name'];
            return base64_encode(file_get_contents(addslashes($image)));
        }
    }

    /**
     * checkEmptyOption
     *
     * @visibility private
     * @param $value
     * @return mixed|void|null
     */
    private function checkEmptyOption($value){
        if($value == "edit-optionName" || $value == "edit-optionPrice" || $value == "add-optionName" || $value == "add-optionPrice" || $value == "retrievedName" || $value == "retrievedPrice" || $value == "retrievedID"){
            if(isset($_POST[$value])){
                return $_POST[$value];
            }
        }else if($value == "removedOption"){
            if(isset($_POST['deletedOption'])){
                return $_POST['deletedOption'];
            }else{
                return null;
            }
        }
    }

}