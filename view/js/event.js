function alertica() {
    Swal.fire({
        title: "Custom width, padding, color, background.",
        width: 600,
        padding: "3em",
        color: "#716add",
        background: "#fff url(img/rutinas.png)",
        backdrop: `
          rgba(0,0,123,0.4)
          url("img/nyancat.gif")
          left top
          no-repeat
        `,
        backdropClass: 'custom-backdrop-class'
    });
}
function error() {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Datos incorrectos",

    });

}

function correcto() {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500
    });
}

function confirmar() {
    Swal.fire({
        title: "Desea guardar los cambios?",
        showDenyButton: true,
        showCancelButton: true,
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


