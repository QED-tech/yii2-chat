const tbody = document.getElementById('tbody')


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

    tbody.innerHTML = ''


    let res = await fetch('/chat/get-not-correct-message');
    let chat = await res.json()

    console.log(chat)
    let i = 0
    let html = ''
    chat.forEach(message => {
        i++

        html += `
       <tr>
  <th scope="row">${i}</th>
      <td>${message.username}</td>
      <td>${message.text}</td>
      <td>
        <button class="btn btn-success" onclick="restoreMessage(${message.id})">Восстановить</button>
        </td>
    </tr>  
        `

    })

    tbody.insertAdjacentHTML('beforeend', html)
}


renderChat()


