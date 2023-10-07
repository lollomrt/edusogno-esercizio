console.log('Script JavaScript in esecuzione');

const passwordInputs = document.querySelectorAll(".password-input");
const toggleButtons = document.querySelectorAll(".toggle-password-visibility");

toggleButtons.forEach((button, index) => {
    button.addEventListener("click", () => {
        togglePasswordVisibility(index);
    });
});

function togglePasswordVisibility(index) {
    const passwordInput = passwordInputs[index];
    const isPasswordVisible = passwordInput.getAttribute("type") === "text";

    if (isPasswordVisible) {
        passwordInput.setAttribute("type", "password");
        toggleButtons[index].classList.remove("fa-eye-slash");
        toggleButtons[index].classList.add("fa-eye");
    } else {
        passwordInput.setAttribute("type", "text");
        toggleButtons[index].classList.remove("fa-eye");
        toggleButtons[index].classList.add("fa-eye-slash");
    }
}

// Script per la gestione dell'apertura7chiusura popup dasboard

// Funzione per aprire il popup e impostare il contenuto in base all'azione
// Funzione per aprire il popup e impostare il contenuto in base all'azione e all'evento
function openPopup(action, eventId) {
    let popup = document.getElementById('popup-dashboard');
    let creaEventoDiv = document.getElementById('popup-crea-evento');
    let eliminaEventoDiv = document.getElementById('popup-elimina-evento');
    let modificaEventoDiv = document.getElementById('popup-modifica-evento');

    // Nasconde tutti i div del popup
    creaEventoDiv.style.display = 'none';
    eliminaEventoDiv.style.display = 'none';
    modificaEventoDiv.style.display = 'none';

    switch (action) {
        case 'crea':
            creaEventoDiv.style.display = 'block';
            break;
        case 'elimina':
            // Imposta l'ID dell'evento nel modulo di eliminazione
            document.querySelector('#popup-elimina-evento input[name="event_id"]').value = eventId;
            eliminaEventoDiv.style.display = 'block';
            break;
        case 'modifica':
            // Ottieni i dati dell'evento dall'attributo data-event del pulsante
            let eventData = JSON.parse(document.querySelector(`[data-event-id="${eventId}"]`).getAttribute('data-event'));
            document.querySelector('#popup-modifica-evento input[name="event_id"]').value = eventData.id;
            document.querySelector('#popup-modifica-evento input[name="nome_evento"]').value = eventData.name;

            // Popola le checkbox dei partecipanti
            let checkboxes = document.querySelectorAll('#popup-modifica-evento input[type="checkbox"]');
            checkboxes.forEach(function (checkbox) {
                if (eventData.attendees.includes(checkbox.value)) {
                    checkbox.checked = true;
                } else {
                    checkbox.checked = false;
                }
            });

            // Popola la data dell'evento
            let dateInput = document.querySelector('#popup-modifica-evento input[name="data_evento"]');
            dateInput.value = eventData.date;

            // Imposta altri campi del modulo di modifica con i dati dell'evento, se necessario
            modificaEventoDiv.style.display = 'block';
            break;
        default:
            // Azione non riconosciuta
            break;
    }

    // Visualizza il popup
    popup.style.display = 'flex';
}

// Funzione per chiudere il popup
function closePopup() {
    let popup = document.getElementById('popup-dashboard');
    popup.style.display = 'none';
}

// Aggiunta gestori di eventi delegati per i pulsanti
let actionButtons = document.querySelectorAll('[data-action]');
actionButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault(); // Evita il comportamento predefinito del link
        let action = this.getAttribute('data-action');
        let eventId = this.getAttribute('data-event-id'); // Ottieni l'ID dell'evento
        if (action === 'chiudi') {
            closePopup();
        } else {
            openPopup(action, eventId); // Passa l'ID dell'evento alla funzione openPopup
        }
    });
});


