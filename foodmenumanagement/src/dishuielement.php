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

class DishUIElement
{
    protected $resourceBasePath = FOODMENUMANAGEMENT_RESOURCEBASEPATH;
    protected $viewPath = FOODMENUMANAGEMENT_VIEWPATH;
    protected $logPath = FOODMENUMANAGEMENT_LOGPATH;

    /**
     * generateHeader
     *
     * To generate the header of the webpage.
     *
     * @visibility protected
     * @return string The generated header component
     */
    protected function generateHeader(){
        return <<<EOT
        <!doctype html>
            <html lang="en">
                <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <!-- Importing CSS -->
                    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'>
                    <link rel="stylesheet" href="{$this->resourceBasePath}/css/dishmanagement.css">
                    
                    <!-- Importing Scripts -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                    
                    <!-- Title of the page -->
                    <title>Food Menu Management</title>
                </head>
                <body>
EOT;
    }

    /**
     * generateFooter
     *
     * To generate the footer of the webpage.
     *
     * @visibility protected
     * @return string The generated footer component
     */
    protected function generateFooter(){
        return <<<EOT
                    <!-- Footer -->
                    <footer class="container-fluid">
                        <hr>
                        <p>© Amaysia Restaurant | Food Menu Management | Developed by Teck Xun Tan</p>
                    </footer>
                </body>
            </html>
EOT;
    }

    /**
     * generateLogo
     *
     * To generate the logo section of the webpage.
     *
     * @visibility protected
     * @return string The generated logo component
     */
    protected function generateLogo(){
        return <<<EOT
        <div class="container-sm-logo">
            <img src="{$this->resourceBasePath}/assets/logo.png" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
        </div>
EOT;
    }

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
                            <a class="nav-link" href={$this->viewPath}>View All Dishes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={$this->logPath}>System Log</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
EOT;

    }

    /**
     * generateTitle
     *
     * To add the specified text in the parameter into the body as a
     * title using <h1> tag.
     *
     * @visibility protected
     * @param string $title The text to be added into the body as new title
     * @return string The generated title component
     */
    protected function generateTitle($title){
        return "<h1>$title</h1>";
    }

    /**
     * generateSubtitle
     *
     * To add the specified text in the parameter into the body as a
     * subtitle using <p> tag.
     *
     * @visibility protected
     * @param string $subtitle The text to be added into the body as new subtitle
     * @return string The generated subtitle component
     */
    protected function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
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
     * generateHorizontalLine
     *
     * To generate a horizontal line using <hr>.
     *
     * @visibility protected
     * @return string The <hr> tag element
     */
    protected function generateHorizontalLine(){
        return "<hr>";
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
                <div class='form-group'>
                    <label>Name:</label>
                    <input class='form-control' type='text' name='$mode-name' id='$mode-name' required>
                </div>
                <div class='form-group'>
                    <label>Description:</label>
                    <textarea class='form-control' name='$mode-description' id='$mode-description' required></textarea>
                </div>
                <div class='form-group'>
                    <label>Category:</label>
EOT;
        $dishForm .= $this->generateCategoryDropdown($mode);
        $dishForm .= <<<EOT
                </div>
                <div class='form-group'>
                    <label>Image Path:</label>
                    <input class='form-control-file' type='file' name='$mode-imgPath' id='$mode-imgPath'>
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
        $categoryDropdown = "<select class='form-control' name='$mode-category' id='$mode-category'>";
        foreach($result as $rows){
            $categoryDropdown .= "<option value='{$rows['categoryID']}'>{$rows['categoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        return $categoryDropdown;
    }

    /**
     * generateDataTable
     *
     * @visibility protected
     * @param $tableName
     * @return string
     */
    protected function generateDataTable($tableName){
        return "<div class='container-fluid' id='$tableName'>Loading data...</div>";
    }

    /**
     * generateModal
     *
     * @visibility protected
     * @param $id
     * @param $title
     * @param $modalContent
     * @return string
     */
    private function generateModal($id,$title,$modalContent){
        $labelID = $id . "Label";
        $modal = <<<EOT
            <!-- $title Modal -->
            <div class="modal fade" id="$id" tabindex="-1" aria-labelledby="$labelID" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="$labelID">$title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
EOT;
        for($i = 0; $i<count($modalContent); $i++){
            $modal .= $modalContent[$i];
        }
        $modal .= <<<EOT
                        </div>
                    </div>
                </div>
            </div>
EOT;

        return $modal;
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
            $dishDB->addDish($dish);
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

            $retrievedDish = new Dish(null,$_POST['previousName'],$_POST['previousDescription'],$_POST['previousCategory'],null,null,null,null);

            if($dishDB->editDish($retrievedDish,$dish,$this->checkEmptyOption("removedOption"))){
                header('Location: '.$this->viewPath);
            }else{
                header('Location: '.$this->logPath);
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
            if ($dishDB->deleteDish($_POST['delete-hiddenID'])) {
                header('Location: ' . $this->viewPath);
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
            if($dishDB->updateDishAvailability($_POST['availability-hiddenID'])){
                header('Location: '.$this->viewPath);
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
     * generateDiv
     *
     * To create a division to wrap around HTML contents
     *
     * This function could be used to wrap division around contents.
     * (Example Code:)
     * generateDiv(
     *      array(
     *          addHeader("Hello World");
     *          addParagraph("Hello World 2");
     *      )
     * );
     *
     * (Result:)
     * <div>
     *      <h1>Hello World</h1>
     *      <p>Hello World 2</p>
     * </div>
     *
     * @visibility protected
     * @param array $containerContent accepting array of generated HTML contents
     * @param string $class The class of the div element
     * @return string This will return the generated division
     */
    protected function generateDiv(array $containerContent, $class){
        $div = "<div {$this->checkClass($class)}'>";
        for($i = 0; $i<count($containerContent); $i++){
            $div .= $containerContent[$i];
        }
        $div .= "</div>";

        return $div;
    }

    /**
     * includeJavascript
     *
     * @param $scriptPath
     * @return string
     */
    protected function includeJavascript($scriptPath){
        return "<script type='text/javascript' src='".$scriptPath."'></script>";
    }

    /**
     * getResourceBasePath
     *
     * @visibility protected
     * @return string
     */
    protected function getResourceBasePath(){
        return $this->resourceBasePath;
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
                <div class='form-group'>
                    <label>ID:</label>
                    <input class='form-control' type='text' name='edit-id' id='edit-id' readonly>
                </div>
EOT;
        }
    }

    /**
     * checkClass
     *
     * To check if a class has been provided to be included as an attribute
     *
     * This function is used to check if a class is provided, if the class parameter
     * is not null, it will add a 'class' attribute into the tags, as shown in the
     * example below.
     *
     * (Example code to generate a paragraph:)
     * public function addParagraph($text,$class){
     *      return "<p " . $this->checkClass($class) . ">$text</p>";
     * }
     *
     * (Result:)
     * <p class="main-container"></p> (with class provided)
     * <p></p> (without class provided / NULL)
     *
     * @visibility private
     * @param string $class The name of the class to a specific CSS
     * @return string This will return a class attribute or null if $class is NULL
     */
    private function checkClass($class){
        if($class != null){
            return "class='$class'";
        }else{
            return null;
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