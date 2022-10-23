const divComments = document.getElementById("comments")
const textarea = document.getElementById("textarea")
const addComment = document.getElementById("add-btn")

const authorBlog = document.body.dataset.authorid
const baseurl = document.body.dataset.baseurl
const blogid = document.body.dataset.blogid


const currentUser = localStorage.getItem("user_id");

function getComments(){
    axios.get(`${baseurl}/api/comments/list.php?id=${blogid}`)
    .then(res =>{
        console.log(res.data);
        showComments(res.data);
    })
}

function showComments(comments){
    let divHTML = `<h2> ${comments.length} комментария</h2>`
    for(let i in comments){
        let deleteButton = ``
        if(currentUser == comments[i]["author_id"]
        || currentUser == authorBlog){
            deleteButton = `<span onclick= "removeComment(${comments[i]['id']})"> Delete </span>`
        }
        divHTML+=`
        <div class="comment">
            <div class="comment-header">
                <div>
                    <img src="images/avatar.png" alt="">
                    ${comments[i]["full_name"]}
                </div>    
                ${deleteButton}
            </div>
                <p>
                ${comments[i]["text"]}
                </p>
        </div>
        `
    }
    divComments.innerHTML = divHTML
}

getComments()

addComment.onclick = function(){
    axios.post(`${baseurl}/api/comments/add.php`,{
        text:textarea.value,
        blog_id: blogid
    }) .then(res =>{
        getComments()
        textarea.value = ""
    })
}


function removeComment(id){
    axios.delete(`${baseurl}/api/comments/delete.php?id=${id}`).then(res =>{
        getComments()
    })
}




