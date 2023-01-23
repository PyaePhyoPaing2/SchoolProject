
let mapOptions = {
    center: [35.70, 139.75],
    zoom: 17
}
let map = new L.map('map', mapOptions);

let layer = new L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(layer);

let iconOptions = {
    draggable: true
}
// check marker

let marker = null; // if marker is already pined => delete it

map.on('click', (event) => {
    if (marker !== null) {
        map.removeLayer(marker);
    }
    console.log(event);// check at console
    marker = L.marker([event.latlng.lat, event.latlng.lng]).addTo(map).bindPopup('<button onclick="AddFunction()">Add Memory </button>').openPopup(); // add multi pin any where

    // click add button

    // output data  to show

    document.getElementById('latitude').value = event.latlng.lat; //  show pin of latitude by getting from js library 
    document.getElementById('longitude').value = event.latlng.lng; //

})

function AddFunction() {
    document.getElementById("ShowContent").classList.add("Show");
}
// close button  event
function RemoveFunction() {
    document.getElementById("ShowContent").classList.remove("Show");
}

//const dateInput = document.getElementsByClassName("form-control"); javascript check data null 

 /*if (dateInput.value !== null) {
    function AddDataSuccess() {
        document.getElementById("dataAdd").classList.add("close-save-data"); // close function
        alert(" successfully data add ");
    }
} */

function BackMainPage() {
    document.getElementById("dataAdd").classList.remove("close-save-data"); // 12/19 add
}

/*

//create icon
let customIcon = {
    iconUrl : "images/izure.JPG",
    iconSize : [60,60]
}

let myIcon = L.icon(customIcon);

let iconOptions = {
    title: "School" ,
    draggable:true ,// can drag pin location
   // icon :myIcon // image icon on the map
}

// marker add to the map
let marker = new L.Marker([35.7092461,139.7520614] , iconOptions);
marker.addTo(map);
marker.bindPopup("button").openPopup(); // click open  text

let popup =  L.popup().setLatLng([35.7092461,139.7520614]).setContent("<p>Memory of My Friend  Izure </p>").openOn(map);

*/

