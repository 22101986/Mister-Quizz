@extends('app')

@section('content')

<div class="main-img">
    <div class="container mt-5 text-center" id="submit">
        <div id="quiz-container" class="card p-4 shadow-sm">
            <div class="card-body">
                
                <h4 id="question-number" class="text-center mb-4"></h4> 
                <img src="{{ asset('images/mister_quiz.png') }}" style="max-width: 200px; width: 100%; height: auto;" alt="">

                <h2 id="category" class="card-title text-primary text-center mb-4"></h2> 
                <h4 id="xp" class="card-title text-success text-center mb-4"></h4> 

                <h3 id="question-text" class="card-title text-center mb-4"></h3> 
                <ul id="answer-buttons" class="list-unstyled"></ul>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" id="next-button" class="blue-btn m-2 p-2" style="display:none;">Next question</button> 
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    let currentQuestionIndex = 0; // Tracks the current question index
    let questions = []; // Array to store the fetched questions
    let selectedAnswers = []; // Array to store selected answer IDs 
    let selectedAnswerId = null; // Variable to track the selected answer ID

    // Function to load questions from the server
    function loadQuestions() {
        fetch('/quiz/get-questions')
            .then(response => response.json())
            .then(data => {
                console.log("Questions received:", data); 
                questions = data; // Store received questions
                loadQuestion(currentQuestionIndex); // Load the first question
            })
            .catch(error => console.error('Error loading questions:', error)); 
    }

    // Function to display a specific question
    function loadQuestion(index) {
        if (index >= questions.length) {
            document.getElementById('quiz-container').innerHTML = '<p>No quiz!</p>';
            return;
        }

        let questionData = questions[index];
        
        // Update UI with question data
        document.getElementById('question-number').innerText = `Question ${index + 1}/${questions.length}`;
        document.getElementById('category').innerText = questionData.category + ":";
        document.getElementById('question-text').innerText = questionData.question;
        document.getElementById('xp').innerText = "XP: +" + questionData.xp;

        const answerButtons = document.getElementById('answer-buttons');
        answerButtons.innerHTML = ''; // Clear previous answer buttons

        // Create and display answer buttons
        questionData.answers.forEach(answer => {
            const button = document.createElement('button');
            button.className = 'answer-button btn btn-dark m-2 p-2';
            button.innerText = answer.answer;
            button.dataset.answerId = answer.id; // Store answer ID in a data attribute
            answerButtons.appendChild(button);
        });

        document.getElementById('next-button').style.display = 'none'; // Hide the next button initially
        selectedAnswerId = null; // Reset selected answer ID
    }

    // Event listener for clicking on answer buttons
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('answer-button')) {
            const answerButtons = document.querySelectorAll('.answer-button');

            answerButtons.forEach(button => button.classList.remove('selected')); // Deselect all buttons
            event.target.classList.add('selected'); // Highlight the selected button
            selectedAnswerId = event.target.dataset.answerId; // Get selected answer ID

            document.getElementById('next-button').style.display = 'block'; // Show the next button

            // Update button text based on the current question index
            document.getElementById('next-button').innerText = 
                currentQuestionIndex === questions.length - 1 ? 'End of the quiz' : 'Next question';
        }
    });

    // Event listener for clicking the next button
    document.getElementById('next-button').addEventListener('click', function () {
        if (selectedAnswerId !== null) {
            selectedAnswers.push(selectedAnswerId); // Store selected answer
            submitAnswer(selectedAnswerId); // Submit the selected answer
        } else {
            console.error('No answer selected'); // Log an error if no answer is selected
        }

        // Check if it's the last question
        if (currentQuestionIndex === questions.length - 1) {
            document.getElementById('submit').innerHTML = `<button type="submit" id="submit-quiz" class="blue-btn m-2 p-2">Submit this quiz</button><br><img src="{{ asset('images/mister_quiz.png') }}" alt="">`;

            document.getElementById('submit-quiz').addEventListener('click', function () {
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`{{ route('quiz.submitQuiz') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ answers: selectedAnswers }) // Send selected answers
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url; // Redirect to results page
                    } else {
                        console.error('Error: Missing redirect URL.');
                    }
                })
                .catch(error => {
                    console.error('Error submitting quiz:', error);
                });
            });

        } else {
            currentQuestionIndex++; // Move to the next question
            loadQuestion(currentQuestionIndex); // Load the next question
        }
    });

    // Function to submit the selected answer to the server
    function submitAnswer(answerId) {
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`{{ route('quiz.submitAnswer') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token 
            },
            body: JSON.stringify({ answer_id: answerId }) // Send the selected answer ID
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error during submission: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Answer submitted successfully:', data);
        })
        .catch(error => {
            console.error('Error submitting answer:', error);
        });
    }

    loadQuestions(); // Start loading questions when the script runs
</script>

@endsection
