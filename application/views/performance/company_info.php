<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style type="text/css">
	.wizard {
	    margin: 20px auto;
	    background: #fff;
	}

	    .wizard .nav-tabs1 {
	        position: relative;
	        margin: 40px auto;
	        margin-bottom: 0;
	        border-bottom-color: #e0e0e0;
	    }

	    .wizard > div.wizard-inner {
	        position: relative;
	    }

	.connecting-line {
	    height: 2px;
	    background: #e0e0e0;
	    position: absolute;
	    width: 80%;
	    margin: 0 auto;
	    left: 0;
	    right: 0;
	    top: 35%;
	    z-index: 1;
	}

	.wizard .nav-tabs1 > li.active > a, .wizard .nav-tabs1 > li.active > a:hover, .wizard .nav-tabs1 > li.active > a:focus {
	    color: #555555;
	    cursor: default;
	    border: 0;
	    border-bottom-color: transparent;
	}

	span.round-tab {
	    width: 70px;
	    height: 70px;
	    line-height: 70px;
	    display: inline-block;
	    border-radius: 100px;
	    background: #fff;
	    border: 2px solid #e0e0e0;
	    z-index: 2;
	    position: absolute;
	    left: 0;
	    text-align: center;
	    font-size: 25px;
	}
	span.round-tab i{
	    color:#555555;
	}
	.wizard li.active span.round-tab {
	    background: #fff;
	    border: 2px solid #5bc0de;
	    
	}
	.wizard li.active span.round-tab i{
	    color: #5bc0de;
	}

	span.round-tab:hover {
	    color: #333;
	    border: 2px solid #333;
	}

	.wizard .nav-tabs1 > li {
	    width: 14%;
	    float: left;
	}

	.wizard li:after {
	    content: " ";
	    position: absolute;
	    left: 46%;
	    opacity: 0;
	    margin: 0 auto;
	    bottom: 0px;
	    border: 5px solid transparent;
	    border-bottom-color: #5bc0de;
	    transition: 0.1s ease-in-out;
	}

	.wizard li.active:after {
	    content: " ";
	    position: absolute;
	    left: 46%;
	    opacity: 1;
	    margin: 0 auto;
	    bottom: 0px;
	    border: 10px solid transparent;
	    border-bottom-color: #5bc0de;
	}

	.wizard .nav-tabs1 > li a {
	    width: 70px;
	    height: 70px;
	    margin: 20px auto;
	    border-radius: 100%;
	    padding: 0;
	}

	    .wizard .nav-tabs1 > li a:hover {
	        background: transparent;
	    }

	.wizard .tab-pane {
	    position: relative;
	    padding-top: 50px;
	}

	.wizard h3 {
	    margin-top: 0;
	}

	@media( max-width : 585px ) {

	    .wizard {
	        width: 90%;
	        height: auto !important;
	    }
	    .nav-tabs1{
	    	display: none;
	    }

	    span.round-tab {
	        font-size: 16px;
	        width: 50px;
	        height: 50px;
	        line-height: 50px;
	    }

	    .wizard .nav-tabs1 > li a {
	        width: 50px;
	        height: 50px;
	        line-height: 50px;
	    }

	    .wizard li.active:after {
	        content: " ";
	        position: absolute;
	        left: 35%;
	    }
	}
	.label-wizard{
		padding: 20px;
    	margin-top: -20px;
	}
	@import "compass/css3";
	  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
	      border: solid 1px #dcdcdc;
	    }

	  .table-editable {
	    position: relative;
	    
	    .glyphicon {
	      font-size: 20px;
	    }
	  }

	  .table-remove, .table-splan-remove, .table-splan3-remove, .table-cm-remove, .table-cnfunding-remove, .table-cnservices-remove, .table-financial_highlights-remove, .table-income-remove, .table-liquidity-remove, .table-activity-remove, .table-profitability-remove, .table-solvability-remove{
	    color: #e21b1b;
	    cursor: pointer;
	    float: right;
	    right: 2px;
	    
	    &:hover {
	      color: #f00;
	    }
	  }

	  .table-up, .table-down {
	    color: #007;
	    cursor: pointer;
	    
	    &:hover {
	      color: #00f;
	    }
	  }

	  /*.table-add, .table-splan-add, .table-splan3-add, .table-cm-add, .table-cnfunding-add, .table-cnservices-add, .table-financial_highlights-add, .table-liquidity-add, .table-activity-add, .table-income-add, .table-solvability-add, .table-profitability-add{
	    color: #070;
	    cursor: pointer;
	    position: absolute;
	    top: 8px;
	    right: 10px;
	    
	    &:hover {
	      color: #0b0;
	    }
	  }*/
	  
		.step_descr{
			text-align: center;
		}

		#save, .info {
		  display: none;
		}

		.info {
		  color: #999;
		}
	  .my-group .form-control{
	      width:100%;
	  }

		textarea {
		  width: 100%;
		  min-height: 10px;
		  resize: vertical;
		  margin: 0;
		  padding: 2px;
		}
	  .txt {
	    padding: 10px;
	  }
	  .txt:read-write:focus {
	    background: #fff;
	    border: 2px solid #006699;

	  }
	  .mid {
	      text-align: center;
	  }
	  span.multiselect-native-select {
	    position: relative
	  }
	  span.multiselect-native-select select {
	    border: 0!important;
	    clip: rect(0 0 0 0)!important;
	    height: 1px!important;
	    margin: -1px -1px -1px -3px!important;
	    overflow: hidden!important;
	    padding: 0!important;
	    position: absolute!important;
	    width: 1px!important;
	    left: 50%;
	    top: 30px
	  }
	  .multiselect-container {
	    position: absolute;
	    list-style-type: none;
	    top: -50px;
	    width: 350px;
	    /*margin: 0;
	    padding: 0*/
	  }
	  .multiselect-container>li {
	    width: 100%;
	  }
	  .multiselect-container .input-group {
	    margin: -25px
	  }
	  .multiselect-container>li {
	    padding: 0
	  }
	  .multiselect-container>li>a.multiselect-all label {
	    font-weight: 700
	  }
	  .multiselect-container>li.multiselect-group label {
	    margin: 0;
	    padding: 3px 20px 3px 20px;
	    height: 100%;
	    font-weight: 700
	  }
	  .multiselect-container>li.multiselect-group-clickable label {
	    cursor: pointer
	  }
	  .multiselect-container>li>a {
	    padding: 0
	  }
	  .multiselect-container>li>a>label {
	    margin: 0;
	    height: 100%;
	    cursor: pointer;
	    font-weight: 400;
	    padding: 3px 0 3px 30px
	  }
	  .multiselect-container>li>a>label.radio, .multiselect-container>li>a>label.checkbox {
	    margin: 0
	  }
	  .multiselect-container>li>a>label>input[type=checkbox] {
	    margin-bottom: 5px
	  }
	  .btn-group>.btn-group:nth-child(2)>.multiselect.btn {
	    border-top-left-radius: 4px;
	    border-bottom-left-radius: 4px
	  }
	  .form-inline .multiselect-container label.checkbox, .form-inline .multiselect-container label.radio {
	    padding: 3px 20px 3px 40px
	  }
	  .form-inline .multiselect-container li a label.checkbox input[type=checkbox], .form-inline .multiselect-container li a label.radio input[type=radio] {
	    margin-left: -20px;
	    margin-right: 0
	  }
	  .btn-chk{
	    background: none;
	    border:none;
	  }
	  .btn-annual{
	    float: right;
	  }
	  ._content{
	    border: 1px solid #dcdcdc;
	    background: #fff;
	    margin-top: -11px;
	  }
	  ul.bar_tabs {
	    background: none; 
	     padding-left: 0px; 
	    position: relative;
	    z-index: 1;
	    width: 100%;
	    border-bottom: 1px solid #E6E9ED;
	  }
	  ul.bar_tabs>li {
	    color: #333!important;
	    margin-top: -17px;
	    margin-left: 0px; 
	    background: #dcdcdc;
	  }
	  ul.bar_tabs>li a {
	    background: #ffffff;
	  }
	  ul.bar_tabs>li.active a {
	    border-bottom: none;
	    background: #dcdcdc;
	  }
	  ul.bar_tabs>li.active {
	     border-right: none ;
	     background: #dcdcdc;
	  }
	  .table-editable{
	    margin-top: 20px;
	  }
	  .tab-btn{
	  	padding: 20px;
	    background: #b8cbde;
	    width: 100%;
	    text-align: center;
	  }

