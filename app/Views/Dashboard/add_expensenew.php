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
                        <form action="#" class="horizontal-form">
                            <div class="form-body">
                                <!-- <h3 class="form-section">Person Info</h3> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Vendors</label>
                                            <input type="text" id="ExpenseName" class="form-control" placeholder="Enter Vendor's name">
                                            <span class="help-block"> This is inline help </span>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-error">
                                            <label class="control-label">Bill Upload</label>
                                            <input type="file" id="billDetails" class="form-control" placeholder="Upload the bill details" multiple>
                                            <span class="help-block"> This field has error. </span>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row" style="padding-bottom: 2rem;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Process</label>
                                            <select class="form-control" data-placeholder="Choose a Process" tabindex="1">
                                                <option value="Category 1">UK</option>
                                                <option value="Category 2">USA</option>
                                                <option value="Category 3">CANADA</option>
                                                <option value="Category 4">DOMESTIC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="Category 1">Utilities</option>
                                                <option value="Category 2">Grocery</option>
                                                <option value="Category 3">Supplies</option>
                                                <option value="Category 4">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row" style="padding-top:2rem; border-top: 1px solid #e7ecf1;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Add Items</label><br>
                                            <form method="post">
                                                <div id="itemRows">
                                                    Item Name: <input class="form-control input-small" type="text" name="add_name" style="display: inline-block;" /> Price: <input class="form-control input-xsmall" type="text" name="add_price" size="4" style="display: inline-block;" />
                                                    <input onclick="addRow(this.form);" type="button" value="Add row" /><br>
                                                </div>
                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Total Amount</label><br>
                                            <div class="amount-currency" style="display: inline-flex;">
                                                <select class="form-control input-xsmall" data-placeholder="Choose a Category" tabindex="1" style="border-radius: 4px 0 0 4px;">
                                                    <option value="Category 1">£</option>
                                                    <option value="Category 1">$</option>
                                                    <option value="Category 2">₹</option>
                                                </select>
                                                <input class="form-control" type="number" autocomplete="off" placeholder="Total Amount" style="border-radius: 0 4px 4px 0;" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>
                            <div class="form-actions left">
                                <button type="button" id="button-tos" class="btn default">Cancel</button>
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
</script>
<!-- END CONTAINER -->
<?= $this->include('includes/footer.php'); ?>