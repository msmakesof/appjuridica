(function () {
    var takePicture = document.querySelector("#take-picture"),
        showPicture = document.querySelector("#show-picture");

    if (takePicture && showPicture) {
        // Establecer eventos
        takePicture.onchange = function (event) {
            // Obtener una referencia a la fotografía tomada o fichero seleccionado
            var files = event.target.files,
                file;
            if (files && files.length > 0) {
                file = files[0];
                try {
                    // Crear ObjectURL
                    var imgURL = window.URL.createObjectURL(file);

                    // Establecer ObjectURL como img src 
                    showPicture.src = imgURL;

                    // Revocar ObjectURL
                    URL.revokeObjectURL(imgURL);
                }
                catch (e) {
                    try {
                        // Regresar a FileReader si createObjectURL no está soportado
                        var fileReader = new FileReader();
                        fileReader.onload = function (event) {
                            showPicture.src = event.target.result;
                        };
                        fileReader.readAsDataURL(file);
                    }
                    catch (e) {
                        //
                        var error = document.querySelector("#error");
                        if (error) {
                            error.innerHTML = "Neither createObjectURL or FileReader are supported";
                        }
                    }
                }
            }
        };
    }
})();