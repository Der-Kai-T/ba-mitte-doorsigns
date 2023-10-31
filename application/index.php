<html>
<head>
    <title>
        Türschilder BA Mitte
    </title>

    <!-- Bootstrap Framework -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Fontawesome Icon-Library -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

    <!-- User Content-->
    <link rel="stylesheet" href="assets/css/usercss.css">
    <script src="assets/js/user.js"></script>
</head>

<body>
<div class="container mt-3">
    <h2>Türschilder</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informationen <span class="fa-solid fa-caret-down pointer" id="info_caret"
                                                               onclick="toggle_card_body('info_body', 'info_caret')"></span>
                    </h3>
                </div>
                <div class="card-body" id="info_body" style="display:none">
                    <p>Mithilfe dieser Webanwendung können Türschilder für die Büros im (angemieteten) D-Flur des
                        Bezirksamtsgebäudes in der Caffamacherreihe 1-3 erstellt werden.</p>

                    <p>
                        Aktuell steht nur das Logo des Bezirksamtes zur Verfügung. Weitere Logos können an
                        <a href="mailto:dev@kai-thater.de?subject=Logo%20Türschilder">dev@kai-thater.de</a>
                        gesendet werden.

                    </p>
                    <p>Anforderungen an die Datei</p>
                    <ul>
                        <li> Dateiformat .png mit transparentem Hintergrund</li>
                        <li> Auflösung 300dpi</li>
                        <li> Maße: 70mm breit, 25mm hoch (inkl. Logoschutzzonen)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Daten
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class='form-group'>
                                <label class='col-form-label' for='authority'>Behörde</label>
                                <select required name='authority' class='form-control' id='authority'>
                                    <option value="ba-mitte">Bezirksamt Hamburg-Mitte</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?= input("room", "Raum", true); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?= input("department", "Fachamt", true); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?= input("section_number", "Leitzeichen Abteilung / Abschnitt"); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?= input("section_name", "Name Abteilung / Abschnitt"); ?>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <p> Zeilen, die mit einem * beginnen werden kursiv gesetzt</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo input("line_1_$i", "Zeile 1.$i");
                            }

                            ?>

                        </div>

                        <div class="col-6">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo input("line_2_$i", "Zeile 2.$i");
                            }

                            ?>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-success mt-3" onclick="add_data()"><span
                                        class="fa-solid fa-save"></span><span class="p-3">Eintrag speichern</span>
                            </button>
                            <button class="btn btn-danger mt-3" onclick="clear_inputs()"><span
                                        class="fa-solid fa-trash"></span><span class="p-3">Eingaben leeren</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Daten weiterverarbeiten
                </div>
                <div class="card-body">
                    <p>
                        Hier werden die Daten, die oben eingegeben werden in einem maschinenlesbaren Format (json)
                        abgelegt.
                        Wenn Sie Ihre Arbeit teilen möchten, speichern sie den Inhalt des Feldes mit Hilfe eines
                        Text-Editor (z.B. Notepad unter Windows) als .txt-Datei und geben Sie diese weiter. Verwenden
                        Sie kein Textverarbeitungsprogramm wie
                        Microsoft Word, da dieses ggf. den Inhalt verändert und Sie so alle Daten verlieren!
                    </p>
                    <p>Zum laden der Daten kopieren Sie diese in das Textfeld.</p>

                    <p>Achtung! Wenn Sie die Daten über diese Möglichkeit austauschen können Sie anschließend keine
                        weiteren
                        Daten über das Formular oben eingeben, da dies Ihre kopierten Daten überschreiben würde.</p>

                    <p>Verwenden Sie zum Speichern daher die Buttons unten, die die Daten in ihrem lokalen
                        Browserstorage speichern.</p>

                    </p>
                    <p>Wenn Sie mit Ihrer Arbeit fertig sind, klicken Sie auf <span class="fa-solid fa-file-pdf"></span><span
                                class="p-1">PDF erzeugen</span></p>


                    <form action="generate.php" method="POST">
                        <textarea name="json" id="json" class="form-control" style="font-family: monospace"></textarea>

                        <button type="submit" class="btn btn-primary mt-3"><span
                                    class="fa-solid fa-file-pdf"></span><span class="p-3">PDF erzeugen</span></button>

                    </form>
                    <button class="btn btn-danger mt-1" onclick="clear_all()"><span
                                class="fa-solid fa-trash"></span><span class="p-3">Daten leeren</span></button>

                    <h4 class="mt-3">Speichern im lokalen Browserstorage</h4>
                    <button class="btn btn-info mt-3" onclick="safe_browser()"><span
                                class="fa-solid fa-save"></span><span class="p-3">Daten speichern</span></button>
                    <button class="btn btn-info mt-3" onclick="load_browser()"><span
                                class="fa-solid fa-folder-open"></span><span class="p-3">Daten laden</span></button>
                    <button class="btn btn-danger mt-3" onclick="clear_browser()"><span
                                class="fa-solid fa-trash"></span><span class="p-3">Daten löschen</span></button>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Symbolbild
                </div>
                <div class="card-body">
                    <img src="assets/img/template.png"
                         class="img-fluid"
                         alt="Darstellung der Felder">

                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3 mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Impressum und Datenschutz
                </div>
                <div class="card-body">
                    <p>Diese Seite wurde entwickelt und wird betrieben von:</p>

                    <p>Kai Thater<br>
                    Iserbrooker Weg 67<br>
                    22589 Hamburg</p>

                    <p>
                        Kontakt:  <a href="mailto:dev@kai-thater.de?subject=Türschilder">dev@kai-thater.de</a>
                    </p>

                    <p>
                        Die von Ihnen eingegebenen Daten werden transportverschlüsselt (https) an den Server übertragen,
                        dort in ein PDF gewandelt und Ihnen wieder zurückgesendet. Außerhalb von temporären Daten während
                    der Verarbeitung werden keine Daten auf dem Server gespeichert.
                    </p>

                    <p>
                        Die von Ihnen über den "Speichern"-Button gespeicherten Daten werden in Ihrem lokalen Browser-Storage
                        gespeichert und nicht an den Server übertragen.
                    </p>



                </div>
                <div class="card-footer">
                    Version 1.0 | Das PDF-Skript wurde
                    <?php
                    $number = file_get_contents("counter.txt");
                    echo $number;
                    ?>
                    Mal aufgerufen.

                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>

<?php

function input($name, $label = "", $required = false, $type = "text")
{

    if ($required) {
        $required = "required";
    } else {
        $required = "";
    }

    return "
<div class='form-group'>
    <label class='col-form-label' for='$name'>$label</label>
    <input $required type='$type' name='$name' class='form-control' id='$name'>
</div>
    ";
}










