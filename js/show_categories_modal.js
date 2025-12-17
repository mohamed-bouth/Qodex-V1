const openBtn = document.querySelector("#openBtn")
const categoriesModal = document.querySelector("#categoriesModal")
const closeBtn = document.querySelector("#closeBtn")
const cancelBtn = document.querySelector("#cancelBtn")

let flage = false
function renderCategories(){
    if(flage === false){
        categoriesModal.className = "modal active"
        flage = true
    }else{
        categoriesModal.className = "modal"
        flage = false
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