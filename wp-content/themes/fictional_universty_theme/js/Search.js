// import $ from 'jQuery';

class search {

    constructor(){
        this.openButton =document.getElementsByClassName("js-search-trigger")[1]
        this.closeButton = document.getElementsByClassName("search-overlay__close")[0]
        this.opened_search = false
        this.searchFeild =document.getElementById('search-term')
        this.typingTimer
        this.isSpinerVisable =false
        this.perviousValue
        this.resultsDiv = document.getElementById('search-overlay__results')
        this.events();
        // alert("Gomaa")
    }

    events(){
        this.openButton.onclick = this.openOverlay.bind(this);
        this.closeButton.onclick = this.closeOverlay.bind(this);
        document.addEventListener('keydown', this.key_dispacer.bind(this));
        this.searchFeild.addEventListener('keyup', this.typingLogic.bind(this))
    }

    typingLogic(){
        if(this.searchFeild.value !== this.perviousValue){
            clearTimeout(this.typingTimer)
            if(!this.searchFeild.value){
                this.resultsDiv.innerHTML=""
                this.isSpinerVisable=false
            }
            else{
                if(!this.isSpinerVisable){
                    this.resultsDiv.innerHTML ="<div class = 'spinner-loader'></div>"
                    this.isSpinerVisable=true
                }
                this.typingTimer = setTimeout(this.get_results.bind(this), 750) //mille second
            }
        }
        this.perviousValue = this.searchFeild.value
    }

    async get_results(){
        let CustomApiResponse = await fetch(universiry_data.root_url + '/wp-json/university/v1/search?term=' + this.searchFeild.value)
        if(CustomApiResponse.ok){
            let CustomApiResponseResult = await CustomApiResponse.json()
            this.resultsDiv.innerHTML=`
                <div class="row">
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">General Information</h2>
                        ${CustomApiResponseResult.generalInfo.length ? '<ul class ="link-list min-list">' : '<p>No General infromation found for this word</p>'}
                            ${CustomApiResponseResult.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ` + item.authorName : ''}</li>`).join('')}
                        ${CustomApiResponseResult.generalInfo.length ? '</ul>' : ''}
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Programs</h2>
                        ${CustomApiResponseResult.programs.length ? '<ul class ="link-list min-list">' : `<p>No Programs found for this word</p> <a href="${universiry_data.root_url}/programs">View all Programes here</a>`}
                            ${CustomApiResponseResult.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${CustomApiResponseResult.programs.length ? '</ul>' : ''}
                        <h2 class="search-overlay__section-title">Professors</h2>
                        ${CustomApiResponseResult.professors.length ? '<ul class ="link-list min-list">' : `<p>No General infromation found for this word</p> <a href="${universiry_data.root_url}/professors">View all Professors here</a>`}
                            ${CustomApiResponseResult.professors.map(item => `<li class="professor-card__list-item">
                            <a class="professor-card" href="${item.permalink}">
                              <img src="${item.image}" alt="" class="professor-card__image">
                              <span class="professor-card__name">${item.title}</span>
                            </a>
                          </li>`).join('')}
                        ${CustomApiResponseResult.professors.length ? '</ul>' : ''}
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Events</h2>
                        ${CustomApiResponseResult.events.length ? '' : `<p>No Events found for this word</p> <a href="${universiry_data.root_url}/events">View all Events here</a>`}
                            ${CustomApiResponseResult.events.map(item => `
                            <div class="event-summary">
                                <a class="event-summary__date t-center" href="${item.permalink}">
                                    <span class="event-summary__month">${item.month}</span>
                                    <span class="event-summary__day">${item.day}</span>  
                                </a>
                                <div class="event-summary__content">
                                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                                    <p>${item.content}<a href="${item.permalink}" class="nu gray">Learn more</a></p>
                                </div>
                            </div>
                            `).join('')}
                    </div>
                </div>
            `
        }
        // // this.resultsDiv.innerHTML='hey my name is wahta ?'
        // let response_posts = await fetch(universiry_data.root_url + '/wp-json/wp/v2/posts?search=' + this.searchFeild.value)
        // let response_pages = await fetch(universiry_data.root_url + '/wp-json/wp/v2/pages?search=' + this.searchFeild.value)
        
        // if (response_posts.ok && response_pages.ok) { // if HTTP-status is 200-299
        // // get the response body (the method explained below)
        //     let posts = await response_posts.json()
        //     let pages = await response_pages.json()
        //     let CombinedResluts = posts.concat(pages)
        //     this.resultsDiv.innerHTML=`
        //     <h2 class="search-overlay__section-title">General Information</h2>
        //     ${CombinedResluts.length ? '<ul class ="link-list min-list">' : '<p>No General infromation found for this word</p>'}
        //         ${CombinedResluts.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `by ` + item.authorName : ''}</li>`).join('')}
        //     ${CombinedResluts.length ? '</ul>' : ''}
        //     `
        // } 
        // else {
        //     alert("HTTP-Error: " + response_posts.status);
        // }
        this.isSpinerVisable=false
    }

    openOverlay(){
        this.searchOverlay = document.getElementsByClassName("search-overlay")[0]
        this.searchOverlay.classList.add("search-overlay--active")
        this.searchFeild.focus()
        document.getElementsByTagName('body')[0].classList.add('body-no-scroll')
        
    }

    closeOverlay(){
        this.searchOverlay = document.getElementsByClassName("search-overlay")[0]
        this.searchOverlay.classList.remove("search-overlay--active")
        document.getElementsByTagName('body')[0].classList.remove('body-no-scroll')
        this.searchFeild.value=""
    }

    key_dispacer(event){
        if(event.keyCode == 83 && !this.opened_search && !jQuery('input , textarea').is(':focus')){
            this.openOverlay();
            this.opened_search = true
        }
        else if (event.keyCode == 27 && this.opened_search){
            this.closeOverlay();
            this.opened_search = false
        }

    }
}

new search()