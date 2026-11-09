<!DOCTYPE html>
<html lang="es">
<head>
    <!--CONFIGURACIONES Y LINKS DE LA PAGINA-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos en la Educación - EduPOLI</title>
    <script src="https://unpkg.com/react@17/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@0.263.1/dist/umd/lucide.min.js"></script>
    <link rel="stylesheet" href="botss.css">
</head>
<!--CUERPO DE LA PAGINA-->
<body>


    <!--ICONO PARA EL DESPLIEGUE DEL CHATBOT-->
    <div id="chatbot-toggle" class="chatbot-toggle">
        <span class="text-2xl">💬</span>
    </div>
    <div id="chatbot-container" class="chatbot-container"></div>


    <!--SCRIPT DE JS PARA EL FUNCIONAMIENTO DEL CHATBOT-->
    <script type="text/babel">

        //VARIABLES DE ENTRADA Y SALIDA PARA LA INTERACCION
        const educationResponses = {
            "hola": "¡Hola! Soy el asistente virtual de la LicoreraJP. ¿En qué puedo ayudarte hoy?",
            "ayuda": "En que puedo ayudarte ?",
            "gracias": "¡De nada! Estoy aquí para ayudarte con cualquier duda sobre nuestros productos. ¿Hay algo más en lo que pueda asistirte?",
            "adios": "¡Gracias por tu visita! Recuerda beber con responsabilidad. ¡Hasta pronto!",
            "cigarrillos": "Contamos con una amplia variedad de marcas de cigarrillos disponibles.",
            "regalos": "Tenemos sets de vinos, destilados y accesorios perfectos para regalar.",
            "sin alcohol": "Ofrecemos mixers, refrescos y otras bebidas sin alcohol para acompañar tus momentos.",
            "eventos": "Podemos ayudarte a elegir las bebidas ideales para tu evento.",
            "personalizacion": "Ofrecemos etiquetas personalizadas para botellas en ocasiones especiales.",
            "temporada": "Descubre nuestras bebidas de temporada, perfectas para el clima actual.",
            "presupuesto": "Contamos con opciones para todos los presupuestos.",
            "degustaciones": "Realizamos degustaciones en tienda los fines de semana.",
            "historia": "Somos una licorera comprometida con ofrecer productos de calidad y excelente servicio.",
            "sostenibilidad": "Trabajamos con marcas sostenibles que apoyan el cuidado del medio ambiente.",
            "exclusivas": "Disponemos de botellas de edición limitada y colecciones especiales.",
            "rastreo": "Por favor, proporciónanos tu número de compra para rastrear tu pedido.",
            "valoraciones": "Gracias por tu compra. Puedes dejarnos una reseña para ayudarnos a mejorar.",
            "formas de pago": "Aceptamos pagos en efectivo, tarjeta de crédito, débito y transferencias bancarias.",
            "entrega": "El tiempo estimado de entrega depende de tu ubicación, generalmente entre 1 y 2 horas dentro de la ciudad.",
            "stock": "Tenemos disponibilidad de todos nuestros productos anunciados, salvo que se indique lo contrario.",
            "descuentos": "Contamos con descuentos especiales en productos seleccionados.",
            "novedades": "Revisa nuestras novedades para conocer los últimos productos que hemos agregado.",
            "licores favoritos": "Puedes encontrar los licores más populares en nuestra sección de más vendidos.",
            "reembolsos": "Ofrecemos reembolsos en caso de problemas con el producto o error en el pedido.",
            "marcas": "Trabajamos con marcas reconocidas como Absolut, Tanqueray, Johnnie Walker, y muchas más.",
            "contacto": "Si tienes dudas, puedes contactarnos por WhatsApp, correo o teléfono.",
            "ubicacion": "Nos encontramos en el barrio X.",
            "facturacion": "Emitimos facturas para tus compras. Solicítala durante tu pedido.",
            "productos": "Ofrecemos una amplia variedad de licores, incluyendo vinos, cervezas, destilados y cócteles premezclados. Encuentra todos los detalles en nuestra página.",
            "vinos": "Tenemos vinos tintos, blancos y rosados de las mejores regiones del mundo. Revisa nuestra selección para elegir el ideal.",
            "cervezas": "Disponemos de cervezas artesanales, importadas y nacionales, con estilos como lager, ale, IPA y más.",
            "destilados": "Nuestra colección incluye whisky, ron, vodka, gin y tequila de marcas reconocidas.",
            "cockteles": "Contamos con cócteles premezclados listos para servir, perfectos para cualquier ocasión.",
            "ofertas": "Consulta nuestras ofertas especiales en vinos y packs de cervezas en nuestra página de promociones.",
            "envio": "Realizamos envíos rápidos a domicilio dentro de la ciudad y alrededores. Consulta el costo al finalizar tu compra.",
            "horario": "Nuestro horario es de lunes a sábado de 10:00 AM a 9:00 PM, y domingos de 11:00 AM a 7:00 PM.",
            "recomendacion": "Podemos sugerirte el licor perfecto según tus preferencias. Explora nuestras categorías para más detalles.",
            "maridaje": "Encuentra el maridaje perfecto según el tipo de comida. Visita nuestra sección de recomendaciones.",
            "promociones": "Descubre nuestras promociones y descuentos exclusivos en productos seleccionados."
        };

        //CONFIGURACION DEL CHAT PARA LA DETECCION Y BUSQUEDA DE RESPUESTA
        const ChatBot = () => {
            const [messages, setMessages] = React.useState([]);
            const [inputMessage, setInputMessage] = React.useState('');
            const messagesEndRef = React.useRef(null);

            const scrollToBottom = () => {
                messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
            };

            React.useEffect(scrollToBottom, [messages]);

            const handleSendMessage = () => {
                if (inputMessage.trim() === '') return;

                const userMessage = { text: inputMessage, sender: 'user' };
                setMessages(prevMessages => [...prevMessages, userMessage]);

                setTimeout(() => {
                    const botResponse = { text: getBotResponse(inputMessage), sender: 'bot' };
                    setMessages(prevMessages => [...prevMessages, botResponse]);
                }, 1000);

                setInputMessage('');
            };

            const getBotResponse = (input) => {
                const lowercaseInput = input.toLowerCase();
                for (const key in educationResponses) {
                    if (lowercaseInput.includes(key)) {
                        return educationResponses[key];
                    }
                }
                return "Interesante pregunta. Como asistente virtual de la licoreraJP, puedo ayudarte con información sobre nuestra selección de licores, recomendaciones de maridaje, ofertas especiales y consejos para cocteles. ¿Podrías especificar más sobre qué tipo de bebida o servicio te interesa? Por ejemplo, ¿buscas un vino para una cena, un whisky para regalo?";
            };

            return (
                <div className="flex flex-col h-full">
                    <div className="chatbot-header">
                        <div className="flex items-center">
                            <img src="imgs/imgvin.png" alt="LicoBot" />
                            <h2 className="text-xl font-bold ml-2">LicoBot</h2>
                        </div>
                        <button id="chatbot-close">&times;</button>
                    </div>
                    <div className="chatbot-messages" id="chatbot-messages">
                        {messages.map((message, index) => (
                            <div key={index} className={`message ${message.sender}`}>
                                <div className="text">{message.text}</div>
                            </div>
                        ))}
                        <div ref={messagesEndRef} />
                    </div>
                    <div className="chatbot-input">
                        <input
                            type="text"
                            value={inputMessage}
                            onChange={(e) => setInputMessage(e.target.value)}
                            onKeyPress={(e) => e.key === 'Enter' && handleSendMessage()}
                            placeholder="Escribe tu mensaje..."
                            className="flex-1 border rounded-l-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <button
                            onClick={handleSendMessage}
                            className="bg-blue-500 text-white p-2 rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <span className="text-xl">➤</span>
                        </button>
                    </div>
                </div>
            );
        };
        
        //DESPLIEGUE DEL CHAT
        ReactDOM.render(<ChatBot />, document.getElementById('chatbot-container'));

        const chatbotToggle = document.getElementById('chatbot-toggle');
        const chatbotContainer = document.getElementById('chatbot-container');
        const chatbotClose = document.getElementById('chatbot-close');

        chatbotToggle.addEventListener('click', () => {
            chatbotContainer.style.display = 'flex';
            chatbotToggle.style.display = 'none';
        });

        chatbotClose.addEventListener('click', () => {
            chatbotContainer.style.display = 'none';
            chatbotToggle.style.display = 'flex';
        });
    </script>
</body>
</html>