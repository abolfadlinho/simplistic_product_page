class Product {
    constructor(sku, name, price){
        this.sku = sku;
        this.name = name;
        this.price = price;
    }
}

class ProductType extends Product{
    constructor(sku, name, price, type){
        super(sku, name, price);
        this.type = type;
        this.setFields();
    }
    getFieldValue(field) {
        return document.getElementById(field).value; 
    }
    setFields() {
        let selectedType = document.getElementById(this.type);
        let listOfChildren = selectedType.children;
        for(let i = 0; i < listOfChildren.length; i++){
            let id = listOfChildren.item(i).id;
            this[id] = this.getFieldValue(id);

        }

    }
}

function displayChildren(selected) {
    let id = document.getElementById(selected);
    let listOfChildren = id.children;
    for(let i = 0; i < listOfChildren.length; i++){
        document.getElementById(listOfChildren[i].id).style.display = 'block';
    }
}

const myForm = document.getElementById("product_form");
myForm.addEventListener("submit", (e) => {
    e.preventDefault();
    let sku = document.getElementById("sku").value;
    let name = document.getElementById("name").value;
    let price = String(document.getElementById("price").value);
    let type = document.getElementById("productType").value;
    let obj = new ProductType(sku, name, price, type);  
    
    console.log(obj);  
    const jsonString = JSON.stringify(obj);
    console.log(jsonString);
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "store.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(jsonString);
    console.log("Request sent");
});

function convert(object) { //Converts a JS object into a PHP Object
    var json = "{";
    for(property in object) {
        var value = object[property];
        if(typeof(value) == "string") {
            json += '"' + property + '":"' + value + '",'
        } else {
            if(!value[0]) { //The part we are most conserned with because we are using associative arrays
                json += '"' + property + '":' + convert(value) + ',';
            } else {
                json += '"' + property + '":[';
                for(prop in value) json += '"' + value[prop] + '",';
                json + json.substr(0, json.length - 1) + "],";
            }
        }
    }
    return json.substr(0, json.length - 1) + "}";
}