let dateOfBirth = document.querySelector('.dateOfBirthInput')
let country = document.querySelector('.countryInput')
let name = document.querySelector('.nameInput')
let mail = document.querySelector('.mailInput')
let checkbox = document.querySelector('#cgu')
let signature = document.querySelector('.signature')

name.addEventListener("input", (event)=>{
    let nameEdit = document.querySelector('.name')
    nameEdit.textContent = `${event.target.value}`;
})
mail.addEventListener("input", (event)=>{
    let mailEdit = document.querySelector('.mail')
    mailEdit.textContent = `${event.target.value}`;
})
country.addEventListener("input", (event)=>{
    let countryEdit = document.querySelector('.country')
    countryEdit.textContent = `${event.target.value}`;
})

dateOfBirth.addEventListener("input", (event)=>{
    let dateOfBirthEdit = document.querySelector('.dateOfBirth')
    dateOfBirthEdit.textContent = `${event.target.value}`;
})

checkbox.addEventListener("click", (event)=>{
    signature.textContent = "Pret a voyager ?"
})
