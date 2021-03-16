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
                    <a href="#">Add Expense</a>
                </li>
            </ul>
            <!-- <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">
                                            <i class="icon-bell"></i> Action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-shield"></i> Another action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-user"></i> Something else here</a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-bag"></i> Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Add Expenses
            <!-- <small>blank page layout</small> -->
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body form">


                        <!-- BEGIN FORM-->
                        <form action="" enctype="multipart/form-data" method="post" class="horizontal-form">
                            <div class="form-body">
                                <!-- <h3 class="form-section">Person Info</h3> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Vendor</label>
                                            <input type="text" name="ExpenseName" class="form-control" placeholder="Enter Expense title" id="vendor" autocomplete="off">
                                            <div id="vendor-list"></div>
                                            <span style="color:red"><?= (isset($validation) && $validation->hasError('ExpenseName')) ? $validation->getError('ExpenseName') : ''; ?> </span>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Bill Upload</label>
                                            <input type="file" name="BillDetails[]" class="form-control" placeholder="Upload the bill details" multiple>
                                            <span style="color:red"><?= (isset($validation) && $validation->hasError('BillDetails')) ? $validation->getError('BillDetails') : ''; ?> </span>

                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Process</label>
                                            <select class="form-control" name="process" data-placeholder="Choose a Process" tabindex="1">
                                                <?php foreach ($processes as  $process) : ?>
                                                    <option value="<?= $process['process_name'] ?>"><?= $process['process_name'] ?></option>
                                                    <!-- <option value="Category 2">USA</option>
                                                <option value="Category 3">CANADA</option>
                                                <option value="Category 4">DOMESTIC</option> -->
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select class="form-control" name="category" data-placeholder="Choose a Category" tabindex="1">
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?></option>
                                                    <!-- <option value="Category 2">Grocery</option>
                                                <option value="Category 3">Supplies</option>
                                                <option value="Category 4">Others</option> -->
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Payment Method</label>
                                            <select class="form-control" name="paymentMode" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="cash" selected disabled>--- Select payment type ---</option>
                                                <option value="cash">Cash</option>
                                                <option value="bank transfer">Bank Transfer</option>
                                                <option value="Credit card">Credit card</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Add Items</label><br>

                                            <div id="itemRows">
                                                Item Name: <input class="form-control input-small" type="text" name="add_name" style="display: inline-block;" /> Price: <input class="form-control input-xsmall" type="text" name="add_price" size="4" style="display: inline-block;" />
                                                <input onclick="addRow(this.form);" type="button" value="Add row" /><br>
                                            </div>
                                            <br>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Total Amount</label><br>
                                            <div class="amount-currency" style="display: inline-flex;">
                                                <select class="form-control input-xsmall" name="currency" data-placeholder="Choose a Category" tabindex="1" style="border-radius: 4px 0 0 4px;">
                                                    <!-- <option value="£">£</option>
                                                    <option value="$">$</option> -->
                                                    <option value="₹">₹</option>
                                                </select>
                                                <input class="form-control" type="number" name="amount" autocomplete="off" placeholder="Total Amount" style="border-radius: 0 4px 4px 0;" />
                                                <span style="color:red"><?= (isset($validation) && $validation->hasError('amount')) ? $validation->getError('amount') : ''; ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <label class="control-label">Total Amount</label>
                                            <input class="form-control" name="amount" type="number" autocomplete="off" placeholder="Total Amount" /> -->
                                    <!-- </div>
                                    </div> -->
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>
                            <div class="form-actions left">
                                <a href="<?= base_url() ?>/dashboard" class="btn default">Cancel</a>
                                <button type="submit" class="btn blue">
                                    <i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>

                        <!-- END FORM-->
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
<!-- END CONTAINER -->
<?= $this->include('includes/footer'); ?>
<?php if (session()->has('foo')) :  ?>
    // echo session()->getFlashdata('foo');
    <script>
        swal("SUCCESS", "<?= session()->getFlashdata('foo') ?>", "success");
    </script>
<?php endif; ?>
<script type="text/javascript">
    var rowNum = 0;

    function addRow(frm) {
        rowNum++;
        var row = '<p id="rowNum' + rowNum + '"> Item Name: <input style="display: inline-block;" class="form-control input-small" type="text" name="name[]" value="' + frm.add_name.value + '"> Price: <input style="display: inline-block;" class="form-control input-xsmall" type="text" name="price[]" size="4" value="' + frm.add_price.value + '"> <input type="button" value="Remove" onclick="removeRow(' + rowNum + ');"></p>';
        jQuery('#itemRows').append(row);
        frm.add_price.value = '';
        frm.add_name.value = '';
    }

    function removeRow(rnum) {
        jQuery('#rowNum' + rnum).remove();
    }

    // <!-- Auto complete vendor field -->
    $(document).ready(function() {
        $('#vendor').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: "<?= base_url(); ?>/listVendor",
                    type: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#vendor-list').fadeIn();
                        $('#vendor-list').html(data);
                    }


                });
            } else {
                $('#vendor-list').fadeOut();
                $('#vendor-list').html("");

            }

        });
        $(document).on('click', 'li', function() {
            $('#vendor').val($(this).text());
            $('#vendor-list').fadeOut();

        });
    });
</script>