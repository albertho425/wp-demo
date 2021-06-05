import $ from 'jquery';

class Search {

    //1. describe and create/initiate our object
    constructor() {
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.events();
    }

    //2. events

    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $document.on("keyup", this.keyPressDispatcher.bind(this));
    }
        
    //3. methods (fuction, action...)

    
    keyPressDispatcher() {
        console.log("This is a test");
    }
    
    openOverlay(){

        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        
    }

    closeOverlay(){

        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
    }
}

export default Search;

