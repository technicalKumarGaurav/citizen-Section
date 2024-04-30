<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?= validation_list_errors() ?>
                    
                    <button class="btn btn-primary mt-2" onclick="window.print()">Print</button>
                    <div class="card card-primary mt-3">
                        
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Open Ticket No.:</td>
                                    <td><?= $user['token'] ?></td>
                                </tr>
                                <tr>
                                    <td>Applicant Name:</td>
                                    <td><?= $user['user_name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Applicant Mobile No.</td>
                                    <td><?= $user['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Request</td>
                                    <td><?= date('d/m/Y', strtotime($user['created_at'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Supprted Department</td>
                                    <td><?= $user['department_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td><?= $user['district_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tehsil</td>
                                    <td><?= $user['tehsil_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gram Panchayat</td>
                                    <td><?= $user['gp_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Village</td>
                                    <td><?= $user['village_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Village</td>
                                    <td><?= date('d/m/Y',strtotime($user['created_at'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Village</td>
                                    <td><?= $user['status'];; ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </section>

</div>