document.getElementById("buscar-num").addEventListener("click", getTrackingSifamilla);

async function getTrackingSifamilla() {
    try {
        var numberTracking = document.getElementById("search-input").value;
        const urlAuropaq = `http://sifamilla.fivepaq.com/api/Detalles/GetDetalleByGuia?guia=${numberTracking}&entorno=AUROPAQ`;
        let res = await fetch(urlAuropaq);
        let json = await res.json();
        showData(json);


        //console.log('json', json)
    } catch (err) {
        let fail = document.getElementById("error");
        fail.classList.remove("hidden")
        //console.error('err', err);

    }
}


function showData(dataAuro) {
    let divResult = document.getElementById("resultTracking");
    divResult.classList.remove("hidden");
    let bodyTable = document.getElementById('bodyTable');
    bodyTable.innerHTML = "";
    for (let item of dataAuro) {
        let date = item.DateDelivery;
        //llamar funcion de calculo de hora
        let horaUTCBogota = horarioUTC_5(date);
        //console.log("Esta es la fecha nueva :" + horaUTCBogota);
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


