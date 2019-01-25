<?php
/* @var $this yii\web\View */
//echo $user_id = Yii::$app->session->get('userId'); exit;


?>

<!-- Note: The background image is set within the uturn-casual -->


<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="page_title col-lg-12">My Account</div>
        <div class="col-lg-8 col-md-12 content_wrap">
            <h3 class="green_txt">Hello <?php echo $model->first_name; ?>! <br/>You can manage your account here.</h3>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 left_space">

                        <div class="tabs_wrap_box tabs_wrap_box_combos">
                            <ul class="tabs_wrap">
                                <li class="active"><a href="#">Dashboard</a></li>
                                <li><a href="#">My SIM</a></li>
                                <li><a href="#">My Plan</a></li>
                                <li><a href="#">My Device</a></li>
                            </ul>

                            <div class="dashboard_info_holder">
                                <div class="data_info">Account : <?php echo $model->id; ?></div>
                                <div class="user_ac_info_wrap">
                                    <div class="user_ac_info">
                                        <div class="col-lg-2 user_info_heading">Name</div>
                                        <div class="col-lg-10 user_info_txt"><?php echo $model->first_name . ' ' . $model->last_name; ?></div>
                                        <div class="cb"></div>
                                    </div>
                                    <div class="user_ac_info">
                                        <div class="col-lg-2 user_info_heading">Address</div>
										<?php
										$address1 = $model->billing_address1 != '' ? $model->billing_address1 . ', ' : '';
										$address2 = $model->billing_address2 != '' ? $model->billing_address2 . ', ' : '';
										$suburb = $model->billing_suburb != '' ? $model->billing_suburb . ', ' : '';
										$city = $model->billing_city != '' ? $model->billing_city . ' ' : '';
										$postalcode = $model->billing_post_code != '' ? $model->billing_post_code : '';

										$userAddress = $address1 . $address2 . $suburb . $city . $postalcode;

										?>
                                        <div class="col-lg-10 user_info_txt"><?php echo $userAddress; ?></div>
                                        <div class="cb"></div>
                                    </div>
                                    <div class="user_ac_info">
                                        <div class="col-lg-2 user_info_heading">Phone</div>
                                        <div class="col-lg-10 user_info_txt"><?php echo $model->contact_number != '' ? $model->contact_number : ''; ?></div>
                                        <div class="cb"></div>
                                    </div>
                                    <div class="user_ac_info">
                                        <div class="col-lg-2 user_info_heading">Email</div>
                                        <div class="col-lg-10 user_info_txt"><?php echo $model->email != '' ? $model->email : ''; ?></div>
                                        <div class="cb"></div>
                                    </div>
                                    <button class="btn btn-primary darkblue_btn" type="button">Update</button>
                                    <button class="btn btn-primary darkblue_btn" type="button">Activate</button>
                                </div>

                                <div class="maintable">
                                    <ul class="table_heading">
                                        <li>Subscriber ID</li>
                                        <li>Phone Number</li>
                                        <li>Subscriber Name</li>
                                        <li>Handset</li>
                                        <li>Action</li>
                                    </ul>
                                    <ul class="table_info_txt">
                                        <li>123</li>
                                        <li>1234567890</li>
                                        <li>Fay Rose</li>
                                        <li>
                                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/frontend/web/images/dummy_phone.png"
                                                 alt=""/><br/> Blueskyphone
                                        </li>
                                        <li>
                                            <button class="btn btn-primary darkblue_btn" type="button">Top Up</button>
                                        </li>
                                    </ul>
                                </div>
                            </div><!--dashboard_info_holder-->
                            <div class="cb"></div>
                        </div>
                        <button class="btn btn-primary darkblue_btn fr bot_space" type="button">Check Phone
                            Compatibilty?
                        </button>


                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- /.row -->


    <!-- Footer -->

</div>
