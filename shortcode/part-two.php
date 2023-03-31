<?php
/**
 * @package  HouseConfigurator
 */
global $wpdb;
//  btw_list list from database [wp_house_configurator_part_2] where name = 'btw_list'
$btw_list_table = $wpdb->prefix . 'house_configurator_part_2';
$btw_list = $wpdb->get_var("SELECT value FROM $btw_list_table WHERE name = 'btw_list'");
$btw_list = json_decode($btw_list, true);
//  aff_list list from database [wp_house_configurator_part_2] where name = 'afplakken_list'
$aff_list_table = $wpdb->prefix . 'house_configurator_part_2';
$aff_list = $wpdb->get_var("SELECT value FROM $aff_list_table WHERE name = 'afplakken_list'");
$aff_list = json_decode($aff_list, true);
// contact list
$contact_list_table = $wpdb->prefix . 'house_configurator_part_2';
$contact_list = $wpdb->get_var("SELECT value FROM $contact_list_table WHERE name = 'contact_list'");
$contact_list = json_decode($contact_list, true);

$price = esc_attr( get_option( 'house_config_house_part_two_price' ) );
?>

<div class="row">
    <div class="col-12">
        <div class="card h__card shadow">
            <div class="card-header text-center bg-transparent">
                <h3 class="card-title m-0"><?php echo esc_html('Wij werken in Nederland + grensgebied', 'house-configurator'); ?></h3>
                <h5 class="m-0 mt-4 text-success"><?php echo esc_html('BETALING IN 3 TERMIJNEN IS MOGELIJK!', 'house-configurator'); ?></h5>
                <p class="text-success m-0"><?php echo esc_html('Vraag naar de voorwaarden', 'house-configurator'); ?></p>
                <div class="ping__me text-end">
                    <a href="https://web.whatsapp.com" class="">
                        <svg width="25" height="25" viewBox="-1.5 0 259 259" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"><path d="m67.663 221.823 4.185 2.093c17.44 10.463 36.971 15.346 56.503 15.346 61.385 0 111.609-50.224 111.609-111.609 0-29.297-11.859-57.897-32.785-78.824-20.927-20.927-48.83-32.785-78.824-32.785-61.385 0-111.61 50.224-110.912 112.307 0 20.926 6.278 41.156 16.741 58.594l2.79 4.186-11.16 41.156 41.853-10.464Z" fill="#00E676"/><path d="M219.033 37.668C195.316 13.254 162.531 0 129.048 0 57.898 0 .698 57.897 1.395 128.35c0 22.322 6.278 43.947 16.742 63.478L0 258.096l67.663-17.439c18.834 10.464 39.76 15.347 60.688 15.347 70.453 0 127.653-57.898 127.653-128.35 0-34.181-13.254-66.269-36.97-89.986ZM129.048 234.38c-18.834 0-37.668-4.882-53.712-14.648l-4.185-2.093-40.458 10.463 10.463-39.76-2.79-4.186C7.673 134.63 22.322 69.058 72.546 38.365c50.224-30.692 115.097-16.043 145.79 34.181 30.692 50.224 16.043 115.097-34.18 145.79-16.045 10.463-35.576 16.043-55.108 16.043Zm61.385-77.428-7.673-3.488s-11.16-4.883-18.136-8.371c-.698 0-1.395-.698-2.093-.698-2.093 0-3.488.698-4.883 1.396 0 0-.697.697-10.463 11.858-.698 1.395-2.093 2.093-3.488 2.093h-.698c-.697 0-2.092-.698-2.79-1.395l-3.488-1.395c-7.673-3.488-14.648-7.674-20.229-13.254-1.395-1.395-3.488-2.79-4.883-4.185-4.883-4.883-9.766-10.464-13.253-16.742l-.698-1.395c-.697-.698-.697-1.395-1.395-2.79 0-1.395 0-2.79.698-3.488 0 0 2.79-3.488 4.882-5.58 1.396-1.396 2.093-3.488 3.488-4.883 1.395-2.093 2.093-4.883 1.395-6.976-.697-3.488-9.068-22.322-11.16-26.507-1.396-2.093-2.79-2.79-4.883-3.488H83.01c-1.396 0-2.79.698-4.186.698l-.698.697c-1.395.698-2.79 2.093-4.185 2.79-1.395 1.396-2.093 2.79-3.488 4.186-4.883 6.278-7.673 13.951-7.673 21.624 0 5.58 1.395 11.161 3.488 16.044l.698 2.093c6.278 13.253 14.648 25.112 25.81 35.575l2.79 2.79c2.092 2.093 4.185 3.488 5.58 5.58 14.649 12.557 31.39 21.625 50.224 26.508 2.093.697 4.883.697 6.976 1.395h6.975c3.488 0 7.673-1.395 10.464-2.79 2.092-1.395 3.487-1.395 4.882-2.79l1.396-1.396c1.395-1.395 2.79-2.092 4.185-3.487 1.395-1.395 2.79-2.79 3.488-4.186 1.395-2.79 2.092-6.278 2.79-9.765v-4.883s-.698-.698-2.093-1.395Z" fill="#FFF"/></svg>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="body-header text-left mb-3">
                    <h6 class="m-0"><strong><?php echo esc_html('ONLINE OFFERTE - AIRLESS LATEX SPUITEN', 'house-configurator'); ?></strong> | <small><?php echo esc_html('Terug naar de website', 'house-configurator'); ?></small></h6>
                </div>
                <hr />
                <form class="h__form_body" method="GET" id="calculator_02">
                    <div class="form-group row">
                        <label class="col-3" for="number"><h4><?php echo esc_html('Terug naar de website', 'house-configurator'); ?>01.</h4></label>
                        <div class="col-9">
                            <select name="btw__list" class="form-control form-select bg-light">
                                <option value=""><?php echo esc_html('Selecter', 'house-configurator'); ?></option>
                                <?php foreach($btw_list as $data) : ?>
                                    <option value="<?php echo $data['value']; ?>"  <?php if(isset($_GET['btw__list']) && $_GET['btw__list'] === $data['value']) echo 'selected'; ?>> <?php echo $data['name']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3" for="number"><h4>02.</h4></label>
                        <div class="col-9">
                            <select name="aff__list" class="form-control form-select bg-light">
                                <option value=""><?php echo esc_html('Selecter', 'house-configurator'); ?></option>
                                <?php foreach($aff_list as $data) : ?>
                                    <option value="<?php echo $data['value']; ?>" <?php if(isset($_GET['aff__list']) && $_GET['aff__list'] === $data['value']) echo 'selected'; ?>> <?php echo $data['name']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <small>- <?php echo esc_html('Links vierkante meters in wit - Rechts vierkante meters in kleur', 'house-configurator'); ?></small><br />
                            <small>- <?php echo esc_html('Geen kleurcodes invoeren', 'house-configurator'); ?>	</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- two input and one label-->
                        <label class="col-3" for="number"><h4>03.</h4></label>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-5 col-sm-6 col-md-5 col-lg-5">
                                    <input type="number" class="form-control bg-light" name="wit" placeholder="Wit" value="<?php echo isset($_GET['wit']) ? $_GET['wit'] : ''; ?>">
                                </div>
                                <div class="col-5 col-sm-6 col-md-5 col-lg-5">
                                    <input type="number" class="form-control bg-light" name="kleur" placeholder="Kleur" value="<?php echo isset($_GET['kleur']) ? $_GET['kleur'] : ''; ?>">
                                </div>
                                <div class="col-2 d-sm-none d-md-block">
                                    <h4>M2</h4>
                                </div>
                                <small><?php echo esc_html('Hoe heeft u ons gevonden?', 'house-configurator'); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3" for="number"><h4>04.</h4></label>
                        <div class="col-9">
                            <select name="c__list" class="form-control form-select bg-light">
                                <option value=""><?php echo esc_html('Selecter', 'house-configurator'); ?></option>
                            <?php foreach($contact_list as $key => $data) : ?>
                                <option value="<?php echo $key + 1; ?>" <?php if(isset($_GET['c__list']) && $_GET['c__list'] === $key + 1) echo 'selected'; ?>> <?php echo $data; ?> </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- submit and name is calculate -->
                    <div class="form-group row">
                        <label class="col-3" for="number"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-warning" value="Calculate">
                            <!-- reset -->
                            <input type="reset" class="btn btn-danger" value="Reset">
                        </div>
                    </div>
                </form>
                <hr />
                <!-- calculation result with bootstrap tabkle -->
                <div class="result cal__result">
                    <?php
                        // if server request method is post then calculate
                        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                            // get value from form
                            $total = 0;
                            $discount = 0;
                            $subtotal = 0;
                            $btw = isset($_GET['btw__list']) ? $_GET['btw__list'] : '';
                            $aff = isset($_GET['aff__list']) ? $_GET['aff__list'] : '';
                            $wit = isset($_GET['wit']) ? $_GET['wit'] : '';
                            $kleur = isset($_GET['kleur']) ? $_GET['kleur'] : '';
                            $c__list = isset($_GET['c__list']) ? $_GET['c__list'] : '';
                            // calculate and before convert to int
                            $total = ((int)$wit + (int)$kleur) * (int)$price + (int)$btw;
                           if( $total > 0 ) {
                                $discount = 15;
                                $subtotal = $total - $discount;
                           }                            
                            // show result
                            echo '<h4 class="text-center my-4">Uw totaal bedrag is: € '. $total .'</h4>';
                            echo '<table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>SUBTOTAAL: (incl. btw)</td>
                                            <td><h5>€ '. $total. '('. (int)$wit + (int)$kleur.' M2)'.'</h5></td>
                                        </tr>
                                        <tr>
                                            <td>KORTING:</td>
                                            <td><h5>€ '. $discount.'</h5></td>
                                        </tr>
                                        <tr>
                                            <td>TOTAAL:</td>
                                            <td><h5>€ '. $subtotal.'</h5></td>
                                        </tr>
                                    </tbody>
                                </table>';

                            echo '<div class="text-center">
                                    <button class="btn btn-success" onclick="generatePDF()">Download PDF</button>
                                </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script> -->
