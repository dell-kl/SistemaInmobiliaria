// (() => {

//clasificamos la manera en como vamos a guardar los respectivos archivos.
// let FILES = {
//     imagenes: new Map(),
//     planos: new Map(),
//     videos: new Map()
// };

// document.addEventListener("DOMContentLoaded", (e) => {
//     CargaArchivos();
// });


// function CargaArchivos(){
//     let SeccionesArchivos = document.querySelectorAll(".seccion-archivo");

//     SeccionesArchivos.forEach(elemento => {
//         //buscar el boton de agregar..
//         let tipoArchivo = elemento.id;

//         document.querySelector(`.buttonArchivo-${tipoArchivo}`).onclick = (e) => {
//             const gallery = document.getElementById(`gallery-${tipoArchivo}`);
//             const empty = document.getElementById(`empty-${tipoArchivo}`);
//             const hidden = document.getElementById(`hidden-input-${tipoArchivo}`);
//             hidden.click();

//             hidden.onchange = (j) => {
//                 for (const file of j.target.files) {
//                     addFile(gallery, file, tipoArchivo);
//                 }
//             };

//             gallery.onclick = ({ target }) => {
//                 if (target.classList.contains("delete")) {
//                     const ou = target.dataset.target;
//                     let elemento = document.getElementById(ou);
//                     console.log(elemento);
//                     elemento.remove(ou);
//                     gallery.children.length === 1 && empty.classList.remove("hidden");

//                     // FILES[tipoArchivo].delete(ou);
//                 }
//             };

//         };
//     });
// }


// function addFile(target, file, type) {
//     const isImage = file.type.match("image.*"),
//     objectURL = URL.createObjectURL(file);

//     const clone = isImage
//     ? document.getElementById(`image-template-${type}`).content.cloneNode(true)
//     : document.getElementById(`file-template-${type}`).content.cloneNode(true);

//     console.log(clone);

//     clone.querySelector("h1").textContent = file.name;
//     clone.querySelector("li").id = objectURL;
//     clone.querySelector(".delete").dataset.target = objectURL;
//     clone.querySelector(".size").textContent = file.size > 1024
//         ? file.size > 1048576
//         ? Math.round(file.size / 1048576) + "mb"
//         : Math.round(file.size / 1024) + "kb"
//         : file.size + "b";

//     isImage &&
//     Object.assign(clone.querySelector("img"), {
//         src: objectURL,
//         alt: file.name
//     });

//     //este es el mensaje de "Archvio no seleccionado" que vamos a ocultar.
//     document.getElementById(`empty-${type}`).classList.add("hidden");

//     console.log(target);

//     target.appendChild(clone);

//     // FILES[type].set(objectURL, file);

// }



    // let fileTempl = document.getElementById("file-template-imagenes") ? document.getElementById("file-template-imagenes") :
    //     document.getElementById("file-template-planos") ? document.getElementById("file-template-planos") :
    //     document.getElementById("file-template-videos") ? document.getElementById("file-template-videos") : null;


    // let imageTempl = document.getElementById("image-template-imagenes") ? document.getElementById("image-template-imagenes") :
    //     document.getElementById("image-template-planos") ? document.getElementById("image-template-planos") :
    //     document.getElementById("image-template-videos") ? document.getElementById("image-template-videos") : null;

    // let empty = document.getElementById("empty-imagenes") ? document.getElementById("empty-imagenes") :
    //         document.getElementById("empty-planos") ? document.getElementById("empty-planos") :
    //         document.getElementById("empty-videos") ? document.getElementById("empty-videos") : null;

    // let FILES = {};



    // //tenemos que especificar el tipo para hacer la subida del recurso.
    // const gallery = document.getElementById("gallery-imagenes") ? document.getElementById("gallery-imagenes") :
    //     document.getElementById("gallery-planos") ? document.getElementById("gallery-planos") :
    //     document.getElementById("gallery-videos") ? document.getElementById("gallery-videos") : null;

    // const overlay = document.querySelector(".overlay-imagenes") ? document.querySelector(".overlay-imagenes") :
    //     document.querySelector(".overlay-planos") ? document.querySelector(".overlay-planos") :
    //     document.querySelector(".overlay-videos") ? document.querySelector(".overlay-videos") : null;

    // // click the hidden input of type file if the visible button is clicked
    // // and capture the selected files
    // //debemos especificar justamente el tipo para este elemento general.
    // const hidden = document.getElementById("hidden-input-imagenes") ? document.getElementById("hidden-input-imagenes") :
    //     document.getElementById("hidden-input-planos") ? document.getElementById("hidden-input-planos") :
    //     document.getElementById("hidden-input-videos") ? document.getElementById("hidden-input-videos") : null;


    // (document.querySelector(".buttonArchivo-imagenes") ? document.querySelector(".buttonArchivo-imagenes") :
    //     document.querySelector(".buttonArchivo-planos") ? document.querySelector(".buttonArchivo-planos") :
    //     document.querySelector(".buttonArchivo-videos") ? document.querySelector(".buttonArchivo-videos") : null)
    //     .onclick = () => hidden.click();


    // hidden.onchange = (e) => {
    //     for (const file of e.target.files) {
    //     //agregamos dentro de nuestra lista algunos datos correspondientes ...
    //     addFile(gallery, file);
    //     }
    // };

    // // use to check if a file is being dragged
    // const hasFiles = ({ dataTransfer: { types = [] } }) =>
    // types.indexOf("Files") > -1;

    // // use to drag dragenter and dragleave events.
    // // this is to know if the outermost parent is dragged over
    // // without issues due to drag events on its children
    // let counter = 0;

    // // reset counter and append file to gallery when file is dropped
    // function dropHandler(ev) {
    //     ev.preventDefault();
    //     for (const file of ev.dataTransfer.files) {
    //         addFile(gallery, file);
    //         overlay.classList.remove("draggedover");
    //         counter = 0;
    //     }
    // }

    // // only react to actual files being dragged
    // function dragEnterHandler(e) {
    //     e.preventDefault();
    //     if (!hasFiles(e)) {
    //         return;
    //     }
    //     ++counter && overlay.classList.add("draggedover");
    // }

    // function dragLeaveHandler(e) {
    //     1 > --counter && overlay.classList.remove("draggedover");
    // }

    // function dragOverHandler(e) {
    //     if (hasFiles(e)) {
    //         e.preventDefault();
    //     }
    // }

    // // event delegation to caputre delete events
    // // fron the waste buckets in the file preview cards
    // gallery.onclick = ({ target }) => {
    //     if (target.classList.contains("delete")) {
    //         const ou = target.dataset.target;
    //         document.getElementById(ou).remove(ou);
    //         gallery.children.length === 1 && empty.classList.remove("hidden");
    //         delete FILES[ou];
    //     }
    // };

    // // print all selected files
    // document.getElementById("submit").onclick = () => {
    //     alert(`Submitted Files:\n${JSON.stringify(FILES)}`);
    //     console.log(FILES);
    // };

    // clear entire selection
    // document.getElementById("cancel").onclick = () => {
    //     while (gallery.children.length > 0) {
    //         gallery.lastChild.remove();
    //     }
    //     FILES = {};
    //     empty.classList.remove("hidden");
    //     gallery.append(empty);
    // };


// })();
