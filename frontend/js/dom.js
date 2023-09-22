 import { C } from './constantes.js';

 export class DOM {
  static listar(form) {
    const $div = DOM.crearDiv(C.DIV_CONTAINER_BUTTON_ID, null, DOM.estilizarContenedorBoton);
    const $btn = DOM.crearBoton('submit', C.BTN_ENVIAR_PETICION_ID, C.BTN_ENVIAR_PETICION_TEXTCONTENT, DOM.estilizarBoton);
    $div.appendChild($btn);
    form.appendChild($div);
    form.setAttribute('method', 'GET');
  }

  static agregar(form) {
    const campos = [ 'legajo', 'nombre', 'apellido' ];
    form.setAttribute('method', 'POST');
    DOM.agregarElementos(campos);
  }

  static agregarElementos(campos) {
    const $fragment = document.createDocumentFragment();
    const $divPadre = DOM.crearDiv(C.DIV_CONTAINER_PADRE_ID, null, DOM.estilizarContenedorPadre);
    campos.forEach(item => {
      const $divHijo = DOM.crearDiv(null, C.DIV_CONTAINER_HIJO_CLASS, DOM.estilizarContenedorInput);
      const $input = DOM.crearInput('text', `txt-${item}`, item, `Ingrese ${item}`); // TODO: quitar magic strings
      const $label = DOM.crearLabel(item[0].toUpperCase() + item.substring(1), $input.id);
      $divHijo.append($label, $input);
      $divPadre.appendChild($divHijo);
    });
    const $contenedorBoton = DOM.crearDiv(C.DIV_CONTAINER_BUTTON_ID, null, DOM.estilizarContenedorBoton);
    const $btn = DOM.crearBoton('submit', C.BTN_ENVIAR_PETICION_ID, C.BTN_ENVIAR_PETICION_TEXTCONTENT, DOM.estilizarBoton);
    $contenedorBoton.appendChild($btn);
    $fragment.append($divPadre, $contenedorBoton);
    document.getElementById(C.FORM_CRUD_ID).appendChild($fragment);
  }

  static crearDiv(id, clase, darEstilo) {
    const $div = document.createElement('div');
    if (id !== null) $div.id = id;
    if (clase !== null) $div.className = clase;
    if (darEstilo !== null) darEstilo($div);
    return $div;
  }
  
  static crearInput(type, id, name, placeholder) {
    const $input = document.createElement('input');
    $input.type = type;
    $input.id = id;
    $input.name = name;
    $input.placeholder = placeholder;
    return $input;
  }
  
  static crearLabel(textContent, htmlFor) {
    const $label = document.createElement('label');
    $label.textContent = textContent;
    $label.htmlFor = htmlFor;
    return $label;
  }
  
  static crearBoton(type, id, textContent, darEstilo) {
    const $btn = document.createElement('button');
    $btn.type = type;
    $btn.id = id;
    $btn.textContent = textContent;
    if (darEstilo !== null) darEstilo($btn);
    return $btn;
  }

  // estilos
  static estilizarContenedorPadre(div) {
    div.style.display = "flex";
    div.style.flexDirection = "column";
    div.style.width = "85%";
    div.style.alignItems = "center";
  }
  
  static estilizarContenedorInput(div) {
    div.classList.add(C.DIV_CONTAINER_HIJO_CLASS);
  }

  static estilizarContenedorBoton(div) {
    div.style.width = "68%";
    div.style.display = "flex";
    div.style.justifyContent = "flex-end";
    div.style.margin = "25px 0";
  }

  static estilizarBoton(btn) {
    btn.style.fontSize = "16px";
    btn.style.fontFamily = "sans-serif";
    btn.style.backgroundColor = "#333";
    btn.style.color = "#fff";
    btn.style.padding = "10px 30px";
    btn.style.fontWeight = "bold";
    btn.onmouseover = function() {
      this.style.transition = "all 1.4s";
      this.style.backgroundColor = "rgb(20, 140, 20)";      
      this.style.cursor = "pointer";
    }
    btn.onmouseout = function() {
      this.style.backgroundColor = "#333";
    }
  }
}