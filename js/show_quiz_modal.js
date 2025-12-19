const navBtn = document.querySelector(".right-btn");
const quizModal = document.querySelector("#createQuizModal");
const CancelBtn = document.querySelector("#CancelBtn");
const AddQuestion = document.querySelector("#AddQuestion");
const questionsContainer = document.getElementById('questionsContainer');
const quizForm = document.querySelector('.quiz-form');
const numQuestion = document.querySelector("#num_question");
const titreInput = document.querySelector("#titreInput");
const descriptionInput = document.querySelector("#descriptionInput");
const titreLabel = document.querySelector("#titreLabel");
const descriptionLabel = document.querySelector("#descriptionLabel");
const editBtns = document.querySelectorAll("#editBtn");
const question = document.querySelector("#question");
const option = document.querySelectorAll(".option");
const form = document.querySelector("#quizForm")
let questionCount = numQuestion.value + 1;

let editNumQuestion = null
quetionData = null
function addQuestion(quetionData, option1, option2, option3, option4) {
    if (typeof quetionData != "string") {
        quetionData = ""
    }
    if (typeof option1 != "string") {
        option1 = ""
    }
    if (typeof option2 != "string") {
        option2 = ""
    }
    if (typeof option3 != "string") {
        option3 = ""
    }
    if (typeof option4 != "string") {
        option4 = ""
    }


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
                <input type="text" name="questions[${index}][question]" value="${quetionData}" class="form-input" placeholder="Posez votre question...">
            </div>

            <div class="options-grid">
                <div class="form-group">
                    <label class="form-label-sm">Option 1 *</label>
                    <input type="text" name="questions[${index}][option1]" value="${option1}" class="form-input option">
                </div>
                <div class="form-group">
                    <label class="form-label-sm">Option 2 *</label>
                    <input type="text" name="questions[${index}][option2]" value="${option2}" class="form-input option">
                </div>
                <div class="form-group">
                    <label class="form-label-sm">Option 3 *</label>
                    <input type="text" name="questions[${index}][option3]" value="${option3}" class="form-input option">
                </div>
                <div class="form-group">
                    <label class="form-label-sm">Option 4 *</label>
                    <input type="text" name="questions[${index}][option4]" value="${option4}" class="form-input option">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Réponse correcte *</label>
                <select name="questions[${index}][correct]"  class="form-input">
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
    form.action = "./add_quiz.php"
    if (quizForm) quizForm.reset();

    questionsContainer.innerHTML = '';

    questionCount = 0;

    addQuestion();
    titreInput.value = ''
    descriptionInput.value = ''
    titreLabel.textContent = "Quiz title *"
    titreLabel.style.color = "black"
    descriptionLabel.textContent = "Description"
    descriptionLabel.style.color = "black"
}

function openModal() {
    quizModal.style.display = 'flex';
}

navBtn.addEventListener("click", openModal);
CancelBtn.addEventListener("click", closeModal);
AddQuestion.addEventListener("click", addQuestion);


document.addEventListener("DOMContentLoaded", function () {
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
    })
});
let catData = [];

function fetchData(id) {
    return fetch("search_quiz.php?id=" + id)
        .then(res => res.json());
}

editBtns.forEach(editBtn => {
    editBtn.addEventListener("click", () => {
        function replaceData(idd) {
            // داخل دالة فتح الـ Edit
            let hiddenInput = document.querySelector('input[name="quiz_id_form"]');
            if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "quiz_id_form";
                document.getElementById('quizForm').appendChild(hiddenInput);
            }
// quizId هو المتغير الذي يحمل رقم الكويز الذي ضغطت عليه
            let id
            if(!idd){
                 id = editBtn.dataset.id;
                 hiddenInput.value = editBtn.dataset.id;
            }else{
                id = idd
                hiddenInput.value = idd;
            }
            form.action = "./edit_quiz.php"
            
            fetchData(id).then(data => {
                catData = data;

                openModal();
                questionsContainer.innerHTML = '';
                questionCount = 0;

                titreInput.value = catData[0].title;
                descriptionInput.value = catData[0].description;

                for (let index = 0; index < catData.length; index++) {
                    addQuestion(catData[index].question, catData[index].option_1, catData[index].option_2, catData[index].option_3, catData[index].option_4)
                }
            });
        }
        replaceData()
    });
});






