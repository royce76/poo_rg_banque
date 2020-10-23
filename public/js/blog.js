//Loading figure use to see if request id done
let loading = document.querySelector(".spinner-border");

//Ask request
httpRequest = new XMLHttpRequest();

//Name function for request
httpRequest.onreadystatechange = blog;

//Get the request with true to asynchronize
httpRequest.open('GET', 'https://oc-jswebsrv.herokuapp.com/api/articles', true);
httpRequest.send();

//launch blog Information
function blog() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            loading.classList.add("d-none");
            let blog = JSON.parse(httpRequest.response)
            showBlog(blog);
        } else {
            console.log("Oups !!! Données non reçu");
        }
    } else {
        console.log("en attente");
    }
}

function showBlog(dataBlog) {
  for(let i=0; i < dataBlog.length; i++) {
    let article = document.createElement("article");
    document.getElementById('cardBlog').appendChild(article);
    article.classList.add("card", "col-10", "mx-auto", "col-md-5", "my-4");
    article.style.width = "18rem";
    let title = document.createElement("h3");
    title.classList.add("card-header", "text-center");
    article.appendChild(title);
    title.innerText = i;
    let ul = document.createElement("ul");
    article.appendChild(ul);
    ul.classList.add("list-group", "list-group-flush");
    for (let prop in dataBlog[i]) {
      let li = document.createElement("li");
      ul.appendChild(li);
      li.classList.add("list-group-item",  "col-10", "mx-auto");
      li.innerText = prop + " : " + dataBlog[i][prop] ;
    }
  }
}