</style>
<div class="right_col" role="main">
	
    <div class="container">
    	<div class="1" style="margin-bottom: -40px;">
			<div class="x_title" style="text-transform: uppercase; padding: 20px; background: #2a3f54; color: #fff;">
			    <div class="col-lg-6 col-xs-12">
			      <b style="text-transform: uppercase;">
			        <h4>ACCOUNT PLANNING</h4>
			        PT Sinarmas Group
			      </b>  
			    </div>
			    <div class="col-lg-2 col-xs-12">
			    	<br>Date : </br><b>1 jan 2018 </b>
			    </div>
			    <div class="col-lg-2 col-xs-12">
			    	<br>Division : </br><b>Agribisnis </b>
			    </div>
			    <div class="col-lg-2 col-xs-12">
			    	<br>Clasification: </br><b>Silver </b>
			    </div>
			    <div class="clearfix"></div>
			</div>
		</div>
		<div class="1">
			<section>
	        <div class="wizard">
	            <div class="wizard-inner">
	                <div class="connecting-line"></div>
	                <ul class="nav nav-tabs1" role="tablist">

	                    <li role="presentation" class="active">
	                        <a href="#step1" data-toggle="tab" aria-controls="Company Information" role="tab" title="Company Information">
	                            <span class="round-tab">
	                                <i class="fa fa-building"></i>
	                            </span>
	                        </a>
	                        <div class="label-wizard">
	                        	<center>Company Information</center>
	                        </div>
	                    </li>

	                    <li role="presentation" class="disabled">
	                        <a href="#step2" data-toggle="tab" aria-controls="bri" role="tab" title="BRI Starting Position">
	                            <span class="round-tab">
	                                <i class="fa fa-users"></i>
	                            </span>
	                        </a>
	                        <div class="label-wizard">
	                        	<center>BRI Starting Position</center>
	                        </div>
	                    </li>
	                    <li role="presentation" class="disabled">
	                        <a href="#step3" data-toggle="tab" aria-controls="Client Needs" role="tab" title="Client Needs">
	                            <span class="round-tab">
	                                <i class="fa fa-user"></i>
	                            </span>
	                        </a>
	                        <div class="label-wizard">
	                        	<center>Client <br>Needs</center>
	                        </div>
	                    </li>
	                    <li role="presentation" class="disabled">
	                        <a href="#step4" data-toggle="tab" aria-controls="Action Plan" role="tab" title="Action Plan">
	                            <span class="round-tab">
	                                <i class="fa fa-sitemap"></i>
	                            </span>
	                        </a>
	                        <div class="label-wizard">
	                        	<center>Action <br>Plan</center>
	                        </div>
	                    </li>
	                    <li role="presentation" class="disabled">
	                        <a href="#step5" data-toggle="tab" aria-controls="Input _" role="tab" title="Input _">
	                            <span class="round-tab">
	                                <i class="fa fa-file"></i>
	                            </span>
	                        </a>
	                        <div class="label-wizard">
	                        	<center>Input_</center>
	                        </div>
	                    </li>
	                    <li role="presentation" class="disabled">
	                        <a href="#step6" data-toggle="tab" aria-controls="Simulation" role="tab" title="Simulation">
	                            <span class="round-tab">
	                                <i class="fa fa-superscript"></i>
	                            </span>
	                        </a>
	                        <div class="label-wizard">
	                        	<center>Simulasi<br>CPA</center>
	                        </div>
	                    </li>

	                    <li role="presentation" class="disabled">
	                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
	                            <span class="round-tab">
	                                <i class="glyphicon glyphicon-ok"></i>
	                            </span>
	                        </a>
	                        <div class="label-wizard">
	                        	<center>Status</center>
	                        </div>
	                    </li>
	                </ul>
	            </div>

	            <div>
	                <div class="tab-content">
	                    <div class="tab-pane active" role="tabpanel" id="step1">
	                        <?php $this->load->view('performance/company/company_information.php'); ?>
	                        <ul class="list-inline pull-right tab-btn">
	                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="step2">
	                        <?php $this->load->view('performance/company/bri_starting/bri_starting.php'); ?>
	                        <ul class="list-inline pull-right tab-btn">
	                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
	                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="step3">
	                        <?php $this->load->view('performance/company/client_needs.php'); ?>
	                        <ul class="list-inline pull-right tab-btn">
	                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
	                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="step4">
	                        <?php $this->load->view('performance/company/action_plan.php'); ?>
	                        <ul class="list-inline pull-right tab-btn">
	                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
	                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="step5">
	                        <?php $this->load->view('performance/company/input_.php'); ?>
	                        <ul class="list-inline pull-right tab-btn">
	                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
	                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="step6">
	                        <?php $this->load->view('performance/company/simulasi.php'); ?>
	                        <ul class="list-inline pull-right tab-btn">
	                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
	                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
	                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Next Step</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="complete">
	                        <h3>Complete</h3>
	                        <p>You have successfully completed all steps.</p>
	                        <ul class="list-inline pull-right">
	                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
	                        </ul>
	                    </div>
	                    <div class="clearfix"></div>
	                </div>
	            </div>
	        </div>
	    </section>
	   </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
    //Initialize tooltips
	    $('.nav-tabs1 > li a[title]').tooltip();
	    
	    //Wizard
	    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

	        var $target = $(e.target);
	    
	        if ($target.parent().hasClass('disabled')) {
	            return false;
	        }
	    });

	    $(".next-step").click(function (e) {

	        var $active = $('.wizard .nav-tabs1 li.active');
	        $active.next().removeClass('disabled');
	        nextTab($active);

	    });
	    $(".prev-step").click(function (e) {

	        var $active = $('.wizard .nav-tabs1 li.active');
	        prevTab($active);

	    });
	});

	function nextTab(elem) {
	    $(elem).next().find('a[data-toggle="tab"]').click();
	}
	function prevTab(elem) {
	    $(elem).prev().find('a[data-toggle="tab"]').click();
	}
</script>
<script type="text/javascript">
	var el = document.getElementsByTagName('td')[0];
	var range = document.createRange();
	var sel = window.getSelection();
	range.setStart(el.childNodes[0], 2);
	range.collapse(true);
	sel.removeAllRanges();
	sel.addRange(range);
	el.focus();
</script>
<?php $this->load->view('performance/company/assets.php'); ?>