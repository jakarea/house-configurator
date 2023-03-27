<?php
/**
 * @package  HouseConfigurator
 */

 global $wpdb;
    // get all levels from database
    $h_type = $wpdb->prefix . 'house_configurator_type';
    $levels = $wpdb->get_results("SELECT * FROM $h_type");

    // get all features from database
    $h_feature = $wpdb->prefix . 'house_configurator_feature';
    $features = $wpdb->get_results("SELECT * FROM $h_feature");

    $house_configure_price = esc_attr( get_option( 'house_configure_price' ) );

?>
<!-- add simple bootstrap card -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title"><?php echo esc_html('House Configurator', 'house-configurator'); ?></h5>
            </div>
            <div class="card-body">
                <form action="#" method="post" id="calculate_01">
                    <div class="form-group mb-3">
                        <label for="square_meters"><?php echo esc_html('Surface area in square metres', 'house-configurator'); ?></label>
                        <input type="number" class="form-control" id="square_meters" name="square_meters" placeholder="Enter square meters" value="<?php echo $house_configure_price; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="levels"><?php echo esc_html('All Levels', 'house-configurator'); ?></label>
                        <select class="form-control" id="levels" name="levels" required>
                        <?php
                        foreach ($levels as $level) { 
                            echo '<option value="'.$level->price.'" data-id="'.$level->id.'">'.$level->name.'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div id="features">
                    <?php
                    foreach($features as $feature){ ?>
                    <div class="form-group">
                        <?php
                            echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input" type="checkbox" id="feature_'.$feature->id.'" name="feature" value="'.$feature->price.'" data-type="'.$feature->type_id.'">';
                            echo '<label class="form-check-label" for="feature_'.$feature->id.'">'.$feature->name.'</label>';
                            echo '</div>';
                        ?>                       
                    </div>
                    <?php } ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-5 shadow-sm">
            <div class="card-body text-center">
                <div class="card-title">
                    <h4 class="mb-3"><?php echo esc_html('Result', 'house-configurator'); ?></h4>
                </div>
                <div class="badge badge-primage bg-success">
                    <h3 class="mb-0 cal__result">0</h3>
                </div>
            </div>
        </div>

        <!-- generate pdf-->
        <div class="card mt-5 shadow-sm">
            <div class="card-body text-center">
                <div class="card-title">
                    <h4 class="mb-3"><?php echo esc_html('Generate PDF', 'house-configurator'); ?></h4>
                    <button class="btn btn-primary" id="generate_pdf"><?php echo esc_html('Generate PDF', 'house-configurator'); ?></button>
                    <div id="pdf_result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function generatePDF() {
        window.jsPDF = window.jspdf.jsPDF;
        var doc = new jsPDF();
        var form = document.getElementById('calculate_01');
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
        var cal__result = document.querySelector('.cal__result').innerHTML;
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
            tableData.push([label, pair[1]]); // modify this line to push an array
        }

        // add last row to table with total price
        tableData.push(['Total Price', cal__result]);

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

        doc.save('part-01.pdf');
    }

    document.getElementById('generate_pdf').addEventListener('click', generatePDF);

</script>