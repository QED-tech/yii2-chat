const chatInput = document.getElementById('chat-input');
const chatBox = document.getElementById('chat-box')

const chatAddMessage = () => {
    let message = `
    <div class="rounded font-w600 p-10 mb-10 animated fadeIn" id="chat-message">
        ${chatInput.value} 
    </div>
    `


    chatBox.insertAdjacentHTML('beforeend', message)
}


chatInput.addEventListener('change', () => {
    chatAddMessage()
    chatInput.value = ''
    console.log('ok')
})