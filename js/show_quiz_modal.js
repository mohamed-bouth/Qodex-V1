const navBtn = document.querySelector(".right-btn");
const quizModal = document.querySelector("#createQuizModal");
const CancelBtn = document.querySelector("#CancelBtn");
const AddQuestion = document.querySelector("#AddQuestion");
const questionsContainer = document.getElementById('questionsContainer');
const quizForm = document.querySelector('.quiz-form');

let questionCount = 1;


function addQuestion() {
    questionCount++;
    const index = questionCount - 1;

    const questionHTML = `
        <div class="question-card">
            <div class="card-header">
                <h5 class="question-number">Question ${questionCount}</h5>
                <button type="button" class="btn-icon-danger delete-btn">
                    Delete
                </button>
            </div>

            <div class="form-group">
                <label class="form-label">Question *</label>
                <input type="text" name="questions[${index}][question]" required class="form-input" placeholder="Posez votre question...">
            </div>

            <div class="options-grid">
                <div class="form-group">
                    <label class="form-label-sm">Option 1 *</label>
                    <input type="text" name="questions[${index}][option1]" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label-sm">Option 2 *</label>
                    <input type="text" name="questions[${index}][option2]" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label-sm">Option 3 *</label>
                    <input type="text" name="questions[${index}][option3]" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label-sm">Option 4 *</label>
                    <input type="text" name="questions[${index}][option4]" required class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Réponse correcte *</label>
                <select name="questions[${index}][correct]" required class="form-input">
                    <option value="">Sélectionner la bonne réponse</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </div>
        </div>
    `;

    questionsContainer.insertAdjacentHTML('beforeend', questionHTML);
}

function closeModal() {
    quizModal.style.display = 'none';
    if (quizForm) quizForm.reset();

    questionsContainer.innerHTML = '';

    questionCount = 0;

    addQuestion();
}

function openModal() {
    quizModal.style.display = 'flex';
}

navBtn.addEventListener("click", openModal);
CancelBtn.addEventListener("click", closeModal);
AddQuestion.addEventListener("click", addQuestion);



questionsContainer.addEventListener("click", (e) => {
    
    if (e.target.closest('.delete-btn')) {
        const button = e.target.closest('.delete-btn');
        const questionBlock = button.closest('.question-card');
        
        questionBlock.remove();

        const questions = document.querySelectorAll('.question-card');
        questions.forEach((q, index) => {
            const title = q.querySelector('.question-number');
            title.textContent = `Question ${index + 1}`;
        });

        questionCount = questions.length;
    }
});



