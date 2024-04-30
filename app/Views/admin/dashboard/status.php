<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?= validation_list_errors() ?>
                    <!-- general form elements -->
                    <div class="card card-primary mt-3">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div> -->
                       
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Open Ticket No.</th>
                                    <th scope="col">Applicant Name</th>
                                    <th scope="col">Applicant Mobile No.</th>
                                    <th scope="col">Date of Request</th>
                                    <th scope="col">Supprted Department</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View/Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usersData as $user): ?>
                                    <tr>
                                        <td><?php echo $user->token; ?></td>
                                        <td><?php echo $user->user_name; ?></td>
                                        <td><?php echo $user->phone; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($user->created_at)); ?></td>
                                        <td><?php echo $user->department_name; ?></td>
                                        <td><?php echo ucfirst($user->status); ?></td>
                                        <td>
                                            <a href="<?= base_url('user_details/' . $user->id) ?>">view/print</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>


                        </table>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>