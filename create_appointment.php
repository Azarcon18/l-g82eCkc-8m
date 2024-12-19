<div class="container-fluid">
    <form action="" id="appointment-form">
        <input type="hidden" name="id">
        <input type="hidden" name="sched_type_id" value="<?php echo $_GET['sched_type_id'] ?>">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fullname" class="control-label">Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control rounded-0" required
                        pattern="09\d{9}" maxlength="11" value="09"
                        oninput="this.value = '09' + this.value.slice(2).replace(/[^0-9]/g, '')"
                        placeholder="09XXXXXXXXX">
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">Address</label>
                    <textarea name="address" id="address" class="form-control rounded-0" required></textarea>
                </div>
                <div class="form-group">
                    <label for="facebook" class="control-label">Facebook</label>
                    <input type="text" name="facebook" id="facebook" class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="schedule" class="control-label">Desired Schedule</label>
                    <input type="datetime-local" name="schedule" id="schedule" class="form-control rounded-0"
                        required min="">
                </div>
                <div class="form-group">
                    <label for="remarks" class="control-label">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control rounded-0" required></textarea>
                </div>
                <div class="form-group">
                    <label for="registry_no" class="control-label">Registry Number</label>
                    <input type="text" name="registry_no" id="registry_no" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="province" class="control-label">Province</label>
                    <input type="text" name="province" id="province" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="city_municipality" class="control-label">City/Municipality</label>
                    <input type="text" name="city_municipality" id="city_municipality" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="age_at_death" class="control-label">Age at Time of Death</label>
                    <input type="text" name="age_at_death" id="age_at_death" class="form-control rounded-0">
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <h5>Death Person Information</h5>
                <div class="form-group">
                    <label for="death_person_fullname" class="control-label">Full Name</label>
                    <input type="text" name="death_person_fullname" id="death_person_fullname"
                        class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="gender" class="control-label">Gender</label>
                    <select name="gender" id="gender" class="form-control rounded-0" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Gay">Gay</option>
                        <option value="Lesbian">Lesbian</option>
                        <option value="Bisexual/Bi">Bisexual/Bi</option>
                        <option value="Trans Gender">Trans Gender</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_of_death" class="control-label">Date of Death</label>
                    <input type="date" name="date_of_death" id="date_of_death" class="form-control rounded-0"
                        max="<?php echo date('Y-m-d', strtotime('0 day')); ?>" required>
                </div>
                <div class="form-group">
                    <label for="birthdate" class="control-label">Birthdate</label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="civil_status" class="control-label">Civil Status</label>
                    <select name="civil_status" id="civil_status" class="form-control rounded-0" required>
                        <option value="" disabled selected>Select Civil Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="resident" class="control-label">Resident</label>
                    <input type="text" name="resident" id="resident" class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="nationality" class="control-label">Nationality</label>
                    <select name="nationality" id="nationality" class="form-control rounded-0" required>
                        <option value="" disabled selected>Select your nationality</option>
                        <option value="Filipino">Filipino</option>
                        <option value="American">American</option>
                        <option value="Canadian">Canadian</option>
                        <option value="British">British</option>
                        <option value="Australian">Australian</option>
                        <option value="Indian">Indian</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mother" class="control-label">Mother's Name</label>
                    <input type="text" name="mother" id="mother" class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="father" class="control-label">Father's Name</label>
                    <input type="text" name="father" id="father" class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                    <label for="place_of_death" class="control-label">Place of Death</label>
                    <input type="text" name="place_of_death" id="place_of_death" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="religion" class="control-label">Religion</label>
                    <input type="text" name="religion" id="religion" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="occupation" class="control-label">Occupation</label>
                    <input type="text" name="occupation" id="occupation" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="immediate_cause" class="control-label">Immediate Cause of Death</label>
                    <input type="text" name="immediate_cause" id="immediate_cause" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="antecedent_cause" class="control-label">Antecedent Cause of Death</label>
                    <input type="text" name="antecedent_cause" id="antecedent_cause" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="underlying_cause" class="control-label">Underlying Cause of Death</label>
                    <input type="text" name="underlying_cause" id="underlying_cause" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="other_conditions" class="control-label">Other Significant Conditions</label>
                    <input type="text" name="other_conditions" id="other_conditions" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="maternal_condition" class="control-label">Maternal Condition</label>
                    <input type="text" name="maternal_condition" id="maternal_condition" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="manner_of_death" class="control-label">Manner of Death</label>
                    <input type="text" name="manner_of_death" id="manner_of_death" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="place_of_occurrence" class="control-label">Place of Occurrence</label>
                    <input type="text" name="place_of_occurrence" id="place_of_occurrence" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="autopsy" class="control-label">Autopsy</label>
                    <select name="autopsy" id="autopsy" class="form-control rounded-0">
                        <option value="" disabled selected>Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="attendant" class="control-label">Attendant</label>
                    <input type="text" name="attendant" id="attendant" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="corpse_disposal" class="control-label">Corpse Disposal</label>
                    <input type="text" name="corpse_disposal" id="corpse_disposal" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="cemetery_crematory" class="control-label">Cemetery or Crematory</label>
                    <input type="text" name="cemetery_crematory" id="cemetery_crematory" class="form-control rounded-0">
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];

    // Set the 'max' attribute of the date input to today's date
    document.getElementById('birthdate').setAttribute('max', today);

    $(function () {
        $('#appointment-form').submit(function (e) {
            e.preventDefault();

            // Check form validity before proceeding
            if (!this.checkValidity()) {
                this.reportValidity(); // Triggers browser's default validation messages
                return; // Stop if form is invalid
            }

            var _this = $(this);
            $('.err-msg').remove();
            start_loader();

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_appointment_req",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                dataType: 'json',
                error: function (err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (typeof resp === 'object' && resp.status === 'success') {
                        end_loader();
                        setTimeout(() => {
                            uni_modal('', 'success_msg.php');
                        }, 200);
                    } else if (resp.status === 'failed' && !!resp.msg) {
                        var el = $('<div>');
                        el.addClass("alert alert-danger err-msg").text(resp.msg);
                        _this.prepend(el);
                        el.show('slow');
                        $("html, body").animate({ scrollTop: _this.offset().top }, "fast");
                        end_loader();
                    } else {
                        alert_toast("An error occurred", 'error');
                        end_loader();
                        console.log(resp);
                    }
                }
            });
        });
    });
</script>