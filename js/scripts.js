const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const searchForm = document.querySelector("#searchForm");

function showHint(str) {
    if (str.length == 0) {
        suggBox.innerHTML = "";
        searchWrapper.classList.remove("active");
        return;
    } else {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {                   
                searchWrapper.classList.add("active");
                suggBox.innerHTML = this.responseText;

                let allList = suggBox.querySelectorAll("li");
                for (let i = 0; i < allList.length; i++) {
                    allList[i].setAttribute("onclick", "select(this)");
                }                
            }
        }
    
        xhr.open('GET', 'suggestions.php?keywoard=' + inputBox.value, true);
        xhr.send();
    }
  }

function select(element) {    
    let selectUserData = element.textContent;
    inputBox.value = selectUserData;  
    searchForm.submit();  
    searchWrapper.classList.remove("active");
}