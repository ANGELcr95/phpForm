                    // This section is show password or hidden password
let formulario = document.getElementById('formulario')
let inputs = document.querySelectorAll('#formulario input') // creamos un arrglo para traer todo los input
let push = document.getElementById("eye"); 
let password = inputs[1];

push.addEventListener('mouseover' ,passwordShow)
push.addEventListener('mouseout' ,passwordShow)

function passwordShow(){
    if(password.type == "password"){
        password.type = "text"
        push.src = "img/hidden.png"
        // function hidden(){
            //password.type = "password";
            //push.src = "img/show.png"
            // }
            // setTimeout("hidden()", 1000); esto lo dejo para poder ejecutarlo 
    } else {
        password.type = "password";
        push.src = "img/show.png"
    }
}

                    // This section is show password or hidden password2
let push2 = document.getElementById("eye2"); 
let password2 = document.getElementById("password2");

push2.addEventListener('mouseover' ,passwordShow2)
push2.addEventListener('mouseout' ,passwordShow2)

function passwordShow2() {
    if(password2.type == "password"){
        password2.type = "text"
        push2.src = "img/hidden.png"
    } else {
        password2.type = "password";
        push2.src = "img/show.png"
    }
}

                // Es para hacer comprativas con expresiones regulares
let expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}
                // Es para comparar cada input con las expesiones y asi agregar clases
let validarCampo = (expresion, input, campo) => {
    if(expresion.test(input)){  // aqui comparo la cadena con una expesion regular
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
    }
}

                // Es para poder hacer dinamico la entrada de los inputs
let validarFormulario = (e) => {
    switch (e.target.name) {  // aaui identifico el nombre del input
        case "email":  // se ejecuta cuando el name del input sea igual al case
			validarCampo(expresiones.correo, e.target.value , e.target.name);
        break;
        case "password":
            validarCampo(expresiones.password, e.target.value , e.target.name);
            comparePassword()
        break;
        case "confirm_password":
            comparePassword()
        break
    }
}
                // Comparacion de la contrasena
let comparePassword = () => {
    if(inputs[1].value === inputs[2].value && inputs[2].value != "" ) {
        // yo lo que hago aqui es basicamnete traerme el elemendto por el Id y y a ese elemento agregarle la clsae y los elementos que esten dentro de estes tomaran las propiedades segun el estilo que halla definido para esta
        document.getElementById('grupo__confirm_password').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__confirm_password').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__confirm_password i').classList.add('fa-check-circle');
        document.querySelector('#grupo__confirm_password i').classList.remove('fa-times-circle');
        document.querySelector('#grupo__confirm_password .formulario__input-error').classList.remove('formulario__input-error-activo');

    } else {
        document.getElementById('grupo__confirm_password').classList.add('formulario__grupo-incorrecto');
        document.getElementById('grupo__confirm_password').classList.remove('formulario__grupo-correcto');
        document.querySelector('#grupo__confirm_password i').classList.add('fa-times-circle');
        document.querySelector('#grupo__confirm_password i').classList.remove('fa-check-circle');
        document.querySelector('#grupo__confirm_password .formulario__input-error').classList.add('formulario__input-error-activo');
       
    }
}
                // For each para los input
inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario)
    input.addEventListener('blur', validarFormulario)  // cuando le den un click fuera del input ejecuta igual esa funcion
    
})
                // Es para agregar el boton de check de al condicional
let caja = document.getElementById("condiciones");
function palomita(){
    if(caja.checked) {
        document.getElementById('grupo__condiciones').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__condiciones').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__condiciones i').classList.add('fa-check-circle');
        document.querySelector('#grupo__condiciones i').classList.remove('fa-times-circle');
        document.querySelector(`#grupo__condiciones .formulario__input-error`).classList.remove('formulario__input-error-activo');

        
    }else{
        document.getElementById('grupo__condiciones').classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__condiciones .formulario__input-error`).classList.add('formulario__input-error-activo');

    }
}
caja.addEventListener('click' ,palomita)
                // Es para poder evitar que sin los inputs no se cumplen no envien el formulario
let envioCondiciones = () => {
    if(!expresiones.correo.test(inputs[0].value)
     || expresiones.password.test(inputs[1].value) == false  
     || expresiones.password.test(inputs[2].value) == false 
     || inputs[1].value != inputs[2].value  
     || inputs[0].value == "" 
     || !inputs[1].value.length
     || inputs[2].value == ""  
     || !caja.checked){
         return false;
     }
     return true;
     
}
formulario.addEventListener('mouseover', envioCondiciones)
formulario.addEventListener('keyup', envioCondiciones)

formulario.addEventListener('submit', (e) => {
    if(!envioCondiciones()) {
        e.preventDefault();
    }
});



const conditions = document.getElementById('conditions');

const modal_container = document.getElementById('modal_container');
const close = document.getElementById('close');

conditions.addEventListener('click', () => {
  modal_container.classList.add('show');  
});

close.addEventListener('click', () => {
  modal_container.classList.remove('show');
});