

function error() {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Datos incorrectos",

    });

}

function mensaje() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Los datos se guardaron correctamente!',
        showConfirmButton: false,
        timer: 1500,
        
    });
}



function confirmar() {
    Swal.fire({
        title: "Desea guardar?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Guardar",
        denyButtonText: `No guardar`
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire("Guardado!", "", "exitoso");
        } else if (result.isDenied) {
            Swal.fire("No se pudieron guardar los cambios", "", "info");
        }
    });
}
function guardar_cambios() {
    Swal.fire({
        title: "Estas seguro de guardar todos los cambios?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Guardar",
        denyButtonText: `No guardar`
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire("Guardado!", "", "success");
        } else if (result.isDenied) {
            Swal.fire("Los cambios no se guardaran", "", "info");
        }
    });
}

function borrado() {
    Swal.fire({
        title: "Estas seguro?",
        text: "No podras revertir la accion!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, deseo borrarlo!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Borrado!",
                text: "Has eliminado ",
                icon: "success"
            });
        }
    });
}

function cargando() {
    let timerInterval;
    Swal.fire({
        title: "Atención",
        html: "Se estan cargando los datos en  <b></b> milisegundos.",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
    });
}



function messege() {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500
    });
}