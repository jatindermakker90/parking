<div class="row col-12">
  <div class="col-sm-12">
    <input type="hidden" name="id" value="{{ $id }}">
    <div class="form-group">
        <label for="company_id">Company Name</label>
        <select class="form-control select2" style="width: 100%;" name="company_id" id="company_id">
            <option value="">Select company</option>
            @foreach ($all_companies as $companies_key => $companies_value)
                <option value="{{ $companies_value->id }}" {{ $company_id == $companies_value->id ? 'selected' : '' }}>{{ $companies_value->company_title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="date">Select Start Date</label>
        <input type="date" class="form-control" name="date" id="date" value="{{ $date }}">
    </div>
    <div class="form-group">
      <label>Journey Type {{ $journey_type }}</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" <?php echo ($journey_type == 'arrival') ? 'checked' : '' ?> type="radio" id="modalCustomRadio1" name="modal_journey_type" value="arrival">
        <label for="modalCustomRadio1" class="custom-control-label">Arrival</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" <?php echo ($journey_type == 'departure') ? 'checked' : '' ?> type="radio" id="modalCustomRadio2" name="modal_journey_type" value="departure">
        <label for="modalCustomRadio2" class="custom-control-label">Departure</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" <?php echo ($journey_type == 'both') ? 'checked' : '' ?> type="radio" id="modalCustomRadio3" name="modal_journey_type" value="both">
        <label for="modalCustomRadio3" class="custom-control-label">Both</label>
      </div>
    </div>
    <div class="form-group">
      <label>Status</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" <?php echo ($status) ? 'checked' : '' ?> type="radio" id="="="modal-status1" name="modal_status" value="active">
        <label for="="="modal-status1" class="custom-control-label">Active</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" <?php echo (!$status) ? 'checked' : '' ?> type="radio" id="modal-status2" name="modal_status" value="unactive">
        <label for="modal-status2" class="custom-control-label">Unactive</label>
      </div>
    </div>
  </div>
</div>