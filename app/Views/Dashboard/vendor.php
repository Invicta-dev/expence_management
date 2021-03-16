<?= $this->include('includes/header'); ?>
<?= $this->include('includes/sidebar'); ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Vendors</a>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Vendors
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="#add-user-modal" data-toggle="modal" class="btn green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th> vendor name </th>
                                    <th> Contact person name </th>
                                    <th> Phone no. </th>
                                    <th> GST No. </th>
                                    <th> Location </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($vendors)) {
                                    foreach ($vendors as $vendor) : ?>

                                        <tr>
                                            <td><?= $vendor['vendor_name']; ?></td>
                                            <td><?= $vendor['contact']; ?> </td>
                                            <td> <?= $vendor['phone']; ?> </td>
                                            <td> <?= $vendor['gst_no']; ?> </td>
                                            <td> <?= $vendor['location']; ?> </td>
                                            <td>
                                                <!-- <a class="edit-user" data-toggle="modal" href="#edit-user-modal"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;</a> -->
                                                <a class="delete-user" onclick="delete_vendor(<?= $vendor['id'] ?>)"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<div id="edit-user-modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit the details</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <form action="" class="horizontal-form">
                        <div class="form-body">
                            <!-- <h3 class="form-section">Person Info</h3> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Vendor name</label>
                                        <input type="text" name="vendorName" class="form-control" value="Limbras">
                                        <!-- <span class="help-block"> This is inline help </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Contact person name</label>
                                        <input type="text" name="contactName" class="form-control" value="Alex Nilson">
                                        <!-- <span class="help-block"> This field has error. </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone No.</label>
                                        <input type="text" name="phoneNo" class="form-control" value="123456789">
                                        <!-- <span class="help-block"> This is inline help </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">GST No.</label>
                                        <input type="text" name="gstNo" class="form-control" value="GSTIN088809do2e23">
                                        <!-- <span class="help-block"> This is inline help </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Location</label>
                                        <input type="text" name="location" class="form-control" value="Fatorda">
                                        <!-- <span class="help-block"> This field has error. </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="submit" class="btn green">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="add-user-modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" method="post" class="horizontal-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div id='myDiv'></div>
                    <h4 class="modal-title">Add new vendor</h4>
                </div>
                <div class="modal-body">
                    <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">

                        <div class="form-body">
                            <!-- <h3 class="form-section">Person Info</h3> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Vendor name</label>
                                        <input type="text" name="vendorName" class="form-control">
                                        <!-- <span class="help-block"> This is inline help </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Contact person name</label>
                                        <input type="text" name="contactName" class="form-control">
                                        <!-- <span class="help-block"> This field has error. </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone No.</label>
                                        <input type="text" name="phoneNo" class="form-control">
                                        <!-- <span class="help-block"> This is inline help </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">GST No.</label>
                                        <input type="text" name="gstNo" class="form-control">
                                        <!-- <span class="help-block"> This is inline help </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Location</label>
                                        <input type="text" name="location" class="form-control">
                                        <!-- <span class="help-block"> This field has error. </span> -->
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <!-- <button type="button" class="btn green">Save changes</button> -->
                    <input type="submit" class="btn green" value="Save changes">
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END CONTAINER -->
<?= $this->include('includes/footer'); ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- <script src="./assets/pages/js/table-datatables-editable.min.js" type="text/javascript"></script> -->
<script src="./assets/pages/js/table-datatables-editable.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    $(function() {

        $('form').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '<?= base_url(); ?>/vendor',
                data: $('form').serialize(),
                success: function(data) {
                    if (data == 'validation successful') {
                        $("#add-user-modal").modal("hide");

                        swal({
                            title: "success",
                            text: "Vendor added successfully",
                            icon: "success"
                        }).then(function() {
                            location.reload();
                        });

                    } else {
                        $("#myDiv").html(data);
                        $("#myDiv").attr('role', 'alert');
                        $("#myDiv").addClass("alert alert-danger");
                    }
                }
            });

        });

    });
</script>
<!-- delete vendor -->
<script type="text/javascript">
    function delete_vendor(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data from database
            $.ajax({
                url: "<?= base_url(); ?>/delete-vendor/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>