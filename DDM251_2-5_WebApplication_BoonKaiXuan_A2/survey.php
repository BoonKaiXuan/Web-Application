<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['customerID'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Question 1 - Tealive New Product Launch</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/survey.css">

</head>

<body class="bg-dark-purple">
    <div class="max-width">

        <form action="runSurvey.php" method="POST">
            <!--------- Q1 ---------->
            <div id="survey_1" class="step active">

                <header class="intro">
                    <h2>Tell Us What You Love!</h2>
                    <p>Help us personalize your Tealive experience.</p>
                </header>
                <!-- Progress Bar -->
                <div class="progress active">
                    <progress value="1" max="3"></progress>
                </div>

                <p class="error-msg" id="err-1">Please select an option before submitting!</p>

                <h3>Q1: What kind of drink are you craving today?</h3>
                <div class="survey_options">
                    <input type="radio" id="q1_a" name="q1_score" value="0" required>
                    <label for="q1_a">🥛 Rich & Creamy</label>
                    <br>
                    <input type="radio" id="q1_b" name="q1_score" value="1">
                    <label for="q1_b">🍓 Fruity & Sweet</label>
                    <br>
                    <input type="radio" id="q1_c" name="q1_score" value="2">
                    <label for="q1_c">🍋 Refreshing & Tangy</label>
                    <br>
                    <input type="radio" id="q1_d" name="q1_score" value="3">
                    <label for="q1_d">🌸 Light & Floral</label>
                </div>

                <div class="btns next">
                    <button class="btn btn-yellow" type="button" onclick="nextStep(1, 2)">
                        Next >
                    </button>
                </div>

            </div>
            <!--------- Q2 ---------->
            <div id="survey_2" class="step">

                <h2 class="intro">One more...</h2>
                <!-- Progress Bar -->
                <div class="progress">
                    <progress value="2" max="3"></progress>
                </div>

                <p class="error-msg" id="err-2">Please select an option before submitting!</p>

                <h3>Q2: How adventurous are you when trying new flavours?</h3>
                <div class="survey_options">
                    <input type="radio" id="q2_a" name="q2_score" value="0" required>
                    <label for="q2_a">🏠 I always order my usual favourite</label>
                    <br>
                    <input type="radio" id="q2_b" name="q2_score" value="1">
                    <label for="q2_b">🤔 I sometimes try something new</label>
                    <br>
                    <input type="radio" id="q2_c" name="q2_score" value="2">
                    <label for="q2_c">🌟 I enjoy seasonal or limited-time drinks </label>
                    <br>
                    <input type="radio" id="q2_d" name="q2_score" value="3">
                    <label for="q2_d">🚀 I love discovering new flavours</label>
                </div>
                <div class="btns row-flex space-btwn">
                    <button class="btn btn-outline" type="button" onclick="prevStep(2, 1)">
                        < Back</button>

                            <button class="btn btn-yellow next" type="button" onclick="nextStep(2, 3)">Next ></button>
                </div>

            </div>
            <!--------- Q3 ---------->
            <div id="survey_3" class="step">

                <h2 class="intro">And we're done...</h2>
                <!-- Progress Bar -->
                <div class="progress">
                    <progress value="3" max="3"></progress>
                </div>

                <p class="error-msg" id="err-3">Please select an option before submitting!</p>

                <h3>Q3: Which drink would you choose on a hot day?</h3>
                <div class="survey_options">
                    <input type="radio" id="q3_a" name="q3_score" value="0" required>
                    <label for="q3_a">🧋 Brown Sugar Milk Tea</label>
                    <br>
                    <input type="radio" id="q3_b" name="q3_score" value="1">
                    <label for="q3_b">🍓 Strawberry Milk Tea</label>
                    <br>
                    <input type="radio" id="q3_c" name="q3_score" value="2">
                    <label for="q3_c">🍍 Tropical Fruit Tea</label>
                    <br>
                    <input type="radio" id="q3_d" name="q3_score" value="3">
                    <label for="q3_d">🌺 Floral Fruit Tea</label>
                </div>

                <div class="btns row-flex space-btwn">
                    <button class="btn btn-outline" type="button" onclick="prevStep(3, 2)">
                        < Back</button>
                            <button class="btn btn-yellow" type="submit" onclick="return validateStep(3)">Show My Drink!</button>
                </div>

            </div>
        </form>
    </div>

    <script>
        function nextStep(current, next) {
            // 1. First, check if the user actually picked an answer!
            if (validateStep(current)) {

                document.getElementById(`survey_${current}`).classList.remove('active');

                document.getElementById(`survey_${next}`).classList.add('active');
            }
        }

        function prevStep(current, prev) {
            document.getElementById(`survey_${current}`).classList.remove('active');

            document.getElementById(`survey_${prev}`).classList.add('active');
        }

        function validateStep(currentStepNum) {
            // 1. Look inside the CURRENT step for any checked radio button
            const isChecked = document.querySelector(`#survey_${currentStepNum} input[type="radio"]:checked`);

            // 2. Find the error message paragraph for this step
            const errElement = document.getElementById(`err-${currentStepNum}`);

            // 3. If NO radio button was selected:
            if (!isChecked) {
                errElement.style.display = "block"; // Show red error text
                return false; // Stop! Do not allow moving to next step
            }

            // 4. If an answer WAS selected:
            errElement.style.display = "none";
            return true;
        }
    </script>

</body>

</html>