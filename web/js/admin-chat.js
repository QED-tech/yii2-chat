const chatInput = document.getElementById('chat-input');
let chatBox = document.getElementById('chat-box')
const usernameLink = document.getElementById('username')


const chatAddMessage = () => {
    const username = usernameLink.dataset['username']

    let message = `
    <div class="rounded font-w600 p-10 mb-10" id="chat-message">
        ${username}
        <br>
        ${chatInput.value} 
    </div>
    `

    let formData = new FormData
    formData.append('text', chatInput.value)
    formData.append('username', username)


    fetch('/chat/add-message', {
        method: 'POST',
        body: formData
    })
        .then(r => r.json())
        .then(response => console.log(response))

    chatBox.insertAdjacentHTML('beforeend', message)
    renderChat()
}


document.addEventListener('change', event => {
    let chatInput = event.target.closest('#chat-input')
    if (!chatInput) return

    chatAddMessage()
    chatInput.value = ''
})

async function reportMessage(id) {
    let question = confirm('Вы уверены?')

    let formData = new FormData

    formData.append('message-id', id)

    if (question) {

        let tmp = `/chat/report-message`
        let res = await fetch(tmp, {
            method: 'POST',
            body: formData
        });
        let response = await res.json()

        console.log(response)
        await renderChat();
    }

    return false;
}

async function restoreMessage(id) {
    let question = confirm('Вы уверены?')

    let formData = new FormData

    formData.append('message-id', id)

    if (question) {

        let tmp = `/chat/restore-message`
        let res = await fetch(tmp, {
            method: 'POST',
            body: formData
        });
        let response = await res.json()

        console.log(response)
        await renderChat();
    }

    return false;
}


async function renderChat() {

    chatBox.innerHTML = ''

    let res = await fetch('/chat/get-chat-for-admin-page');
    let chat = await res.json()

    console.log(chat)

    let html = ''
    chat.forEach(message => {

        let isCorrect = message.is_correct === 1
            ? `<span class="chat-message__change-status ml-auto report"  onclick="reportMessage(${message.id})">
             <i class="fa fa-thumbs-down fa-2x"></i>
           </span>`
            : `<span class="chat-message__change-status ml-auto restore"  onclick="restoreMessage(${message.id})">
             <i class="fa fa-repeat fa-2x"></i>
           </span>`

        let customClass = message.is_admin === 1
            ? '🛡'
            : '👨‍🦰'

        html += `
        <div class="rounded font-w600 p-10 mb-10" id="chat-message">
           <div class="chat-message__header">
            <span class="chat-message__username">
             ${message.username} ${customClass}
           </span>   
           
           ${isCorrect}
           
           <span class="chat-message__date">
             ${message.created_at}
           </span> 
        </div>
        <br>
            ${message.text} 
        </div>    
        `

    })

    chatBox.insertAdjacentHTML('beforeend', html)
}


renderChat()