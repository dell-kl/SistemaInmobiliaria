<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/config.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/propiedades.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/tailwaind.css') }}">
    <title>Lista Propiedades</title>
</head>
<body>
    <header class="flex flex-row justify-between px-4 pt-2 mb-2">
        <div class="flex flex-row items-baseline gap-2">
            <h1 class="logo font-bold text-5xl">LJZC</h1>
            <p class="mensaje text-2xl">Panel de gestion de propiedades</p>
        </div>
        <div class="flex flex-row items-center gap-2">
            <div class="logo-perfil p-2 rounded-full">
                <p class="inicial text-3xl px-2">A</p>
            </div>

            <li class="nav-item dropdown list-none">
                <a class="nav-link dropdown-toggle text-3xl" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                </a>
                <ul class="dropdown-menu list-none">
                  <li><a class="dropdown-item" href="#">Perfil</a></li>
                  <li><a class="dropdown-item" href="#">Cerrar Sesion</a></li>
                </ul>
              </li>
        </div>
    </header>

    <div class="w-full propiedades" style="background-color: #F2F2F2;">
        <div class="m-auto pt-5" style="width:85.5%;">
            <button class="btn btn-warning flex flex-row items-center gap-2" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <img src="/icons/home.png" width="50"/>
                Agregar Propiedad
            </button>
    
            <div class="filtro pt-4">
                <div class="bg-white w-3/12 text-center fw-bold rounded-t-lg p-2 text-xl">Filtrar Propiedades</div>
                <div class="bg-white p-3 rounded-r-lg">
                    <div class="row">
                        <div class="col">
                            <select class="form-select border-2 border-black" aria-label="Default select example">
                                <option selected>Tipo</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select border-2 border-black" aria-label="Default select example">
                                <option selected>Caracteristica</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control border-2 border-black" placeholder="Escribe lo que deseas buscar"/>
                        </div>
    
                        <div class="col">
                            <input type="submit" class="btn btn-buscar text-white w-50"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-auto propiedades-listado pt-4 flex flex-row flex-wrap gap-4 items-center pb-2" style="width:85.5%;">
            @livewire('propiedad')
            @livewire('propiedad')
            @livewire('propiedad')
            @livewire('propiedad')
            @livewire('propiedad')
            @livewire('propiedad')
        </div>

        <div class="w-11/12 m-auto flex flex-row items-center justify-center gap-2 paginador py-4">
            <a href="#" class="group">
                <li class="active px-2 w-100 h-10 text-gray-800 grid place-items-center rounded-md border lg:border-2 border-green-700 group-hover:bg-green-700">
                  <span class="text-green-700 font-medium group-hover:text-slate-200">◀️ Retroceder</span>
                </li>
              </a>
    
              <a href="#" class="group">
                <li class="w-100 px-2 h-10 text-gray-800 grid place-items-center rounded-md border lg:border-2 border-red-700 group-hover:bg-red-700">
                  <span class="text-red-700 font-medium group-hover:text-slate-200">Continuar ▶️</span>
                </li>
              </a>
        </div>  
    </div>

    @livewire('registro-propiedad')
    <script>
        const fileTempl = document.getElementById("file-template"),
        imageTempl = document.getElementById("image-template"),
        empty = document.getElementById("empty");
        
        // use to store pre selected files
        let FILES = {};
        
        // check if file is of type image and prepend the initialied
        // template to the target element
        function addFile(target, file) {
        const isImage = file.type.match("image.*"),
          objectURL = URL.createObjectURL(file);
        
        const clone = isImage
          ? imageTempl.content.cloneNode(true)
          : fileTempl.content.cloneNode(true);
        
        clone.querySelector("h1").textContent = file.name;
        clone.querySelector("li").id = objectURL;
        clone.querySelector(".delete").dataset.target = objectURL;
        clone.querySelector(".size").textContent =
          file.size > 1024
            ? file.size > 1048576
              ? Math.round(file.size / 1048576) + "mb"
              : Math.round(file.size / 1024) + "kb"
            : file.size + "b";
        
        isImage &&
          Object.assign(clone.querySelector("img"), {
            src: objectURL,
            alt: file.name
          });
        
        empty.classList.add("hidden");
        target.prepend(clone);
        
        FILES[objectURL] = file;
        }
        
        const gallery = document.getElementById("gallery"),
        overlay = document.getElementById("overlay");
        
        // click the hidden input of type file if the visible button is clicked
        // and capture the selected files
        const hidden = document.getElementById("hidden-input");
        document.getElementById("button").onclick = () => hidden.click();
        hidden.onchange = (e) => {
        for (const file of e.target.files) {
          addFile(gallery, file);
        }
        };
        
        // use to check if a file is being dragged
        const hasFiles = ({ dataTransfer: { types = [] } }) =>
        types.indexOf("Files") > -1;
        
        // use to drag dragenter and dragleave events.
        // this is to know if the outermost parent is dragged over
        // without issues due to drag events on its children
        let counter = 0;
        
        // reset counter and append file to gallery when file is dropped
        function dropHandler(ev) {
        ev.preventDefault();
        for (const file of ev.dataTransfer.files) {
          addFile(gallery, file);
          overlay.classList.remove("draggedover");
          counter = 0;
        }
        }
        
        // only react to actual files being dragged
        function dragEnterHandler(e) {
        e.preventDefault();
        if (!hasFiles(e)) {
          return;
        }
        ++counter && overlay.classList.add("draggedover");
        }
        
        function dragLeaveHandler(e) {
        1 > --counter && overlay.classList.remove("draggedover");
        }
        
        function dragOverHandler(e) {
        if (hasFiles(e)) {
          e.preventDefault();
        }
        }
        
        // event delegation to caputre delete events
        // fron the waste buckets in the file preview cards
        gallery.onclick = ({ target }) => {
        if (target.classList.contains("delete")) {
          const ou = target.dataset.target;
          document.getElementById(ou).remove(ou);
          gallery.children.length === 1 && empty.classList.remove("hidden");
          delete FILES[ou];
        }
        };
        
        // print all selected files
        document.getElementById("submit").onclick = () => {
        alert(`Submitted Files:\n${JSON.stringify(FILES)}`);
        console.log(FILES);
        };
        
        // clear entire selection
        document.getElementById("cancel").onclick = () => {
        while (gallery.children.length > 0) {
          gallery.lastChild.remove();
        }
        FILES = {};
        empty.classList.remove("hidden");
        gallery.append(empty);
        };
        
        </script>
        
        <style>
        .hasImage:hover section {
        background-color: rgba(5, 5, 5, 0.4);
        }
        .hasImage:hover button:hover {
        background: rgba(5, 5, 5, 0.45);
        }
        
        #overlay p,
        i {
        opacity: 0;
        }
        
        #overlay.draggedover {
        background-color: rgba(255, 255, 255, 0.7);
        }
        #overlay.draggedover p,
        #overlay.draggedover i {
        opacity: 1;
        }
        
        .group:hover .group-hover\:text-blue-800 {
        color: #2b6cb0;
        }
        </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>