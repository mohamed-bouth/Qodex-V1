const openBtn = document.querySelector("#openBtn")
const categoriesModal = document.querySelector("#categoriesModal")
const closeBtn = document.querySelector("#closeBtn")
const cancelBtn = document.querySelector("#cancelBtn")
const nameLabel = document.querySelector("#nameLabel")
const descriptionLabel = document.querySelector("#descriptionLabel")

let flage = false
function renderCategories(){
    if(flage === false){
        categoriesModal.className = "modal active"
        flage = true
    }else{
        categoriesModal.className = "modal"
        flage = false
        categoryForm.action = './delete_categories.php'
        submitBtn.textContent = "Create"
        nameInput.value = ''
        descriptionInput.value = ''
        nameLabel.textContent = "Category name"
        descriptionLabel.textContent = "Description"
    }
}

openBtn.addEventListener("click" , () => {
    renderCategories()
})

closeBtn.addEventListener("click" , () => {
    renderCategories()
})

cancelBtn.addEventListener("click" , () => {
    renderCategories()
})

const editbtn = document.querySelectorAll("#editbtn")
const categoryForm = document.querySelector("#categoryForm")
const submitBtn = document.querySelector("#submitBtn")
const nameInput = document.querySelector("#nameInput")
const descriptionInput = document.querySelector("#descriptionInput")
const catgId = document.querySelector("#catg-id")


editbtn.forEach(btn => {
    btn.addEventListener("click" , ()=> {
        categoryForm.action = './edit_categories.php'
        submitBtn.textContent = "Edit"
        nameInput.value = btn.dataset.name
        descriptionInput.value = btn.dataset.description
        catgId.value = btn.dataset.id

        renderCategories();
        console.log(btn.dataset.id)
        console.log(btn.dataset.name)
        console.log(btn.dataset.description)
    })
});

