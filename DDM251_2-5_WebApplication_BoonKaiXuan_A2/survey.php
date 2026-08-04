<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
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

<body>
    <h1>Tell Us What You Love!</h1>
    <p>Help us personalize your Tealive experience.</p>


    <form action="runSurvey.php" method="POST">

        <div id="survey_1" class="step active">
            <!-- Progress Bar -->
            <div>
                <progress value="1" max="3"></progress>
            </div>

            <h3>Q1: What kind of drink are you craving today?</h3>
            <div class="survey_options">
                <input type="radio" id="q1_a" name="q1_score" value="0" required>
                <label for="q1_a">Rich & Creamy</label>
                <br>
                <input type="radio" id="q1_b" name="q1_score" value="1">
                <label for="q1_b">Fruity & Sweet</label>
                <br>
                <input type="radio" id="q1_c" name="q1_score" value="2">
                <label for="q1_c">Refreshing & Tangy</label>
                <br>
                <input type="radio" id="q1_d" name="q1_score" value="3">
                <label for="q1_d">Light & Floral</label>
            </div>

            <p class="error-msg" id="err-1">Please select an option before submitting!</p>

            <button type="button" onclick="nextStep(1, 2)">
                Next
            </button>
        </div>

        <div id="survey_2" class="step">
            <!-- Progress Bar -->
            <div>
                <progress value="2" max="3"></progress>
            </div>

            <h3>Q2: How adventurous are you when trying new flavours?</h3>
            <div class="survey_options">
                <input type="radio" id="q2_a" name="q2_score" value="0" required>
                <label for="q2_a">I always order my usual favourite</label>
                <br>
                <input type="radio" id="q2_b" name="q2_score" value="1">
                <label for="q2_b">I sometimes try something new</label>
                <br>
                <input type="radio" id="q2_c" name="q2_score" value="2">
                <label for="q2_c">I enjoy seasonal or limited-time drinks </label>
                <br>
                <input type="radio" id="q2_d" name="q2_score" value="3">
                <label for="q2_d">I love discovering new flavours</label>
            </div>

            <p class="error-msg" id="err-2">Please select an option before submitting!</p>

            <button type="button" onclick="prevStep(2, 1)">Back</button>
            <button type="button" onclick="nextStep(2, 3)">Next</button>
        </div>

        <div id="survey_3" class="step">
            <!-- Progress Bar -->
            <div>
                <progress value="3" max="3"></progress>
            </div>

            <h3>Q3: Which drink would you choose on a hot day?</h3>
            <div class="survey_options">
                <input type="radio" id="q3_a" name="q3_score" value="0" required>
                <label for="q3_a">Brown Sugar Milk Tea</label>
                <br>
                <input type="radio" id="q3_b" name="q3_score" value="1">
                <label for="q3_b">Strawberry Milk Tea</label>
                <br>
                <input type="radio" id="q3_c" name="q3_score" value="2">
                <label for="q3_c">Tropical Fruit Tea</label>
                <br>
                <input type="radio" id="q3_d" name="q3_score" value="3">
                <label for="q3_d">Floral Fruit Tea</label>
            </div>

            <p class="error-msg" id="err-3">Please select an option before submitting!</p>

            <button type="button" onclick="prevStep(3, 2)">Back</button>
            <button type="submit" onclick="return validateStep(3)">Show Me My Drink!</button>
        </div>
    </form>

    <script>
        function nextStep(current, next) {
            // 1. First, check if the user actually picked an answer!
            if (validateStep(current)) {

                // 2. Hide current question (removes 'active' class from step-1)
                document.getElementById(`survey_${current}`).classList.remove('active');

                // 3. Show next question (adds 'active' class to step-2)
                document.getElementById(`survey_${next}`).classList.add('active');
            }
        }

        function prevStep(current, prev) {
            // 1. Hide Question 2
            document.getElementById(`survey_${current}`).classList.remove('active');

            // 2. Show Question 1 again
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