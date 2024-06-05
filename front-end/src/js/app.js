function cambiarIconoClave(){
    const passwordField = document.getElementById('clave');
    const showEye = document.getElementById('show-eye');
    const hideEye = document.getElementById('hide-eye');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Cambiar el icono dependiendo del estado
    if (type === 'password') {
        showEye.style.display = 'none';
        hideEye.style.display = 'block';
    } else {
        showEye.style.display = 'block';
        hideEye.style.display = 'none';
    }
}

const chatBox = document.getElementById('chat-box');
const chatContainer = document.getElementById('chat-container');
const questionButtons = document.getElementById('question-buttons');

const responses = {
    "¿Qué servicios ofrece la Clínica Veterinaria Patitas Contentas?": "En Patitas Contentas ofrecemos consultas médicas, vacunación y desparacitación, cirugías, servicios de emergencia, guardería y peluquería. Encuentra más información en nuestra sección de <a href='servicios.php'>Servicios</a>.",
    "¿Cuál es el horario de atención?": "Tenemos atención de Lunes a Sábado de 8 am a 6 pm, jornada continua. Para emergencias y guardería tenemos atención 24/7.",
    "¿Dónde están ubicados?": "Estamos ubicados en Calle 19 #12-45, Barrio San Francisco, Pereira, Risaralda, Colombia. Visítanos y obtén la mejor atención.",
    "¿Puedo comprar alimentos y suplementos en la Clínica Veterinaria Patitas Contentas?": "Claro que sí. Solo es que te comuniques con nosotros o visites nuestro punto físico. Encuentra toda la información en <a href='contactanos.php'>Contáctanos</a>.",
    "¿Cómo puedo agendar una cita para mi mascota?": "Puedes <a href='registrarse.php'>registrarte</a> o <a href='contactanos.php'>contactarnos</a> para mayor asesoría.",
    "¿Qué hago en caso de una emergencia veterinaria?": "Si tu mascota tiene una emergencia, comunícate con nosotros al +57 323 303 9679 o acude a nuestra clínica en Calle 19 #12-45, Barrio San Francisco, Pereira, Risaralda, Colombia."
};

function selectQuestion(question) {
    addMessageUser(question, 'user-message');
    setTimeout(() => {
        const botResponse = getBotResponse(question);
        addMessageBot(botResponse, 'bot-message');
    }, 500);
}

const userIcon = `
            <svg width="33" height="30" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="90" height="90" fill="url(#pattern0_578_68)"/>
                <defs>
                <pattern id="pattern0_578_68" patternContentUnits="objectBoundingBox" width="1" height="1">
                <use xlink:href="#image0_578_68" transform="scale(0.0111111)"/>
                </pattern>
                <image id="image0_578_68" width="40" height="41" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEM0lEQVR4nO2cW4scVRCAj0bF+KDgLYJoDImaqRrWwIqsqCiiQR98HDVR8DJ9qnUXCfkFyaMoGMULIeiTmj8g+OKDSLwR4wVNzDI7XTVZDIEkmoigrolOOJ3RBJMYdzLd1dunPihYdgdm6qO2OFNd3c4ZhmEYhmEYhmEY82emDSt6BFPscSt7/IoJfxSCP0Kwx4P57zxuFY+TewiXD/EW8fLhhrsv6CXwGHv4VAj78wkm+EQI1vZbrUXaeVQaIXhAPHbmK/iU8DDNhKu186kce2n8Evbw5jkLPjW2zK6fWKydXyXoPjN2NRN+WYDkv6v7i85Tq65ysUsWD9OFST6plUQre29oF0VW8mkqW55YerGLDS6mJ58tNruYYMLVCpIHld140MVyTpZRHOGGDCbYHcU5O6Pm42rV/E9V46Ou7jDhZ9qi2cPHru6zC9Gu5rx94F+9ZGyZqys9giltySdVderqCodJWwUkD6r6HVdXmPDr6oiGHa6usMeD2oJPBOx3dUUI5/QFD8Lj766uiLbcf4WrK1IBuSaaTPQoK3pOu4qj6NFsp46SRJOdo8sS/W51Wge87eqKeJxUFxzDrGMP4fIwOVOXHD5DevMNrs7wEBtIBcQ2V3eEYK22aE4aD7u602+1FpWyy3HG3oy7orhmGMjS5v1aonsJ3OtiQgi3lF7NBG+42JhdP7E43x4qT/TnUW4qBcI+XBn9OuxyTNNNV7qY6QTZBNuLrORoFxxP20YINxfRk6NtF/9F5hv3hX/zcxbscVd0p4uhztkprAnbRPP5uj547TYmfKS/wZ2vnceCopeMLQvDn7CDEXapB/PsuUEcCCsD+d88pLWfXRiGYRiGYRiGYURDRuOXCTVv5wS8ELzMhO/ns+TwxAKP+5jwtzzyn2F3uPkovIY9bMoIE0lWTnSeW3Gpdh6VQybhmnDBlgneYg/ZCCd33fzu3BTWZO3mEhcjksAq8fACE+4seuh/YuAE34rH57N2c8zVmYzgeva4Ljyepwy5ZxujiseN3bRxo6sLGcGdQvBeFTaUzjBa/SAjfKjv3HluobGzBRf1UmyLx++0Zcr/DQ/fSAJP7qDxC91CIFSHEM6oi6NhhWOHCVqVrfAshdvCVRF1UTQy4R91qXmrq9hjITYywVF1OTTaYI9/CsEr6u0kXD46/qw5fSlSaMD28MAAJcl4jxAc1peA5VQ3waEsadxVquTwhuFrsHbyUrZsD7/2UryjFMk/TK28IlyB1k5a9OLAbBsuL1w0E75UgWT7ugEvFi5a88FTUpFggu8LFx36lHaioh0efylctBD21BMl9YruliH6Ve1ERVu0h02Fi55Nb7mWPfyknayoBRyeeRavc6Xd7OPx5+gqmeBQ6evA+aYnwev5tMvDkdrK9XDkeI74Gj/dWFqqZMMwDMMwDMMwDMMwDFdNjgHNgLIxzCGxawAAAABJRU5ErkJggg=="/>
                </defs>
            </svg>
        `;

