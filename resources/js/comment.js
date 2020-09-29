import axios from 'axios';
let inputs = document.querySelectorAll('#input');
let publish = document.querySelectorAll('.publish');
let forms = document.querySelectorAll('#form-comment');

for (let i = 0; i < inputs.length; i++) {
   inputs[i].addEventListener('input' , ()=>{

       inputs[i].value != "" ? inputs[i].nextElementSibling.classList.remove('d-none'):inputs[i].nextElementSibling.classList.add('d-none')
   })
}


for (let i = 0; i < publish.length; i++) {
   publish[i].addEventListener('click' , (e)=>{
       const comment = inputs[i].value;
       console.log(inputs[i].value)

       const url = forms[i].getAttribute('action');
       const token = document.querySelector('meta[name="csrf-token"]').content;
       const postId = forms[i].querySelector('#post-id-js').value;
       const count = forms[i].querySelector('#count-comment');


       fetch(url, {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        method: 'post',
        body: JSON.stringify({
            id: postId,
            comment:comment
        })
        }).then(response => {
            response.json().then(data => {
                // count.innerHTML = data.count + ' Comment(s)';
                inputs[i].value='';
                inputs[i].nextElementSibling.classList.add('d-none');
                window.location.reload();

                
            })
        }).catch(error => {
            console.log(error)
        });

       
       
       
    })

}

