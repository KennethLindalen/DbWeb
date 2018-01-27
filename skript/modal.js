window.addEventListener('click', closeModal)

function openRegistrerModal(){
  registrerModal.style.display = 'block'
}

function openLoginModal(){
  loginModal.style.display = 'block'
}

function closeModal(e) {
  if (e.target.className == 'modal')
    document.getElementById(e.target.id).style.display = 'none'
}
