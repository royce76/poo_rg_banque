//Create the layer
function overlay(data) {
  let overlay = document.createElement('article');
  document.getElementById("body").appendChild(overlay);
  overlay.id = "overlay";
  let divOverlay = document.createElement("div");
  divOverlay.id = "divOverlay";
  divOverlay.classList.add("d-flex", "flex-column", "align-items-center","p-4");
  overlay.appendChild(divOverlay);
  let image = document.createElement('img');
  image.classList.add("my-4");
  divOverlay.appendChild(image);
  image.src = "public/img/layer.jpg";
  image.alt = "cadena";
  image.id = "imgOverlay";
  let title = document.createElement("h4");
  title.innerText = "Bienvenue chez RGS";
  divOverlay.appendChild(title);
  let textOverlay = document.createElement('p');
  divOverlay.appendChild(textOverlay);
  textOverlay.innerText = data;
  textOverlay.id = "textOverlay";
  textOverlay.classList.add("text-justify");
  let buttonOverlay = document.createElement("button");
  buttonOverlay.id = "buttonOverlay";
  divOverlay.appendChild(buttonOverlay);
  buttonOverlay.classList.add("btn","btn-primary");
  buttonOverlay.type = "submit";
  buttonOverlay.innerText = "Accepter";
  buttonOverlay.addEventListener("click", function() {
    sessionStorage.setItem("informed", true);
    overlay.style.display = "none";
  });
}

//launch layer
function security() {
  if (httpRequest.readyState === XMLHttpRequest.DONE) {
    if (httpRequest.status === 200) {
      divSpinner.classList.add("d-none");
      let security = JSON.parse(httpRequest.response);
      overlay(security["alert"]);
    } else {
      console.log("Oups !!! Où sont les données ?");
    }
  } else {
    console.log("en attente");
  }
}

if (!sessionStorage.setItem("informed")) {
  //Loading figure use to see if request is done
  let divSpinner = document.createElement("div");
  divSpinner.classList.add("spinner-border");
  divSpinner.role = "status";
  let main = document.getElementById("main");
  main.appendChild(divSpinner);
  let spanSpinner = document.createElement("span");
  spanSpinner.classList.add("sr-only");
  divSpinner.appendChild(spanSpinner);
  spanSpinner.innerText = "Loading...";


  //Ask request
  httpRequest = new XMLHttpRequest();

  //Name function for request
  httpRequest.onreadystatechange = security;

  //Get the request with true to asynchronize
  httpRequest.open('GET', 'main.json', true);
  httpRequest.send();
}
