console.log('Come on')

let articles_id = []
function chooseArticles(){
    document.addEventListener('input',async function(e){
        const target = e.target;
        if (!target.closest('.choose-article')) return;
        let articles = target.closest('.choose-article');
        let btn_remove_articles = document.querySelector('.btn-remove-articles');
        let chosen_articles = document.querySelector('.chosen-articles');

        if(articles.checked){
            articles_id.push(articles.value)
        }else{
            var index = articles_id.indexOf(articles.value);
            articles_id.splice(index, 1);
        }

        if(articles_id != undefined && articles_id.length != 0){
            btn_remove_articles.classList.remove('d-none')
        }else{
            btn_remove_articles.classList.add('d-none')
        }

        chosen_articles.value = JSON.stringify(articles_id);
    });
}

document.addEventListener("DOMContentLoaded", ()=>{
    chooseArticles()
})
