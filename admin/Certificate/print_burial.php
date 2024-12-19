<?php
// Include necessary database connection and other required files
require_once('../config.php');

$debug = false; // Set to true when you need to debug

// Enable error reporting for debugging
if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the appointment ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($debug) {
    echo "Debug: Received ID = " . $id . "<br>";
}

if ($id) {
    // Fetch the specific appointment data
    $query = "SELECT * FROM appointment_schedules WHERE id = ?";

    if ($debug) {
        echo "Debug: Query = " . $query . "<br>";
    }

    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();

    if ($appointment) {
        // Display the appointment data using the modified template
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 850px;
                    margin: 20px auto;
                    padding: 20px;
                }
                
                .certificate {
                    border: 2px solid #000080;
                    padding: 10px;
                }
                
                .header {
                    text-align: center;
                    margin-bottom: 10px;
                }
                
                .form-number {
                    text-align: left;
                    font-size: 12px;
                    float: left;
                }
                
                .form-note {
                    text-align: right;
                    font-size: 12px;
                    float: right;
                }
                
                .title {
                    font-size: 20px;
                    font-weight: bold;
                    margin: 5px 0;
                }
                
                .subtitle {
                    font-size: 14px;
                    margin: 3px 0;
                }
                
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 5px;
                }
                
                td {
                    border: 1px solid #000080;
                    padding: 5px;
                    font-size: 12px;
                }
                
                .small-text {
                    font-size: 10px;
                    color: #000080;
                }
                
                .field-label {
                    color: #000080;
                    font-size: 11px;
                }
                
                .input-field {
                    border-bottom: 1px solid #000;
                    min-height: 18px;
                }
                
                .checkbox {
                    width: 12px;
                    height: 12px;
                    border: 1px solid #000;
                    display: inline-block;
                    margin-right: 5px;
                    vertical-align: middle;
                }
                
                .blue-text {
                    color: #000080;
                }
                
                .medical-certificate {
                    text-align: center;
                    font-weight: bold;
                    border: 1px solid #000080;
                    padding: 5px;
                    margin: 10px 0;
                }

                .clearfix::after {
                    content: "";
                    clear: both;
                    display: table;
                }
            </style>
        </head>
        <body>
            <div class="certificate">
                <div class="header clearfix">
                    <div class="form-number">Municipal Form No. 103<br>(Revised January 2007)</div>
                    <div class="form-note">(To be accomplished in quadruplicate using black ink)</div>
                    <div style="clear: both;"></div>
                    <div class="subtitle">Republic of the Philippines</div>
                    <div class="subtitle">OFFICE OF THE CIVIL REGISTRAR GENERAL</div>
                    <div class="title">CERTIFICATE OF DEATH</div>
                </div>

                <table>
                    <tr>
                        <td width="80%">Province<div class="input-field"><?php echo htmlspecialchars($appointment['province']); ?></div></td>
                        <td>Registry No.<div class="input-field"><?php echo htmlspecialchars($appointment['registry_no']); ?></div></td>
                    </tr>
                    <tr>
                        <td colspan="2">City/Municipality<div class="input-field"><?php echo htmlspecialchars($appointment['city_municipality']); ?></div></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td width="75%">
                            1. NAME
                            <div class="field-label">
                                <table style="border: none;">
                                    <tr>
                                        <td style="border: none;" width="33%">(First)</td>
                                        <td style="border: none;" width="33%">(Middle)</td>
                                        <td style="border: none;" width="33%">(Last)</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['death_person_fullname']); ?></div>
                        </td>
                        <td>
                            2. SEX
                            <div class="field-label">(Male/Female)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['gender']); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            3. DATE OF DEATH
                            <div class="field-label">(Day, Month, Year)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['date_of_death']); ?></div>
                        </td>
                        <td>
                            4. DATE OF BIRTH
                            <div class="field-label">(Day) (Month) (Year)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['birthdate']); ?></div>
                        </td>
                        <td>
                            5. AGE AT THE TIME OF DEATH
                            <div class="field-label">(Fill-in below accrdg. to age category)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['age_at_death']); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            6. PLACE OF DEATH
                            <div class="field-label">(Name of Hospital/Clinic/Institution/House No., St., Barangay, City/Municipality, Province)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['place_of_death']); ?></div>
                        </td>
                        <td width="30%">
                            7. CIVIL STATUS
                            <div class="field-label">(Single/Married/Widow/<br>Widower/Annulled/Divorced)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['civil_status']); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            8. RELIGION/RELIGIOUS SECT
                            <div class="input-field"><?php echo htmlspecialchars($appointment['religion']); ?></div>
                        </td>
                        <td>
                            9. CITIZENSHIP
                            <div class="input-field"><?php echo htmlspecialchars($appointment['nationality']); ?></div>
                        </td>
                        <td>
                            10. RESIDENCE
                            <div class="field-label">(House No., St., Barangay, City/Municipality, Province, Country)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['resident']); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            11. OCCUPATION
                            <div class="input-field"><?php echo htmlspecialchars($appointment['occupation']); ?></div>
                        </td>
                        <td>
                            12. NAME OF FATHER
                            <div class="field-label">(First, Middle, Last)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['father']); ?></div>
                        </td>
                        <td>
                            13. MAIDEN NAME OF MOTHER
                            <div class="field-label">(First, Middle, Last)</div>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['mother']); ?></div>
                        </td>
                    </tr>
                </table>

                <div class="medical-certificate">
                    MEDICAL CERTIFICATE
                    <br>
                    <span style="font-size: 11px;">(For ages 0 to 7 days, accomplish items 14-19a at the back)</span>
                </div>

                <table>
                    <tr>
                        <td colspan="2">
                            19b. CAUSES OF DEATH (If the deceased is aged 8 days and over)
                            <div style="text-align: right;">Interval Between Onset and Death</div>
                            <div style="margin-top: 10px;">
                                I. Immediate cause : a.<div class="input-field"><?php echo htmlspecialchars($appointment['immediate_cause']); ?></div>
                                <br>Antecedent cause : b.<div class="input-field"><?php echo htmlspecialchars($appointment['antecedent_cause']); ?></div>
                                <br>Underlying cause : c.<div class="input-field"><?php echo htmlspecialchars($appointment['underlying_cause']); ?></div>
                                <br>II. Other significant conditions contributing to death:<div class="input-field"><?php echo htmlspecialchars($appointment['other_conditions']); ?></div>
                            </div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td colspan="5">19c. MATERNAL CONDITION (If the deceased is female aged 15-49 years old)</td>
                    </tr>
                    <tr>
                        <td>
                            a. pregnant,<br>not in labour
                            <div class="input-field"><?php echo htmlspecialchars($appointment['maternal_condition'] == 'pregnant_not_in_labour' ? '✔' : ''); ?></div>
                        </td>
                        <td>
                            b. pregnant, in<br>labour
                            <div class="input-field"><?php echo htmlspecialchars($appointment['maternal_condition'] == 'pregnant_in_labour' ? '✔' : ''); ?></div>
                        </td>
                        <td>
                            c. less than 42 days after<br>delivery
                            <div class="input-field"><?php echo htmlspecialchars($appointment['maternal_condition'] == 'less_than_42_days' ? '✔' : ''); ?></div>
                        </td>
                        <td>
                            d. 42 days to 1 year after<br>delivery
                            <div class="input-field"><?php echo htmlspecialchars($appointment['maternal_condition'] == '42_days_to_1_year' ? '✔' : ''); ?></div>
                        </td>
                        <td>
                            e. None of the<br>choices
                            <div class="input-field"><?php echo htmlspecialchars($appointment['maternal_condition'] == 'none' ? '✔' : ''); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td colspan="2">
                            19d. DEATH BY EXTERNAL CAUSES
                            <div style="margin-top: 5px;">
                                a. Manner of death <span class="blue-text">(Homicide, Suicide, Accident, Legal intervention, etc.)</span>
                                <div class="input-field"><?php echo htmlspecialchars($appointment['manner_of_death']); ?></div>
                            </div>
                            <div style="margin-top: 5px;">
                                b. Place of Occurrence of External Cause <span class="blue-text">(e.g. home, farm, factory, street, sea, etc.)</span>
                                <div class="input-field"><?php echo htmlspecialchars($appointment['place_of_occurrence']); ?></div>
                            </div>
                        </td>
                        <td width="20%">
                            20. AUTOPSY
                            <span class="blue-text">(Yes / No)</span>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['autopsy']); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td width="70%">
                            21a. ATTENDANT
                            <div style="margin-top: 5px;">
                                <span class="checkbox"><?php echo $appointment['attendant'] == 'Private Physician' ? '✔' : ''; ?></span>1 Private Physician
                                <span class="checkbox"><?php echo $appointment['attendant'] == 'Public Health Officer' ? '✔' : ''; ?></span>2 Public Health Officer
                                <span class="checkbox"><?php echo $appointment['attendant'] == 'Hospital Authority' ? '✔' : ''; ?></span>3 Hospital Authority
                                <span class="checkbox"><?php echo $appointment['attendant'] == 'None' ? '✔' : ''; ?></span>4 None
                                <span class="checkbox"><?php echo $appointment['attendant'] == 'Others' ? '✔' : ''; ?></span>5 Others (Specify)_______
                            </div>
                        </td>
                        <td>
                            21b. If attended, state duration (mm/dd/yy)<br>
                            From _____________ To _____________
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td colspan="2">
                            22. CERTIFICATION OF DEATH<br>
                            I hereby certify that the foregoing particulars are correct as near as same can be ascertained and I further certify that I
                            <span class="checkbox"></span> have attended/
                            <span class="checkbox"></span> have not attended the deceased and that death occurred at __________ am/pm on the date of death specified above.
                            <div style="margin-top: 10px;">
                                Signature <div class="input-field"></div>
                                Name in Print <div class="input-field"></div>
                                Title or Position <div class="input-field"></div>
                                Address <div class="input-field"></div>
                                Date <div class="input-field"></div>
                            </div>
                        </td>
                        <td width="30%">
                            REVIEWED BY:<br><br>
                            <div style="text-align: center;">
                                <div class="input-field"></div>
                                Signature Over Printed Name of Health Officer<br><br>
                                <div class="input-field"></div>
                                Date
                            </div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td width="33%">
                            23. CORPSE DISPOSAL<br>
                            <span class="blue-text">(Burial, Cremation, if others, specify)</span>
                            <div class="input-field"><?php echo htmlspecialchars($appointment['corpse_disposal']); ?></div>
                        </td>
                        <td width="33%">
                            24a. BURIAL/CREMATION PERMIT<br>
                            Number <div class="input-field"></div>
                            Date Issued <div class="input-field"></div>
                        </td>
                        <td width="33%">
                            24b. TRANSFER PERMIT<br>
                            Number <div class="input-field"></div>
                            Date Issued <div class="input-field"></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            25. NAME AND ADDRESS OF CEMETERY OR CREMATORY
                            <div class="input-field"><?php echo htmlspecialchars($appointment['cemetery_crematory']); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td width="50%">
                            26. CERTIFICATION OF INFORMANT<br>
                            I hereby certify that all information supplied are true and correct<br>
                            to my own knowledge and belief.<br><br>
                            Signature <div class="input-field"></div>
                            Name in Print <div class="input-field"></div>
                            Relationship to the Deceased <div class="input-field"></div>
                            Address <div class="input-field"></div>
                            Date <div class="input-field"></div>
                        </td>
                        <td width="50%">
                            27. PREPARED BY<br><br><br>
                            Signature <div class="input-field"></div>
                            Name in Print <div class="input-field"></div>
                            Title or Position <div class="input-field"></div>
                            Date <div class="input-field"></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td width="50%">
                            28. RECEIVED BY<br>
                            Signature <div class="input-field"></div>
                            Name in Print <div class="input-field"></div>
                            Title or Position <div class="input-field"></div>
                            Date <div class="input-field"></div>
                        </td>
                        <td width="50%">
                            29. REGISTERED BY THE CIVIL REGISTRAR<br>
                            Signature <div class="input-field"></div>
                            Name in Print <div class="input-field"></div>
                            Title or Position <div class="input-field"></div>
                            Date <div class="input-field"></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            REMARKS/ANNOTATIONS (For LCRO/OCRG Use Only)
                            <div class="input-field" style="height: 50px;"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <script>
                // Automatically print the page when it loads
                window.onload = function() {
                    window.print();
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Appointment not found.";
    }
} else {
    echo "Invalid request. No ID provided.";
}
?>