//Loading figure use to see if request id done
let loading = document.querySelector(".spinner-border");

//Ask request
httpRequest = new XMLHttpRequest();

//Name function for request
httpRequest.onreadystatechange = bourseInformation;

//Get the request with true to asynchronize
httpRequest.open('GET', 'statistical.json', true);
httpRequest.send();

//launch bourseInformation
function bourseInformation() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            loading.classList.add("d-none");
            let bourse = JSON.parse(httpRequest.response);
            show(bourse);
        } else {
            console.log("Problèmes de connexions");
        }
    } else {
        console.log("en attente");
    }
}
//function to show details from the variable bourse.
function show(data) {
  for(let preciseData in data) {
      let article = document.createElement("article");
      document.getElementById('card').appendChild(article);
      article.classList.add("card", "col-10", "mx-auto", "col-md-5", "col-lg-3", "my-4");
      article.style.width = "18rem";
      let title = document.createElement("h3");
      title.classList.add("card-header", "text-center");
      article.appendChild(title);
      title.innerText = preciseData;
      let ul = document.createElement("ul");
      article.appendChild(ul);
      ul.classList.add("list-group", "list-group-flush");
      for (let values in data[preciseData]) {
        let li = document.createElement("li");
        ul.appendChild(li);
        li.classList.add("list-group-item",  "col-10", "mx-auto");
        li.innerText = values + " : " + data[preciseData][values] ;
      }
  }
}
