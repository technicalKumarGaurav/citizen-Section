<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?= validation_list_errors() ?>
                    <!-- general form elements -->
                    <div class="card card-primary mt-3">
                        <table class="table">
                        <tbody>
                            <tr>
                                <td>Token:</td>
                                <td><?= $user['token'] ?></td>
                            </tr>
                            <tr>
                                <td>User Name:</td>
                                <td><?= $user['user_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td><?= $user['phone'] ?></td>
                            </tr>
                            <!-- Add more rows for other user details as needed -->
                        </tbody>
                        </table>
                        <button class="btn btn-primary" onclick="window.print()">Print</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>