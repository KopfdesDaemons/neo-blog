// Wenn man auf "Antworten" klickt, wird das normale Formular unter dem Kommentarbaum (Ebene 1) geschoben
// Das geschieht über die Wordpress Funktion comment_reply_link()
// Ein Antwortformular wird über diesem Formular eingeblendet, also zwei Formulare übereinander
// Das normale Formular wird unsichtbar gemacht
// Das Antwortformular wird in den Kommentar verschoben

const replyLinks = document.querySelectorAll(".comment-reply-link");
for (const replyLink of replyLinks) {
    replyLink.addEventListener("click", function(e) {
        e.preventDefault();
        
        // Verstecke alle Antwortlinks
        for(const replyL of replyLinks){
            replyL.parentNode.style.display = 'none';
        }
        
        // Zerstöre alle vorhandenen Antwortformulare
        const allContainers = document.querySelectorAll(".comment-form-container");
        for (const container of allContainers) {
            container.remove();
        }
        
        // Erstelle neuen Container mit dem Antwortformular
        const newContainer = document.createElement("div");
        newContainer.classList.add("comment-form-container");
        newContainer.style.display = "block";
        
        // Füge den neuen Container in den CommentContent ein
        const commentContent = this.closest(".commentContent");
        const commentBody = this.closest(".commentCard");
        commentContent.appendChild(newContainer);

        // Füge das Formular in den Container ein
        const form = document.querySelector('.comment-respond');
        newContainer.innerHTML = form.innerHTML;
        
        // Füge dem Formular einen hr-tag hinzu und ändere den Abbrechentext
        const hr = document.createElement('hr');
        newContainer.prepend(hr);
        commentBody.querySelector('#cancel-comment-reply-link').innerHTML = '❌';
        
        // Verstecke das ursprüngliche Formular
        form.style.display = 'none';

        // Entferne das Antwortformular beim Abbrechen und zeige das normale Formular an
        var cancelLink = commentBody.querySelector('#cancel-comment-reply-link');
        cancelLink.addEventListener('click', function(e) {
            form.style.display = 'block';
            for(const replyL of replyLinks){
                replyL.parentNode.style.display = 'flex';
            }
            newContainer.remove();
        })
    });
}