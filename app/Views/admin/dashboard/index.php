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
                                            <option selected diasabled> Select Gram Panchayat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Village</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="village" id="village" disabled>
                                            <option selected diasabled> Village</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Select Slot for judicial</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="date" class="form-control" name="slot" placeholder="Enter" value="<?= old('slot');?>">
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputFile">Department</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="department" id="">
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const districtDropdown = document.getElementById('district');
        const tehsilDropdown = document.getElementById('tehsil');
        const panchayatDropdown = document.getElementById('panchayat');
        const villageDropdown = document.getElementById('village');

        districtDropdown.addEventListener('change', async function() {
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

        tehsilDropdown.addEventListener('change', async function() {
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
        panchayatDropdown.addEventListener('change', async function() {
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

