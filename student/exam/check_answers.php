<?php
include_once 'exam_db.php';

// Display submitted POST data for debugging
echo 'Value of POST:' . '<br>';
print_r($_POST);

// Initialize arrays to store question IDs and student answers
$q_id = [];
$ans = [];

// Extract question IDs and answers from POST data
foreach ($_POST['answers'] as $key => $value) {
    $q_id[] = $key; // Collect question IDs
    $ans[] = $value; // Collect answers
}

echo 'Value of q_id:' . '<br>';
print_r($q_id);
echo 'Value of answers $ans:' . '<br>';
print_r($ans);

// Fetch correct answers for the given question IDs
$fetch_data = [];
foreach ($q_id as $question_id) {
    $sql = "SELECT q_id, correct_ans FROM `scheduled_exams` WHERE q_id = $question_id";
    $res = mysqli_query($conn_exam, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $fetch_data[$row['q_id']] = $row['correct_ans']; // Store the correct answers in an associative array
        }
    } else {
        echo "No data found for question ID: $question_id<br>";
    }
}
print_r($fetch_data);
// Compare student answers with correct answers
echo '<h2>Answer Evaluation</h2>';

$totalQuestions = count($q_id);
$correctCount = 0;

foreach ($q_id as $index => $question_id) {
    $student_answer = $ans[$index];
    $correct_answer = $fetch_data[$question_id] ?? 'N/A';

    if ($student_answer === $correct_answer) {
        echo "Question ID $question_id: Your answer is <strong>correct</strong>.<br>";
        $correctCount++;
    } else {
        echo "Question ID $question_id: Your answer is <strong>incorrect</strong>. Correct answer: $correct_answer<br>";
    }
}

// Calculate and display the overall score
$scorePercentage = ($correctCount / $totalQuestions) * 100;
echo "<h2>Your Score: $correctCount out of $totalQuestions ($scorePercentage%)</h2>";
?>