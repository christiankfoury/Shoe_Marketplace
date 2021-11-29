var brandSel;

var brandObject = {
    "Jordan": [ "Retro 1", "Retro 11", "Retro 12", "Retro 13"],
    "Nike": ["Air Max 90", "Air Max 95", "Air Max 97", "Air Force 1", "Dunks"],
    "Adidas": ["NMD", "Ultraboost", "Yeezy 350", "Yeezy Foam"],
    "Vans": ["Sk8 Hi", "Old Skool", "Slip on", "Slide on"],
    "NewBalance": ["550", "993", "990", "574"],
    "SelectABrand": ["Select a brand"]
}
window.onload = function () {
    var brandSel = document.getElementById("brand");
    console.log(brandSel);
    var modelSel = document.getElementById("model");
    brandSel.onchange = function () {
        modelSel.options.length = 1;
        if (brandSel.value === "jordan") {
            for (var i = 0; i < brandObject.Jordan.length; i++) {
                modelSel.options[i] = new Option(brandObject.Jordan[i], brandObject.Jordan[i]);
            }
        } else if (brandSel.value === "nike") {
            for (var i = 0; i < brandObject.Nike.length; i++) {
                modelSel.options[i] = new Option(brandObject.Nike[i], brandObject.Nike[i]);
            }
        } else if (brandSel.value === "adidas") {
            for (var i = 0; i < brandObject.Adidas.length; i++) {
                modelSel.options[i] = new Option(brandObject.Adidas[i], brandObject.Adidas[i]);
            }
        } else if (brandSel.value === "vans") {
            for (var i = 0; i < brandObject.Vans.length; i++) {
                modelSel.options[i] = new Option(brandObject.Vans[i], brandObject.Vans[i]);
            }
        } else if (brandSel.value === "new balance") {
            console.log(brandSel.value);
            for (var i = 0; i < brandObject.NewBalance.length; i++) {
                modelSel.options[i] = new Option(brandObject.NewBalance[i], brandObject.NewBalance[i]);
            }
        } else {
            for (var i = 0; i < brandObject.SelectABrand.length; i++) {
                modelSel.options[i] = new Option(brandObject.SelectABrand[i], brandObject.SelectABrand[i]);
            }
        }
    }
}