<!-- <script>

    function generatePDF() {
        var doc = new jsPDF();
        var form = document.getElementById('calculator_02');
        var formData = new FormData(form);

        // Add website logo
        // doc.addImage("https://sample-videos.com/img/Sample-jpg-image-50kb.jpg", "JPG", 15, 40, 180, 180);

        // Add website name
        doc.setFontSize(20);
        var websiteName = 'Bouwspecialist.nl';
        var websiteNameWidth = doc.getStringUnitWidth(websiteName) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        var x = (doc.internal.pageSize.width - websiteNameWidth) / 2;
        doc.text(x, 20, websiteName).setFontSize(14);

        var websiteUrl = 'https://bouwspecialist.nl/';
        var websiteUrlWidth = doc.getStringUnitWidth(websiteUrl) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        x = (doc.internal.pageSize.width - websiteUrlWidth) / 2;
        doc.text(x, 30, websiteUrl);

        var url = window.location.href;
        var urlWidth = doc.getStringUnitWidth(url) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        x = (doc.internal.pageSize.width - urlWidth) / 2;
        doc.text(x, 40, url);

        // Add date and time of PDF generation
        var currentDate = new Date();
        var dateString = 'Generated on: ' + currentDate.toLocaleDateString() + ' ' + currentDate.toLocaleTimeString();
        doc.setFontSize(12);
        doc.text(20, 50, dateString);

        // Iterate through form data and add to PDF
        doc.setFontSize(14);
        var y = 70;
        // get result from calculation
        var sub_total = document.querySelector('.cal__result table tbody tr:nth-child(1) td:nth-child(2) h5').textContent;
        var vat = document.querySelector('.cal__result table tbody tr:nth-child(2) td:nth-child(2) h5').textContent;
        var total = document.querySelector('.cal__result h4').textContent;
        for (var pair of formData.entries()) {
            var label = '';
            var input = document.querySelector('[name="' + pair[0] + '"]');
            if (input.type === 'checkbox') {
                var inputId = input.getAttribute('id');
                label = document.querySelector('label[for="' + inputId + '"]').textContent;
            } else if (input.type === 'select-one') {
                var select = document.querySelector('[name="' + pair[0] + '"]');
                label = select.options[select.selectedIndex].textContent;
            } else {
                label = pair[0];
            }
            doc.text(20, y, label + ': ' + pair[1]);
            y += 10;
        }

        // Add sub total
        doc.text(20, y, 'Sub Total: ' + sub_total);
        // Add vat
        doc.text(20, y + 10, 'VAT: ' + vat);
        // Add total
        doc.text(20, y + 20, 'Total: ' + total);
        
        doc.save('part-01.pdf');
    }