const botIcon = `
            <svg width="45" height="46" viewBox="0 0 45 46" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="22.5" cy="22.7659" r="22.5" fill="#EDEDED"/>
            <path d="M34 20.6333V16.6667C34 15.9594 33.719 15.2811 33.2189 14.781C32.7188 14.2809 32.0405 14 31.3333 14H23.3333V12.2507C23.74 11.8853 24 11.36 24 10.7707C24 10.2402 23.7892 9.73152 23.4142 9.35645C23.0391 8.98137 22.5304 8.77066 22 8.77066C21.4695 8.77066 20.9608 8.98137 20.5857 9.35645C20.2107 9.73152 20 10.2402 20 10.7707C20 11.36 20.26 11.8853 20.6666 12.2507V14H12.6666C11.9594 14 11.2811 14.2809 10.781 14.781C10.2809 15.2811 9.99996 15.9594 9.99996 16.6667V20.664L9.90396 20.6707C9.56781 20.6946 9.25323 20.8451 9.02363 21.0918C8.79402 21.3384 8.66645 21.663 8.66663 22V24.6667C8.66663 25.0203 8.8071 25.3594 9.05715 25.6095C9.3072 25.8595 9.64634 26 9.99996 26V32.6667C9.99996 33.3739 10.2809 34.0522 10.781 34.5523C11.2811 35.0524 11.9594 35.3333 12.6666 35.3333H31.3333C32.0405 35.3333 32.7188 35.0524 33.2189 34.5523C33.719 34.0522 34 33.3739 34 32.6667V26C34.3536 26 34.6927 25.8595 34.9428 25.6095C35.1928 25.3594 35.3333 25.0203 35.3333 24.6667V22.0827C35.3487 21.8757 35.3159 21.668 35.2373 21.476C34.968 20.8253 34.3906 20.6693 34 20.6333ZM15.3333 22C15.3333 20.528 16.2293 19.3333 17.3333 19.3333C18.4373 19.3333 19.3333 20.528 19.3333 22C19.3333 23.472 18.4373 24.6667 17.3333 24.6667C16.2293 24.6667 15.3333 23.472 15.3333 22ZM27.3306 30C25.996 29.996 16.6666 30 16.6666 30V27.3333C16.6666 27.3333 26.0013 27.3307 27.336 27.3333L27.3306 30ZM26.6666 24.6667C25.5626 24.6667 24.6666 23.472 24.6666 22C24.6666 20.528 25.5626 19.3333 26.6666 19.3333C27.7706 19.3333 28.6666 20.528 28.6666 22C28.6666 23.472 27.7706 24.6667 26.6666 24.6667Z" fill="#DF662B"/>
            </svg>  
        `; 

function addMessageBot(message, className){
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', className);

    const newDivElement = document.createElement('div');
    newDivElement.classList.add('response-bot');

    const icon = document.createElement('div');
    icon.innerHTML = botIcon;
    newDivElement.appendChild(icon);

    const text = document.createElement('span');
    text.innerHTML = message;
    
    messageElement.appendChild(text);
    newDivElement.appendChild(messageElement);

    chatBox.appendChild(newDivElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function addMessageUser(message, className) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', className);

    const newDivElement = document.createElement('div');
    newDivElement.classList.add('response');

    const text = document.createElement('span');
    text.textContent = message;
    
    messageElement.appendChild(text);
    newDivElement.appendChild(messageElement);

    const icon = document.createElement('div');
    icon.innerHTML = userIcon;
    newDivElement.appendChild(icon);

    chatBox.appendChild(newDivElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function getBotResponse(question) {
    return responses[question] || "Lo siento, no entiendo tu pregunta.";
}

function openChat() {
    chatContainer.style.display = 'block';
}

function closeChat() {
    chatContainer.style.display = 'none';
}