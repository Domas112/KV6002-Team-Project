<?php

class ErrorUIElement extends UIElement
{
    protected function generateNavigation(){
        $errorNavigation = <<<EOT
        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:history.back()">< Back to Previous Page</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
EOT;

        return $errorNavigation;
    }

    protected function generateErrorMessage($message){
        return <<<EOT
            <div id="errorMessage">
                <span class="align-middle">$message</span>
            </div>
EOT;
    }
}