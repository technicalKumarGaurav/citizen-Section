<div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?= validation_list_errors() ?>
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= site_url('/submit-data') ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Applicant Name</label>
                                    <input type="text" class="form-control"
                                        placeholder="Enter Name" name="name" value="<?= old('name');?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Enter Mobile No.</label>
                                    <input type="number" class="form-control" 
                                        placeholder="Enter Mobile Number" name="phone" value="<?= old('phone');?>">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">District</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="district" id="district">
                                            <option selected diasabled> Select District</option>
                                            <?php foreach ($districts as $district) : ?>
                                                <option value="<?= $district['id'] ?>"><?= $district['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>    
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Tehsil</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="tehsil" id="tehsil" disabled>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Gram Panchayat</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="gp" id="panchayat" disabled>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Village</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="village" id="village" disabled>
                                            
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Select Slot for judicial</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="date" class="form-control" name="slot" placeholder="Enter District Name" value="<?= old('slot');?>">
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputFile">Department</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="village" id="">
                                    <?php foreach ($departments as $department) : ?>
                                        <option value="<?= $department['id'] ?>"><?= $department['department_name'] ?></option>
                                    <?php endforeach; ?>   
                                    </select>
                                </div>  
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // Get references to dropdowns
    const districtDropdown = document.getElementById('district');
    const tehsilDropdown = document.getElementById('tehsil');
    const panchayatDropdown = document.getElementById('panchayat');
    const villageDropdown = document.getElementById('village');

    // Event listener for district dropdown change
    districtDropdown.addEventListener('change', async function() {
        const selectedDistrictId = this.value;
        if (selectedDistrictId) {
            // Fetch tehsils for the selected district
            const tehsils = await fetchTehsils(selectedDistrictId);
            // Update tehsil dropdown options
            updateDropdown(tehsilDropdown, tehsils);
            // Enable tehsil dropdown
            tehsilDropdown.disabled = false;
            // Disable dependent dropdowns
            panchayatDropdown.disabled = true;
            villageDropdown.disabled = true;
        } else {
            // If no district is selected, disable tehsil dropdown
            tehsilDropdown.disabled = true;
            // Disable dependent dropdowns
            panchayatDropdown.disabled = true;
            villageDropdown.disabled = true;
        }
    });

    // Function to fetch tehsils for a district
    async function fetchTehsils(districtId) {
        // Make AJAX request to fetch tehsils for the selected district
        // Replace with your actual API endpoint
        const response = await fetch(`/api/tehsils?districtId=${districtId}`);
        if (response.ok) {
            return response.json();
        } else {
            console.error('Failed to fetch tehsils');
            return [];
        }
    }

    // Function to update dropdown options
    function updateDropdown(dropdown, options) {
        // Clear existing options
        dropdown.innerHTML = '';
        // Add new options
        options.forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option.id;
            optionElement.textContent = option.name;
            dropdown.appendChild(optionElement);
        });
    }

</script>