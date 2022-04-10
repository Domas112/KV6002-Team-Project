<?php

class CustomerUIElement extends UIElement
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
        $menuNavigation = <<<EOT
        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/index.php">Back to Homepage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="0">All</a>
                        </li>
EOT;
        $categoryDB = new CategoryDBHandler();
        foreach($categoryDB->retrieveAllCategory() as $category){
            $menuNavigation .= <<<EOT
                        <li class="nav-item">
                            <a class="nav-link" id="{$category['categoryID']}">{$category['categoryName']}</a>
                        </li>
EOT;
        }

        $menuNavigation .= <<<EOT
                    </ul>
                </div>
            </nav>
        </div>
EOT;

        return $menuNavigation;
    }

    protected function generateMenuItem($menuClass){
        return "<div class='container-fluid' id='$menuClass'></div>";
    }
}