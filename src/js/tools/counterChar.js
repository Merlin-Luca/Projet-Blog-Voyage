let resume = document.querySelector('#resumeText')
resume.addEventListener("input", ()=>{
    let resumeEdit = document.querySelector('.resume')
    resumeEdit.textContent = `${"Votre texte fait : " + resume.textLength + " caractères"}`;
    if(resume.textLength < 1){
        resumeEdit.textContent = "";
    }
    if(resume.textLength > 250){
        resumeEdit.style.color = "red";
    }
    if(resume.textLength <= 250){
        resumeEdit.style.color = "black";
    }
})

let commentaires = document.querySelector('#commentaires')
commentaires.addEventListener("input", ()=>{
    let commentairesEdit = document.querySelector('.commentaires')
    commentairesEdit.textContent = `${"Votre texte fait : " + commentaires.textLength + " caractères"}`;
    if(commentaires.textLength < 1){
        commentairesEdit.textContent = "";
    }
    if(commentaires.textLength > 250){
        commentairesEdit.style.color = "red";
    }
    if(commentaires.textLength <= 250){
        commentairesEdit.style.color = "black";
    }
})