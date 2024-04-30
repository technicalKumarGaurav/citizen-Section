<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?= validation_list_errors() ?>
                    <!-- general form elements -->
                    <div class="card card-primary mt-3">
                  
                        <form id="citizen" action="<?= site_url('/submit-data') ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Applicant Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                        value="<?= old('name');?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Enter Mobile No.</label>
                                    <input type="number" class="form-control" placeholder="Enter Mobile Number"
                                        name="phone" value="<?= old('phone');?>">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">District</label>
                                        <select class="form-control" name="district"
                                            id="district" required>
                                            <option value=""> Select District</option>
                                            <?php foreach ($districts as $district) : ?>
                                            <option value="<?= $district['id'] ?>"><?= $district['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Tehsil</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="tehsil"
                                            id="tehsil" disabled>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Gram Panchayat</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="gp"
                                            id="panchayat" disabled>
                                            <option selected diasabled> Select Gram Panchayat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Village</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="village"
                                            id="village" disabled>
                                            <option selected diasabled> Village</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Select Slot for judicial</label>
                                    <div class="input-group">
                                    <select class="form-control select2 select2-hidden-accessible" name="slot">
                                        <option selected disabled>Please Select Slot</option>
                                        <?php foreach ($dates as $date) : ?>
                                            <option value="<?= $date['slot_date'] ?>" ><?= date('d/m/Y',strtotime($date['slot_date'])) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Department</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="department"
                                        id="">
                                        <?php foreach ($departments as $department) : ?>
                                        <option value="<?= $department['id'] ?>"><?= $department['department_name'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group">   
                                        <input type="file" class="form-control-file" id="file" name="user_file">
                                        <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const districtDropdown = document.getElementById('district');
        const tehsilDropdown = document.getElementById('tehsil');
        const panchayatDropdown = document.getElementById('panchayat');
        const villageDropdown = document.getElementById('village');

        districtDropdown.addEventListener('change', async function () {
            const selectedDistrictId = this.value;
            if (selectedDistrictId) {
                const tehsils = await fetchTehsils(selectedDistrictId);
                updateDropdown(tehsilDropdown, tehsils);
                tehsilDropdown.disabled = false;
                panchayatDropdown.disabled = true;
                villageDropdown.disabled = true;
            } else {
                tehsilDropdown.disabled = true;
                panchayatDropdown.disabled = true;
                villageDropdown.disabled = true;
            }
        });

        tehsilDropdown.addEventListener('change', async function () {
            const selectedTehsilId = this.value;
            if (selectedTehsilId) {

                const panchayats = await fetchPanchayats(selectedTehsilId);

                updateDropdown(panchayatDropdown, panchayats);

                panchayatDropdown.disabled = false;

                villageDropdown.disabled = true;
            } else {
                panchayatDropdown.disabled = true;
                villageDropdown.disabled = true;
            }
        });
        panchayatDropdown.addEventListener('change', async function () {
            const selectedPanchayatId = this.value;
            if (selectedPanchayatId) {
                const villages = await fetchVillages(selectedPanchayatId);
                updateDropdown(villageDropdown, villages);
                villageDropdown.disabled = false;
            } else {
                villageDropdown.disabled = true;
            }
        });

        async function fetchTehsils(districtId) {
            const response = await fetch(`/api/tehsils?districtId=${districtId}`);
            if (response.ok) {
                return response.json();
            } else {
                console.error('Failed to fetch tehsils');
                return [];
            }
        }

        async function fetchPanchayats(tehsilId) {
            const response = await fetch(`/api/panchayats?tehsilId=${tehsilId}`);
            if (response.ok) {
                return response.json();
            } else {
                console.error('Failed to fetch panchayats');
                return [];
            }
        }

        async function fetchVillages(panchayatId) {
            const response = await fetch(`/api/villages?panchayatId=${panchayatId}`);
            if (response.ok) {
                return response.json();
            } else {
                console.error('Failed to fetch villages');
                return [];
            }
        }

        function updateDropdown(dropdown, options) {
            dropdown.innerHTML = '';

            // Adding "Please Select" option
            const pleaseSelectOption = document.createElement('option');
            pleaseSelectOption.value = '';
            pleaseSelectOption.textContent = 'Please Select';
            dropdown.appendChild(pleaseSelectOption);

            // Adding other options
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.name;
                dropdown.appendChild(optionElement);
            });
        }
    });
</script>
<!--Form Validation-->
<script>
    $(document).ready(function () {
        $("#citizen").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength:10
                },
                district: {
                    required: true,
                },
                tehsil:{
                    required: true,
                },
                gp:{
                    required: true,
                },
                village:{
                    required: true,
                },
                user_file: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 2 characters long"
                },
                phone: {
                    required: "Please enter your mobile number",
                    number: "Please enter a valid mobile number",
                    minlength: "Mobile number must be at least 10 characters long"
                },
                district: {
                    required: "Please select a district",
                },
                file: {
                    required: "Please select a file",
                    accept: "Only pdf",
                    filesize: "File size must be less than 5MB"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
        $.validator.addMethod('filesize', function (value, element, param) {

            var fileSize = element.files[0].size;

            var maxSize = param * 1024 * 1024;

            return this.optional(element) || fileSize <= maxSize;
        }, '');
    });
</script>
