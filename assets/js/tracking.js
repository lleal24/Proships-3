document.getElementById("buscar-num").addEventListener("click", tracking);
document.getElementById("nav-button").addEventListener("click", reset);
const loader = document.getElementById("loader");
const divResult = document.getElementById("resultTracking");
const fail = document.getElementById("error");

function reset(){
    document.getElementById("search-input").value = "";
    divResult.classList.add("hidden");
    fail.classList.add("hidden");
}

function tracking(){
    var numberTracking = document.getElementById("search-input").value;
    divResult.classList.add("hidden");
    fail.classList.add("hidden");
    getTrackingSifamilla(numberTracking);
}

async function getTrackingSifamilla(numberTracking) {
    try {
        var numberTracking = document.getElementById("search-input").value;
        const urlAuropaq = `http://sifamilla.fivepaq.com/api/Detalles/GetDetalleByGuia?guia=${numberTracking}&entorno=ALL`;
        loader.classList.remove("hidden");
        let res = await fetch(urlAuropaq);
        let json = await res.json();
        loader.classList.add("hidden");
        showData(json);
        //console.log('json', json)
    } catch (err) {
        loader.classList.add("hidden");
        fail.classList.remove("hidden")
        //console.error('err', err);
    }
}

function showData(dataAuro) {
    divResult.classList.remove("hidden");
    let bodyTable = document.getElementById('bodyTable');
    bodyTable.innerHTML = "";
    for (let item of dataAuro) {
        let date = item.DateDelivery;
        let horaUTCBogota = horarioUTC_5(date);
        bodyTable.innerHTML += `
                                    
                                           <tr>
                                              <td>${item.Descripcion}</td>
                                              <td>${horaUTCBogota}</td> 
                                             
                                          </tr>
                             `
    }
}

function horarioUTC_5(fecha) {
    let difHoraria_5 = 1000 * 60 * 60 * 5
    let d = new Date(fecha);
    let hora_UTC_5 = d - difHoraria_5;
    let hUTC = new Date(hora_UTC_5);
    let day = hUTC.getDate() + "/";
    let month = (hUTC.getMonth() + 1) + "/";
    let year = hUTC.getFullYear() + " ";
    let hour = hUTC.getHours() + ":";
    let minutes = hUTC.getMinutes() + "";
    minutes = minutes > 9 ? minutes : '0' + minutes;
    let fechaUTCBog = month + day + year + hour + minutes;
    return fechaUTCBog;
}


