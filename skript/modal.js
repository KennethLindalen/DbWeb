window.addEventListener('click', closeModal)

function openRegistrerModal(){
  registrerModal.style.display = 'block'
}

function openLoginModal(){
  loginModal.style.display = 'block'
}

function closeModal(e) {
  let target = e.target
  if (target.className == 'modal')
    target.style.display = 'none'
}
