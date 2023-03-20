
        
        




<nav>
            <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" 
                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                        aria-selected="true">Personal Details</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" 
                        data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" 
                        aria-selected="false">Flight Details</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" 
                        data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" 
                        aria-selected="false">Vehicle Details</button>
                <button class="nav-link" id="nav-travel-tab" data-bs-toggle="tab" 
                        data-bs-target="#nav-travel" type="button" role="tab" aria-controls="nav-contact" 
                        aria-selected="false">Travel Details</button>
                <button class="nav-link" id="nav-special-tab" data-bs-toggle="tab" 
                        data-bs-target="#nav-special" type="button" role="tab" aria-controls="nav-contact" 
                        aria-selected="false">Special Instruction</button>
                <button class="nav-link" id="nav-shift-tab" data-bs-toggle="tab" 
                        data-bs-target="#nav-shift" type="button" role="tab" aria-controls="nav-contact" 
                        aria-selected="false">Shift Booking</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row">
                <div class="col-2">
                    <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select class="form-control select2" style="width: 100%;" name="title" id="title">
                            <option value="mr" <?php echo ($title == 'mr')  ? 'selected' : '' ?>>Mr.</option>
                            <option value="ms" <?php echo ($title == 'ms')  ? 'selected' : '' ?>>Ms.</option>
                            <option value="mrs" <?php echo ($title == 'mrs')  ? 'selected' : '' ?>>Mrs.</option>
                        </select>
                        <span class="validationFail">Please select title</span>
                    </div>
                </div>
                <div class="col-2">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" id ="first_name" name="first_name" value="{{$first_name}}">
                    <span class="validationFail">Please select first name</span>
                </div>
                </div>
                <div class="col-2">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" id ="last_name" name="last_name" value="{{$last_name}}">
                    <span class="validationFail">Please select last name</span>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id ="email" name="email" value="{{$email}}">
                    <span class="validationFail">Please select email</span>
                </div>
                </div>
                <div class="col-2">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" id ="mobile" name="mobile" value="{{$mobile}}">
                    <span class="validationFail">Please select mobile</span>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                <div class="form-group">
                    <label>City/ Town</label>
                    <input type="text" class="form-control" id ="city_town" name="city_town" placeholder="Enter city">
                    <span class="validationFail">Please select city/ Town</span>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" id ="address" name="address" placeholder="Enter address">
                    <span class="validationFail">Please select address</span>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" id ="country" name="country" placeholder="Enter country">
                    <span class="validationFail">Please select country</span>
                </div>
                </div>
                <div class="col-2">
                <div class="form-group">
                    <label>Postcode</label>
                    <input type="text" class="form-control" id ="postcode" name="postcode" placeholder="Enter postcode">
                    <span class="validationFail">Please select postcode</span>
                </div>
                </div>
            </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label for="drop_off_terminal">Drop-off Terminal</label>
                    <select class="form-control select2" style="width: 100%;" name="drop_off_terminal" id="drop_off_terminal">
                        <option value="tbc" <?php echo ($drop_off_terminal == 'tbc')  ? 'selected' : '' ?>>TBC</option>
                        <option value="main_terminal" <?php echo ($drop_off_terminal == 'main_terminal')  ? 'selected' : '' ?>>Main Terminal</option>
                    </select>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label for="return_terminal">Return Terminal</label>
                    <select class="form-control select2" style="width: 100%;" name="return_terminal" id="return_terminal">
                        <option value="tbc" <?php echo ($return_terminal == 'tbc')  ? 'selected' : '' ?>>TBC</option>
                        <option value="main_terminal" <?php echo ($return_terminal == 'main_terminal')  ? 'selected' : '' ?>>Main Terminal</option>
                    </select>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label for="flight_number">Flight Number</label>
                    <input type="text" class="form-control" placeholder="Enter vehicle colour" name="flight_number" id="flight_number" value="{{ $flight_number }}">
                    <span class="validationFail">Please select flight number</span>
                </div>
                </div>
            </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row">
                    <div class="col-3">
                    <div class="form-group">
                        <label for="vehicle_make">Vehicle Make</label>
                        <input type="text" class="form-control" placeholder="Enter vehicle make" name="vehicle_make" id="vehicle_make" value="{{ $vehicle['vehicle_make'] }}">
                        <span class="validationFail">Please select vehicle make</span>
                    </div>
                    </div>
                    <div class="col-3">
                    <div class="form-group">
                        <label for="vehicle_model">Vehicle Model</label>
                        <input type="text" class="form-control" placeholder="Enter vehicle model" name="vehicle_model" id="vehicle_model" value="{{ $vehicle['vehicle_model'] }}">
                        <span class="validationFail">Please select vehicle model</span>
                    </div>
                    </div>
                    <div class="col-3">
                    <div class="form-group">
                        <label for="vehicle_colour">Vehicle Colour</label>
                        <input type="text" class="form-control" placeholder="Enter vehicle colour" name="vehicle_colour" id="vehicle_colour" value="{{ $vehicle['vehicle_colour'] }}">
                        <span class="validationFail">Please select vehicle colour</span>
                    </div>
                    </div>
                    <div class="col-3">
                    <div class="form-group">
                        <label for="vehicle_reg">Vehicle Reg #</label>
                        <input type="text" class="form-control" placeholder="Enter vehicle reg" name="vehicle_reg" id="vehicle_reg" value="{{ $vehicle['vehicle_reg'] }}">
                        <span class="validationFail">Please select vehicle reg.</span>
                    </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-travel" role="tabpanel" aria-labelledby="nav-travel-tab">
                <!-- travels details -->
                <div class="row">
                    <div class="col-3">
                    <div class="form-group">
                        <label for="name">Departure Date</label>
                        <input type="date" class="form-control" min="{{ now()->format('Y-m-d')  }}" name ="dep_date" placeholder="Select departure date" id="dep_date" value="{{ $dep_date }}">
                        <span class="validationFail">Please select departure date</span>
                    </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="return_date">Arrival Date</label>
                            <input type="date" class="form-control" min="{{ now()->format('Y-m-d')  }}" name ="return_date" id="return_date" value="{{ $return_date }}">
                            <span class="validationFail">Please select arrival date</span>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="name">Departure Time</label>
                            <select class="form-control" name="dep_time" id="dep_time">
                                <option value="">Select time</option>
                                @foreach(config('constant.TIME_INTERVAL') as $time_key => $time_value)
                                <option value="{{$time_value}}" <?php echo ($dep_time == $time_value)  ? 'selected' : '' ?>>{{$time_value}}</option>
                                @endforeach
                            </select>
                            <span class="validationFail">Please select departure time</span>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="return_time">Arrival Time</label>
                            <select class="form-control last_option" name="return_time" id="return_time">
                            <option value="">Select time</option>
                            @foreach(config('constant.TIME_INTERVAL') as $time_key => $time_value)
                                <option value="{{$time_value}}" <?php echo ($return_time == $time_value)  ? 'selected' : '' ?>>{{$time_value}}</option>
                            @endforeach
                            </select>
                            <span class="validationFail">Please select arrival time</span>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="price">Quote Price</label>
                            <input type="text" class="form-control" placeholder="Enter price" name="price" id="price" value="{{ $price }}">
                            <span class="validationFail">Please select price</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-special" role="tabpanel" aria-labelledby="nav-special-tab">
                <label for="special_notes">Special Notes</label>
                <textarea class="w-100" name="special_notes" id="special_notes" rows="5"></textarea>
                <span class="validationFail">Please write some special notes</span>
            </div>
            <div class="tab-pane fade" id="nav-shift" role="tabpanel" aria-labelledby="nav-shift-tab">
                <div class="form-group">
                    <label for="model_company">Select Company</label>
                    <select class="form-control select2" name ="company" id ="model_company">
                        <option value="">Select company</option>
                        @foreach($all_companies as $key => $value )
                            <option value="{{$value['id']}}" <?php echo ($company_id == $value['id'])  ? 'selected' : '' ?>>{{$value['company_title']}}</option>
                        @endforeach                              
                    </select>
                    <span class="validationFail">Please select company</span>
                </div>
            </div>
        </div>