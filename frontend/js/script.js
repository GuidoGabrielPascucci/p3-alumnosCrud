import { DOM } from './dom.js';
import { C } from './constantes.js';

const select = document.getElementById(C.SELECT_ACCIONES_ID);
select.addEventListener('change', (event) => {
  const $form = document.getElementById(C.FORM_CRUD_ID);
  const $divInputs = document.getElementById(C.DIV_CONTAINER_PADRE_ID);
  const $divButton = document.getElementById(C.DIV_CONTAINER_BUTTON_ID);
  if ($form.contains($divInputs)) $form.removeChild($divInputs);
  if ($form.contains($divButton)) $form.removeChild($divButton);
  const accion = event.target.value;
  switch (accion) {
    case 'listar':
      DOM.listar($form);
      break;
    case 'agregar':
    case 'modificar':
    DOM.agregar($form);
      break;
    case 'remover':
      break;
    case 'verificarLegajo':
      break;
  }
});

// ---------------- FUNCIONES DE DOM HTML ----------------

function capitalizarPrimerLetra(cadena) {
  const cadenaResultante = cadena[0].toUpperCase() + cadena.substring(1);
  return cadenaResultante;
}

// ---------------- FUNCIONES XMLHttpRequest ----------------
function realizarPeticion(metodoHttp, url) {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 0 || (xhr.status >= 200 && xhr.status < 400)) {
        const response = xhr.responseText;
        console.log(response);
        // mostrarRespuesta(response);
      }
    }
  }
  xhr.open(metodoHttp, url);
  xhr.send();
}

function mostrarRespuesta(response) {
  const alumnos = JSON.parse(response);
  const $fragmento = document.createDocumentFragment();
  const $div = document.createElement('div');
  alumnos.forEach(alumno => {
    const $p = document.createElement('p');
    $p.textContent = alumno;
    $div.appendChild($p);
  });
  $fragmento.appendChild($div);
}



// select.selectedIndex = -1;

// function listar() {}

// PAGINA INTERESANTE DE <SELECT>
// https://stackoverflow.com/questions/8605516/set-the-select-option-as-blank-as-default-in-html-select-element#:~:text=Just%20set%20a%20check%20to,%3D%22%22%20then%20return%20false.&text=This%20would%20be%20a%20good,buttons%20instead%20of%20a%20dropdown.&text=Not%20a%20weird%20requirement%2C%20if,html5%2Fspec%2Dpreview%2F%E2%80%A6


// https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/change_event
// https://developer.mozilla.org/es/docs/Web/HTML/Element/select
// https://keepcoding.io/blog/eventtarget-en-javascript/
// https://es.stackoverflow.com/questions/465749/pasar-par%C3%A1metros-de-una-funci%C3%B3n-para-un-addeventlistener
// https://stackoverflow.com/questions/15750290/setting-the-html-label-for-attribute-in-javascript
// https://developer.mozilla.org/en-US/docs/Web/API/Element/append
// https://developer.mozilla.org/en-US/docs/Web/API/Request/method
// https://developer.mozilla.org/en-US/docs/Web/API/Node/contains
// https://developer.mozilla.org/es/docs/Web/API/HTMLStyleElement
// https://www.w3schools.com/css/css_howto.asp

// DISABLE BROWSER CACHE ---> NETWORK, DISABLE CACHE

// HOVER
// https://stackoverflow.com/questions/11371550/change-hover-css-properties-with-javascript
// https://stackoverflow.com/questions/1033156/how-can-i-write-ahover-in-inline-css

// CLASSES
// https://stackoverflow.com/questions/195951/how-can-i-change-an-elements-class-with-javascript