</script> -->

<script>

    function generatePDF() {
        window.jsPDF = window.jspdf.jsPDF;
        var doc = new jsPDF();
        var form = document.getElementById('calculator_02');
        var formData = new FormData(form);

        // Add website logo
        // doc.addImage("https://sample-videos.com/img/Sample-jpg-image-50kb.jpg", "JPG", 15, 40, 180, 180);

        // Add website name
        doc.setFontSize(20);
        var websiteName = 'Bouwspecialist.nl';
        var websiteNameWidth = doc.getStringUnitWidth(websiteName) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        var x = (doc.internal.pageSize.width - websiteNameWidth) / 2;
        doc.text(x, 20, websiteName).setFontSize(14);

        var websiteUrl = 'https://bouwspecialist.nl/';
        var websiteUrlWidth = doc.getStringUnitWidth(websiteUrl) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        x = (doc.internal.pageSize.width - websiteUrlWidth) / 2;
        doc.text(x, 30, websiteUrl);

        var url = window.location.href;
        var urlWidth = doc.getStringUnitWidth(url) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        x = (doc.internal.pageSize.width - urlWidth) / 2;

        // Add date and time of PDF generation


        // Iterate through form data and add to PDF
        doc.setFontSize(14);
        var y = 70;
        var sub_total = document.querySelector('.cal__result table tbody tr:nth-child(1) td:nth-child(2) h5').textContent;
        var vat = document.querySelector('.cal__result table tbody tr:nth-child(2) td:nth-child(2) h5').textContent;
        var total = document.querySelector('.cal__result table tbody tr:nth-child(3) td:nth-child(2) h5').textContent;
        // Iterate through form data and create a table
        var tableData = [];
        for (var pair of formData.entries()) {
            var label = '';
            var input = document.querySelector('[name="' + pair[0] + '"]');
            if (input.type === 'checkbox') {
                var inputId = input.getAttribute('id');
                label = document.querySelector('label[for="' + inputId + '"]').textContent;
            } else if (input.type === 'select-one') {
                var select = document.querySelector('[name="' + pair[0] + '"]');
                label = select.options[select.selectedIndex].textContent;
            } else {
                label = pair[0];
            }
            tableData.push([label, '€ ' + pair[1]]); // modify this line to push an array
        }

        //
        tableData.push(['Sub Total', sub_total]);
        tableData.push(['VAT', vat]);
        tableData.push(['Total', total]);

        // Set table column headers and options
        var tableColumns = ['Items', 'Price'];
        var tableOptions = {
            startY: y + 10,
            margin: {left: 20, right: 20},
            bodyStyles: {fontSize: 12},
            headStyles: {fontSize: 14, halign: 'left'},
            columnStyles: {
                0: {cellWidth: 'auto', fontStyle: 'bold'},
                1: {cellWidth: 'auto'}
            },
            theme: 'striped',
        };

        // Generate the table
        doc.autoTable(tableColumns, tableData, tableOptions);




        // doc.text(20, y, 'Total Price: ' + cal__result);


        // add footer text
        doc.setFontSize(10);
        var footerText = "The invoice is created on a computer and is valid without the signature and stamp.";
        var footerTextWidth = doc.getStringUnitWidth(footerText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        x = (doc.internal.pageSize.width - footerTextWidth) / 2;
        // doc.text(x, 280, footerText);


        // add date and current url of PDF generation it should be at the bottom left of the page and same line as date
        var date = new Date();
        var dateString = 'Generated on: ' + date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        var dateStringWidth = doc.getStringUnitWidth(dateString) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        var dateStringX = 20; // Set the x-coordinate for the date text on the left side
        var url = window.location.href;
        var urlWidth = doc.getStringUnitWidth(url) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        var urlX = doc.internal.pageSize.width - urlWidth - 20; // Set the x-coordinate for the URL text on the right side
        var textY = doc.internal.pageSize.height - 10; // Set the margin to 10 units from the bottom of the page
        doc.setFontSize(10);
        doc.text(dateStringX, textY, dateString);
        doc.text(urlX, textY, url);

        // Save the PDF

        doc.save('part-02.pdf');
    }

</script>