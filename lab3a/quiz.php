<?php

require "helpers.php";

# from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
# Reference: https://www.php.net/manual/en/reserved.variables.server.php

// Supply the missing code
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
}

// Supply the missing code
$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];
$answer = $_POST['answer'] ?? null;
$answers = $_POST['answers'] ?? '';

$questions = retrieve_questions();
$num_questions = $questions['questions'];

if (!is_null($answer)) {
    $answers .= $answer;
}


$current_question = get_current_question($answers);
$current_question_number = get_current_question_number($answers);

$target = 'quiz.php';
if ($current_question_number == MAX_QUESTION_NUMBER) {
    $target = 'result.php';
}

$options = get_options_for_question_number($current_question_number);


?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />

    <script>
        window.onload = function() {
            // Set a timer to automatically submit the form after 60 seconds
            setTimeout(function(){
                document.getElementById("quizForm").submit();
            }, 60000); // 60000 milliseconds = 60 seconds
        };
    </script>

</head>
<body>
<section class="section">
    <h1 class="title">Quiz</h1>
    <h2 class="subtitle">Answer all the questions below:</h2>

    <!-- Quiz Form -->
    <form method="POST" action="result.php" id="quizForm">
        <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
        <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
        <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />

        <?php foreach ($questions['questions'] as $index => $question): ?>
            <div class="box">
                <h3 class="subtitle">Question <?php echo $index + 1; ?>: <?php echo htmlspecialchars($question['question']); ?></h3>
                
                <?php foreach ($question['options'] as $option): ?>
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo $option['key']; ?>" />
                                <?php echo htmlspecialchars($option['value']); ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <!-- Submit button -->
        <button type="submit" class="button is-link">Submit</button>
    </form>
</section>
</body>
</html>