@extends('layouts/layout')

@section('content')
	<div style="height:50px;"></div>

	@if($page=='signup')
		<div class="row">
		    <div class="col-md-6 col-md-offset-3">
		        <div class="login-panel panel panel-default">
		            <div class="panel-heading">
		                <h3 class="panel-title">Please complete your registration.</h3>
		            </div>
		            <div class="panel-body">
		        		<div class="col-xs-6 col-sm-3 placeholder">
			              	<img src="{{{ $profilePictureLarge }}}" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
			            </div>
		                <form role="form" method="POST" action="{{{ URL::route('linkedin_complete_post') }}}" accept-charset="UTF-8">
		                	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		                	<input type="hidden" name="profilePicture" value="{{{ $profilePictureLarge }}}">
		                    <fieldset>
		                        <div class="form-group">
		                            <input class="form-control" placeholder="First Name" id="data-registration-firstName" value="{{{ $firstName }}}" disabled>
		                        	<input type="hidden" name="firstname" value="{{ $firstName }}">
		                        </div>
		                        <div class="form-group">
		                            <input class="form-control" placeholder="Last Name" id="data-registration-lastName" value="{{{ $lastName }}}" disabled>
		                        	<input type="hidden" name="lastname" value="{{ $lastName }}">
		                        </div>
		                        <div class="form-group">
		                            <input class="form-control" placeholder="Email" id="data-registration-email" value="{{{ $emailAddress }}}" disabled>
		                        	<input type="hidden" name="email" value="{{ $emailAddress }}">
		                        </div>
		                        <div class="form-group">
		                            <input class="form-control" placeholder="Phone Number" id="data-registration-phone" name="phone" type="text">
		                        </div>
		                        <div class="form-group">
		                            <select name="college" id="data-registration-institution" class="form-control">
									  	<option value="1">National Institute of Technology, Agartala</option>
										<option value="2">Motilal Nehru National Institute of Technology, Allahabad</option>
										<option value="3">Maulana Azad National Institute of Technology, Bhopal</option>
										<option value="4">National Institute of Technology, Calicut</option>
										<option value="5">National Institute of Technology, Durgapur</option>
										<option value="6">National Institute of Technology, Hamirpur</option>
										<option value="7">Malaviya National Institute of Technology, Jaipur</option>
										<option value="8">Dr.B.R.Ambedkar National Institute of Technology, Jalandhar</option>
										<option value="9">National Institute of Technology, Jamshedpur</option>
										<option value="10">National Institute of Technology, Kurukshetra</option>
										<option value="11">Visvesvaraya National Institute of Technology, Nagpur</option>
										<option value="12">National Institute of Technology, Patna</option>
										<option value="13">National Institute of Technology, Raipur</option>
										<option value="14">National Institute of Technology, Rourkela</option>
										<option value="15">National Institute of Technology, Silchar</option>
										<option value="16">National Institute of Technology, Srinagar</option>
										<option value="17">S V National Institute of Technology, Surat</option>
										<option value="18">National Institute of Technology Karnataka, Surathkal</option>
										<option value="19">National Institute of Technology, Trichy</option>
										<option value="20">National Institute of Technology, Tadepalligudem</option>
										<option value="21">National Institute of Technology, Warangal</option>
										<option value="22">National Institute of Technology, Arunachal Pradesh (Yupia)</option>
										<option value="23">National Institute of Technology Sikkim</option>
										<option value="24">National Institute of Technology, Goa</option>
										<option value="25">National Institute of Technology, Meghalaya</option>
										<option value="26">National Institute of Technology, Nagaland</option>
										<option value="27">National Institute of Technology, Manipur</option>
										<option value="28">National Institute of Technology Mizoram</option>
										<option value="29">National Institute of Technology Uttarakhand</option>
										<option value="20">National Institute of Technology, Delhi</option>
										<option value="21">National Institute of Technology, Pondicherry</option>
									</select>
		                        </div>
		                        <div class="form-group">
		                            <select name="department" id="data-registration-department" class="form-control">
		                            	<option value="1">Department of Architecture</option>
										<option value="2">Department of Chemical Engineering</option>
										<option value="3">Department of CDepartment of hemistry</option>
										<option value="4">Department of Civil Engineering</option>
										<option value="5">Department of Computer Science & Engineering</option>
										<option value="6">Department of Electrical Engineering</option>
										<option value="7">Department of Electronics & Communication Engineering</option>
										<option value="8">Department of Mathematics</option>
										<option value="9">Department of Mechanical Engineering</option>
										<option value="10">Department of Physics</option>
										<option value="11">Department of Training Placement</option>
										<option value="12">Department of Physical Education</option>
									</select>
		                        </div>
		                        <div class="form-group">
		                            <select name="position" id="data-registration-position" class="form-control">
		                            	<option value="1">Professor</option>
		                            	<option value="2">Associate Professor</option>
		                            	<option value="3">Assistant Professor</option>
		                  				<option value="4">Ad-hoc</option>
		                            	<option value="5">Adjunct Associate Professor</option>
		                            	<option value="6">Adjunct Professor</option>
		                            	<option value="7">Student</option>
		                            </select>
		                        </div>
		                        <div class="form-group">
		                            <input class="form-control" placeholder="Phone Number" id="data-linkedin-profile" type="text" value="{{{ $linkedinProfile }}}" disabled>
		                            <input type="hidden" name="linkedin" value="{{ $linkedinProfile }}">
		                        </div>
		                        <div class="form-group">
		                            <input class="form-control" placeholder="Facebook-URL" id="data-facebook-profile" name="facebook" type="text">
		                        </div>
		                        <input type="hidden" name="linkedin_id" value="{{ $id }}">

		                        
		                    </fieldset>
		                    <button type="submit" class="btn btn-lg btn-info btn-block">Complete Registration <span class="glyphicon glyphicon-chevron-right"></span></button>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
	@endif
@stop