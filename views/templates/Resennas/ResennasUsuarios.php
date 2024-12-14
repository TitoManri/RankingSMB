<?php
        if ($iniciado) {
        ?>
            <section class="col-5 pt-3">
                <div class="container FondoVerde ms-3 border10" style="color: white;">
                    <form action="" method="post" id="enviarOpinion" class="pt-4 ps-5 ">
                        <?php
                        echo '<input name="IdUsuario" id="IdUsuario" class="form-control" type="hidden" value="', $_SESSION['id'], '" required>';
                        echo '<input name="IdContenido" id="IdContenido" class="form-control" type="hidden" value="" required>';
                        ?>
                        <div class="row">
                            <div class="d-flex justify-content-center border10 pt-1 col" style="background-color: #003344; width: 50%">
                                <input type="radio" name="Calificacion" id="calificacion1" value="1">
                                <label for="calificacion1" class="me-2"><i class="bi bi-star h3" id="estrella0"></i></label>

                                <input type="radio" name="Calificacion" id="calificacion2" value="2">
                                <label for="calificacion2" class="me-2"><i class="bi bi-star h3" id="estrella1"></i></label>

                                <input type="radio" name="Calificacion" id="calificacion3" value="3">
                                <label for="calificacion3" class="me-2"><i class="bi bi-star h3" id="estrella2"></i></label>

                                <input type="radio" name="Calificacion" id="calificacion4" value="4">
                                <label for="calificacion4" class="me-2"><i class="bi bi-star h3" id="estrella3"></i></label>

                                <input type="radio" name="Calificacion" id="calificacion5" value="5">
                                <label for="calificacion5" class="me-2"><i class="bi bi-star h3" id="estrella4"></i></label>
                            </div>
                            <div class="d-flex justify-content-center col">
                                <div class="col-3 animate__animated animate__heartBeat">
                                    <button type="button" class="boton-Opciones" name="BotonLista" id="Favorito">
                                        <img src="./assets/img/heart.png" class="rounded" alt="" style="height: auto; width: 3rem;">
                                    </button>
                                </div>
                                <div class="col-3 animate__animated animate__heartBeat">
                                    <button type="button" class="boton-Opciones" name="BotonLista" id="PorVer">
                                        <img src="./assets/img/vision (1).png" class="rounded" alt="" style="height: auto; width: 3rem;">
                                    </button>
                                </div>
                                <div class="col-3  animate__animated animate__heartBeat cuadrado">
                                    <button type="button" class="boton-Opciones" name="BotonLista" id="Visto">
                                        <img src="./assets/img/verified (2).png" class="rounded" alt="" style="height: auto; width: 3rem;">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div style="width: 85%">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe tu opinion" name="Opinion" id="opinion" style="resize: none;" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                                <label for="floatingTextarea2" style="color: black !important">Escribe tu opinion</label>
                            </div>
                            <div id="validarCalificacion">

                            </div>
                            <div class="d-flex justify-content-end mt-5" id="divBotonEnviar">
                                <button type="submit" class="btn btn-ver">Enviar</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <section id="opiniones" style="margin-bottom: 15px;">
                        <h3 class="text-center">Opiniones</h3>
                        <div class="border10 comentarios" id="comentariosUsuarios">

                        </div>
                    </section>
                    <br>
                </div>
                <br>
            </section>
        <?php
        } else {
        ?>
            <section class="col-5 pt-3">
                <div class="container FondoVerde ms-3 border10" style="color: white;">
                    <div class="pt-4">
                        <h3 class="text-center">Inicia sesion para enviar tu opinion sobre la pelicula!</h3>
                        <br>
                        <div class="d-flex justify-content-center">
                            <a href="" class="btn btn-lg btn-ver">Iniciar sesion</a>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <section id="opiniones" style="margin-bottom: 15px;">
                        <h3 class="text-center">Opiniones</h3>
                        <div class="border10 comentarios" id="comentariosUsuarios">

                        </div>
                    </section>
                    <br>
                </div>
                <br>
            </section>
        <?php
        }
        ?>