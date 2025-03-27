// my custom spinner using bootstrap4 classess
class Spinner {
    constructor(containerid, text) {
        this.containerid = containerid;
        this.text = text;
        this.container = document.getElementById(this.containerid);
        this.spinDiv = document.createElement('div');
        // this.spinDiv.classList.add('container');
        //this.spinDiv.classList.add('overlay');
        // this.spinDiv.classList.add('opacity-50');

        this.spinDiv.classList.add('d-flex');
        this.spinDiv.classList.add('justify-content-center');
        this.spinDiv.classList.add('align-content-center');
        this.span = document.createElement('span');
        this.span.classList.add('spinner-grow')
        this.span.role = 'status';
        this.spanTxt = document.createElement('span');
        this.showLoader();
        
    }
    showLoader() {
        this.spanTxt.innerText = this.text;
        this.spinDiv.append(this.span);
        this.spinDiv.append(this.spanTxt);
        this.container.append(this.spinDiv);

    }
    newText(text) {
        this.text = text;
        this.showLoader();
    }
    destroy() {
        this.spinDiv.remove()
    }

}

// export {Spinner};