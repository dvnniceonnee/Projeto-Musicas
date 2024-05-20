/**
 function changeAspect(){
 if(screenSize < 725){
 let elementos = document.querySelectorAll("#divMusicaNome");
 let imagens = document.querySelectorAll("#divImagem");
 for(let i = 0; i < imagens.length; i++){
 elementos[i].className = "d-none";
 imagens[i].className = "mx-2 p-0 my-auto mx-auto";
 }
 }
 }
 */

function addGenreToList() {
    const selectOptions = document.getElementById('selectInput').selectedOptions
    console.log(selectOptions)
    var genresAdded = document.querySelectorAll('#listInputGenres>li');
    for (let selected of selectOptions) {
        let exists = false;
        for (let x of genresAdded) {
            if (x.textContent === selected.textContent) {
                exists = true;
            }
        }
        if (!exists) {
            const button = document.createElement("li");
            const textButton = document.createTextNode(selected.textContent)
            button.classList.add('btn', 'btn-success', 'rounded-pill', 'col-3')
            button.appendChild(textButton)
            document.getElementById("listInputGenres").appendChild(button)
        }
    }
    var genresAdded = document.querySelectorAll('#listInputGenres>li');
    let listGenresElement = document.getElementById('listInputGenres')
    for (let genre of genresAdded) {
        let remove = true;
        for (let selected of selectOptions) {
            if (genre.textContent == selected.textContent) {
                remove = false
            }
        }
        if (remove) {
            listGenresElement.removeChild(genre);
        }
    }
}

function checkBand(element) {
    const checkedBand = document.querySelectorAll("[name='band_id']")
    for (let check of checkedBand) {
        if (check.checked) {
            console.log(check.id)
            document.getElementById('label' + check.id).classList.remove('btn-success')
        }
    }
    const checkeclabel = document.getElementById('label' + checkedBand)
    var check = element;
    check.classList.add('btn-success')
}

function checkAlbum(element) {
    const checkedAlbum = document.querySelectorAll("[name='album_id']")
    for (let check of checkedAlbum) {
        if (check.checked) {
            console.log(check.id)
            document.getElementById('label' + check.id).classList.remove('btn-success')
        }
    }
    const checkedlabel = document.getElementById('label' + checkedAlbum)
    var check = element;
    check.classList.add('btn-success')
}


let tableBands = new DataTable('#TableBands', {
    responsive: true,
    pageLength: 10,
    columns: [{ orderable: false }, { orderable: true }, { orderable: true }, { orderable: true }, { orderable: false },{ orderable: false }],
    layout: {
        topStart: null
    },
});
let tableMusics = new DataTable('#TableMusics', {
    responsive: true,
    pageLength: 10,
    columns: [{ orderable: false }, { orderable: true }, { orderable: true }, { orderable: true }, { orderable: true },{ orderable: false }, { orderable: false }],
    layout: {
        topStart: null,
        topEnd: 'search'
    },
    topEnd: {
        search: {
            placeholder: 'Type search here'
        }
    },
});
let tableAlbums = new DataTable('#TableAlbums', {
    responsive: true,
    pageLength: 10,
    columns: [{ orderable: false}, { orderable: true }, { orderable: true}, { orderable: true },{ orderable: true }, { orderable: false},{ orderable: false }],
    layout: {
        topStart: null
    },

});








