<!-- Gokul Gampala @ Team 30 | w18031735 | Northumbria University | Team Project and Professionalism KV6002-->
<?php
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Name of the Website displayed on the browser tab -->
    <title>Feedback Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Importing CSS -->
    <link type="text/css" rel="stylesheet" href="feedbackform.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Importing Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <!-- Displays the logo and name of the company ,Begin-->
    <div class="container-sm-logo">
        <a href="http://www.amaysia.com">
            <img src="Images/logo.PNG" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
        </a>
    </div>
    <!-- Displays the logo and name of the company ,End-->
    <!-- Top navigation for the website, Begin-->
    <nav class="navbar navbar-expand-lg" >
        <ul>
            <li>
                <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/index.php">Home</a>
            </li>
            <li>
                <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/foodmenucustomer.php">Our Menu</a>
            </li>
            <li>
                <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/reservsys/index.php">Make a Reservation</a>
            </li>
            <li>
                <a class="active" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/feedback/admin.php">Give Us a Feedback</a>
            </li>
            <li>
                <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/payment/PaymentUI.php">Pay Online</a>
            </li>
            <li>
                <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/account/login.php">Employee Portal</a>
            </li>
        </ul>
    </nav>
    <!-- Top navigation for the website, End-->
    <!-- Header Image and heading of the page, Begin-->
    <div class="container-sm-header">
        <img src="Images/feedback.png" alt="Feedback Form" id="feedbackimg">
        <h1>Feedback Form</h1>
        <p>Please share your opinion about our food and service during your recent visit</p>
    </div>
    <!-- Header Image and heading of the page, End-->
    <div class="container-sm-form col-sm-12 col-xs-12 col-md-12 col-lg-12" id="feedform">

        <div class="container-sm-form col-sm-12 col-xs-12 col-md-6 col-lg-6">

            <fieldset>
                <div class="reqfield col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <span>* fields are required.</span>
                </div>
                <!-- Customer Feedback Form for the website, Begin-->
            <form method="post" enctype="multipart/form-data">
                <!-- Text field to enter personal details, Begin-->
                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" class="form-control" maxlength="255" id="name">
                </div>

                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <label for="email">Your e-mail</label>
                    <input type="email" name="email" class="form-control" maxlength="255" id="email">
                </div>
                <!-- Text field to enter personal details, End-->
                <!-- Rating of 1-5 to collect from user, Begin-->
                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <label>Rating of your overall experience<span class='starsymbol'>*</span></label>
                </div>

                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4" required>
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" required>
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" required>
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" required>
                    <label for="star1" title="text">1 star</label>
                </div>
                <!-- Rating of 1-5 to collect from user, End-->
                <!-- Review to collect from user, Begin-->
                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6" id="reviewqsn">
                    <label for="review">How was your overall experience in the restaurant(review)?<span class='starsymbol'>*</span></label>
                    <textarea class="form-control" name="review" maxlength="500" rows="3" placeholder="Please write your feedback..." id="review" required></textarea>
                </div>
                <!-- Review to collect from user, End-->
                <!-- Suggestion to collect from user, Begin-->
                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <label for="suggestion">Make a suggestion or a complaint
                    </label>
                    <textarea class="form-control" name="suggestion" maxlength="1000" rows="3" placeholder="Please describe your suggestion or a complaint" id="suggestion" required></textarea>
                </div>
                <!-- Suggestion to collect from user, End-->
                <!-- Image of food to collect from user, Begin-->
                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <label>Share the photo(s) of the dish you ordered
                    </label>
                    <input class="uploadbtn btn-sm" type="file" id="upload" name="image" accept=".jpeg,.jpg,.png,.heic">
                </div>

                <div>
                    <input type="hidden" id="blob" name="blob">
                </div>
                <!-- Image of food to collect from user, End-->
                <!-- Net Promoter Score aksing if the user recommends to friends, Begin-->
                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <label>How likely are you to recommend the restaurant to your friends and family? (NPS - Net Promoter Score)<span class='starsymbol'>*</span></label>
                </div>
                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <input type="radio" id="nps1" name="nps" value="1" required>
                    <label for="nps1" title="1">1</label>
                    <input type="radio" id="nps2" name="nps" value="2" required>
                    <label for="nps2" title="2">2</label>
                    <input type="radio" id="nps3" name="nps" value="3" required>
                    <label for="nps3" title="3">3</label>
                    <input type="radio" id="nps4" name="nps" value="4" required>
                    <label for="nps4" title="4">4</label>
                    <input type="radio" id="nps5" name="nps" value="5" required>
                    <label for="nps5" title="5">5</label>
                    <input type="radio" id="nps6" name="nps" value="6" required>
                    <label for="nps6" title="6">6</label>
                    <input type="radio" id="nps7" name="nps" value="7" required>
                    <label for="nps7" title="7">7</label>
                    <input type="radio" id="nps8" name="nps" value="8" required>
                    <label for="nps8" title="8">8</label>
                    <input type="radio" id="nps9" name="nps" value="9" required>
                    <label for="nps9" title="9">9</label>
                    <input type="radio" id="nps10" name="nps" value="10" required>
                    <label for="nps10" title="10">10</label>
                </div>
                <!-- Net Promoter Score aksing if the user recommends to friends, End-->
                <!-- Submit button to submit the form, Begin-->
                <div class="button-sm col-sm-12 col-xs-12 col-md-6 col-lg-6">
                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </div>
                <!-- Submit button to submit the form, End-->
                <!-- Php to collect the details and post into database , Begin-->
                <?php
                include("add.php");
                if(isset($_POST['submit'])){
                    $addFeedback = new Add();
                    if($addFeedback->uploadFeedback($_POST['name'],$_POST['email'],getRating(),$_POST['review'],imageToBlob(),$_POST['suggestion'],$_POST['nps'])){
                        echo "<script>document.location.href='/kv6002/feedback/feedbackformsuccess.php'</script>";
                    }
                }

                function getRating(){
                    if(isset($_POST['rating'])){
                        return $_POST['rating'];
                    }else{
                        return 0;
                    }
                }

                function imageToBlob(){
                    if(!is_uploaded_file($_FILES['image']['tmp_name'])){
                        return null;
                    }else{
                        $image = $_FILES['image']['tmp_name'];
                        return base64_encode(file_get_contents(addslashes($image)));
                    }
                }
                ?>
                <!-- Php to collect the details and post into database , End-->
            </form>
            </fieldset>
            <!-- Customer Feedback Form for the website, End-->
        </div>
    </div>
    <!-- Customer Feedback Form for the website, End-->

    <!-- Script to avoid profane words, Begin-->
    <script>

        //Filter words

        var banned = ['anal', 'analsex','anus', 'areola', 'arse', 'arsehole','ass',
                      'balllicker', 'balls', 'ballsack', 'banging', 'barf', 'bast','biatch', 'beatyourmeat', 'bigass', 'bigbastard', 'bigbutt', 'bitch', 'bitchin', 'blowjob',
                      'bollock', 'boner', 'boob', 'booty', 'bra', 'brea5t', 'breast', 'brothel', 'bugger', 'bullcrap', 'bullshit', 'bumblefuck', 'bumfuck', 'butt', 'butt-bang', 'byatch',
                      'cacker', 'cameltoe','cemetery', 'chav', 'clit', 'cocaine', 'cock', 'coitus', 'condom', 'conservative', 'copulate', 'crap', 'crime', 'criminal', 'cum', 'cunnt', 'cunt',
                      'dammit', 'damn', 'dead', 'death', 'demon', 'devil', 'dick', 'die', 'dildo', 'dipshit', 'doggie', 'doggy', 'drug', 'dumbass', 'dumbbitch', 'dumbfuck',
                      'ejaculate', 'ejaculation', 'ejaculated', 'ejaculating', 'erect', 'erection',
                      'facefucker', 'faeces', 'faggot', 'fagot', 'fannyfucker', 'fart', 'fatfuck', 'fatass', 'feces', 'felatio', 'fellatio', 'feltch', 'fetish', 'fingerfuck', 'fistfuck',
                      'fisting', 'fok', 'footfuck', 'freakfuck', 'freefuck', 'fuc', 'fucc', 'fucck', 'fuck', 'fugly', 'fuk', 'funfuck', 'fuuck',
                      'gangban', 'gaymuthafuckinwhore', 'gaysex', 'genital', 'givehead', 'godammit', 'goddamit', 'goddamn', 'goddamnit', 'goddamnmuthafucker', 'gonorrehea',
                      'handjob', 'headfuck', 'hijack', 'hiscock', 'hobo', 'hoe', 'homobangers', 'hooker', 'hooters', 'hore', 'horney', 'horny', 'horniest', 'horseshit', 'hotdamn', 'hotpussy', 'hymen', 'hymie',
                      'idiot', 'incest', 'insest', 'intercourse', 'interracial', 'intheass',
                      'jackass', 'jackoff', 'jackshit', 'jacktheripper', 'jerkoff', 'jihad',
                      'kill', 'killed', 'kink', 'kock', 'kondom','kondum', 'krap', 'kraut', 'kum', 'kunt',
                      'lactate', 'lapdance', 'libido', 'lickme', 'limpdick', 'livesex', 'loadedgun', 'looser', 'loser', 'lovebone', 'lovegoo', 'lovegun', 'lovejuice', 'lovemuscle', 'lubejob', 'luckcameltoe',
                      'mafia', 'marijuana', 'mastabate', 'masterbate', 'mastrabator', 'masturbate', 'masturbating', 'meatbeater', 'milf', 'mofo', 'molest', 'mormon', 'moron', 'mothafuck', 'mothafuk', 'mothafucka', 'mothafuckaz',
                      'mothafucked', 'mothafucker', 'mothafuckin', 'mothafucking', 'motherfuck',
                      'nastybitch', 'naked', 'nastyslut', 'nastywhore', 'nastyho', 'nazi', 'negro', 'negroes', 'nigga', 'nigger', 'nip', 'nude', 'nuke', 'nutfucker',
                      'orgasim', 'orgasm', 'orgies', 'orgy',
                      'panti', 'panty', 'pansies', 'panties', 'pee', 'penetration', 'peni5', 'penile', 'penis', 'perv', 'phonesex', 'phuk', 'phuck', 'phuq', 'piss', 'pi55', 'pimp', 'poo', 'poop', 'porn', 'pric', 'prick', 'pu55i', 'pussy', 'pussi', 'pu55y', 'pube', 'pubic', 'puss',
                      'rape', 'retard',
                      'satan', 'scum', 'semen', 'sex', 'shag', 'shav', 'shit', 'shite', 'shhit', 'skank', 'skum', 'slut', 'sonofabitch', 'sonofbitch', 'spank', 'sperm', 'spit', 'suckdick', 'sucker', 'suckme', 'suckdick','suckmy',
                      'taboo', 'timbernigger', 'tit', 'tyt', 'twat',
                      'vagina', 'vibrator', 'virginbreaker', 'vulva',
                      'wank', 'weenie', 'weewee', 'whore', 'willie', 'willy', 'wtf'];
        document.getElementById('review').addEventListener('keyup', function(e) {
            var text = document.getElementById('review').value;
            for (var x=0;x<banned.length;x++) {
                if (text.search(banned[x]) !== -1) {
                    alert('Sorry! '+banned[x]+' is not allowed!. Please use Appropriate words.');
                }
                var regExp = new RegExp(banned[x]);
                text = text.replace(regExp,'');
            }
            document.getElementById('review').value = text;
        },false);

    </script>
    <!-- Script to avoid profane words, End-->
    <!-- Footer content of the Website such as copyrights info, page name and developer name, Begin -->
    <footer class="container-fluid">
        <hr>
        <p>© Amaysia Restaurant | Give us a Feedback | Developed by Team 30 </p>
    </footer>
    <!-- Footer content of the Website such as copyrights info, page name and developer name, End -->
</body>

</html>

