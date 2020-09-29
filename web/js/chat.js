const chatInput = document.getElementById('chat-input');
let chatBox = document.getElementById('chat-box')
const usernameLink = document.getElementById('username')
const chatRefreshButton = document.getElementById('chat-refresh')


chatRefreshButton.addEventListener('click', () => {

    renderChat()
})

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
    if(!chatInput) return

    chatAddMessage()
    chatInput.value = ''
})


async function renderChat() {

    chatBox.innerHTML = ''

    let res = await fetch('/chat/get-chat');
    let chat = await res.json()

    console.log(chat)

    let html = ''
    chat.forEach(message => {

        let customClass = message.is_admin === 1
            ? '🛡'
            : '👨‍🦰'

        html += `
        <div class="rounded font-w600 p-10 mb-10" id="chat-message">
           <div class="chat-message__header">
            <span class="chat-message__username">
             ${message.username} ${customClass}
           </span>   
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