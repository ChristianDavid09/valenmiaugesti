```html
@extends('layout')

@section('title', 'Política de Privacidad')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Cabecera --}}
                <div class="p-4 p-md-5 bg-light border-bottom">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 48px; height: 48px;">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>

                        <div>
                            <h1 class="h2 fw-bold mb-1">Política de Privacidad</h1>
                            <p class="text-muted mb-0">ValenmiauGesti</p>
                        </div>
                    </div>

                    <p class="text-muted mb-0">
                        En esta página encontrarás información sobre cómo tratamos
                        y protegemos los datos personales de nuestros usuarios.
                    </p>

                    <small class="text-muted d-block mt-3">
                        Última actualización: 7 de septiembre de 2026
                    </small>
                </div>


                {{-- Contenido --}}
                <div class="p-4 p-md-5">

                    <section class="mb-5">
                        <h2>1. Responsable del tratamiento</h2>

                        <p>
                            El responsable del tratamiento de los datos personales
                            tratados a través de ValenmiauGesti es:
                        </p>

                        <div class="bg-light rounded-3 p-4">
                            <p class="mb-2">
                                <strong>Responsable:</strong>
                                David Murillo Martinez
                            </p>

                            <p class="mb-2">
                                <strong>Proyecto:</strong>
                                ValenmiauGesti
                            </p>

                            <p class="mb-0">
                                <strong>Correo electrónico:</strong>
                                <a href="mailto:valenmiaugesti@gmail.com">
                                    valenmiaugesti@gmail.com
                                </a>
                            </p>
                        </div>

                        <p class="mt-3">
                            Para cualquier cuestión relacionada con el tratamiento
                            de datos personales o el ejercicio de derechos, puedes
                            contactar a través de la dirección de correo indicada.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>2. ¿Qué es ValenmiauGesti?</h2>

                        <p>
                            ValenmiauGesti es una plataforma destinada a facilitar
                            la gestión y difusión de información relacionada con
                            colonias felinas y la adopción de gatos en Valencia.
                        </p>

                        <p>
                            La plataforma permite crear cuentas de usuario, gestionar
                            información relacionada con colonias y animales, publicar
                            gatos disponibles para adopción y establecer comunicación
                            entre usuarios mediante un sistema de chat.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>3. Datos personales que podemos recoger</h2>

                        <h3 class="h5 mt-4">3.1. Datos de los usuarios</h3>

                        <p>
                            Al crear una cuenta en ValenmiauGesti podemos solicitar:
                        </p>

                        <ul>
                            <li>Nombre.</li>
                            <li>Dirección de correo electrónico.</li>
                            <li>Número de teléfono móvil, cuando el usuario decida proporcionarlo.</li>
                            <li>Fotografía de perfil, cuando el usuario decida proporcionarla.</li>
                            <li>Información relacionada con el tipo de cuenta o perfil.</li>
                            <li>Datos necesarios para gestionar la cuenta y utilizar las funcionalidades de la plataforma.</li>
                        </ul>

                        <h3 class="h5 mt-4">3.2. Información publicada sobre animales</h3>

                        <p>
                            Los usuarios pueden publicar información relacionada
                            con gatos gestionados dentro de la plataforma, incluyendo:
                        </p>

                        <ul>
                            <li>Nombre del animal.</li>
                            <li>Raza.</li>
                            <li>Sexo.</li>
                            <li>Estado de esterilización.</li>
                            <li>Características del animal.</li>
                            <li>Fotografías.</li>
                            <li>Información relacionada con su situación y adopción.</li>
                        </ul>

                        <h3 class="h5 mt-4">3.3. Comunicaciones mediante el chat</h3>

                        <p>
                            ValenmiauGesti dispone de un sistema de chat que permite
                            a determinados usuarios comunicarse entre sí, por ejemplo,
                            en relación con la adopción de un animal.
                        </p>

                        <p>
                            Los mensajes enviados mediante este sistema pueden ser
                            almacenados y tratados para permitir el funcionamiento
                            del servicio y garantizar la seguridad y correcto
                            funcionamiento de la plataforma.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>4. Finalidades del tratamiento</h2>

                        <p>Los datos personales podrán ser tratados para:</p>

                        <ul>
                            <li>Crear y gestionar las cuentas de usuario.</li>
                            <li>Permitir el acceso y uso de las funcionalidades de ValenmiauGesti.</li>
                            <li>Gestionar perfiles de colonias y adoptantes.</li>
                            <li>Permitir la publicación y gestión de información sobre gatos.</li>
                            <li>Facilitar procesos de adopción.</li>
                            <li>Permitir la comunicación mediante el sistema de chat.</li>
                            <li>Enviar comunicaciones relacionadas con la cuenta.</li>
                            <li>Recuperar cuentas y gestionar incidencias de acceso.</li>
                            <li>Mantener la seguridad de la plataforma.</li>
                            <li>Prevenir usos fraudulentos o abusivos.</li>
                            <li>Atender consultas y solicitudes de los usuarios.</li>
                            <li>Cumplir las obligaciones legales aplicables.</li>
                        </ul>
                    </section>


                    <section class="mb-5">
                        <h2>5. Base jurídica</h2>

                        <p>
                            El tratamiento de los datos personales se realizará
                            sobre las bases jurídicas previstas por la normativa
                            aplicable en materia de protección de datos, incluyendo,
                            según corresponda:
                        </p>

                        <ul>
                            <li>
                                <strong>Ejecución de la relación con el usuario:</strong>
                                para crear y gestionar su cuenta y proporcionar
                                las funcionalidades solicitadas.
                            </li>

                            <li>
                                <strong>Consentimiento:</strong>
                                cuando sea necesario para determinadas funcionalidades
                                opcionales.
                            </li>

                            <li>
                                <strong>Interés legítimo:</strong>
                                para determinadas tareas relacionadas con la seguridad,
                                prevención del fraude y correcto funcionamiento.
                            </li>

                            <li>
                                <strong>Cumplimiento de obligaciones legales:</strong>
                                cuando exista una obligación que requiera el tratamiento.
                            </li>
                        </ul>
                    </section>


                    <section class="mb-5">
                        <h2>6. Visibilidad de la información</h2>

                        <p>
                            ValenmiauGesti está diseñada para facilitar la interacción
                            entre personas interesadas en la gestión de colonias
                            felinas y la adopción.
                        </p>

                        <p>
                            Determinada información proporcionada por los usuarios
                            puede ser visible para otros usuarios registrados.
                        </p>

                        <p>
                            La información publicada sobre los animales puede ser
                            consultada por los usuarios registrados de la plataforma.
                        </p>

                        <div class="alert alert-info border-0 rounded-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Recomendamos no publicar información personal que no sea
                            necesaria para utilizar el servicio.
                        </div>
                    </section>


                    <section class="mb-5">
                        <h2>7. Conservación de los datos</h2>

                        <p>
                            Los datos personales se conservarán durante el tiempo
                            necesario para cumplir las finalidades para las que
                            fueron recogidos.
                        </p>

                        <p>
                            Mientras la cuenta permanezca activa, podremos conservar
                            los datos necesarios para proporcionar las funcionalidades
                            de ValenmiauGesti.
                        </p>

                        <p>
                            Cuando el usuario solicite la eliminación de su cuenta,
                            los datos podrán ser eliminados o anonimizados, salvo
                            aquellos que deban conservarse para cumplir obligaciones
                            legales, atender posibles responsabilidades o garantizar
                            la seguridad de la plataforma.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>8. Destinatarios de los datos</h2>

                        <p>
                            Los datos personales no se venderán ni cederán a terceros
                            con fines comerciales.
                        </p>

                        <p>
                            Determinada información podrá ser accesible para otros
                            usuarios cuando dicha información forme parte de un perfil
                            o publicación destinada a facilitar la gestión de colonias
                            o la adopción.
                        </p>

                        <p>
                            Asimismo, determinados proveedores tecnológicos podrán
                            tener acceso a datos personales cuando sea necesario para
                            prestar servicios relacionados con el funcionamiento
                            de la plataforma, como alojamiento, almacenamiento,
                            mantenimiento, correo electrónico u otros servicios
                            tecnológicos.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>9. Transferencias internacionales</h2>

                        <p>
                            En función de los proveedores tecnológicos utilizados
                            por ValenmiauGesti, determinados datos podrían ser tratados
                            o almacenados fuera del Espacio Económico Europeo.
                        </p>

                        <p>
                            Cuando exista una transferencia internacional de datos,
                            se adoptarán las garantías exigidas por la normativa
                            aplicable en materia de protección de datos.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>10. Seguridad</h2>

                        <p>
                            Adoptamos medidas técnicas y organizativas razonables
                            destinadas a proteger los datos personales frente a
                            accesos no autorizados, pérdida, alteración, divulgación
                            o destrucción.
                        </p>

                        <p>
                            Los usuarios también son responsables de mantener la
                            confidencialidad de sus credenciales de acceso y de
                            no compartirlas con terceras personas.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>11. Derechos de los usuarios</h2>

                        <p>
                            Los usuarios pueden ejercer los derechos reconocidos
                            por la normativa de protección de datos, entre ellos:
                        </p>

                        <ul>
                            <li>Derecho de acceso.</li>
                            <li>Derecho de rectificación.</li>
                            <li>Derecho de supresión.</li>
                            <li>Derecho a solicitar la limitación del tratamiento.</li>
                            <li>Derecho de oposición.</li>
                            <li>Derecho a la portabilidad cuando resulte aplicable.</li>
                            <li>Derecho a retirar el consentimiento.</li>
                        </ul>

                        <div class="bg-light rounded-3 p-4 mt-4">
                            <h3 class="h5">
                                <i class="bi bi-envelope me-2"></i>
                                Ejercicio de derechos
                            </h3>

                            <p class="mb-2">
                                Para ejercer estos derechos puedes contactar con:
                            </p>

                            <a href="mailto:valenmiaugesti@gmail.com"
                               class="fw-semibold">
                                valenmiaugesti@gmail.com
                            </a>
                        </div>

                        <p class="mt-4">
                            Los usuarios también tienen derecho a presentar una
                            reclamación ante la autoridad de control competente
                            en materia de protección de datos.
                        </p>

                        <p>
                            En España, dicha autoridad es la
                            <strong>Agencia Española de Protección de Datos (AEPD)</strong>.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>12. Menores de edad</h2>

                        <p>
                            ValenmiauGesti no está destinada a recopilar deliberadamente
                            datos personales de menores de edad sin las garantías
                            exigidas por la normativa aplicable.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>13. Responsabilidad sobre la información publicada</h2>

                        <p>
                            Los usuarios son responsables de la información que
                            introducen o publican en ValenmiauGesti y deben asegurarse
                            de que disponen de legitimación suficiente para proporcionar
                            y publicar dicha información.
                        </p>

                        <p>
                            Esto incluye especialmente las fotografías y demás
                            contenidos que incorporen a la plataforma.
                        </p>

                        <p>
                            Los usuarios no deben publicar datos personales de
                            terceras personas sin contar con una base legítima
                            para hacerlo.
                        </p>
                    </section>


                    <section class="mb-5">
                        <h2>14. Cambios en esta Política de Privacidad</h2>

                        <p>
                            Esta Política de Privacidad podrá modificarse cuando
                            resulte necesario para adaptarla a cambios en la plataforma,
                            nuevos servicios, modificaciones legales o mejoras en
                            los procedimientos de tratamiento de datos.
                        </p>

                        <p>
                            Cuando se produzcan cambios relevantes, se podrá informar
                            a los usuarios a través de la propia plataforma o mediante
                            otros medios de contacto disponibles.
                        </p>
                    </section>


                    <section>
                        <h2>15. Contacto</h2>

                        <p>
                            Si tienes cualquier duda sobre esta Política de Privacidad
                            o sobre el tratamiento de tus datos personales, puedes
                            contactar con el responsable a través de:
                        </p>

                        <a href="mailto:valenmiaugesti@gmail.com"
                           class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-envelope me-2"></i>
                            Contactar por email
                        </a>
                    </section>

                </div>

                {{-- Pie --}}
                <div class="border-top bg-light p-4 text-center">
                    <small class="text-muted">
                        © {{ date('Y') }} ValenmiauGesti · Política de Privacidad
                    </small>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
```
