<style>
   .heading_details {
    display: flex;
    justify-content: space-around;
}
    </style>
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?= validation_list_errors() ?>
                    
                   <div class="heading_details">
                         <h3>User Details</h3> <button class="btn btn-primary mt-1" onclick="window.print()">Print</button>
                    </div>
                    <div class="card card-primary mt-3">
                        
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Open Ticket No.:</td>
                                    <td><?= $user->token ?></td>
                                </tr>
                                <tr>
                                    <td>Applicant Name:</td>
                                    <td><?= $user->user_name ?></td>
                                </tr>
                                <tr>
                                    <td>Applicant Mobile No.</td>
                                    <td><?= $user->phone ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Request</td>
                                    <td><?= date('d/m/Y', strtotime($user->created_at)); ?></td>
                                </tr>
                                <tr>
                                    <td>Supprted Department</td>
                                    <td><?= $user->department_name; ?></td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td><?= $user->district_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Tehsil</td>
                                    <td><?= $user->tehsil_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Gram Panchayat</td>
                                    <td><?= $user->panchayat_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Village</td>
                                    <td><?= $user->village_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Created_at</td>
                                    <td><?= date('d/m/Y',strtotime($user->created_at)); ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?= $user->status; ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </section>

</div>


<script>
    // Add JavaScript to handle printing
    document.getElementById('printPdf').addEventListener('click', function() {
        // Open the PDF in a new window
        window.open('<?= site_url('home/generatePdf') ?>', '_blank');
    });
</script>
