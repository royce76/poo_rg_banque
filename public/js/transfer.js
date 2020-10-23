let selectEmetteur = document.getElementById('compte_emetteur');
let selectBeneficiaire = document.getElementById('compte_beneficiaire');

let emetteurs = document.getElementsByClassName('emetteur');
let beneficiaires = document.getElementsByClassName('beneficiaire');

function notClickSameAccount() {
  if (selectEmetteur.value === selectBeneficiaire.value) {
    selectBeneficiaire.value = "";
  }
}

selectBeneficiaire.addEventListener("click", notClickSameAccount);

function notClickSameAccounts() {
  if (selectEmetteur.value === selectBeneficiaire.value) {
    selectEmetteur.value = "";
  }
}

selectEmetteur.addEventListener("click", notClickSameAccounts);
