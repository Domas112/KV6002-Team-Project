<?php
    require_once('../domain/models/Dish.php');
    $dishes = [];
    for($i = 0 ; $i < 4; $i++){
        $dishes[$i] = new Dish(
            $i,
            "Dish title",
            "testing description ". $i,
            5.99,
            "./image.jpg"
        );
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel='stylesheet' href='../resources/styles/style.css'>

</head>
<body class='mx-2'>
    <header class='container'>
        <div class='row'>

            <h1 class='col-10'>Helloworld</h1>
            <button class='border border-dark btn btn-info col-2'>My orders</button>
        </div>
    </header>
    <main class='container p-5'>
        <?php
        foreach ($dishes as $dish) {
        echo "
            <div class='row' id='{$dish->id}'>
                <p class='col-8'>
                    {$dish->title}
                </p>
                <p class='col-2'>
                    £{$dish->price}
                </p>

                <div class='col-2'>
                    <div class='dropdown'>
                        <button class='border  btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='#collapseTest-{$dish->id}' aria-expanded='false' aria-controls='collapseTest-{$dish->id}'>
                            Reveal more
                        </button>
                    </div>
                </div>

                <div class='container collapse col-12' id='collapseTest-{$dish->id}'>

                    <div class='row card-body '>

                        <div class='col'>
                            <img style='width:100%; height:100%;' src='../resources/images/dish_1.jpg' alt='image of a dish'/>

                        </div>

                        <div class='col'>
                            <h2>
                                {$dish->title}
                            </h2>
                            <p>
                                {$dish->description}
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        ";
        }
        ?>
    </main>        
    <footer>
        <p>Amaysia</p>
    </footer>
    
</body>
</html>