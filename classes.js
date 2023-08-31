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
    getType(){
        return this.type;
    }
    getFieldValue(field) {
        return document.getElementById(field).value; 
    }
    setFields() {
        let selectedType = document.getElementById(this.type);
        let listOfChildren = selectedType.children;
        for(let i = 0; i < listOfChildren.length; i++){
            let id = listOfChildren.item(i).id;
            this.id = this.getFieldValue(id);

        }

    }
}

function carry(selected){
    let newObject = new ProductType();
    newObject.setType(selected);
    console.log(newObject);
    console.log(newObject.getFields());
}

/*const form = document.getElementById("product_form");
form.addEventListener("submit", (f) => {
    f.preventDefault();

    const request = new XMLHttpRequest();
    request.open("post", "submit.php");
    request.onload = function () {
        console.log(request.responseText);
    }
    request.send(new FormData(form));
});*/

const form = document.getElementById("product_form");
form.addEventListener("submit", function(event){
    event.preventDefault();
    console.log(document.getElementById('sku').value); 
}
);

function submit_product() {
    let sku = document.getElementById("sku").value;
    let name = document.getElementById("name").value;
    let price = document.getElementById("price").value;
    let type = document.getElementById("productType").value;
    let newProduct = new ProductType(sku, name, price, type);
    newProduct.getFields();
}
